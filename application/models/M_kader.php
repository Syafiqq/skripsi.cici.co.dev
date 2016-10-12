<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_kader extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function addPasienBaru($array) {
        $this->db->insert('pasien', $array);
        return TRUE;
    }

    public function addRiwayat($array) {
        $this->db->insert('riwayat', $array);
    }

    public function getNamaKader($id) {
        $this->db->select('*');
        $this->db->from('data_kader');
        $this->db->where('id', $id);
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row) {
            $result = $row->nama_kader;
            return $result;
        }
    }

    public function getKader($id) {
        $query = "SELECT * FROM data_kader where id = '$id'";
        $listpegawai = $this->db->query($query);
        return $listpegawai;
    }

    public function getListPasien($id) {
        $query = "SELECT * FROM pasien where id_kader = '$id'";
        $listpuskesmas = $this->db->query($query);
        return $listpuskesmas;
    }

    public function getPasienById($id) {
        $query = "SELECT * FROM pasien where id = '$id'";
        $listpuskesmas = $this->db->query($query);
        return $listpuskesmas;
    }

    public function getListRiwayatPasien($id) {
        $query = "SELECT * FROM riwayat where id_pasien= '$id'";
        $listpuskesmas = $this->db->query($query);
        return $listpuskesmas;
    }

    public function editriwayatpasien($id, $update) {
        $this->db->where('id', $id);
        $updatedata = $this->db->update('riwayat', $update);
        return $updatedata;
    }

    public function editpasien($id, $update) {
        $this->db->where('id', $id);
        $updatedata = $this->db->update('pasien', $update);
        return $updatedata;
    }

    public function deletepasien($id_pasien) {
        return $this->db->delete('riwayat', array('id_pasien' => $id_pasien));
    }

    public function deleteriwayat($id) {
        return $this->db->delete('riwayat', array('id' => $id));
    }

    public function checkKTP($ktp) {
        $login = $this->db->query("SELECT * FROM pasien where KTP='$ktp'");
        if ($login->num_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function checkKTPUpdate($old_ktp, $new_ktp) {
        $login = $this->db->query("SELECT * FROM pasien WHERE ktp not in (select ktp from pasien where ktp = '$old_ktp') and ktp = '$new_ktp'");
        if ($login->num_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
    }

}
