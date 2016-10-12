<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (($this->session->userdata('iduser') == null) || ($this->session->userdata('role') != 'Pegawai Dinkes')) {
            redirect('login');
        }
    }

    public function profilepicture() {
        $config['upload_path'] = './assets/foto/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $this->alert('Gagal Upload Ke Server', 'pegawai/dinkes/view/profil');
        } else {
            $file = $this->upload->data();
            if ($this->m_dinkes->updateFoto($this->input->post('id'), $file['file_name']) != $report['error']) {
                redirect('pegawai/dinkes/view/profil');
            } else {
                $this->alert('Gagal Merubah Data Pada Server', 'pegawai/dinkes/view/profil');
            }
        }
    }

    public function pegawai() {
        $input = $this->input->post(NULL);
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

        $data = array(
            'nama' => $input['nama'],
            'NIP' => $input['nip'],
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
            'tempat_lahir' => $input['tempat_lahir'],
            'tanggal_lahir' => date('Y-m-d', strtotime(str_replace('/', '-', $input['tanggal_lahir'])))
        );
        if ($this->m_dinkes->updatePegawai($input['id'], $data)) {
            $this->alert('Perubahan Data Diri Berhasil', 'pegawai/dinkes/view/profil');
        } else {
            $this->alert('Gagal Merubah Data Pada Server', 'pegawai/dinkes/view/profil');
        }
    }

    public function user() {
        $input = $this->input->post(NULL);
        if ($this->m_index->updateUser($input['iduser'], $input)) {
            $this->alert('Perubahan Username dan Password Berhasil', 'pegawai/dinkes/view/profil');
        } else {
            $this->alert('Gagal Merubah Data Pada Server', 'pegawai/dinkes/view/profil');
        }
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
