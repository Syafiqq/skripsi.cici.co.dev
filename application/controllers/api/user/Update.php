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

    public function foto() {
        $filename = $_REQUEST['foto'];
        $base = $_REQUEST['image'];
        $binary = base64_decode($base);
        header('Content-Type: bitmap; charset=utf-8');
        // Images will be saved under 'www/imgupload/uplodedimages' folder
        //$filename = date("Ymd") . "-" . $filename;
        $file = fopen('images/user/' . $filename, 'wb');
        // Create File
        fwrite($file, $binary);
        fclose($file);
        if ($input['role'] == 'dinkes') {
            if (!$this->m_dinkes->updatePegawai($this->input->post('id'), array('foto' => $filename))) {
                $response = array(
                    'status' => false,
                    'message' => 'Gagal Mengganti Foto Pegawai Dinkes'
                );
            }
        } else if ($input['role'] == 'puskesmas') {
            if (!$this->m_puskesmas->updatePegawai($this->input->post('id'), array('foto' => $filename))) {
                $response = array(
                    'status' => false,
                    'message' => 'Gagal Mengganti Foto Pegawai Puskesmas'
                );
            }
        } else if ($input['role'] == 'kader') {
            if (!$this->m_kader->updateKader($this->input->post('id'), array('foto' => $filename))) {
                $response = array(
                    'status' => false,
                    'message' => 'Gagal Mengganti Foto Kader'
                );
            }
        } else {
            $response = array(
                'status' => TRUE,
                'message' => 'Berhasil Mengganti Foto'
            );
        }
        $this->response($response, 200);
    }

    public function account() {
        $response = array();
        $input = $this->input->post(NULL);
        $data = array(
            'username' => $input['username'],
            'password' => $input['password'],
        );
        if ($this->m_index->updateUser($input['iduser'], $data)) {
            $response = array(
                'status' => true,
                'message' => 'Akun Berhasil Di Ubah',
                'user' => $this->db->query("SELECT * FROM USER WHERE IDUSER = '" . $input['iduser'] . "'")->row_array()
            );
        } else {
            $response = array(
                'status' => false,
                'message' => 'Akun Gagal Di Ubah'
            );
        }
        $this->response($response);
    }

}
