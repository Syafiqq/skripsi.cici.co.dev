<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class View extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (($this->session->userdata('iduser') == null) || ($this->session->userdata('role') != 'Kader')) {
            redirect('login');
        }
    }

    public function index() {
        $data['listpasien'] = $this->m_kader->getListPasien($this->session->userdata('id_users'));
        $this->load->view('kader/lihatpasien', $data);
    }

    public function profil() {
        $data['kecamatan'] = $this->m_index->kecamatan();
        $data['profil'] = $this->m_kader->getKader($this->session->userdata('id_users'));
        $this->load->view('kader/profil', $data);
    }

    public function riwayat($id) {
        $data['listriwayat'] = $this->m_kader->getListRiwayatPasien($id);
        $this->load->view('kader/lihatriwayat', $data);
    }

    public function petunjuk() {
        $this->load->view('kader/petunjuk');
    }

}
