<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_puskesmas extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function addPegawai($array) {
        $this->db->insert('pegawai_puskesmas', $array);
    }

    public function addPasien($array) {
        $this->db->insert('pasien', $array);
    }

    public function addRiwayat($array) {
        $this->db->insert('riwayat', $array);
    }

    public function addUser($array) {
        $this->db->insert('user', $array);
    }

    public function addPosbindu($array) {
        $this->db->insert('data_posbindu', $array);
    }

    public function addKader($array) {
        $this->db->insert('data_kader', $array);
    }

    public function getPuskesmas($id_puskesmas) {
        $pegawai = $this->db->query("SELECT * FROM data_puskesmas where id = '$id_puskesmas'");
        return $pegawai;
    }

    public function getListPegawai($id_puskesmas) {
        $pegawai = $this->db->query("SELECT * FROM pegawai_puskesmas where id_puskesmas = '$id_puskesmas'");
        return $pegawai;
    }

    public function getPegawaiById($id) {
        $query = "SELECT * FROM pegawai_puskesmas where id = '$id'";
        $listpegawai = $this->db->query($query);
        return $listpegawai;
    }

    public function getListPosbindu($id_puskesmas) {
        $listPosbindu = $this->db->query("SELECT * FROM data_posbindu where id_puskesmas = '$id_puskesmas'");
        return $listPosbindu;
    }

    public function getListKader($id) {
        $query = "SELECT * FROM data_kader where id_puskesmas = '$id'";
        $listpuskesmas = $this->db->query($query);
        return $listpuskesmas;
    }

    public function getListKaderByIdPosbindu($id) {
        $query = "SELECT * FROM data_kader where id_posbindu = '$id'";
        $listpuskesmas = $this->db->query($query);
        return $listpuskesmas;
    }

    public function getListPasien($id) {
        $query = "SELECT * FROM pasien where id_puskesmas = '$id'";
        $listpuskesmas = $this->db->query($query);
        return $listpuskesmas;
    }

    public function getListRiwayatPasien($id) {
        $query = "SELECT * FROM riwayat where id_pasien = '$id'";
        $listpuskesmas = $this->db->query($query);
        return $listpuskesmas;
    }

    public function getPasienById($id) {
        $query = "SELECT * FROM pasien where id = '$id'";
        $listpuskesmas = $this->db->query($query);
        return $listpuskesmas;
    }

    public function getRiwayatById($id) {
        $query = "SELECT * FROM riwayat where id = '$id'";
        $listpuskesmas = $this->db->query($query);
        return $listpuskesmas;
    }

    public function updatePegawai($id, $update) {
        $this->db->where('id', $id);
        $updatedata = $this->db->update('pegawai_puskesmas', $update);
        return $updatedata;
    }

    public function updatePasien($id, $update) {
        $this->db->where('id', $id);
        $updatedata = $this->db->update('pasien', $update);
        return $updatedata;
    }

    public function updateRiwayat($id, $update) {
        $this->db->where('id', $id);
        $updatedata = $this->db->update('riwayat', $update);
        return $updatedata;
    }

    public function updatePosbindu($id, $update) {
        $this->db->where('id', $id);
        $updatedata = $this->db->update('data_posbindu', $update);
        return $updatedata;
    }

    public function deletePegawai($id) {
        $user = $this->db->query("SELECT * FROM USER where id_users = '$id' and role like '%Puskesmas%'");
        if ($user->num_rows() == 1) {
            return false;
        } else {
            $query_user = "DELETE FROM USER where id_users = '$id' and role like '%Puskesmas%'";
            if ($this->db->query($query_user)) {
                $query_pegawai = "DELETE FROM pegawai_puskesmas where id = '$id'";
                if ($this->db->query($query_pegawai)) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }
    }

    public function deletePosbindu($id) {
        $this->db->delete('data_posbindu', array('id' => $id));
    }

    public function deletePasien($id) {
        $query_pasien = "DELETE FROM pasien where id = '$id'";
        if ($this->db->query($query_pasien)) {
            $query_riwayat = "DELETE FROM riwayat where id_pasien = '$id'";
            if ($this->db->query($query_riwayat)) {
                return $query_riwayat;
            } else {
                return FALSE;
            }
        }
    }

    public function deleteRiwayat($id) {
        return $this->db->delete('riwayat', array('id' => $id));
    }

    public function deleteadminpuskesmas($id) {
        $data = $this->db->from('data_puskesmas')->where('id', $id)->get();
        foreach ($data->result() as $row) {
            $id_admin = $row->id_admin;
        }
        $this->db->delete('pegawai_puskesmas', array('id' => $id_admin));
        $this->db->delete('user', array('id_users' => $id_admin));

        $update = array(
            'status' => '0',
            'id_admin' => null,
            'nama_admin' => null,
            'id_kecamatan' => null,
            'id_kelurahan' => null
        );
        $this->db->where('id', $id);
        $updatedata = $this->db->update('data_puskesmas', $update);
    }

    public function getuser() {
        $query = "SELECT * FROM user";
        $user = $this->db->query($query);
        return $user;
    }

    public function checkNIP($nip) {
        $login = $this->db->query("SELECT * FROM pegawai_puskesmas where NIP='$nip'");
        if ($login->num_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function checkNamaPosbindu($nama) {
        $login = $this->db->query("SELECT * FROM data_posbindu where nama_posbindu='$nama'");
        if ($login->num_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function checkNomor($hp) {
        $login = $this->db->query("SELECT * FROM data_kader where hp='$hp'");
        if ($login->num_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function checkKTP($ktp) {
        $login = $this->db->query("SELECT * FROM pasien where ktp='$ktp'");
        if ($login->num_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function checkNomorUpdate($id, $new_hp) {
        $login = $this->db->query("SELECT * FROM data_kader WHERE hp not in (select hp from data_puskesmas where id = '$id') and hp = '$new_hp'");
        if ($login->num_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function checkNamaPosbinduUpdate($id, $new_nama) {
        $login = $this->db->query("SELECT * FROM data_posbindu WHERE nama_posbindu not in (select nama_posbindu from data_posbindu where id = '$id') and nama_posbindu = '$new_nama'");
        if ($login->num_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function checkNIPUpdate($old_nip, $new_nip) {
        $login = $this->db->query("SELECT * FROM pegawai_puskesmas WHERE NIP not in (select nip from pegawai_puskesmas where nip = '$old_nip') and NIP = '$new_nip'");
        if ($login->num_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function checkKTPUpdate($old_ktp, $new_ktp) {
        $login = $this->db->query("SELECT * FROM pasien WHERE ktp not in (select ktp from pasien where ktp = '$old_ktp') and ktp = '$new_ktp'");
        if ($login->num_rows() == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getIdByNIP($nip) {
        $this->db->select('*');
        $this->db->from('pegawai_puskesmas');
        $this->db->where('NIP', $nip);
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row) {
            $result = $row->id;
        }
        return $result;
    }

    public function getIdPosbinduByNama($nip) {
        $this->db->select('*');
        $this->db->from('data_posbindu');
        $this->db->where('nama_posbindu', $nip);
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row) {
            $result = $row->id;
        }
        return $result;
    }

    public function getIdKaderByHp($hp) {
        $this->db->select('*');
        $this->db->from('data_kader');
        $this->db->where('hp', $hp);
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row) {
            $result = $row->id;
        }
        return $result;
    }

    public function getNamaPegawai($id) {
        $this->db->select('*');
        $this->db->from('pegawai_puskesmas');
        $this->db->where('id', $id);
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row) {
            $result = $row->nama;
            return $result;
        }
    }

    public function getNamaPasien($id) {
        $this->db->select('*');
        $this->db->from('pasien');
        $this->db->where('id', $id);
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row) {
            $result = $row->nama;
            return $result;
        }
    }

    public function updateFoto($condition, $data) {
        $this->db->where('id', $condition); //Hanya akan melakukan update sesuai dengan condition yang sudah ditentukan
        return $this->db->update('pegawai_puskesmas', array('foto' => $data));
    }

}
