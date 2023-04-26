<?php
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('template/header');
        $this->load->view('home/homepage');
        $this->load->view('template/footer');
    }

    public function choose()
    {
        // to be removed laturrr
        $data['choice'] = $this->input->post('choice');
        $data['proj_len'] = $this->input->post('proj_len');
        $data['unit'] = $this->input->post('unit');
        $this->load->view('projectdetails', $data);
    }
}