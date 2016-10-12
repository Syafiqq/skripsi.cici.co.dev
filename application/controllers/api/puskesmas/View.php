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
class View extends REST_Controller {

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
        if ($query->result()) {
            return true;
        } else {
            return FALSE;
        }
    }

    function pegawai_get($id_puskesmas) {
        $pegawaiDinkes = $this->m_puskesmas->getListPegawai($id_puskesmas)->result_array();
        $response = array(
            "status" => true,
            "message" => $pegawaiDinkes
        );
        $this->response($response, 200);
    }

    function posbindu_get($id_puskesmas) {
        $pegawaiDinkes = $this->m_puskesmas->getListPosbindu($id_puskesmas)->result_array();
        $response = array(
            "status" => true,
            "message" => $pegawaiDinkes
        );
        $this->response($response, 200);
    }

    function kader_get($id_puskesmas) {
        $pegawaiDinkes = $this->m_puskesmas->getListkader($id_puskesmas)->result_array();
        $response = array(
            "status" => true,
            "message" => $pegawaiDinkes
        );
        $this->response($response, 200);
    }

    function pasien_get($id_puskesmas) {
        $pegawaiDinkes = $this->m_puskesmas->getListPasien($id_puskesmas)->result_array();
        $response = array(
            "status" => true,
            "message" => $pegawaiDinkes
        );
        $this->response($response, 200);
    }

    function riwayat_get($id_pasien) {
        $pegawaiDinkes = $this->m_puskesmas->getListRiwayatPasien($id_pasien);
        $response = array(
            "status" => true,
            "message" => $pegawaiDinkes
        );
        $this->response($response, 200);
    }

}
