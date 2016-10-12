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
class Index extends REST_Controller {

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

    function login_get() {
        if ($this->auth()) {
            $username = $_SERVER['PHP_AUTH_USER'];
            $password = $_SERVER['PHP_AUTH_PW'];
            $login = $this->db->query("SELECT * FROM USER WHERE USERNAME = '$username' && PASSWORD = '$password'")->row_array();
            if ($login != null) {
                if (strpos($login['role'], 'Dinkes') !== false) {
                    $pegawai = $this->db->query("SELECT * FROM PEGAWAI_DINKES WHERE ID = '" . $login['id_users'] . "'")->row_array();
                } else if (strpos($login['role'], 'Puskesmas') !== false) {
                    $pegawai = $this->db->query("SELECT * FROM PEGAWAI_PUSKESMAS WHERE ID = '" . $login['id_users'] . "'")->row_array();
                } else if (strpos($login['role'], 'Kader') !== false) {
                    $pegawai = $this->db->query("SELECT * FROM DATA_KADER WHERE ID = '" . $login['id_users'] . "'")->row_array();
                }
                $response = array(
                    'status' => true,
                    'user' => $login,
                    'pegawai' => $pegawai
                );
            } else {
                $response = array(
                    'status' => false,
                    'message' => 'Gagal Login, Periksa Kembali Username/Password'
                );
            }
            $this->response($response);
        }
    }

    function index_get() {
        $post_frontend = $this->db->query("select * from post_frontend")->result_array();
        $data_frontend = $this->db->query("select * from data_frontend")->result_array();
        $file_frontend = $this->db->query("select * from file_frontend")->result_array();
        $kecamatan = $this->db->query("select * from kecamatan")->result_array();
        $kelurahan = $this->db->query("select * from kelurahan")->result_array();
        $response = array(
            "status" => true,
            "post_frontend" => $post_frontend,
            "data_frontend" => $data_frontend,
            "file_frontend" => $file_frontend,
            "kecamatan" => $kecamatan,
            "kelurahan" => $kelurahan
        );
        $this->response($response, 200);
    }

    function update_user_post() {
        $input = $this->input->post(NULL);
        $id = $input['id'];
        $response = array();
        if ($this->m_index->checkUsername($id, $input['username']) == 1) {
            $response = array(
                'status' => false,
                'message' => 'Username Sudah Terdaftar dalam Sistem'
            );
        } else {
            $this->db->where('iduser', $id);
            $update = $this->db->update('user', array('username' => $input['username'], 'password' => $input['password']));
            if ($update) {
                $response = array(
                    'status' => true,
                    'message' => 'Akun Berhasil Di Ubah',
                    'user' => $this->db->query("SELECT * FROM USER WHERE IDUSER = '$id'")->row_array()
                );
            } else {
                $response = array(
                    'status' => false,
                    'message' => 'Akun Gagal Di Ubah'
                );
            }
        }
        $this->response($response);
    }

    function update_photo_post() {
        $filename = $_REQUEST['foto'];
        $base = $_REQUEST['image'];
        $binary = base64_decode($base);
        header('Content-Type: bitmap; charset=utf-8');
        // Images will be saved under 'www/imgupload/uplodedimages' folder
        //$filename = date("Ymd") . "-" . $filename;

        $file = fopen('assets/foto/' . $filename, 'wb');
        // Create File
        fwrite($file, $binary);
        fclose($file);
    }

    function dinkes_get() {
        $pegawai = $this->db->query("select * from pegawai_dinkes")->result_array();
        $puskesmas = $this->db->query("select * from data_puskesmas")->result_array();
        $posbindu = $this->db->query("select * from data_posbindu")->result_array();
        $kader = $this->db->query("select * from data_kader")->result_array();
        $pasien = $this->db->query("select * from pasien")->result_array();
        $riwayat = $this->db->query("select * from riwayat")->result_array();
        $response = array(
            "status" => true,
            'pegawai_dinkes' => $pegawai,
            'puskesmas' => $puskesmas,
            'posbindu' => $posbindu,
            "kader" => $kader,
            "pasien" => $pasien,
            "riwayat" => $riwayat
        );
        $this->response($response, 200);
    }

    function puskesmas_get($id_puskesmas) {
        $pegawai = $this->db->query("select * from pegawai_puskesmas where id_puskesmas = '$id_puskesmas'")->result_array();
        $posbindu = $this->db->query("select * from data_posbindu where id_puskesmas = '$id_puskesmas'")->result_array();
        $kader = $this->db->query("select * from data_kader where id_puskesmas = '$id_puskesmas'")->result_array();
        $pasien = $this->db->query("select * from pasien where id_kader = '$id_puskesmas'")->result_array();
        $riwayat = $this->db->query("select * from riwayat where id_kader = '$id_puskesmas'")->result_array();
        $response = array(
            "status" => true,
            'pegawai_puskesmas' => $pegawai,
            'posbindu' => $posbindu,
            "kader" => $kader,
            "pasien" => $pasien,
            "riwayat" => $riwayat
        );
        $this->response($response, 200);
    }

    function kader_get($id_kader) {
        $pasien = $this->db->query("select * from pasien where id_kader = '$id_kader'")->result_array();
        $riwayat = $this->db->query("select * from riwayat where id_kader = '$id_kader'")->result_array();
        $response = array(
            "status" => true,
            "pasien" => $pasien,
            "riwayat" => $riwayat
        );
        $this->response($response, 200);
    }

}
