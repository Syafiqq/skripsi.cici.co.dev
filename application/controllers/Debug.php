<?php
/**
 * This <skripsi.cici.co.dev> project created by :
 * Name         : syafiq
 * Date / Time  : 07 September 2016, 12:35 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Debug extends CI_Controller
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
        // Your own constructor code
    }

    public function index()
    {
        //$this->doPerhitungan();
        $this->load->view('debug/index');
    }

    public function doPerhitungan()
    {
        //$_POST['uji'] = '1';
        //$_POST['total_latih'] = '120';
        //$_POST['k_val'] = array(1, 3, 7);
        if(isset($_POST['uji']))
        {
            $_POST['uji'] = trim($_POST['uji']);
            if ((strlen($_POST['uji']) > 0) && (is_numeric($_POST['uji'])))
            {
                $can_explode = true;
                $_POST['k_val'] = explode(', ', $_POST['k_val']);
                foreach ($_POST['k_val'] as $value)
                {
                    if (!is_numeric($value))
                    {
                        $can_explode = false;
                        break;
                    }
                }

                if ($can_explode)
                {
                    $_SESSION['debug'] = array();
                    $_POST['uji'] = $_POST['uji'] < 1 ? 1 : $_POST['uji'] > 30 ? 30 : $_POST['uji'];
                    $_SESSION['debug'] = $this->m_iknn_debug->loadDataTesting($_POST['uji']);
                    $_SESSION['debug']['total_latih'] = $_POST['total_latih'];
                    $_SESSION['debug']['k_val'] = $_POST['k_val'];
                }
                else
                {
                    redirect('debug/index/');
                    return;
                }
            }
            else
            {
                if (isset($_POST['tekanan_darah'])
                    && isset($_POST['diabetes'])
                    && isset($_POST['riwayat_keluarga'])
                    && isset($_POST['merokok'])
                    && isset($_POST['kolesterol'])
                    && isset($_POST['aktifitas_fisik'])
                    && isset($_POST['diet'])
                    && isset($_POST['bb'])
                    && isset($_POST['tb'])
                    && isset($_POST['riwayat_fa'])
                    && isset($_POST['tingkat_resiko'])
                    && isset($_POST['uji'])
                    && isset($_POST['total_latih'])
                    && isset($_POST['k_val'])
                )
                {
                    $categoryCheck = array(array('k' => 'diabetes', 'v' => 'diabetes'),
                        array('k' => 'kolesterol', 'v' => 'kolesterol'),
                        array('k' => 'diet', 'v' => 'diet'),
                        array('k' => 'bb', 'v' => 'berat badan'),
                        array('k' => 'tb', 'v' => 'tinggi badan'));

                    foreach ($categoryCheck as $category)
                    {
                        if (!is_numeric($_POST[$category['k']]))
                        {
                            unset($_POST[$category['k']]);
                            redirect('debug/index/');
                            return;
                        }
                    }
                    $can_explode = true;
                    $_POST['k_val'] = explode(', ', $_POST['k_val']);
                    foreach ($_POST['k_val'] as $value)
                    {
                        if (!is_numeric($value))
                        {
                            $can_explode = false;
                            break;
                        }
                    }

                    if ($can_explode)
                    {
                        $_SESSION['debug'] = array();
                        $_SESSION['debug']['no'] = 1;
                        $_SESSION['debug']['tekanan_darah'] = $_POST['tekanan_darah'];
                        $_SESSION['debug']['diabetes'] = $_POST['diabetes'];
                        $_SESSION['debug']['riwayat_keluarga'] = $_POST['riwayat_keluarga'];
                        $_SESSION['debug']['merokok'] = $_POST['merokok'];
                        $_SESSION['debug']['kolesterol'] = $_POST['kolesterol'];
                        $_SESSION['debug']['aktifitas_fisik'] = $_POST['aktifitas_fisik'];
                        $_SESSION['debug']['diet'] = $_POST['diet'];
                        $_SESSION['debug']['bb'] = $_POST['bb'];
                        $_SESSION['debug']['tb'] = $_POST['tb'];
                        $_SESSION['debug']['riwayat_fa'] = $_POST['riwayat_fa'];
                        $_SESSION['debug']['tingkat_resiko'] = $_POST['tingkat_resiko'];
                        $_SESSION['debug']['total_latih'] = $_POST['total_latih'];
                        $_SESSION['debug']['k_val'] = $_POST['k_val'];
                    }
                    else
                    {
                        redirect('debug/index/');
                        return;
                    }
                }
                else
                {
                    redirect('debug/index/');
                    return;
                }
            }
            log_message('ERROR', var_export($_SESSION['debug'], true));
            redirect('debug/perhitungan/');
            return;
        }
        else
        {
            redirect('debug/index/');
            return;
        }
    }

    public function perhitungan()
    {
        if(isset($_SESSION['debug']))
        {
            $data['data'] = $this->m_iknn_debug->calculate($_SESSION['debug']);
            $this->load->view('debug/hasil', $data);
        }
        else
        {
            redirect('debug/index');
        }
    }
}