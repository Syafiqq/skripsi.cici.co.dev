<?php
/**
 * This <skripsi.cici.co.dev> project created by : 
 * Name         : syafiq
 * Date / Time  : 01 September 2016, 6:12 AM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function loadDataTraining()
    {
        $data = array();
        $data['data'] = $this->db->query('SELECT ALL * FROM data_latih ORDER BY data_latih.id ASC')->result_array();
        $data['category'] = $this->generateCategory();
        $data['model'] = $this->generateDataModel();
        return $data;
    }

    private function generateCategory()
    {
        return array(
            'key' => array(
                'tekanan_darah',
                'diabetes',
                'riwayat_keluarga',
                'merokok',
                'kolesterol',
                'aktifitas_fisik',
                'diet',
                'bb',
                'tb',
                'riwayat_fa',
                'tingkat_resiko'),
            'value' => array(
                'Tekanan Darah',
                'Diabetes',
                'Riwayat Keluarga',
                'Merokok',
                'Kolesterol',
                'Aktifitas Fisik',
                'Diet',
                'Berat Badan',
                'Tinggi Badan',
                'Riwayat Fibrilasi Atrium',
                'Tingkat Resiko'
            ));
    }

    private function generateDataModel()
    {
        return array('training', 'testing');
    }

    public function getListRiwayatPasien($id) {
        $query = "SELECT * FROM riwayat where id_pasien = '$id'";
        $pasien = $this->db->query($query);
        return $pasien;
    }

    public function getNamaPegawai($id) {
        $this->db->select('*');
        $this->db->from('pegawai_admin');
        $this->db->where('id', $id);
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row) {
            $result = $row->nama;
            return $result;
        }
    }

    public function getListPegawai() {
        $query = "SELECT * FROM pegawai_admin";
        $listpegawai = $this->db->query($query);
        return $listpegawai;
    }

    public function deletepegawai($id) {
        $this->db->delete('pegawai_admin', array('id' => $id));
        $this->db->delete('user', array('id_users' => $id));
    }
}