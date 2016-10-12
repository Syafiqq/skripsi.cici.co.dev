<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (($this->session->userdata('iduser') == null) || ($this->session->userdata('role') != 'Kader')) {
            redirect('login');
        }
    }

    public function pasien($id) {
        $this->m_kader->deletepasien($id);
        redirect('c_kader/lihatkader');
    }

    public function riwayat($id) {
        $this->m_kader->deleteriwayat($id);
        redirect('c_kader/lihatkader');
    }

}
