<?php

if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class Main_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }


    public function login()
    {
        if (isset($_SESSION['user']))
        {
            $this->redirectToRole($_SESSION['user']['role']);
        }
        else
        {
            $this->load->view('login');
        }
    }

    public function doLogin()
    {
        if (isset($_POST['role']) && isset($_POST['username']) && isset($_POST['password']))
        {
            if (strlen(trim($_POST['role'])) != 0)
            {
                if (strlen(trim($_POST['username'])) != 0)
                {
                    if (strlen(trim($_POST['password'])) != 0)
                    {
                        $data = $this->m_main_model->login($_POST);
                        switch ($data['callback'])
                        {
                            case 1 :
                            {
                                $this->session->set_userdata('user', $data['data']['user'][0]);
                                $this->session->set_flashdata('js_cmd', 'alert(\'Login Berhasil\');');
                                if(isset($_POST['urlCallback']))
                                {
                                    redirect($_POST['urlCallback']);
                                }
                                else
                                {
                                    $this->redirectToRole($data['data']['user'][0]['role']);
                                }
                                return;
                            }break;
                            case 0 :
                            {
                                $this->session->set_flashdata('js_cmd', 'alert(\'Identitas user tidak cocok dengan dokumen manapun atau user belum terdaftar.\');');
                            }break;
                            case -1 :
                            {
                                $this->session->set_flashdata('js_cmd', 'alert(\'Terdapat Kesalahan pada Database, silahkan ulangi sekali lagi\');');
                            }break;
                        }
                    }
                    else
                    {
                        $this->session->set_flashdata('js_cmd', 'alert(\'Silahkan isi Password dengan benar\');');
                    }
                }
                else
                {
                    $this->session->set_flashdata('js_cmd', 'alert(\'Silahkan isi Username dengan benar\');');
                }
            }
            else
            {
                $this->session->set_flashdata('js_cmd', 'alert(\'Silahkan pilih role dengan benar\');');
            }
            $this->session->set_flashdata('form_clbk', $_POST);
        }
        else
        {
            $this->session->set_flashdata('js_cmd', 'alert(\'Silahkan isi form dengan benar\');');
        }
        redirect('login/');
    }

    public function doRegister()
    {
        if (isset($_POST['role']) && isset($_POST['name']) && isset($_POST['job']) && isset($_POST['username']) && isset($_POST['password']))
        {
            if (strlen(trim($_POST['role'])) != 0)
            {
                if (strlen(trim($_POST['name'])) != 0)
                {
                    if (strlen(trim($_POST['job'])) != 0)
                    {
                        if (strlen(trim($_POST['username'])) != 0)
                        {
                            if (strlen(trim($_POST['password'])) != 0)
                            {
                                $return = $this->m_main_model->register($_POST);
                                if ($return['callback'])
                                {
                                    $this->session->set_flashdata('registerCallback', '<echo style="color: green">Selamat, Anda Berhasil Terdaftar</echo>');
                                    redirect('login/');
                                    return;
                                }
                                else
                                {
                                    $this->session->set_flashdata('js_cmd', 'alert(\'Terdapat Kesalahan pada Database, silahkan ulangi sekali lagi\');');
                                }
                            }
                            else
                            {
                                $this->session->set_flashdata('js_cmd', 'alert(\'Silahkan isi Password dengan benar\');');
                            }
                        }
                        else
                        {
                            $this->session->set_flashdata('js_cmd', 'alert(\'Silahkan isi Username dengan benar\');');
                        }
                    }
                    else
                    {
                        $this->session->set_flashdata('js_cmd', 'alert(\'Silahkan isi Pekerjaan dengan benar\');');
                    }
                }
                else
                {
                    $this->session->set_flashdata('js_cmd', 'alert(\'Silahkan isi Nama dengan benar\');');
                }
            }
            else
            {
                $this->session->set_flashdata('js_cmd', 'alert(\'Silahkan pilih role dengan benar\');');
            }
            $this->session->set_flashdata('form_clbk', $_POST);
        }
        else
        {
            $this->session->set_flashdata('js_cmd', 'alert(\'Silahkan isi form dengan benar\');');
        }
        redirect('register/');
    }

    public function logout()
    {
        unset($_SESSION['user']);
        redirect();
    }

    public function registrate()
    {
        $this->load->view('register');
    }

    public function getKelurahanByIdKecamatan()
    {
        $data['kelurahan'] = $this->m_index->kelurahan();
        $this->load->view('kelurahan', $data);
    }

    public function getKaderByIdPosbindu()
    {
        $id = $this->input->post('id_posbindu');
        $data['kader'] = $this->m_index->getKaderByIdPosbindu($id);
        $this->load->view('kader', $data);
    }

    public function sendEmail()
    {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'nwahyusuci@gmail.com',
            'smtp_pass' => 'momuchi34',
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => true
        );

        $message = "Name : {$_POST['name']}<br>Sender : {$_POST['email']}<br>Message : {$_POST['problem']}";
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('nwahyusuci@gmail.com');
        $this->email->to('nwahyusuci@gmail.com');
        $this->email->subject('Aplikasi Stroke Problem');
        $this->email->message($message);
        if ($this->email->send())
        {
            $this->session->set_flashdata('send_message', 'Masukan berhasil dikirim');
        }
        else
        {
            $this->session->set_flashdata('send_message', 'Masukan gagal dikirim, coba lagi !');
        }
        redirect('contact-us');
    }

    private function redirectToRole($role)
    {
        switch ($role)
        {
            case 'pasien' :
            {
                redirect('pasien/');
            }break;
            case 'admin' :
            {
                redirect('admin/');
            }break;
            case 'dss' :
            {
                redirect('dss/');
            }break;
            default :
            {
                redirect();
            }
        }
    }

}
