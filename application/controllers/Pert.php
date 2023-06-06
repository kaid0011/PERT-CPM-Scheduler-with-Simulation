<?php
class Pert extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Projects_model');
    }

    public function index()
    {
        $temp['title'] = 'Project Evaluation Review Technique (PERT)';
        $this->load->view('template/header', $temp);
        $this->load->view('pert/pert_main');
        $this->load->view('template/footer'); 
    }

    public function proj_details()
    {
        $len = $this->input->post('proj_len');
        $unit = $this->input->post('unit');
        $arr = array(
            'proj_len' => $len,
            'unit' => $unit,
            'd' => 'none'   //FOR DEMO PURPOSES ONLY
        );
        $this->session->set_userdata($arr);
        redirect('pert/projectdetails');
    }

    public function demo()
    {
        //FOR DEMO PURPOSES ONLY
        $d = $this->uri->segment(3);
        if($d == 'demo1') {
            $proj_len = 15;
        }
        else if($d == 'demo2') {
            $proj_len = 4;
        }
        else if ($d == 'demo3') {
            $proj_len = 4;
        }

        $arr = array(
            'd' => $d,
            'proj_len' => $proj_len,
            'unit' => 'Days'
        );
        $this->session->set_userdata($arr);
        redirect('pert/projectdetails');
    }

    public function projectdetails()
    {
        if(!$this->session->userdata("proj_len"))
        {
            redirect("Home");            
        }
        else 
        {
            $temp['title'] = 'Project Evaluation Review Technique (PERT)';
            $this->load->view('template/header', $temp);
            $this->load->view('pert/pert_input');
            $this->load->view('template/footer');
        }
    }

    public function calculate()
    {
        $proj_len = $this->input->post('proj_len');
        $ProjectID = $this->input->post('ProjectID');

        // ASSIGNING VALUES TO ARRAY
        for ($i = 1; $i <= $proj_len; $i++) {
            if($_SESSION['new'] == false) {
                $data[$i]['RecordID'] = $this->input->post('RecordID_' . $i);
            }
            $data[$i]['taskid'] = $this->input->post($i);
            $data[$i]['ProjectID'] = $ProjectID;
            $data[$i]['name'] = $this->input->post('task_name_' . $i);  // Task Name
            $data[$i]['desc'] = $this->input->post('task_desc_' . $i);
            $data[$i]['opt'] = $this->input->post('task_opt_' . $i);
            $data[$i]['ml'] = $this->input->post('task_ml_' . $i);
            $data[$i]['pes'] = $this->input->post('task_pes_' . $i);
            $data[$i]['time'] = 0;
            $data[$i]['unit'] = $this->input->post('unit');     // Unit
            if ($this->input->post('task_prereq_' . $i) != '-') {
                $data[$i]['prereq'] = explode(";", $this->input->post('task_prereq_' . $i));
            } else {
                $data[$i]['prereq'][] = -1;
            }
            $data[$i]['sd'] = 0;
            $data[$i]['v'] = 0;     // variance
            $data[$i]['es'] = 0;
            $data[$i]['ef'] = 0;
            $data[$i]['ls'] = 0;
            $data[$i]['lf'] = 0;
            $data[$i]['slack'] = 0;
            $data[$i]['isCritical'] = false;
            $data[$i]['priorityLvl'] = "Low"; // Critical task or not
            $data[$i]['type'] = "Parallel"; // Critical task or not
            $data[$i]['pqty'] = $proj_len;
        }
        $this->time($data);
    }

    public function time($data)
    {
        foreach ($data as $time)
        {
            $tid = $time['taskid'];
            $duration = ($time['opt'] + (4 * $time['ml']) + $time['pes']) / 6;              // compute task mean
            $data[$tid]['time'] = round($duration, 2);                                      // round mean to 2 decimal places
            $data[$tid]['sd'] = ($time['pes'] - $time['opt']) / 6;                          // compute task standard deviation
            $data[$tid]['v'] = pow($data[$tid]['sd'], 2);                                   // compute task variance
        }
        $this->forward_pass($data);     // proceed to forward pass
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
            $id = $tasks['taskid'];
            if (in_array("-1", $tasks['prereq'])) //check if first task
            {
                $data[$id]['es'] = 0;   //ES = 0
                $data[$id]['ef'] = $tasks['time'];   //EF = duration
            } else {    //if not first task
                foreach ($tasks['prereq'] as $prereq) {     // Loop through the prereq array of each task 
                    if ($prereq != '-1' and count($tasks['prereq']) == 1) {     // If only 1 prereq
                        $data[$id]['es'] = $data[$prereq]['ef'];                // ES = EF of prereq
                        $data[$id]['ef'] = $data[$id]['es'] + $tasks['time'];   // EF = ES + Duration
                    } elseif ($prereq != '-1') {        // If multiple prereqs
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
            $rdata[] = $data[$j];            // assign reversed $data array to $rdata
            $pre[] = $data[$j]['prereq'];    // assign all prereqs to $pre associative array
        }
        $merged_pre = call_user_func_array('array_merge', $pre);    // merge $pre array to easily locate if a task is a prereq of any task

        foreach ($rdata as $rtasks) {
            $rid = $rtasks['taskid'];
            if (in_array($rid, $merged_pre)) {
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
            } else {     // if not a prereq of any task
                $data[$rid]['lf'] = $data['finish_time'];
                // $data[$rid]['ls'] = $data[$rid]['lf'] - $rtasks['time'];
                $data[$rid]['ls'] = bcsub($data[$rid]['lf'], $rtasks['time'], 2);
            }
            //compute slack and if critical task
            //$data[$rid]['slack'] = $data[$rid]['lf'] - $data[$rid]['ef'];
            $data[$rid]['slack'] = bcsub($data[$rid]['lf'], $data[$rid]['ef'], 2);
            if ($data[$rid]['slack'] == 0) {
                $data[$rid]['isCritical'] = true;
                $data[$rid]['priorityLvl'] = "High";
                $data[$rid]['type'] = "Sequential";
            }
        }
        $this->show_result($data);  // proceed to show_result
    }

    public function show_result($data)
    {
        $proj_var = 0;
        $data['qty'] = count($data);
        for ($j = 1; $j < $data['qty']; $j++) {
            $data[$j]['prereq'] = implode(";", $data[$j]['prereq']);
            $project[] = $data[$j];
            $ProjectID = $data[$j]['ProjectID'];
            if ($data[$j]['isCritical'] == true)
            {
                $cp[] = $data[$j];
                $proj_var += $data[$j]['v'];    // add up variance of critical tasks to get project variance
            }
        }  

        //insert to db
        $this->Projects_model->insertPERT($project, $ProjectID);
        if(isset($_SESSION['new']) && $_SESSION['new'] == false)
        {
            $arr = array(
                'project' => $project,
                'cp' => $cp,
                'finish_time' => $data['finish_time'],
                'proj_variance' => $proj_var,
                'proj_sd' => sqrt($proj_var),
                'unit' => $data[1]['unit'],
                'new' => false
            );
        }
        else
        {
            $arr = array(
                'project' => $project,
                'cp' => $cp,
                'finish_time' => $data['finish_time'],
                'proj_variance' => $proj_var,
                'proj_sd' => sqrt($proj_var),
                'unit' => $data[1]['unit'],
                'new' => true
            );
        }
      
        $this->session->set_userdata($arr);
        redirect('pert/results');
    }

    public function results()
    {
        if(!$this->session->userdata("project"))
        {
            redirect("Home");            
        }
        else 
        {
            $temp['title'] = 'Project Evaluation Review Technique (PERT)';
            $this->load->view('template/header', $temp);
            $this->load->view('pert/pert_output');
            $this->load->view('template/footer'); 
        }
    }

    public function editpert()
    {
        if(!$this->session->userdata("project"))
        {
            redirect("Home");            
        }
        else 
        {
            $temp['title'] = 'Project Evaluation Review Technique (PERT)';
            $this->load->view('header', $temp);
            $this->load->view('pert/pert_edit');
            $this->load->view('footer'); 
        }
    }
}
?>