<?php
/**
 * This <skripsi.cici.co.dev> project created by : 
 * Name         : syafiq
 * Date / Time  : 01 September 2016, 7:48 AM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Dss extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct() {
        parent::__construct();
        if (isset($_SESSION['user']))
        {
            if($_SESSION['user']['role'] != 'dss')
            {
                redirect('error/');
            }
        }
        else
        {
            $this->session->set_flashdata('notRegistered', '<echo style="color: red">Silahkan Login Terlebih Dahulu</echo>');
            $this->session->set_flashdata('urlCallback', base_url('index.php/'.uri_string()));
            redirect('login/');
        }
    }

    public function index() {
        $this->load->view('dss/index');
    }
}