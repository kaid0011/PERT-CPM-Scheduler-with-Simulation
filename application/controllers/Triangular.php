<?php
class Triangular extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {       
        $temp['title'] = 'Triangular Distribution';
        $this->load->view('template/header', $temp);
        $this->load->view('triangular/triangular_main');
        $this->load->view('template/footer'); 
    }

    public function proj_details()
    {
        $len = $this->input->post('proj_len');
        $unit = $this->input->post('unit');
        $arr = array(
            'proj_len' => $len,
            'unit' => $unit
        );
        $this->session->set_userdata($arr);
        redirect('triangular/projectdetails');
    }

    public function projectdetails()
    {
        if(!$this->session->userdata("proj_len"))
        {
            redirect("Home");            
        }
        else 
        {
            $temp['title'] = 'Triangular Distribution';
            $this->load->view('template/header', $temp);
            $this->load->view('triangular/triangular_input');
            $this->load->view('template/footer');
        }
    }

    public function calculate()
    {
        $proj_len = $this->input->post('proj_len');

        // ASSIGNING VALUES TO ARRAY
        for ($i = 1; $i <= $proj_len; $i++) {
            $data[$i]['id'] = $this->input->post($i);
            $data[$i]['desc'] = $this->input->post('task_desc_' . $i);
            $data[$i]['opt'] = $this->input->post('task_opt_' . $i);
            $data[$i]['ml'] = $this->input->post('task_ml_' . $i);
            $data[$i]['pes'] = $this->input->post('task_pes_' . $i);
            $data[$i]['time'] = 0;
            $data[$i]['unit'] = $this->input->post('unit');     // Unit
            if ($this->input->post('task_prereq_' . $i) != '-') {
                $data[$i]['prereq'] = explode(",", $this->input->post('task_prereq_' . $i));
            } else {
                $data[$i]['prereq'][] = -1;
            }
            // $data[$i]['sd'] = 0;
            $data[$i]['es'] = 0;
            $data[$i]['ef'] = 0;
            $data[$i]['ls'] = 0;
            $data[$i]['lf'] = 0;
            $data[$i]['slack'] = 0;
            $data[$i]['isCritical'] = "No";
            $data[$i]['N'] = $this->input->post('N');
            $data[$i]['pqty'] = $proj_len;
        }
        $this->alphabeta($data);
    }

    public function alphabeta($data)
    {
        foreach($data as $ab)
        {
            $id = $ab['id'];
            $a = $ab['opt'];
            $m = $ab['ml'];
            $b = $ab['pes'];
            $pd = 'tri';
            $N = $ab['N'];

            // Pass values to python to compute task duration
            // $command = escapeshellcmd("python pd.py $pd $a $m $b $N");
            // $output = shell_exec($command);

            for($k = 1; $k <= $N; $k++)
            {
                // $command = escapeshellcmd("python pd.py $pd $a $m $b $N");
                // $res = shell_exec($command);

                $r = rand() / getrandmax();
                if($r < (($m - $a) / ($b - $a)))
                {
                    $x = 1;
                    $y = -2 * $a;
                    $z = pow($a, 2) - $r * ($m - $a) * ($b - $a);
                    $res = ((-$y + sqrt((pow($y, 2)) - 4 * $x * $z)) / 2) / $x;
                }
                else
                {
                    $x = 1;
                    $y = -2 * $b;
                    $z = (pow($b, 2)) - (1 - $r) * ($b - $a) * ($b - $m);
                    $res = ((-$y - sqrt((pow($y, 2)) - 4 * $x * $z)) / 2) / $x;
                }

                $f = floatval($res);
                $sim_arr[$id][] = $f; 
                $data[$id]['sim_val'][] = $f;          
            }
            $t = array_sum($data[$id]['sim_val']) / count($data[$id]['sim_val']);

            $data[$id]['time'] = round($t, 2);     // assign task duration
        }
        $this->forward_pass($data); // proceed to forward pass
    }

    public function forward_pass($data)
    {
        /* 
            ---FORWARD PASS---
            EF = ES + T
            * If first task, EF = T

            ES = EF of prerequisite
            * If more than one prerequisite, get highest 
        */
        foreach ($data as $tasks) {
            $id = $tasks['id'];
            if (in_array("-1", $tasks['prereq'])) //check if first task
            {
                $data[$id]['es'] = 0;   //ES = 0
                $data[$id]['ef'] = $tasks['time'];      //EF = duration
            } else {    //if not first task
                foreach ($tasks['prereq'] as $prereq) {     // Loop through the prereq array of each task 
                    if ($prereq != '-1' and count($tasks['prereq']) == 1) {     // If only 1 prereq
                        $data[$id]['es'] = $data[$prereq]['ef'];                // ES = EF of prereq
                        $data[$id]['ef'] = $data[$id]['es'] + $tasks['time'];   // EF = ES + Duration
                    } elseif ($prereq != '-1') {    // If multiple prereqs
                        if ($data[$prereq]['ef'] > $data[$id]['es']) {      // if prereq's EF is greater than current task's ES
                            $data[$id]['es'] = $data[$prereq]['ef'];        // ES = EF of prereq
                            $data[$id]['ef'] = $data[$id]['es'] + $tasks['time'];   // EF = ES + duration
                        }
                    }
                }
            }
        }
        $data['finish_time'] = max(array_column($data, 'ef'));  //project finish time = maximum EF

        $this->backward_pass($data);    // proceed to backward pass
    }

    public function backward_pass($data)
    {
        /*
            ---BACKWARD PASS---
            LF
            * If not a prerequisite of any task, LF = Project Finish Time
            * Otherwise, LS of successor
            ** If multiple successors, get lowest

            LS = LF - T
        */

        // reverse $data array
        $cnt = count($data) - 1;
        $rdata = array();
        $pre = array();
        for ($j = $cnt; $j >= 1; $j--) {
            $rdata[] = $data[$j];           // assign reversed $data array to $rdata
            $pre[] = $data[$j]['prereq'];   // assign all prereqs to $pre associative array
        }
        $merged_pre = call_user_func_array('array_merge', $pre);    // merge $pre array to easily locate if a task is a prereq of any task

        foreach ($rdata as $rtasks) {
            $rid = $rtasks['id'];
            if (in_array($rid, $merged_pre)) {  // if current task is a prereq of any task
                $p = array_column($data, 'prereq');
                $key = '';
                foreach ($p as $k => $v) {
                    if (in_array($rid, $v)) {
                        $key = $k;
                        if ($data[$rid]['lf'] == 0) {   // if LF not yet computed
                            $data[$rid]['lf'] = $data[$key + 1]['ls'];
                            // $data[$rid]['ls'] = $data[$rid]['lf'] - $rtasks['time'];
                            $data[$rid]['ls'] = bcsub($data[$rid]['lf'], $rtasks['time'], 2);
                        }
                        if ($data[$rid]['lf'] > $data[$key + 1]['ls']) {    // if current task's LF is greater than succesor's LS
                            $data[$rid]['lf'] = $data[$key + 1]['ls'];
                            // $data[$rid]['ls'] = $data[$rid]['lf'] - $rtasks['time'];
                            $data[$rid]['ls'] = bcsub($data[$rid]['lf'], $rtasks['time'], 2);
                        }
                    }
                }
            } else {    // if not a prereq of any task
                $data[$rid]['lf'] = $data['finish_time'];
                // $data[$rid]['ls'] = $data[$rid]['lf'] - $rtasks['time'];
                $data[$rid]['ls'] = bcsub($data[$rid]['lf'], $rtasks['time'], 2);
            }
            //compute slack and if critical task
            //$data[$rid]['slack'] = $data[$rid]['lf'] - $data[$rid]['ef'];
            $data[$rid]['slack'] = bcsub($data[$rid]['lf'], $data[$rid]['ef'], 2);
            if ($data[$rid]['slack'] == 0) {
                $data[$rid]['isCritical'] = "Yes";
            }
        }
        $this->show_result($data);  // proceed to show_result
    }

    public function show_result($data)
    {
        $data['qty'] = count($data);
        for ($j = 1; $j < $data['qty']; $j++) {
            $project[] = $data[$j];
            if ($data[$j]['isCritical'] == "Yes")
            {
                $cp[] = $data[$j];
            }
        }
        $arr = array(
            'project' => $project,
            'cp' => $cp,
            'finish_time' => $data['finish_time'],
            'unit' => $data[1]['unit']
        );
        $this->session->set_userdata($arr);
        redirect('triangular/results');
    }

    public function results()
    {
        if(!$this->session->userdata("project"))
        {
            redirect("Home");            
        }
        else 
        {
            $temp['title'] = 'Triangular Distribution';
            $this->load->view('template/header', $temp);
            $this->load->view('triangular/triangular_output');
            $this->load->view('template/footer'); 
        }
    }
}



