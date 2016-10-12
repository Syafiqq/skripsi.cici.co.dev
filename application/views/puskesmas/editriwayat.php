<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Puskesmas - Deteksi Dini Penyakit Stroke</title>
        <!-- Bootstrap core CSS -->
        <link rel="icon" href="<?php echo base_url(); ?>assets/favicon.ico" type="image/x-icon" />

        <link href="<?php echo base_url(); ?>assets/backend/css/bootstrap.min.css" rel="stylesheet"/>

        <link href="<?php echo base_url(); ?>assets/backend/fonts/css/font-awesome.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>assets/backend/css/animate.min.css" rel="stylesheet"/>

        <!-- Custom styling plus plugins -->
        <link href="<?php echo base_url(); ?>assets/backend/css/customPuskesmas.css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>assets/backend/css/icheck/flat/green.css" rel="stylesheet"/>
        <!-- editor -->
        <link href="http:/netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>assets/backend/css/editor/external/google-code-prettify/prettify.css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>assets/backend/css/editor/index.css" rel="stylesheet"/>
        <!-- select2 -->
        <link href="<?php echo base_url(); ?>assets/backend/css/select/select2.min.css" rel="stylesheet"/>
        <!-- switchery -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/backend/css/switchery/switchery.min.css" />

        <script src="<?php echo base_url(); ?>assets/backend/js/jquery.min.js"/>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/libs/jquery.min.js"/>

        <!-- Memanggil file .js untuk proses autocomplete -->
        <script type='text/javascript' src='<?php echo base_url(); ?>assets/backend/autocomplete/js/jquery-1.8.2.min.js'></script>
        <script type='text/javascript' src='<?php echo base_url(); ?>assets/backend/autocomplete/js/jquery.autocomplete.js'></script>

        <!-- Memanggil file .css untuk style saat data dicari dalam filed -->
        <link href='<?php echo base_url(); ?>assets/backend/autocomplete/js/jquery.autocomplete.css' rel='stylesheet' />

    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="<?php echo base_url(); ?>puskesmas" class="site_title"><i class="fa fa-plus-circle"></i> <span>Stroke Prevention</span></a>
                        </div>
                        <div class="clearfix"></div>
                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                            <div class="menu_section">
                                <h3><?php echo $this->session->userdata('role'); ?></h3>
                                <ul class="nav side-menu">
                                    <li><a href="<?php echo base_url(); ?>puskesmas"><i class="fa fa-home"></i>Home</span></a></li>
                                    <li><a href="<?php echo base_url(); ?>puskesmas/view/puskesmas"><i class="fa fa-user"></i>Profil Puskesmas</a></li>
                                    <li><a><i class="fa fa-edit"></i>Manajemen Puskesmas<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url(); ?>puskesmas/add/pegawai">Tambah Pegawai Puskesmas</a></li>
                                            <li><a href="<?php echo base_url(); ?>puskesmas/view/pegawai">Data Pegawai Puskesmas</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-edit"></i>Manajemen Posbindu<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url(); ?>puskesmas/add/posbindu">Tambah Posbindu</a></li>
                                            <li><a href="<?php echo base_url(); ?>puskesmas/view/posbindu">Data Posbindu</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-edit"></i>Manajemen Kader<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url(); ?>puskesmas/add/kader">Tambah Kader</a></li>
                                            <li><a href="<?php echo base_url(); ?>puskesmas/view/kader">Data Kader</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-edit"></i>Manajemen Pasien<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url(); ?>puskesmas/add/pasien">Tambah Pasien</a></li>
                                            <li><a href="<?php echo base_url(); ?>puskesmas/view/pasien">Data Pasien</a></li>
                                        </ul>
                                    </li>
                                    <li><a  href="<?php echo base_url(); ?>puskesmas/view/petunjuk"><i class="fa fa-bullhorn"></i>Petunjuk</span></a></li>
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
                                        <img src="<?php echo base_url(); ?>assets/backend/images/img.jpg" alt=""><?php echo $this->m_puskesmas->getNamaPegawai($this->session->userdata('id_users')); ?>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                        <li><a href="<?php echo base_url(); ?>puskesmas/view/profil"><i class="fa fa-user pull-right"></i> Profil</a></li>
                                        <li><a href="<?php echo base_url(); ?>main_controller/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                        </li>
                                    </ul>
                                </li>


                            </ul>
                        </nav>
                    </div>

                </div>
                <!-- /top navigation -->
                <!-- page content -->
                <div class="right_col" role="main">
                    <?php foreach ($listpuskesmas->result() as $baris) : ?>
                        <div class="col-md-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Edit Riwayat Pasien <?php echo $this->m_puskesmas->getNamaPasien($baris->id_pasien); ?></h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        <form class="form-horizontal" action="<?php echo base_url(); ?>puskesmas/edit/updateriwayat" method="post">
                                            <input name="id" value="<?php echo $baris->id; ?>" type="hidden">
                                            <input name="id_pasien" value="<?php echo $baris->id_pasien; ?>" type="hidden">
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Anggota Keluarga<span class="required"></span></label>
                                                <div class="col-md-6">                                                                                            
                                                    <select class="form-control select" name="anggota_keluarga" required>
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

                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Tekanan Darah Sistole/Diastole <span class="required"></span></label>
                                                <div class="col-md-3 col-sm-3 col-xs-3">
                                                    <input type="number" id="sistole" name="sistole" required="required" data-validate-minmax="50,200" class="form-control col-md-7 col-xs-12" placeholder="sistole" value="<?php echo $baris->td_sistole; ?>">
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-3">
                                                    <input type="number" id="diastole" name="diastole" required="required" data-validate-minmax="60,120" class="form-control col-md-7 col-xs-12" placeholder="diastole" value="<?php echo $baris->td_diastole; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Irama Denyut</label>
                                                <div class="col-md-6">                                                                                            
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


                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Merokok</label>
                                                <div class="col-md-6 ">
                                                    <input type="number" id="merokok" name="merokok" required="required" data-validate-minmax="0,1000" class="form-control col-md-7 col-xs-12" placeholder="Isi jumlah batang per hari" value="<?php echo $baris->merokok; ?>">/Hari
                                                </div>
                                                <span class="help-block">Jika Tidak Pernah, isi dengan 0</span>
                                            </div> 

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Kolesterol</label>
                                                <div class="col-md-6">                                                                                            
                                                    <select class="form-control select" name="kolesterol" required>
                                                        <option hidden="">Pilih Kolesterol</option>
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
                                                    <span class="help-block">Pilih Kolesterol</span>
                                                </div>
                                            </div> 

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Diabetes Melitus</label>
                                                <div class="col-md-6">                                                                                            
                                                    <select class="form-control select" name="diabetes" required>
                                                        <option hidden="">Pilih Diabetes</option>
                                                        <option value="0" <?php
                                                        if ($baris->diabetes == 0) {
                                                            echo 'selected';
                                                        }
                                                        ?>>Ya</option>
                                                        <option value="1" <?php
                                                        if ($baris->diabetes == 1) {
                                                            echo 'selected';
                                                        }
                                                        ?>>Tidak</option>

                                                    </select>
                                                    <span class="help-block">Pilih pernah diabetes melitus atau tidak</span>
                                                </div>
                                            </div> 


                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Kegiatan Olahraga</label>
                                                <div class="col-md-6">                                                                                            
                                                    <select class="form-control select" name="olahraga" required>
                                                        <option hidden="">Apakah sering berolahraga?</option>
                                                        <option value="0" <?php
                                                        if ($baris->olahraga == 0) {
                                                            echo 'selected';
                                                        }
                                                        ?>>Sering</option>
                                                        <option value="2" <?php
                                                        if ($baris->olahraga == 2) {
                                                            echo 'selected';
                                                        }
                                                        ?>>Tidak</option>
                                                        <option value="1" <?php
                                                        if ($baris->olahraga == 1) {
                                                            echo 'selected';
                                                        }
                                                        ?>>Jarang</option>
                                                    </select>
                                                    <span class="help-block">Pilih keseringan melakukan Kegiatan Olahraga </span>
                                                </div>
                                            </div> 
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Tinggi / Berat Badan <span class="required"></span>
                                                </label>
                                                <div class="col-md-3 col-sm-3 col-xs-3">
                                                    <input type="number" id="tinggi_badan" name="tinggi_badan" required="required" data-validate-minmax="50,200" class="form-control col-md-7 col-xs-12" placeholder="tinggi badan" value="<?php echo $baris->tinggi_badan; ?>">
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-3">
                                                    <input type="number" id="berat_badan" name="berat_badan" required="required" data-validate-minmax="20,250" class="form-control col-md-7 col-xs-12" placeholder="berat badan" value="<?php echo $baris->berat_badan; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Riwayat Sakit</label>
                                                <div class="col-md-6">                                                                                            
                                                    <select class="form-control select" name="sakit" required>
                                                        <option hidden="">Apakah Pernah Sakit Sebelumnya?</option>
                                                        <option value="0" <?php
                                                        if ($baris->riwayat_sakit == 0) {
                                                            echo 'selected';
                                                        }
                                                        ?>>Ya</option>
                                                        <option value="1" <?php
                                                        if ($baris->riwayat_sakit == 1) {
                                                            echo 'selected';
                                                        }
                                                        ?>>Tidak</option>
                                                    </select>
                                                    <span class="help-block">Pilih pernah sakit atau tidak</span>
                                                </div>
                                            </div> 

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Riwayat Keluarga</label>
                                                <div class="col-md-6">                                                                                            
                                                    <select class="form-control select" name="keluarga" required>
                                                        <option hidden="">Apakah Memiliki Keturunan Stroke?</option>
                                                        <option value="0" <?php
                                                        if ($baris->riwayat_keluarga == 0) {
                                                            echo 'selected';
                                                        }
                                                        ?>>Ya</option>
                                                        <option value="1" <?php
                                                        if ($baris->riwayat_keluarga == 1) {
                                                            echo 'selected';
                                                        }
                                                        ?>>Tidak</option>
                                                    </select>
                                                    <span class="help-block">Pilih ya atau tidak jika ada keturunan sakit</span>
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <button type="submit" class="btn btn-primary pull-right" id="send"><i class="fa fa-floppy-o"></i> Save Change</button>
                                                </div>
                                            </div>                        
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

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
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group"></ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>
        <script src="<?php echo base_url(); ?>assets/backend/js/bootstrap.min.js"></script>
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
        <style type='text/css'>
            #peta {
                width: 100%;
                height: 500px;
            };
        </style>
    </body>
</html>