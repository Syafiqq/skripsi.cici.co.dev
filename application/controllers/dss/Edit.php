<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (($this->session->userdata('iduser') == null) || ($this->session->userdata('role') != 'Admin Puskesmas')) {
            redirect('login');
        }
    }

    public function profilepicture() {
        $config['upload_path'] = './assets/foto/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['overwrite'] = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $this->alert('Gagal Upload Ke Server', 'puskesmas/view/profil');
        } else {
            $file = $this->upload->data();
            if ($this->m_puskesmas->updateFoto($this->input->post('id'), $file['file_name'])) {
                redirect('puskesmas/view/profil');
            } else {
                $this->alert('Gagal Merubah Data Pada Server', 'puskesmas/view/profil');
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
        if ($this->m_puskesmas->updatePegawai($input['id'], $data)) {
            $this->alert('Perubahan Data Diri Berhasil', 'puskesmas/view/profil');
        } else {
            $this->alert('Gagal Merubah Data Pada Server', 'puskesmas/view/profil');
        }
    }

    public function user() {
        $input = $this->input->post(NULL);
        if ($this->m_index->updateUser($input['iduser'], $input)) {
            $this->alert('Perubahan Username dan Password Berhasil', 'puskesmas/view/profil');
        } else {
            $this->alert('Gagal Merubah Data Pada Server', 'puskesmas/view/profil');
        }
    }

    public function posbindu($id) {
        $data['kecamatan'] = $this->m_index->kecamatan();
        $data['listpuskesmas'] = $this->m_puskesmas->getPuskesmasById($id);
        $this->load->view('puskesmas/editpuskesmas', $data);
    }

    public function pasien($id) {
        $data['kecamatan'] = $this->m_index->kecamatan();
        $data['listpuskesmas'] = $this->m_puskesmas->getPuskesmasById($id);
        $this->load->view('puskesmas/editpuskesmas', $data);
    }

    public function pasientokader($id) {
        $data['posbindu'] = $this->m_index->getListPosbindu($this->m_index->getIdPuskesmasByPegawaiPuskesmas($this->session->userdata('id_users')));
        $data['listpasien'] = $this->m_puskesmas->getPasienById($id);
        $this->load->view('puskesmas/serahkankekader', $data);
    }

    public function riwayat($id) {
        $data['kecamatan'] = $this->m_index->kecamatan();
        $data['listpuskesmas'] = $this->m_puskesmas->getRiwayatById($id);
        $this->load->view('puskesmas/editriwayat', $data);
    }

    public function updatePosbindu() {
        $input = $this->input->post(NULL);
        $update = array(
            'nama_puskesmas' => $input['nama'],
            'latitude' => $input['latitude'],
            'longitude' => $input['longitude'],
            'alamat' => $input['alamat'],
            'rt' => $input['rw'],
            'rw' => $input['rw'],
            'id_kecamatan' => $input['kecamatan'],
            'id_kelurahan' => $input['kelurahan'],
            'kode_puskesmas' => $input['kode'],
            'jenis_puskesmas' => $input['jenis'],
            'telepon' => $input['telepon'],
        );
        if ($this->m_puskesmas->updatePosbindu($input['id'], $update)) {
            $this->alert('Perubahan Data Puskesmas Berhasil', 'puskesmas/view/puskesmas');
        } else {
            $this->alert('Gagal Dalam Proses Perubahan Data Puskesmas', 'puskesmas/edit/puskesmas');
        }
    }

    public function updatePasien() {
        $input = $this->input->post(NULL);
        $update = array(
            'anggota_keluarga' => $input['anggota_keluarga'],
            'td_sistole' => $input['sistole'],
            'td_diastole' => $input['diastole'],
            'irama_denyut' => $input['irama_denyut'],
            'merokok' => $input['merokok'],
            'kolesterol' => $input['kolesterol'],
            'diabetes' => $input['diabetes'],
            'olahraga' => $input['olahraga'],
            'tinggi_badan' => $input['tinggibadan'],
            'berat_badan' => $input['beratbadan'],
            'riwayat_sakit' => $input['sakit'],
            'riwayat_keluarga' => $input['keluarga'],
        );
        $this->m_puskesmas->updatePasien($input['id'], $update);
        $this->alert('Perubahan Data Puskesmas Berhasil', 'puskesmas/view/puskesmas');
    }

    public function updateRiwayat() {
        $input = $this->input->post(NULL);
        $update = array(
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
        $this->m_puskesmas->updateRiwayat($input['id'], $update);
        $this->alert('Perubahan Riwayat Pasien ' . $this->m_puskesmas->getNamaPasien($input['id_pasien'])
                . ' Berhasil', 'puskesmas/view/riwayat/' . $input['id_pasien']);
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
