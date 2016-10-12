<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class View extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (isset($_SESSION['user']))
        {
            if($_SESSION['user']['role'] != 'dss')
            {
                redirect('error/');
            }
        }
        else
        {
            $this->session->set_flashdata('notRegistered', '<echo style="color: red">Silahkan Login Terlebih Dahulu</echo>');
            $this->session->set_flashdata('urlCallback', base_url('index.php/'.uri_string()));
            redirect('login/');
        }
    }

    public function index() {
        //$this->load->view('puskesmas/index1');
    }

    public function profil() {
        $data['kecamatan'] = $this->m_index->kecamatan();
        $data['profil'] = $this->m_puskesmas->getPegawaiById($this->session->userdata('id_users'));
        $this->load->view('puskesmas/profil', $data);
    }

    public function puskesmas() {
        $data['listpuskesmas'] = $this->m_puskesmas->getPuskesmas($this->m_index->getIdPuskesmasByPegawaiPuskesmas($this->session->userdata('id_users')));
        $this->load->view('puskesmas/profilpuskesmas', $data);
    }

    public function pegawai() {
        $data['listpegawai'] = $this->m_puskesmas->getListPegawai($this->m_index->getIdPuskesmasByPegawaiPuskesmas($this->session->userdata('id_users')));
        $this->load->view('puskesmas/lihatpegawaipuskesmas', $data);
    }

    public function posbindu() {
        $data['listposbindu'] = $this->m_puskesmas->getListPosbindu($this->m_index->getIdPuskesmasByPegawaiPuskesmas($this->session->userdata('id_users')));
        $this->load->view('puskesmas/lihatposbindu', $data);
    }

    public function kader() {
        $data['listkader'] = $this->m_puskesmas->getListkader($this->m_index->getIdPuskesmasByPegawaiPuskesmas($this->session->userdata('id_users')));
        $this->load->view('puskesmas/lihatkader', $data);
    }

    public function pasien() {
        $data['listpasien'] = $this->m_puskesmas->getListPasien($this->m_index->getIdPuskesmasByPegawaiPuskesmas($this->session->userdata('id_users')));
        $this->load->view('puskesmas/lihatpasien', $data);
    }

    public function riwayat($id_pasien) {
        $data['listriwayat'] = $this->m_puskesmas->getListRiwayatPasien($id_pasien);
        $this->load->view('puskesmas/lihatriwayat1', $data);
    }

    public function petunjuk() {
        $this->load->view('puskesmas/petunjuk');
    }

}
