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
class Delete extends REST_Controller {

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

    function pegawai_get($id) {
        $deletePegawai = $this->db->query("delete from pegawai_dinkes where id='$id'");
        $response = array();
        if ($deletePegawai) {
            $deleteUser = $this->db->query("delete from user where id_pegawai='$id' and role = '%dinkes");
            if ($deleteUser) {
                $response = array(
                    'status' => true,
                    'message' => 'Hapus Pegawai Berhasil'
                );
            } else {
                $response = array(
                    'status' => false,
                    'message' => 'Hapus User Gagal'
                );
            }
        } else {
            $response = array(
                'status' => false,
                'message' => 'Hapus Pegawai Gagal'
            );
        }
        $this->response($response, 200);
    }

    function puskesmas_post() {
        $id = $this->input->post('id');
        $this->db->query("delete from data_puskesmas where id='$id'");
        $response = array(
            'status' => true,
            'message' => 'Hapus Puskesmas Berhasil'
        );
        $this->response($response, 200);
    }

}
