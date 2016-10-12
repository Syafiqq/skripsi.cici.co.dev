<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends CI_Controller {

    public function __construct() {
        parent::__construct();
        @session_start();
        $this->load->library('session');
        if (($this->session->userdata('iduser') == null) || ($this->session->userdata('role') != 'dinkes')) {
            redirect('login');
        }
    }

    public function pegawaiDinkes() {
        $query['data1'] = $this->m_dinkes->getListPegawai();
        //load the view and saved it into $html variable
        $html = $this->load->view('export/pegawaidinkes', $query, true);
        //this the the PDF filename that user will get to download
        $filename = 'daftar-pegawai-dinkes-per-' . date("Y-m-d"); //save our workbook as this file name
        $pdfFilePath = $filename . ".pdf";
        //load mPDF library
        $this->load->library('m_pdf');
        //actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //Set Landscape
        $pdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '', 10, // margin_left
                10, // margin right
                10, // margin top
                10, // margin bottom
                6, // margin header
                3); // margin footer
        //generate the PDF!
        $pdf->WriteHTML('<h1>Pegawai Dinkes</h1>');
        $pdf->WriteHTML($html);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
    }

    public function kader() {
        $query['data1'] = $this->m_dinkes->getListPuskesmas();
        //load the view and saved it into $html variable
        $html = $this->load->view('export/kader', $query, true);
        //this the the PDF filename that user will get to download
        $filename = 'daftar-kader-per-' . date("Y-m-d"); //save our workbook as this file name
        $pdfFilePath = $filename . ".pdf";
        //load mPDF library
        $this->load->library('m_pdf');
        //actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //Set Landscape
        $pdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '', 10, // margin_left
                10, // margin right
                10, // margin top
                10, // margin bottom
                6, // margin header
                3); // margin footer
        //generate the PDF!
        $pdf->WriteHTML('<h1>Pegawai Dinkes</h1>');
        $pdf->WriteHTML($html);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
    }

    public function pegawaiPuskesmas() {
        $query['data1'] = $this->m_kader->getListPegawai($this->m_kader->idkader());
        //load the view and saved it into $html variable
        $html = $this->load->view('export/pegawai', $query, true);
        //this the the PDF filename that user will get to download
        $filename = 'daftar-pegawai-kader-per-' . date("Y-m-d"); //save our workbook as this file name
        $pdfFilePath = $filename . ".pdf";
        //load mPDF library
        $this->load->library('m_pdf');
        //actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //Set Landscape
        $pdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '', 10, // margin_left
                10, // margin right
                10, // margin top
                10, // margin bottom
                6, // margin header
                3); // margin footer
        //generate the PDF!
        $pdf->WriteHTML('<h1>Pegawai Puskesmas ' . $this->m_kader_ . '</h1>');
        $pdf->WriteHTML($html);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
    }

    public function posbindu() {
        $query['data1'] = $this->m_kader->getListPegawai($this->m_kader->idkader());
        //load the view and saved it into $html variable
        $html = $this->load->view('export/pegawai', $query, true);
        //this the the PDF filename that user will get to download
        $filename = 'daftar-pegawai-kader-per-' . date("Y-m-d"); //save our workbook as this file name
        $pdfFilePath = $filename . ".pdf";
        //load mPDF library
        $this->load->library('m_pdf');
        //actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //Set Landscape
        $pdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '', 10, // margin_left
                10, // margin right
                10, // margin top
                10, // margin bottom
                6, // margin header
                3); // margin footer
        //generate the PDF!
        $pdf->WriteHTML('<h1>Pegawai Puskesmas ' . $this->m_kader_ . '</h1>');
        $pdf->WriteHTML($html);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
    }

    public function kader() {
        $query['data1'] = $this->m_kader->getListPegawai($this->m_kader->idkader());
        //load the view and saved it into $html variable
        $html = $this->load->view('export/pegawai', $query, true);
        //this the the PDF filename that user will get to download
        $filename = 'daftar-pegawai-kader-per-' . date("Y-m-d"); //save our workbook as this file name
        $pdfFilePath = $filename . ".pdf";
        //load mPDF library
        $this->load->library('m_pdf');
        //actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //Set Landscape
        $pdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '', 10, // margin_left
                10, // margin right
                10, // margin top
                10, // margin bottom
                6, // margin header
                3); // margin footer
        //generate the PDF!
        $pdf->WriteHTML('<h1>Kader</h1>');
        $pdf->WriteHTML($html);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
    }

    public function kaderByIdPuskesmas() {
        $query['data1'] = $this->m_kader->getListPegawai($this->m_kader->idkader());
        //load the view and saved it into $html variable
        $html = $this->load->view('export/pegawai', $query, true);
        //this the the PDF filename that user will get to download
        $filename = 'daftar-pegawai-kader-per-' . date("Y-m-d"); //save our workbook as this file name
        $pdfFilePath = $filename . ".pdf";
        //load mPDF library
        $this->load->library('m_pdf');
        //actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //Set Landscape
        $pdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '', 10, // margin_left
                10, // margin right
                10, // margin top
                10, // margin bottom
                6, // margin header
                3); // margin footer
        //generate the PDF!
        $pdf->WriteHTML('<h1>Kader Puskesmas ' . $this->m_kader_ . '</h1>');
        $pdf->WriteHTML($html);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
    }

    public function kaderByIdPosbindu() {
        $query['data1'] = $this->m_kader->getListPegawai($this->m_kader->idkader());
        //load the view and saved it into $html variable
        $html = $this->load->view('export/pegawai', $query, true);
        //this the the PDF filename that user will get to download
        $filename = 'daftar-pegawai-kader-per-' . date("Y-m-d"); //save our workbook as this file name
        $pdfFilePath = $filename . ".pdf";
        //load mPDF library
        $this->load->library('m_pdf');
        //actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //Set Landscape
        $pdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '', 10, // margin_left
                10, // margin right
                10, // margin top
                10, // margin bottom
                6, // margin header
                3); // margin footer
        //generate the PDF!
        $pdf->WriteHTML('<h1>Kader Puskesmas ' . $this->m_kader_ . '</h1>');
        $pdf->WriteHTML($html);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
    }

    public function pasien() {
        $query['data1'] = $this->m_kader->getListPegawai($this->m_kader->idkader());
        //load the view and saved it into $html variable
        $html = $this->load->view('export/pegawai', $query, true);
        //this the the PDF filename that user will get to download
        $filename = 'daftar-pegawai-kader-per-' . date("Y-m-d"); //save our workbook as this file name
        $pdfFilePath = $filename . ".pdf";
        //load mPDF library
        $this->load->library('m_pdf');
        //actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //Set Landscape
        $pdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '', 10, // margin_left
                10, // margin right
                10, // margin top
                10, // margin bottom
                6, // margin header
                3); // margin footer
        //generate the PDF!
        $pdf->WriteHTML('<h1>Pegawai Puskesmas ' . $this->m_kader_ . '</h1>');
        $pdf->WriteHTML($html);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
    }

    public function pasienByIdPuskesmas() {
        $query['data1'] = $this->m_kader->getListPegawai($this->m_kader->idkader());
        //load the view and saved it into $html variable
        $html = $this->load->view('export/pegawai', $query, true);
        //this the the PDF filename that user will get to download
        $filename = 'daftar-pegawai-kader-per-' . date("Y-m-d"); //save our workbook as this file name
        $pdfFilePath = $filename . ".pdf";
        //load mPDF library
        $this->load->library('m_pdf');
        //actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //Set Landscape
        $pdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '', 10, // margin_left
                10, // margin right
                10, // margin top
                10, // margin bottom
                6, // margin header
                3); // margin footer
        //generate the PDF!
        $pdf->WriteHTML('<h1>Pegawai Puskesmas ' . $this->m_kader_ . '</h1>');
        $pdf->WriteHTML($html);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
    }

    public function pasienByIdPosbindu() {
        $query['data1'] = $this->m_kader->getListPegawai($this->m_kader->idkader());
        //load the view and saved it into $html variable
        $html = $this->load->view('export/pegawai', $query, true);
        //this the the PDF filename that user will get to download
        $filename = 'daftar-pegawai-kader-per-' . date("Y-m-d"); //save our workbook as this file name
        $pdfFilePath = $filename . ".pdf";
        //load mPDF library
        $this->load->library('m_pdf');
        //actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //Set Landscape
        $pdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '', 10, // margin_left
                10, // margin right
                10, // margin top
                10, // margin bottom
                6, // margin header
                3); // margin footer
        //generate the PDF!
        $pdf->WriteHTML('<h1>Pegawai Puskesmas ' . $this->m_kader_ . '</h1>');
        $pdf->WriteHTML($html);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
    }

    public function pasienByIdKader() {
        $query['data1'] = $this->m_kader->getListPegawai($this->m_kader->idkader());
        //load the view and saved it into $html variable
        $html = $this->load->view('export/pegawai', $query, true);
        //this the the PDF filename that user will get to download
        $filename = 'daftar-pegawai-kader-per-' . date("Y-m-d"); //save our workbook as this file name
        $pdfFilePath = $filename . ".pdf";
        //load mPDF library
        $this->load->library('m_pdf');
        //actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //Set Landscape
        $pdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '', 10, // margin_left
                10, // margin right
                10, // margin top
                10, // margin bottom
                6, // margin header
                3); // margin footer
        //generate the PDF!
        $pdf->WriteHTML('<h1>Pegawai Puskesmas ' . $this->m_kader_ . '</h1>');
        $pdf->WriteHTML($html);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
    }

    public function riwayat($id) {
        $query['data1'] = $this->m_dinkes->getListRiwayatPasien($id);
        //load the view and saved it into $html variable
        $html = $this->load->view('export/pegawai', $query, true);
        //this the the PDF filename that user will get to download
        $filename = 'daftar-pegawai-kader-per-' . date("Y-m-d"); //save our workbook as this file name
        $pdfFilePath = $filename . ".pdf";
        //load mPDF library
        $this->load->library('m_pdf');
        //actually, you can pass mPDF parameter on this load() function
        $pdf = $this->m_pdf->load();
        //Set Landscape
        $pdf->AddPage('L', // L - landscape, P - portrait
                '', '', '', '', 10, // margin_left
                10, // margin right
                10, // margin top
                10, // margin bottom
                6, // margin header
                3); // margin footer
        //generate the PDF!
        $pdf->WriteHTML('<h1>Riwayat Pasien ' . $this->m_index->namaPasien($riwayat->result()->id_pasien) . '</h1>');
        $pdf->WriteHTML($html);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
    }

}
