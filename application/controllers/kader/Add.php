<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (($this->session->userdata('iduser') == null) || ($this->session->userdata('role') != 'Kader')) {
            redirect('login');
        }
    }

    public function pasien() {
        $data['kecamatan'] = $this->m_index->kecamatan();
        $this->load->view('kader/tambahpasien', $data);
    }

    public function riwayat($id_pasien) {
        $data['kecamatan'] = $this->m_index->kecamatan();
        $data['id_pasien'] = $id_pasien;
        $this->load->view('kader/tambahriwayat', $data);
    }

    public function createpasien() {
        $input = $this->input->post(NULL);
        if ($this->m_kader->checkKTP($input['ktp']) == 1) {
            $this->alert('Pasien Sudah terdaftar', 'kader/add/pasien');
        } else {
            $insert = array(
                'id_kader' => $input['id_kader'],
                'nama' => $input['nama'],
                'ktp' => $input['ktp'],
                'alamat' => $input['alamat'],
                'hp' => $input['hp'],
                'email' => $input['email'],
                'rt' => $input['rt'],
                'rw' => $input['rw'],
                'id_kecamatan' => $input['kecamatan'],
                'id_kelurahan' => $input['kelurahan'],
                'tempat_lahir' => $input['tempatlahir'],
                'tanggal_lahir' => date('Y-m-d', strtotime(str_replace('/', '-', $input['tanggallahir'])))
            );
            if ($this->m_kader->addPasien($insert)) {
                $this->alert('Pendaftaran Pasien Berhasil', 'kader');
            } else {
                $this->alert('Gagal Dalam Proses Pendaftaran Pasien', 'kader/add/pasien');
            }
        }
    }

    public function createriwayat() {
        $config['upload_path'] = './assets/foto/';
        $config['allowed_types'] = 'gif|jpg|png';
        $this->load->library('upload', $config);
        $input = $this->input->post(NULL);
        if ($this->m_kader->checkNIP($input['nik']) == 1) {
            $this->alert('NIK Sudah terdaftar', 'kader/kader/add/adminkader');
        } else {
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
                    'id_kader' => $input['id_kader'],
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
            if ($this->m_kader->addPegawai($insert_pegawai)) {
                $insert_user = array(
                    'username' => $input['username'],
                    'password' => $input['password'],
                    'role' => $input['status'],
                    'id_users' => $this->m_kader->getIdByNIP($input['nik'])
                );
                if ($this->m_index->addUser($insert_user)) {
                    $this->alert('Pendaftaran Berhasil', 'kader/kader/view/pegawai');
                } else {
                    $this->alert('Gagal Dalam Proses Pendaftaran User', 'kader/add/pegawai');
                }
            } else {
                $this->alert('Gagal Dalam Proses Pendaftaran Pegawai', 'kader/add/pegawai');
            }
        }
    }

    public
            function alert($text, $url) {
        ?>
        <script language="JavaScript">
            alert('<?php echo $text; ?>');
            document.location = '<?php echo site_url($url); ?>'
        </script>
        <?php
    }

}
