<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (($this->session->userdata('iduser') == null) || ($this->session->userdata('role') != 'Admin Puskesmas')) {
            redirect('login');
        }
    }

    public function pegawai() {
        $data['kecamatan'] = $this->m_index->kecamatan();
        $this->load->view('puskesmas/tambahpegawaipuskesmas', $data);
    }

    public function posbindu() {
        $data['kecamatan'] = $this->m_index->kecamatan();
        $this->load->view('puskesmas/tambahposbindu', $data);
    }

    public function kader() {
        $data['kecamatan'] = $this->m_index->kecamatan();
        $data['posbindu'] = $this->m_index->getListPosbindu($this->m_index->getIdPuskesmasByPegawaiPuskesmas($this->session->userdata('id_users')));
        $this->load->view('puskesmas/tambahkader', $data);
    }

    public function pasien() {
        $data['kecamatan'] = $this->m_index->kecamatan();
        $this->load->view('puskesmas/tambahpasienbaru', $data);
    }

    public function riwayat($id) {
        $data['id_pasien'] = $id;
        $data['kecamatan'] = $this->m_index->kecamatan();
        $this->load->view('puskesmas/tambahriwayat', $data);
    }

    public function createpegawai() {
        $config['upload_path'] = './assets/foto/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $input = $this->input->post(NULL);
        if ($this->m_puskesmas->checkNIP($input['nik']) == 1) {
            $this->alert('NIK Sudah terdaftar', 'puskesmas/view/pegawai');
        } else {
            if ($input['sosmed1'] == NULL) {
                $sosmed1 = '-';
            } else {
                $sosmed1 = $input['sosmed1'];
            }
            if ($input['sosmed2'] == NULL) {
                $sosmed2 = '-';
            } else {
                $sosmed2 = $input['sosmed2'];
            }
            if ($input['sosmed3'] == NULL) {
                $sosmed3 = '-';
            } else {
                $sosmed3 = $input['sosmed3'];
            }
            if (!$this->upload->do_upload()) {
                $insert_pegawai = array(
                    'nama' => $input['nama'],
                    'NIP' => $input['nik'],
                    'alamat' => $input['alamat'],
                    'hp' => $input['hp'],
                    'email' => $input['email'],
                    'sosmed1' => $sosmed1,
                    'sosmed2' => $sosmed2,
                    'sosmed3' => $sosmed3,
                    'rt' => $input['rt'],
                    'rw' => $input['rw'],
                    'id_kecamatan' => $input['kecamatan'],
                    'id_kelurahan' => $input['kelurahan'],
                    'tempat_lahir' => $input['tempatlahir'],
                    'tanggal_lahir' => date('Y-m-d', strtotime(str_replace('/', '-', $input['tanggallahir'])))
                );
            } else {
                $file = $this->upload->data();
                $insert_pegawai = array(
                    'nama' => $input['nama'],
                    'NIP' => $input['nik'],
                    'alamat' => $input['alamat'],
                    'hp' => $input['hp'],
                    'email' => $input['email'],
                    'sosmed1' => $sosmed1,
                    'sosmed2' => $sosmed2,
                    'sosmed3' => $sosmed3,
                    'rt' => $input['rt'],
                    'rw' => $input['rw'],
                    'id_kecamatan' => $input['kecamatan'],
                    'id_kelurahan' => $input['kelurahan'],
                    'foto' => $file['file_name'],
                    'tempat_lahir' => $input['tempatlahir'],
                    'tanggal_lahir' => date('Y-m-d', strtotime(str_replace('/', '-', $input['tanggallahir'])))
                );
            }
            $this->m_puskesmas->addPegawai($insert_pegawai);
            $insert_user = array(
                'username' => $input['username'],
                'password' => $input['password'],
                'role' => $input['status'],
                'id_users' => $this->m_puskesmas->getIdByNIP($input['nik'])
            );
            $this->m_puskesmas->addUser($insert_user);
            $this->alert('Pendaftaran Berhasil', 'puskesmas/view/pegawai');
        }
    }

    public function createposbindu() {
        $input = $this->input->post(NULL);
        $insert = array(
            'nama_posbindu' => $input['nama'],
            'latitude' => $input['latitude'],
            'longitude' => $input['longitude'],
            'alamat' => $input['alamat'],
            'rt' => $input['rw'],
            'rw' => $input['rw'],
            'id_kecamatan' => $input['kecamatan'],
            'id_kelurahan' => $input['kelurahan'],
            'id_puskesmas' => $this->m_index->getIdPuskesmasByPegawaiPuskesmas($this->session->userdata('id_users')),
        );
        $this->m_puskesmas->addPosbindu($insert);
        $this->alert('Pendaftaran Posbindu Berhasil', 'puskesmas/view/posbindu');
    }

    public function createkader() {
        $config['upload_path'] = './assets/foto/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $input = $this->input->post(NULL);
        if (!$this->upload->do_upload()) {
            if ($input['sosmed1'] == NULL) {
                $sosmed1 = '-';
            } else {
                $sosmed1 = $input['sosmed1'];
            }
            if ($input['sosmed2'] == NULL) {
                $sosmed2 = '-';
            } else {
                $sosmed2 = $input['sosmed2'];
            }
            if ($input['sosmed3'] == NULL) {
                $sosmed3 = '-';
            } else {
                $sosmed3 = $input['sosmed3'];
            }
            $insert_pegawai = array(
                'id_puskesmas' => $input['id_puskesmas'],
                'id_posbindu' => $input['posbindu'],
                'nama_kader' => $input['nama'],
                'alamat' => $input['alamat'],
                'hp' => $input['hp'],
                'email' => $input['email'],
                'sosmed1' => $sosmed1,
                'sosmed2' => $sosmed2,
                'sosmed3' => $sosmed3,
                'rt' => $input['rt'],
                'rw' => $input['rw'],
                'id_kecamatan' => $input['kecamatan'],
                'id_kelurahan' => $input['kelurahan'],
                'tempat_lahir' => $input['tempatlahir'],
                'tanggal_lahir' => date('Y-m-d', strtotime(str_replace('/', '-', $input['tanggallahir'])))
            );
        } else {
            $file = $this->upload->data();
            $insert_pegawai = array(
                'id_puskesmas' => $input['id_puskesmas'],
                'id_posbindu' => $input['posbindu'],
                'nama_kader' => $input['nama'],
                'alamat' => $input['alamat'],
                'hp' => $input['hp'],
                'email' => $input['email'],
                'sosmed1' => $input['sosmed1'],
                'sosmed2' => $input['sosmed2'],
                'sosmed3' => $input['sosmed3'],
                'rt' => $input['rt'],
                'rw' => $input['rw'],
                'id_kecamatan' => $input['kecamatan'],
                'id_kelurahan' => $input['kelurahan'],
                'foto' => $file['file_name'],
                'tempat_lahir' => $input['tempatlahir'],
                'tanggal_lahir' => date('Y-m-d', strtotime(str_replace('/', '-', $input['tanggallahir'])))
            );
        }
        $this->m_puskesmas->addKader($insert_pegawai);
        $insert_user = array(
            'username' => $input['username'],
            'password' => $input['password'],
            'role' => 'Kader',
            'id_users' => $this->m_puskesmas->getIdKaderByHp($input['hp'])
        );
        $this->m_index->addUser($insert_user);
        $this->alert('Pendaftaran Berhasil', 'puskesmas/view/kader');
    }

    public function createpasien() {
        $input = $this->input->post(NULL);
        if ($this->m_puskesmas->checkKTP($input['ktp']) == 1) {
            $this->alert('KTP Sudah terdaftar', 'puskesmas/add/adminpuskesmas');
        } else {
            $insert = array(
                'id_puskesmas' => $input['id_puskesmas'],
                'nama' => $input['nama'],
                'ktp' => $input['ktp'],
                'jenis_kelamin' => $input['jeniskelamin'],
                'alamat' => $input['alamat'],
                'hp' => $input['hp'],
                'rt' => $input['rt'],
                'rw' => $input['rw'],
                'id_kecamatan' => $input['kecamatan'],
                'id_kelurahan' => $input['kelurahan'],
                'tempat_lahir' => $input['tempatlahir'],
                'tgl_lahir' => date('Y-m-d', strtotime(str_replace('/', '-', $input['tanggallahir'])))
            );
            $this->m_puskesmas->addPasien($insert);
            $this->alert('Pendaftaran Berhasil', 'puskesmas/view/pasien');
        }
    }

    public function createriwayat() {
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
        $this->alert('Penambahan Riwayat Berhasil', 'puskesmas/view/pasien');
    }

    public function alert($text, $url) {
        ?>
        <script language="JavaScript">
            alert('<?php echo $text; ?>');
            document.location = '<?php echo site_url($url); ?>'
        </script>
        <?php
    }

}
