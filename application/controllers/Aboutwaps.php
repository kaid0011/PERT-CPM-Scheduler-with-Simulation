<?php
class Aboutwaps extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $temp['title'] = 'WAPS with Simulation';
        $this->load->view('template/header', $temp);
        $this->load->view('aboutwaps');
        $this->load->view('template/footer');
    }
}
?>