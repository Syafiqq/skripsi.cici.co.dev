<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class View extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (($this->session->userdata('iduser') == null) || ($this->session->userdata('role') != 'Pegawai Dinkes')) {
            redirect('login');
        }
    }

    public function index() {
        $this->load->view('pegawai_dinkes/index');
    }

    public function profil() {
        $data['kecamatan'] = $this->m_index->kecamatan();
        $data['profil'] = $this->m_dinkes->getPegawaiById($this->session->userdata('id_users'));
        $this->load->view('pegawai_dinkes/profil', $data);
    }

    public function dinkes() {
        $this->load->view('pegawai_dinkes/profildinkes');
    }

    public function pegawai() {
        $data['listpegawai'] = $this->m_dinkes->getListPegawai();
        $this->load->view('pegawai_dinkes/lihatpegawaidinkes', $data);
    }

    public function puskesmas() {
        $data['listpuskesmas'] = $this->m_dinkes->getListPuskesmas();
        $this->load->view('pegawai_dinkes/lihatpuskesmas', $data);
    }

    public function posbindu() {
        $data['listposbindu'] = $this->m_dinkes->getListPosbindu();
        $this->load->view('pegawai_dinkes/lihatposbindu', $data);
    }

    public function kader() {
        $data['listkader'] = $this->m_dinkes->getListkader();
        $this->load->view('pegawai_dinkes/lihatkader', $data);
    }

    public function pasien() {
        $data['listpasien'] = $this->m_dinkes->getListPasien();
        $this->load->view('pegawai_dinkes/lihatpasien', $data);
    }

    public function riwayat($id) {
        $data['listriwayat'] = $this->m_dinkes->getListRiwayatPasien($id);
        $this->load->view('pegawai_dinkes/lihatriwayat', $data);
    }

    public function petunjuk() {
        $this->load->view('pegawai_dinkes/petunjuk');
    }

}
