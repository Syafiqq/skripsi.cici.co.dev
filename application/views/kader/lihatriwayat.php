<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Kader - Deteksi Dini Penyakit Stroke</title>

        <!-- Bootstrap core CSS -->
        <link rel="icon" href="<?php echo base_url(); ?>assets/favicon.ico" type="image/x-icon" />

        <link href="<?php echo base_url(); ?>assets/backend/css/bootstrap.min.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/backend/fonts/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/backend/css/animate.min.css" rel="stylesheet">

        <!-- Custom styling plus plugins -->
        <link href="<?php echo base_url(); ?>assets/backend/css/customKader.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/backend/css/icheck/flat/green.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/backend/css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">

        <script src="<?php echo base_url(); ?>assets/backend/js/jquery.min.js"></script>

        <!--[if lt IE 9]>
            <script src="../assets/js/ie8-responsive-file-warning.js"></script>
            <![endif]-->

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="<?php echo base_url(); ?>kader" class="site_title"><i class="fa fa-plus-circle"></i> <span>Stroke Prevention</span></a>
                        </div>
                        <div class="clearfix"></div>
                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3><?php echo $this->session->userdata('role'); ?></h3>
                                <ul class="nav side-menu">
                                    <li><a href="<?php echo base_url(); ?>kader"><i class="fa fa-home"></i>Daftar Pasien</span></a></li>
                                    <li><a href="<?php echo base_url(); ?>kader/add/pasien"><i class="fa fa-plus-square"></i>Tambah Pasien</a></li>
                                    <li><a  href="<?php echo base_url(); ?>kader/view/petunjuk"><i class="fa fa-bullhorn"></i>Petunjuk</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- /sidebar menu -->
                    </div>
                </div>

                <!-- top navigation -->
                <div class="top_nav">

                    <div class="nav_menu">
                        <nav class="" role="navigation">
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="<?php echo base_url(); ?>assets/backend/images/img.jpg" alt=""><?php echo $this->m_kader->getNamaKader($this->session->userdata('id_users')); ?>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                        <li><a href="<?php echo base_url(); ?>kader/view/profil"><i class="fa fa-user pull-right"></i> Profil</a></li>
                                        <li><a href="<?php echo base_url(); ?>main_controller/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                    </ul>
                                </li>


                            </ul>
                        </nav>
                    </div>

                </div>
                <!-- /top navigation -->
                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Laporan Data Pasien</h2>
                                    <?php if ($listriwayat->num_rows() != 0) { ?>
                                        <div class="btn-group pull-right">
                                            <button class="btn btn-success dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?php echo base_url(); ?>kader/export/xls/riwayat/<?php echo $this->uri->segment(3); ?>">XLS</a></li>
                                                <li><a href="<?php echo base_url(); ?>kader/export/pdf/riwayat/<?php echo $this->uri->segment(3); ?>">PDF</a></li>
                                            </ul>
                                        </div>                                    
                                    <?php } ?>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table table-bordered">
                                        <thead>
                                            <tr class="heading">
                                                <th>Tanggal</th>
                                                <th>Diagnosa</th>
                                                <th>Action</span></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($listriwayat->result() as $baris) : ?>
                                                <tr class="even pointer">
                                                    <td> <?php echo $baris->tanggal; ?></td>
                                                    <td> <?php echo $baris->diagnosa; ?></td>
                                                    <td style="width: 40%; text-align: center">
                                                        <a href="#modal-lihat-pegawai<?php echo $baris->id; ?>" data-toggle="modal" data-placement="bottom" title="Lihat Detail" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> Lihat Detail Riwayat</a>
                                                        <a href="<?php echo base_url() . 'kader/edit/riwayat/' . $baris->id; ?>" data-toggle="modal" data-placement="bottom" title="Edit Pegawai" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i> Edit Riwayat</a>
                                                        <a href="#modal-delete-pegawai<?php echo $baris->id; ?>" data-toggle="modal" data-placement="bottom" title="Hapus Pegawai" class="btn btn-xs btn-info"><i class="fa fa-times"></i> Hapus Riwayat</a>
                                                    </td>
                                                </tr>
                                            <div id="modal-lihat-pegawai<?php echo $baris->id; ?>"  class="modal animated pulse"  tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">  
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h2 class="modal-title" >
                                                                <font color="#000000">Detail Pegawai</span></font> 
                                                            </h2>
                                                        </div>  <!--end modal-header--> 
                                                        <div class="modal-body">
                                                            <div class="row"> 
                                                                <!-- Current avatar -->
                                                                <div class="col-md-6 col-sm-6 col-xs-6">	
                                                                    <p><b>Anggota Keluarga</b></p>
                                                                    <p><?php echo $baris->anggota_keluarga; ?></p>

                                                                    <p><b>Tekanan Darah</b></p>
                                                                    <p><?php echo $baris->td_sistole . '/' . $baris->td_diastole; ?></p>

                                                                    <p><b>Irama Denyut</b></p>
                                                                    <p><?php echo $baris->irama_denyut; ?></p>

                                                                    <p><b>Jumlah Rokok per Hari</b></p>
                                                                    <p><?php echo $baris->merokok . ' batang'; ?></p>

                                                                    <p><b>Mempunyai Riwayat Kolesterol?</b></p>
                                                                    <p>
                                                                        <?php
                                                                        if ($baris->kolesterol == 0) {
                                                                            echo 'Tidak';
                                                                        } else {
                                                                            echo 'Ya';
                                                                        }
                                                                        ?>
                                                                    </p>

                                                                    <p><b>Mempunyai Riwayat Diabetes?</b></p>
                                                                    <p>
                                                                        <?php
                                                                        if ($baris->diabetes == 0) {
                                                                            echo 'Tidak';
                                                                        } else {
                                                                            echo 'Ya';
                                                                        }
                                                                        ?>
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                                    <p><b>Intensitas Olahraga?</b></p>
                                                                    <p>
                                                                        <?php
                                                                        if ($baris->olahraga == 0) {
                                                                            echo 'Tidak Pernah';
                                                                        } else if (0 < $baris->olahraga && $baris->olahraga < 1) {
                                                                            echo 'Jarang';
                                                                        } else if ($baris->olahraga == 1) {
                                                                            echo 'Sering';
                                                                        }
                                                                        ?>
                                                                    </p>

                                                                    <p><b>Tinggi Badan</b></p>
                                                                    <p><?php echo $baris->tinggi_badan . ' cm'; ?></p>

                                                                    <p><b>Berat Badan</b></p>
                                                                    <p><?php echo $baris->berat_badan . ' Kg'; ?></p>

                                                                    <p><b>Mempunyai Riwayat Stroke?</b></p>
                                                                    <p>
                                                                        <?php
                                                                        if ($baris->riwayat_sakit == 0) {
                                                                            echo 'Tidak';
                                                                        } else {
                                                                            echo 'Ya';
                                                                        }
                                                                        ?>
                                                                    </p>

                                                                    <p><b>Keluarga Mempunyai Riwayat Stroke?</b></p>
                                                                    <p>
                                                                        <?php
                                                                        if ($baris->riwayat_keluarga == 0) {
                                                                            echo 'Tidak';
                                                                        } else {
                                                                            echo 'Ya';
                                                                        }
                                                                        ?>
                                                                    </p>
                                                                    <p><b>Diagnosa</b></p>
                                                                    <p><?php echo $baris->diagnosa; ?></p>
                                                                </div>
                                                            </div>
                                                        </div><!--modal body--> 
                                                    </div><!--modal content--> 
                                                </div>
                                            </div>              
                                            <div id="modal-edit-pegawai<?php echo $baris->id; ?>"  class="modal animated pulse"  tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">  
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h2 class="modal-title" >
                                                                <font color="#000000">Edit Riwayat</font> 
                                                            </h2>
                                                        </div> 
                                                        <!--end modal-header--> 
                                                        <form action="<?php echo site_url('kader/edit/riwayat' . $baris->id); ?>" method="post">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="item form-group" style="padding-bottom: 10px;">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="occupation">Anggota Keluarga<span class="required"></span></label>
                                                                        <div class="col-md-8 col-xs-12">
                                                                            <select class="form-control select" name="sakit" required>
                                                                                <option hidden="">Pilih Anggota Keluarga</option>
                                                                                <option value="Ayah" <?php
                                                                                if ($baris->anggota_keluarga == 'Ayah') {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>Ayah</option>
                                                                                <option value="Ibu" <?php
                                                                                if ($baris->anggota_keluarga == 'Ibu') {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>Ibu</option>
                                                                                <option value="Saudara" <?php
                                                                                if ($baris->anggota_keluarga == 'Saudara') {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>Saudara</option>
                                                                                <option value="Diri Sendiri" <?php
                                                                                if ($baris->anggota_keluarga == 'Diri Sendiri') {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>Diri Sendiri</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <br><br>
                                                                    <div class="item form-group">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="number">Tekanan Darah (Sistole/Diastole)<span class="required"></span></label>
                                                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                                                            <input type="number" id="sistole" name="sistole" required="required" data-validate-minmax="50,200" class="form-control col-md-7 col-xs-12" placeholder="sistole" value="<?php echo $baris->td_sistole; ?>">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                                                            <input type="number" id="diastole" name="diastole" required="required" data-validate-minmax="60,120" class="form-control col-md-7 col-xs-12" placeholder="diastole" value="<?php echo $baris->td_diastole; ?>">
                                                                        </div>
                                                                    </div><br><br>

                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Irama Denyut</label>
                                                                        <div class="col-md-8 col-xs-12">
                                                                            <select class="form-control select" name="irama" required>
                                                                                <option hidden="">Pilih Irama Denyut</option>
                                                                                <option value="0" <?php
                                                                                if ($baris->irama_denyut == 0) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>Irama</option>
                                                                                <option value="1" <?php
                                                                                if ($baris->irama_denyut == 1) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>Tak berirama</option>
                                                                            </select>
                                                                        </div>
                                                                    </div> 
                                                                    <br><br>

                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Merokok (Jika Tidak Pernah, isi dengan 0)</label>
                                                                        <div class="col-md-8 col-xs-12">
                                                                            <input type="number" id="merokok" name="merokok" required="required" data-validate-minmax="0,1000" class="form-control col-md-7 col-xs-12" placeholder="Isi jumlah batang per hari" value="<?php echo $baris->merokok; ?>">
                                                                        </div>
                                                                    </div> 
                                                                    <br><br>
                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Kolesterol</label>
                                                                        <div class="col-md-8 col-xs-12">
                                                                            <select class="form-control select" name="kolesterol" required>
                                                                                <option hidden="">Tingkatan Kolesterol</option>
                                                                                <option value="0" <?php
                                                                                if ($baris->kolesterol == 0) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>Kurang dari 200</option>
                                                                                <option value="1" <?php
                                                                                if ($baris->kolesterol == 1) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>200-239</option>
                                                                                <option value="2" <?php
                                                                                if ($baris->kolesterol == 2) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>Lebih dari 240</option>
                                                                            </select>
                                                                        </div>
                                                                    </div> <br><br>
                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Diabetes Melitus</label>
                                                                        <div class="col-md-8 col-xs-12">                                                                                            
                                                                            <select class="form-control select" name="diabetes" required>
                                                                                <option hidden="">Mempunyai Riwayat Penyakit Diabetes?</option>
                                                                                <option value="1" <?php
                                                                                if ($baris->diabetes == 0) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>Ya</option>
                                                                                <option value="0" <?php
                                                                                if ($baris->diabetes == 1) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>Tidak</option>
                                                                            </select>
                                                                        </div>
                                                                    </div> 
                                                                    <br><br>

                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Kegiatan Olahraga</label>
                                                                        <div class="col-md-8 col-xs-12">                                                                                         
                                                                            <select class="form-control select" name="olahraga" required>
                                                                                <option hidden="">Apakah sering berolahraga?</option>
                                                                                <option value="1" <?php
                                                                                if ($baris->olahraga == 1) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>Ya</option>
                                                                                <option value="0" <?php
                                                                                if ($baris->olahraga == 0) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>Tidak</option>
                                                                                <option value="0.5" <?php
                                                                                if ($baris->olahraga == 0.) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>Jarang</option>
                                                                            </select>
                                                                        </div>
                                                                    </div> <br><br>
                                                                    <div class="item form-group">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Tinggi / Berat Badan <span class="required"></span></label>
                                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                                            <input type="number" id="tinggi_badan" name="tinggi_badan" required="required" data-validate-minmax="50,200" class="form-control col-md-7 col-xs-12" placeholder="tinggi badan" value="<?php echo $baris->tinggi_badan; ?>">
                                                                        </div>
                                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                                            <input type="number" id="berat_badan" name="berat_badan" required="required" data-validate-minmax="20,250" class="form-control col-md-7 col-xs-12" placeholder="berat badan" value="<?php echo $baris->berat_badan; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <br><br>
                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Riwayat Sakit</label>
                                                                        <div class="col-md-8 col-xs-12">
                                                                            <select class="form-control select" name="sakit" required>
                                                                                <option hidden="">Apakah Pernah Sakit Stroke Sebelumnya?</option>
                                                                                <option value="1" <?php if ($baris->riwayat_sakit == 1) {
                                                                                        echo 'selected';
                                                                                    } ?>>Ya</option>
                                                                                <option value="0" <?php if ($baris->riwayat_sakit == 0) {
                                                                                        echo 'selected';
                                                                                    } ?>>Tidak</option>
                                                                            </select>
                                                                        </div>
                                                                    </div> 
                                                                    <br><br>
                                                                    <div class="form-group">
                                                                        <label class="control-label col-md-4 col-sm-4 col-xs-12">Riwayat Keluarga</label>
                                                                        <div class="col-md-8 col-xs-12">
                                                                            <select class="form-control select" name="keluarga" required>
                                                                                <option hidden="">Apakah Keluarga Memiliki Keturunan Stroke?</option>
                                                                                <option value="1" <?php if ($baris->riwayat_keluarga == 1) {
                                                                                        echo 'selected';
                                                                                    } ?>>Ya</option>
                                                                                <option value="0" <?php if ($baris->riwayat_keluarga == 0) {
                                                                                        echo 'selected';
                                                                                    } ?>>Tidak</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-primary pull-right">Save Change <span class="fa fa-floppy-o fa-right"></span></button>
                                                            </div>
                                                        </form>
                                                    </div><!--modal content--> 
                                                </div>
                                            </div>  

                                            <div id="modal-delete-pegawai<?php echo $baris->id; ?>"  class="modal animated pulse"  tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">  
                                                        <form action="<?php echo site_url('c_kader/deletepegawai/' . $baris->id); ?>" method="post">                            
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h2 class="modal-title" >
                                                                    <font color="#000000">Hapus Pegawai <?php echo $baris->nama; ?>?</span></font> 
                                                                </h2>
                                                            </div>  <!--end modal-header--> 
                                                            <div class="modal-footer">
                                                                <a href="<?php echo site_url('c_kader/deletepegawai/' . $baris->id); ?>" class="btn btn-success btn-lg">Ya</a>
                                                                <button class="btn btn-default btn-lg mb-control-close">Batal</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div> 
<?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <br />
                        <br />
                        <br />

                    </div>

                    <!-- footer content -->
                    <footer>
                        <div class="">
                            <p>©2015 All Rights Reserved. Fakultas Ilmu Komputer Universitas Brawijaya &amp; Dinas Kesehatan Kota Malang</p>
                        </div>
                        <div class="clearfix"></div>
                    </footer>
                    <!-- /footer content -->

                </div>
                <!-- /page content -->
            </div>

        </div>

        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>


        <script src="<?php echo base_url(); ?>assets/backend/js/bootstrap.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/datatables/jquery.dataTables.min.js"></script>

        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/tableexport/tableExport.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/tableexport/jquery.base64.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/tableexport/html2canvas.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/tableexport/jspdf/libs/sprintf.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/tableexport/jspdf/jspdf.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/tableexport/jspdf/libs/base64.js"></script>
        <!-- chart js -->
        <script src="<?php echo base_url(); ?>assets/backend/js/chartjs/chart.min.js"></script>
        <!-- bootstrap progress js -->
        <script src="<?php echo base_url(); ?>assets/backend/js/progressbar/bootstrap-progressbar.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/backend/js/nicescroll/jquery.nicescroll.min.js"></script>
        <!-- icheck -->
        <script src="<?php echo base_url(); ?>assets/backend/js/icheck/icheck.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/backend/js/custom.js"></script>


        <!-- Datatables -->
        <script src="<?php echo base_url(); ?>assets/backend/js/datatables/js/jquery.dataTables.js"></script>
        <script src="<?php echo base_url(); ?>assets/backend/js/datatables/tools/js/dataTables.tableTools.js"></script>

        <!-- image cropping -->
        <script src="<?php echo base_url(); ?>assets/backend/js/cropping/cropper.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/backend/js/cropping/main2.js"></script>
        <script>
            $(document).ready(function () {
                $('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });

            var asInitVals = new Array();
            $(document).ready(function () {
                var oTable = $('#example').dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:"
                    },
                    "aoColumnDefs": [
                        {
                            'bSortable': false,
                            'aTargets': [2]
                        } //disables sorting for column one
                    ],
                    'iDisplayLength': 10,
                    "sPaginationType": "full_numbers",
                    "tableTools": {
                        "sSwfPath": "<?php echo base_url('assets/backend/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
                    }
                });
                $("tfoot input").keyup(function () {
                    /* Filter on the column based on the index of this element's parent <th> */
                    oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
                });
                $("tfoot input").each(function (i) {
                    asInitVals[i] = this.value;
                });
                $("tfoot input").focus(function () {
                    if (this.className == "search_init") {
                        this.className = "";
                        this.value = "";
                    }
                });
                $("tfoot input").blur(function (i) {
                    if (this.value == "") {
                        this.className = "search_init";
                        this.value = asInitVals[$("tfoot input").index(this)];
                    }
                });
            });
        </script>
    </body>
</html>