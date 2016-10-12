<?php
/**
 * This <skripsi.cici.co.dev> project created by : 
 * Name         : syafiq
 * Date / Time  : 02 August 2016, 2:08 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class M_perhitungan extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function getDataLatih()
    {
        return $this->db->query('SELECT ALL * FROM data_latih ORDER BY data_latih.id ASC')->result_array();
    }
}