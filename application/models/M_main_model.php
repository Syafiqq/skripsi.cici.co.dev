<?php

if (!defined('BASEPATH'))
{
    exit('No direct script access allowed');
}

class m_main_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function login($loginData)
    {
        if($data = $this->db->query('SELECT * FROM user WHERE username = ? AND password = ? AND user.role = ? LIMIT 1', array($loginData['username'], md5(md5($loginData['password'])), $loginData['role'])))
        {
            if($data->num_rows() == 1)
            {
                return array('callback' => 1, 'data' => array('user' => $data->result_array()));
            }
            else
            {
                return array('callback' => 0);
            }
        }
        return array('callback' => -1);
    }

    public function register($registerData)
    {
        $this->db->trans_start();
        $this->db->query('SELECT @max_id := MAX(`iduser`) FROM user');
        $this->db->query('INSERT INTO user VALUES (NULL, ?, ?, ?, ?, ?, @max_id+1)', array($registerData['name'], $registerData['job'], $registerData['username'], md5(md5($registerData['password'])), $registerData['role']));
        $this->db->trans_complete();
        return array('callback' => 1);
    }

    public function getdetail($iduser)
    {
        return $this->db->query("
        Select * FROM user where iduser=$iduser");
    }

}
