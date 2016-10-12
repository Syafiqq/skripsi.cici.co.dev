<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_index extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function countPuskesmas() {
        $count = $this->db->count_all('data_puskesmas');
        return $count;
    }

    public function countPosbindu() {
        $count = $this->db->count_all('data_posbindu');
        return $count;
    }

    public function countKader() {
        $count = $this->db->count_all('data_kader');
        return $count;
    }

    public function countPasien() {
        $count = $this->db->count_all('pasien');
        return $count;
    }

    public function countPegawaiPuskesmas($id) {
        $this->db->where('id_puskesmas', $id);
        $this->db->from('pegawai_puskesmas');
        $count = $this->db->count_all_results();
        return $count;
    }

    public function countPosbinduByIdPuskesmas($id) {
        $this->db->where('id_puskesmas', $id);
        $this->db->from('data_posbindu');
        $count = $this->db->count_all_results();
        return $count;
    }

    public function countKaderByIdPuskesmas($id) {
        $this->db->where('id_puskesmas', $id);
        $this->db->from('data_kader');
        $count = $this->db->count_all_results();
        return $count;
    }

    public function countPasienByIdPuskesmas($id) {
        $this->db->where('id_puskesmas', $id);
        $this->db->from('pasien');
        $count = $this->db->count_all_results();
        return $count;
    }

    public function getIdPuskesmasByPegawaiPuskesmas($id_pegawai) {
        $this->db->select('*');
        $this->db->from('pegawai_puskesmas');
        //$this->db->where('id', $id_pegawai);
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row) {
            $result = $row->id_puskesmas;
        }
        return $result;
    }

    public function getIdPuskesmasByKader($id_pegawai) {
        $this->db->select('*');
        $this->db->from('data_kader');
        $this->db->where('id', $id_pegawai);
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row) {
            $result = $row->id_puskesmas;
        }
        return $result;
    }

    public function getIdPosbinduByKader($id_pegawai) {
        $this->db->select('*');
        $this->db->from('data_kader');
        $this->db->where('id', $id_pegawai);
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row) {
            $result = $row->id_posbindu;
        }
        return $result;
    }

    public function namaPasien($id) {
        $this->db->select('*');
        $this->db->from('pasien');
        $this->db->where('id', $id);
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row) {
            $result = $row->nama;
        }
        return $result;
    }

    public function kecamatan() {
        $result = array();
        $this->db->select('*');
        $this->db->from('kecamatan');
        $this->db->order_by('ID', 'ASC');
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row) {
            $result[0] = '-Pilih Kecamatan-';
            $result[$row->ID] = $row->NAMA_KECAMATAN;
        }
        return $result;
    }

    public function kelurahan() {
        $id_kecamatan = $this->input->post('id_kecamatan');
        $result = array();
        $this->db->select('*');
        $this->db->from('kelurahan');
        $this->db->where('ID_KECAMATAN', $id_kecamatan);
        $this->db->order_by('KELURAHAN', 'ASC');
        $array_keys_values = $this->db->get();
        $result[0] = '-Pilih Kelurahan-';
        foreach ($array_keys_values->result() as $row) {
            $result[$row->id] = $row->kelurahan;
        }
        return $result;
    }

    public function getNamaPosbindu($id) {
        $this->db->select('*');
        $this->db->from('data_posbindu');
        $this->db->where('ID', $id);
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row) {
            $result = $row->nama_posbindu;
        }
        return $result;
    }

    public function getListPosbindu($id_puskesmas) {
        $this->db->select('*');
        $this->db->from('data_posbindu');
        $this->db->where('ID_PUSKESMAS', $id_puskesmas);
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row) {
            $result[0] = '-Pilih Posbindu-';
            $result[$row->id] = $row->nama_posbindu;
        }
        return $result;
    }

    public function getKaderByIdPosbindu($id) {
        $this->db->select('*');
        $this->db->from('data_kader');
        $this->db->where('ID_POSBINDU', $id);
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row) {
            $result[0] = '-Pilih Kader-';
            $result[$row->id] = $row->nama_kader;
        }
        return $result;
    }

    public function getNamaKecamatan($id) {
        $this->db->select('*');
        $this->db->from('kecamatan');
        $this->db->where('ID', $id);
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row) {
            $result = $row->NAMA_KECAMATAN;
        }
        return $result;
    }

    public function getNamaKelurahan($id) {
        $this->db->select('*');
        $this->db->from('kelurahan');
        $this->db->where('id', $id);
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row) {
            $result = $row->kelurahan;
        }
        return $result;
    }

    public function addUser($array) {
        $this->db->insert('user', $array);
    }

    public function getUser($id) {
        $query = "SELECT * FROM user where iduser = '$id'";
        $user = $this->db->query($query);
        return $user;
    }

    public function updateUser($id, $data) {
        $this->db->where('iduser', $id);
        return $this->db->update('user', $data);
    }

    public function checkUsername($id, $username) {
        $login = $this->db->query("SELECT * FROM user WHERE username not in (select username from user where iduser = '$id') and username = '$username'");
        if ($login->num_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function deleteUser($id){
        $this->db->where('iduser', $id);
        $this->db->delete('user');
    }

}
