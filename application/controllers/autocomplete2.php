<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Autocomplete2 extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function search() {
        // tangkap variabel keyword dari URL
        $keyword = $this->uri->segment(3);

        // cari di database
        $data = $this->db->from('pasien')->like('nama', $keyword)->get();

        // format keluaran di dalam array
        foreach ($data->result() as $row) {
            $jenis = $row->jenis_puskesmas;
            if ($jenis == 0) {
                $jeniss = 'Non Rawat Inap';
            } else {
                $jeniss = 'Rawat Inap';
            }
            $karakter = substr(($row->kode_puskesmas), -5);


            $arr['query'] = $keyword;
            $arr['suggestions'][] = array(
                'value' => $row->nama_puskesmas,
                'kode_puskesmas' => $row->kode_puskesmas,
                'alamat' => $row->alamat,
                'jenis_puskesmas' => $jeniss,
                'karakter' => $karakter,
                'id' => $row->id
            );
        }
        // minimal PHP 5.2
        echo json_encode($arr);
    }

}

?>