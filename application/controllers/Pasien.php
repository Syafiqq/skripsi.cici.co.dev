<?php
/**
 * This <skripsi.cici.co.dev> project created by :
 * Name         : syafiq
 * Date / Time  : 01 August 2016, 7:11 AM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller
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

    public function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['user']))
        {
            if($_SESSION['user']['role'] != 'pasien')
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

    public function index()
    {
        $this->load->view('pasien/beranda');
    }

    public function beranda()
    {
        $this->load->view('pasien/beranda');
    }

    public function profil()
    {
        $this->load->view('pasien/profil', array('user' => $_SESSION['user']));
    }

    public function deteksi()
    {
        $this->load->view('pasien/deteksi');
    }

    public function doDeteksi()
    {
        if (isset($_POST['form']['tekanan_darah'])
            && isset($_POST['form']['diabetes'])
            && isset($_POST['form']['riwayat_keluarga'])
            && isset($_POST['form']['merokok'])
            && isset($_POST['form']['kolesterol'])
            && isset($_POST['form']['aktifitas_fisik'])
            && isset($_POST['form']['diet'])
            && isset($_POST['form']['bb'])
            && isset($_POST['form']['tb'])
            && isset($_POST['form']['total_latih'])
            && isset($_POST['form']['riwayat_fa'])
            && isset($_POST['form']['tingkat_resiko'])
            && isset($_POST['form']['k_val']))
        {
            $categoryCheck = array(array('k' => 'diabetes', 'v' => 'diabetes'),
                array('k' => 'kolesterol', 'v' => 'kolesterol'),
                array('k' => 'diet', 'v' => 'diet'),
                array('k' => 'bb', 'v' => 'berat badan'),
                array('k' => 'tb', 'v' => 'tinggi badan'));

            foreach ($categoryCheck as $category)
            {
                if(!is_numeric($_POST['form'][$category['k']]))
                {
                    unset($_POST['form'][$category['k']]);
                    $this->session->set_flashdata('deteksiError', "<echo style=\"color: red\">Terdapat kesalahan pada field {$category['v']}, ulangi sekali lagi</echo>");
                    $this->session->set_flashdata('callbackForm', $_POST['form']);
                    redirect('pasien/deteksi/');
                    return;
                }
            }
            $can_explode = true;
            $_POST['form']['k_val'] = explode(', ', $_POST['form']['k_val']);
            foreach ($_POST['form']['k_val'] as $value)
            {
                if(!is_numeric($value))
                {
                    $can_explode = false;
                    break;
                }
            }

            if($can_explode)
            {
                $_SESSION['user']['data']['deteksi'] = $_POST['form'];
                redirect('pasien/hasil-deteksi/');
            }
            else
            {
                unset($_POST['form']['k_val']);
                $this->session->set_flashdata('deteksiError', '<echo style="color: red">Terdapat kesalahan pada field nilai k, ulangi sekali lagi</echo>');
                $this->session->set_flashdata('callbackForm', $_POST['form']);
                redirect('pasien/deteksi/');
            }
        }
        else
        {
            $this->session->set_flashdata('deteksiError', '<echo style="color: red">Terdapat kesalahan, silahkan isi semua form yang ada</echo>');
            redirect('pasien/deteksi/');
        }
    }

    public function hasildeteksi()
    {
        if(isset($_SESSION['user']['data']['deteksi']))
        {
            $data = $this->m_iknn->calculate($_SESSION['user']['data']['deteksi']);
            $saran = 'Tidak ada Saran';
            switch ($data['data']['metadata']['voting']['class'])
            {
                case 1 :
                {
                    $saran = 'Ini saran untuk tingkat rendah';
                }break;
                case 2 :
                {
                    $saran = 'Ini saran untuk tingkat sedang';
                } break;
                case 3 :
                {
                    $saran = 'Ini saran untuk tingkat tinggi';
                } break;
            }
            $this->load->view('pasien/hasildeteksi', array('class' => $data['data']['metadata']['class'][$data['data']['metadata']['voting']['class']], 'saran' => $saran));
        }
        else
        {
            $this->session->set_flashdata('deteksiError', "<echo style=\"color: red\">Silahkan isi terlebih dahulu</echo>");
            redirect('pasien/deteksi/');
        }
    }

}