<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Update extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->database();
        $this->load->helper("url");
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits'
        // within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key

        date_default_timezone_set('Asia/Jakarta');
    }

    function auth() {
        if (!isset($_SERVER['PHP_AUTH_USER'])) {
            header("WWW-Authenticate: Basic realm=\"Private Area\"");
            header("HTTP/1.0 401 Unauthorized");
            //print "Sorry - you need valid credentials to be granted access!\n";
            //exit;
            return false;
        } else {
            if ($this->validate($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
                return true;
            } else {
                header("WWW-Authenticate: Basic realm=\"Private Area\"");
                header("HTTP/1.0 401 Unauthorized");
                //print "Sorry - you need valid credentials to be granted access!\n";
                //exit;
                return false;
            }
        }
        //echo 'false';
        //return FALSE;
    }

    function validate($username, $password) {
        $query = $this->db->query("SELECT * FROM USER WHERE USERNAME = '$username' && PASSWORD = '$password'");
        //print_r($query->result());
        if ($query->result()) {
            return true;
        } else {
            return FALSE;
        }
    }

    public function pegawai() {
        $input = $this->input->post(NULL);
        $data = array(
            'nama' => $input['nama'],
            'alamat' => $input['alamat'],
            'hp' => $input['hp'],
            'email' => $input['email'],
            'sosmed1' => $input['sosmed1'],
            'sosmed2' => $input['sosmed2'],
            'sosmed3' => $input['sosmed3'],
            'rt' => $input['rt'],
            'rw' => $input['rw'],
            'id_kecamatan' => $input['kecamatan'],
            'id_kelurahan' => $input['kelurahan'],
            'tempat_lahir' => $input['tempat_lahir'],
            'tanggal_lahir' => $input['tanggal_lahir']
        );
        if ($this->m_kader->updatePegawai($input['id'], $data)) {
            $response = array(
                'status' => TRUE,
                'message' => 'Perubahan Data Diri Berhasil'
            );
        } else {
            $response = array(
                'status' => false,
                'message' => 'Gagal Merubah Data Pada Server'
            );
        }
        $this->response($response, 200);
    }

    public function pasien_post() {
        $input = $this->input->post(NULL);
        if ($this->m_kader->checkKTPUpdate($input['old_ktp'], $input['ktp']) == 1) {
            $response = array(
                'status' => false,
                'message' => 'KTP Pasien Sudah terdaftar dalam sistem'
            );
        } else {
            $data = array(
                'nama' => $input['nama'],
                'ktp' => $input['ktp'],
                'jenis_kelamin' => $input['jenis_kelamin'],
                'alamat' => $input['alamat'],
                'hp' => $input['hp'],
                'rt' => $input['rt'],
                'rw' => $input['rw'],
                'id_kecamatan' => $input['id_kecamatan'],
                'id_kelurahan' => $input['id_kelurahan'],
                'tempat_lahir' => $input['tempat_lahir'],
                'tgl_lahir' => $input['tanggal_lahir']
            );
            $this->m_kader->editpasien($input['id'], $data);
            $response = array(
                'status' => true,
                'message' => 'Pasien Berhasil Di Ubah'
            );
        }
        $this->response($response, 200);
    }

    public function riwayat_post() {
        $input = $this->input->post(NULL);
        $data = array(
            'id_kader' => $input['id_kader'],
            'id_pasien' => $input['id_pasien'],
            'anggota_keluarga' => $input['anggota_keluarga'],
            'td_sistole' => $input['sistole'],
            'td_diastole' => $input['diastole'],
            'irama_denyut' => $input['irama'],
            'merokok' => $input['merokok'],
            'kolesterol' => $input['kolesterol'],
            'diabetes' => $input['diabetes'],
            'olahraga' => $input['olahraga'],
            'tinggi_badan' => $input['tinggi_badan'],
            'berat_badan' => $input['berat_badan'],
            'riwayat_sakit' => $input['sakit'],
            'riwayat_keluarga' => $input['keluarga'],
        );
        if ($this->m_kader->updateRiwayat($input['id'], $data)) {
            $response = array(
                'status' => true,
                'message' => 'Riwayat Pasien Berhasil Di Ubah'
            );
        } else {
            $response = array(
                'status' => false,
                'message' => 'Riwayat Pasien Gagal Di Ubah'
            );
        }
        $this->response($response, 200);
    }

}
