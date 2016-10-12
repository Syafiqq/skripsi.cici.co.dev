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
class Create extends REST_Controller {

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

    public function pegawai_post() {
        $input = $this->input->post(NULL);
        if ($this->m_puskesmas->checkNIP($input['nip']) == 1) {
            $response = array(
                'status' => false,
                'message' => 'NIP/NIK Sudah terdaftar'
            );
        } else {
            $insert_pegawai = array(
                'id_puskesmas' => $input['id_puskesmas'],
                'nama' => $input['nama'],
                'NIP' => $input['nip'],
                'alamat' => $input['alamat'],
                'hp' => $input['hp'],
                'email' => $input['email'],
                'sosmed1' => $input['sosmed1'],
                'sosmed2' => $input['sosmed2'],
                'sosmed3' => $input['sosmed3'],
                'rt' => $input['rt'],
                'rw' => $input['rw'],
                'foto' => $this->getFileName(),
                'id_kecamatan' => $input['id_kecamatan'],
                'id_kelurahan' => $input['id_kelurahan'],
                'tempat_lahir' => $input['tempat_lahir'],
                'tanggal_lahir' => $input['tanggal_lahir']
            );
            $this->m_puskesmas->addPegawai($insert_pegawai);
            if ($this->m_index->checkUsername($this->m_puskesmas->getIdByNIP($input['nip']), $input['username']) == 1) {
                $this->db->delete('pegawai_puskesmas', array('id' => $this->m_puskesmas->getIdByNIP($input['nip'])));
                $response = array(
                    'status' => false,
                    'message' => 'Username Sudah Terdaftar Dalam Sistem'
                );
            } else {
                $response = array(
                    'status' => true,
                    'message' => 'Pegawai Puskesmas Berhasil Ditambahkan'
                );
            }
        }
        $this->response($response, 200);
    }

    public function posbindu_post() {
        $response = array();
        $input = $this->input->post(NULL);
        if ($this->m_puskesmas->checkNamaPosbindu($input['nama_posbindu']) == 1) {
            $response = array(
                'status' => false,
                'message' => 'Nama Posbindu Sudah terdaftar dalam sistem'
            );
        } else {
            $data = array(
                'nama_posbindu' => $input['nama_posbindu'],
                'alamat' => $input['alamat'],
                'rt' => $input['rw'],
                'rw' => $input['rw'],
                'id_kecamatan' => $input['id_kecamatan'],
                'id_kelurahan' => $input['id_kelurahan'],
                'id_puskesmas' => $input['id_puskesmas'],
            );
            $this->m_puskesmas->addPosbindu($data);
            $response = array(
                'status' => true,
                'message' => $this->m_puskesmas->getIdPosbinduByNama($input['nama_posbindu'])
            );
        }
        $this->response($response, 200);
    }

    public function kader_post() {
        $input = $this->input->post(NULL);
        if ($this->m_puskesmas->checkNomor($input['hp']) == 1) {
            $response = array(
                'status' => false,
                'message' => 'Nomor Telepon Sudah terdaftar dalam sistem'
            );
        } else {
            $insert = array(
                'id_puskesmas' => $input['id_puskesmas'],
                'id_posbindu' => $input['id_posbindu'],
                'nama_kader' => $input['nama_kader'],
                'alamat' => $input['alamat'],
                'hp' => $input['hp'],
                'email' => $input['email'],
                'sosmed1' => $input['sosmed1'],
                'sosmed2' => $input['sosmed2'],
                'sosmed3' => $input['sosmed3'],
                'rt' => $input['rt'],
                'rw' => $input['rw'],
                'foto' => $this->getFileName(),
                'id_kecamatan' => $input['id_kecamatan'],
                'id_kelurahan' => $input['id_kelurahan'],
                'tempat_lahir' => $input['tempat_lahir'],
                'tanggal_lahir' => $input['tanggal_lahir']
            );
            $this->m_puskesmas->addKader($insert);
            if ($this->m_index->checkUsername($this->m_puskesmas->getIdKaderByHp($input['hp']), $input['username']) == 1) {
                $this->db->delete('data_kader', array('id' => $this->m_dinkes->getIdByNIP($input['nip'])));
                $response = array(
                    'status' => false,
                    'message' => 'Username Sudah Terdaftar Dalam Sistem'
                );
            } else {
                $response = array(
                    'status' => true,
                    'message' => 'Kader Berhasil Ditambahkan'
                );
            }
        }
        $this->response($response, 200);
    }

    public function pasien_post() {
        $input = $this->input->post(NULL);
        if ($this->m_kader->checkKTP($input['ktp']) == 1) {
            $response = array(
                'status' => false,
                'message' => 'KTP Pasien Sudah terdaftar dalam sistem'
            );
        } else {
            $insert = array(
                'id_puskesmas' => $input['id_puskesmas'],
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
                'tgl_lahir' => $input['tanggal_lahir'],
            );
            $this->m_puskesmas->addPasien($insert);
            $response = array(
                'status' => true,
                'message' => 'Pasien Berhasil Di Tambahkan'
            );
        }
        $this->response($response, 200);
    }

    public function riwayat_post() {
        $input = $this->input->post(NULL);
        $insert = array(
            'id_puskesmas' => $input['id_puskesmas'],
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
        $this->m_puskesmas->addRiwayat($insert);
        $response = array(
            'status' => true,
            'message' => 'Riwayat Pasien Berhasil Di tambahkan'
        );
        $this->response($response, 200);
    }

    private function getFileName() {
        // Get file name posted from Android App
        $filename = $_REQUEST['foto'];
        if ($filename != "") {
            // Decode Image
            $base = $_REQUEST['image'];
            $binary = base64_decode($base);
            header('Content-Type: bitmap; charset=utf-8');
            // Images will be saved under 'www/imgupload/uplodedimages' folder
            //$filename = date("Ymd") . "-" . $filename;

            $file = fopen('images/user/' . $filename, 'wb');
            // Create File
            fwrite($file, $binary);
            fclose($file);
        } else {
            $filename = "Blank-Profile-Picture.jpg";
        }
        return $filename;
    }

}
