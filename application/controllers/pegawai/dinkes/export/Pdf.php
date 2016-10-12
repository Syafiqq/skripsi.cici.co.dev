<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends CI_Controller {

    public function __construct() {
        parent::__construct();
        @session_start();
        $this->load->library('session');
        if (($this->session->userdata('iduser') == null) || ($this->session->userdata('role') != 'Pegawai Dinkes')) {
            redirect('login');
        }
    }

    public function pegawai() {
        $query['data1'] = $this->m_dinkes->getListPegawai();
        //load the view and saved it into $html variable
        $html = $this->load->view('export/pegawai', $query, true);
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

    public function puskesmas() {
        $query['data1'] = $this->m_dinkes->getListPuskesmas();
        //load the view and saved it into $html variable
        $html = $this->load->view('export/puskesmas', $query, true);
        //this the the PDF filename that user will get to download
        $filename = 'daftar-puskesmas-per-' . date("Y-m-d"); //save our workbook as this file name
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
        $pdf->WriteHTML('<h1>Puskesmas</h1>');
        $pdf->WriteHTML($html);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
    }

    public function posbindu() {
        $query['data1'] = $this->m_dinkes->getListPosbindu();
        //load the view and saved it into $html variable
        $html = $this->load->view('export/posbindu', $query, true);
        //this the the PDF filename that user will get to download
        $filename = 'daftar-posbindu-per-' . date("Y-m-d"); //save our workbook as this file name
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
        $pdf->WriteHTML('<h1>Posbindu</h1>');
        $pdf->WriteHTML($html);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
    }

    public function kader() {
        $query['data1'] = $this->m_dinkes->getListKader();
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
        $pdf->WriteHTML('<h1>Kader</h1>');
        $pdf->WriteHTML($html);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
    }

    public function pasien() {
        $query['data1'] = $this->m_dinkes->getListPasien();
        //load the view and saved it into $html variable
        $html = $this->load->view('export/pasien', $query, true);
        //this the the PDF filename that user will get to download
        $filename = 'daftar-pasien-per-' . date("Y-m-d"); //save our workbook as this file name
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
        $pdf->WriteHTML('<h1>Pasien</h1>');
        $pdf->WriteHTML($html);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
    }

    public function riwayat($id) {
        $query['data1'] = $this->m_dinkes->getListRiwayatPasien($id);
        //load the view and saved it into $html variable
        $html = $this->load->view('export/riwayat', $query, true);
        //this the the PDF filename that user will get to download
        $filename = 'daftar-riwayat-' . $this->m_index->namaPasien($id) . '-per-' . date("Y-m-d"); //save our workbook as this file name
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
        $pdf->WriteHTML('<h1>Riwayat Pasien ' . $this->m_index->namaPasien($id) . '</h1>');
        $pdf->WriteHTML($html);
        //offer it to user via browser download! (The PDF won't be saved on your server HDD)
        $pdf->Output($pdfFilePath, "D");
    }

}
