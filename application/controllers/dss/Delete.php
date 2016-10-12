<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (($this->session->userdata('iduser') == null) || ($this->session->userdata('role') != 'Admin Puskesmas')) {
            redirect('login');
        }
    }

    public function pegawai($id) {
        if ($this->m_puskesmas->deletepegawai($id)) {
            redirect('puskesmas/view/pegawai');
        } else {
            $this->alert('Anda tidak diperbolehkan menghapus pegawai ini','puskesmas/view/pegawai');
        }
    }

    public function posbindu($id) {
        $this->m_puskesmas->deleteposbindu($id);
        redirect('puskesmas/view/posbindu');
    }

    public function kader($id) {
        $this->m_puskesmas->deletekader($id);
        redirect('puskesmas/view/kader');
    }

    public function pasien($id) {
        $this->m_puskesmas->deletepasien($id);
        redirect('puskesmas/view/pasien');
    }

    public function riwayat($id) {
        $this->m_puskesmas->deleteriwayat($id);
        redirect('puskesmas/view/riwayat');
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
