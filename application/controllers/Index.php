<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('M_index');
        if (!$this->session->userdata('iduser') == null) {
            redirect('login');
        }
    }

    public function index() {
        $data['puskesmas'] = $this->M_index->countPuskesmas();
        $data['posbindu'] = $this->M_index->countPosbindu();
        $data['kader'] = $this->M_index->countKader();
        $data['pasien'] = $this->M_index->countPasien();
        $this->load->view('index', $data);
    }

    public function kenali() {
        $this->load->view('kenali');
    }

    public function pencegahan() {
        $this->load->view('pencegahan');
    }

    public function dampak() {
        $this->load->view('dampak');
    }

    public function tentang() {
        $this->load->view('tentang');
    }

    public function contact_us() {
        $this->load->view('contact-us');
    }
}
