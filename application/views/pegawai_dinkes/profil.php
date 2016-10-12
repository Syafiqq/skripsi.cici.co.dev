<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dinkes - Deteksi Dini Penyakit Stroke</title>

        <!-- Bootstrap core CSS -->
        <link rel="icon" href="<?php echo base_url(); ?>assets/favicon.ico" type="image/x-icon" />

        <link href="<?php echo base_url(); ?>assets/backend/css/bootstrap.min.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/backend/fonts/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/backend/css/animate.min.css" rel="stylesheet">

        <!-- Custom styling plus plugins -->
        <link href="<?php echo base_url(); ?>assets/backend/css/customDinkes.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/backend/css/icheck/flat/green.css" rel="stylesheet">


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
                    <!--<div class="left_col scroll-view">-->
                    <div class="left_col">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="<?php echo base_url(); ?>pegawai/dinkes" class="site_title"><i class="fa fa-plus-circle"></i> <span>Stroke Prevention</span></a>
                        </div>
                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print">
                            <div class="menu_section">
                                <h3><?php echo $this->session->userdata('role'); ?></h3>
                                <ul class="nav side-menu">
                                    <li><a href="<?php echo base_url(); ?>pegawai/dinkes"><i class="fa fa-home"></i>Home</span></a></li>
                                    <li><a href="<?php echo base_url(); ?>pegawai/dinkes/view/dinkes"><i class="fa fa-user"></i>Profil</span></a></li>
                                    <li>
                                        <a><i class="fa fa-edit"></i>Lihat Data<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">            
                                            <li><a href="<?php echo base_url(); ?>pegawai/dinkes/view/pegawai">Pegawai Dinkes</a></li>
                                            <li><a href="<?php echo base_url(); ?>pegawai/dinkes/view/puskesmas">Puskesmas</a></li>
                                            <li><a href="<?php echo base_url(); ?>pegawai/dinkes/view/posbindu">Posbindu</a></li>
                                            <li><a href="<?php echo base_url(); ?>pegawai/dinkes/view/kader">Kader</a></li>
                                            <li><a href="<?php echo base_url(); ?>pegawai/dinkes/view/pasien">Pasien</a></li>
                                        </ul>
                                    </li>
                                    <li><a  href="<?php echo base_url(); ?>pegawai/dinkes/view/petunjuk"><i class="fa fa-bullhorn"></i>Petunjuk</span></a></li>
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
                                        <img src="<?php echo base_url(); ?>assets/backend/images/login.png" alt=""><?php echo $this->m_dinkes->getNamaPegawai($this->session->userdata('id_users')); ?>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                        <li><a href="<?php echo base_url(); ?>pegawai/dinkes/view/profil"><i class="fa fa-user pull-right"></i> Profil</a></li>
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
                    <div class="">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <?php foreach ($profil->result() as $baris) : ?>
                                        <div class="x_title">
                                            <h2><?php echo $baris->nama; ?></h2>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="x_content">
                                            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                                                <div class="profile_img">
                                                    <!-- end of image cropping -->
                                                    <div id="crop-avatar">
                                                        <!-- Current avatar -->
                                                        <div class="avatar-view">
                                                            <img src="<?php echo base_url(); ?>assets/foto/<?php echo $baris->foto; ?>" alt="Avatar">
                                                        </div>
                                                        <div class="container" style="text-align: center;">
                                                            <form action="<?php echo base_url() ?>pegawai/dinkes/edit/profilepicture" method="post" enctype="multipart/form-data">
                                                                <input type="hidden" name="id" type="id" value="<?php echo $baris->id; ?>"/>
                                                                <input type="file" accept="image/*" title="Browse file" onchange="this.form.submit()" id="foto" name="userfile" style="visibility: hidden;" />
                                                                <a href="" onclick="document.getElementById('foto').click();
                                                                        return false" data-toggle="modal" data-placement="bottom" title="Hapus Pegawai" class="btn btn-xs btn-info">Ganti Profile Picture</a>
                                                            </form>
                                                        </div>
                                                        <!-- Loading state -->
                                                        <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
                                                    </div>
                                                    <!-- end of image cropping -->
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <div class="profile_title">
                                                    <div class="col-md-6">
                                                        <p><i class="fa fa-credit-card user-profile-icon"></i> NIP/NIK</p>
                                                        <p><?php echo $baris->NIP; ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><i class="fa fa-smile-o user-profile-icon"></i> Tempat, Tanggal Lahir</p>
                                                        <p><?php echo $baris->tempat_lahir; ?>, <?php echo $baris->tanggal_lahir; ?></p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="profile_title">
                                                    <div class="col-md-12">
                                                        <p><i class="fa fa-map-marker user-profile-icon"></i> Alamat</p>
                                                        <p><?php echo $baris->alamat . ' RT ' . $baris->rt . ' RW ' . $baris->rw . ' Kecamatan ' . $this->m_index->getNamaKecamatan($baris->id_kecamatan) . ' Kelurahan ' . $this->m_index->getNamaKelurahan($baris->id_kelurahan); ?></p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="profile_title">
                                                    <div class="col-md-4">
                                                        <p><i class="fa fa-bitcoin user-profile-icon"></i> BBM</p>
                                                        <p><?php echo $baris->sosmed3; ?></p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p><i class="fa fa-weixin user-profile-icon"></i> Whatsapp</p>
                                                        <p><?php echo $baris->sosmed1; ?></p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p><i class="fa fa-twitter user-profile-icon"></i> Twitter</p>
                                                        <p><?php echo $baris->sosmed2; ?></p>
                                                    </div>
                                                </div>
                                                <div class="profile_title">
                                                    <div class="col-md-offset-2 col-md-6">
                                                        <p><i class="fa fa-phone user-profile-icon"></i> Nomor Handphone</p>
                                                        <p><?php echo $baris->hp; ?></p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <p><i class="fa fa-google user-profile-icon"></i> Email</p>
                                                        <p><?php echo $baris->email; ?></p>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="container">
                                                    <div class="col-md-4" style="text-align: left">
                                                        <a href="#modal-edit-pegawai" data-toggle="modal" data-placement="bottom" title="Lihat Detail" class="btn btn-xs btn-info">Edit Data Diri</a>
                                                    </div>
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4" style="text-align: right;">
                                                        <a href="#modal-edit-account" data-toggle="modal" data-placement="bottom" title="Hapus Pegawai" class="btn btn-xs btn-info">Ganti Username dan Password</a>
                                                    </div>
                                                </div>
                                                <br>
                                                </ul>
                                            </div>
                                        </div>
                                        <div id="modal-edit-pegawai"  class="modal animated pulse"  tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">  
                                                    <form action="<?php echo site_url('pegawai/dinkes/edit/pegawai/'); ?>" method="post">                            
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h2 class="modal-title" >
                                                                <font color="#000000">Edit Pegawai</span></font> 
                                                            </h2>
                                                        </div>
                                                        <!--end modal-header--> 
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <input type="hidden" class="form-control" name="id" value="<?php echo $baris->id; ?>"/>
                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-xs-12 control-label">Nama Pegawai</label>
                                                                    <div class="col-md-9 col-xs-12">                                            
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                                                            <input type="text" class="form-control" name="nama" value="<?php echo $baris->nama; ?>"required="required"/>
                                                                        </div>                                            
                                                                    </div>
                                                                </div> <br>
                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-xs-12 control-label">NIP/NIK</label>
                                                                    <div class="col-md-9 col-xs-12">                                            
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="fa fa-credit-card"></span></span>
                                                                            <input type="text" class="form-control" name="nip" value="<?php echo $baris->NIP; ?>"required="required"/>
                                                                        </div>                                            

                                                                    </div>
                                                                </div> <br>
                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-xs-12 control-label">Tempat Lahir</label>
                                                                    <div class="col-md-9 col-xs-12">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                                                            <input type="text" class="form-control" name="tempat_lahir" value="<?php echo $baris->tempat_lahir; ?>"required="required"/>
                                                                        </div>                                            

                                                                    </div>
                                                                </div> <br>
                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-xs-12 control-label">Tanggal Lahir</label>
                                                                    <div class="col-md-9 col-xs-12">                                            
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                                                            <input type="date" class="form-control" data-inputmask="'mask': '99/99/9999'" placeholder="DD/MM/YYYY" id="tgl_lahir" name="tanggal_lahir"  value="<?php echo $baris->tanggal_lahir; ?>">
                                                                        </div>                                            
                                                                    </div>
                                                                </div> <br>
                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-xs-12 control-label">Alamat</label>
                                                                    <div class="col-md-9 col-xs-12">                                            
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                                                            <input type="text" class="form-control" name="alamat" value="<?php echo $baris->alamat; ?>"required="required"/>
                                                                        </div>                                            
                                                                    </div>
                                                                </div><br>

                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-xs-12 control-label">RT</label>
                                                                    <div class="col-md-9 col-xs-12">                                            
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                                                            <input type="text" class="form-control" name="rt" value="<?php echo $baris->rt; ?>"required="required"/>
                                                                        </div>                                            
                                                                    </div>
                                                                </div><br>

                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-xs-12 control-label">RW</label>
                                                                    <div class="col-md-9 col-xs-12">                                            
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                                                            <input type="text" class="form-control" name="rw" value="<?php echo $baris->rw; ?>"required="required"/>
                                                                        </div>                                            
                                                                    </div>
                                                                </div><br>

                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-xs-12 control-label">Kecamatan</label>
                                                                    <div class="col-md-9 col-xs-12">                                            
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                                                            <?php echo form_dropdown('kecamatan', $kecamatan, $baris->id_kecamatan, 'id="kecamatan" class="select2_single form-control" tabindex="-1" required'); ?>
                                                                        </div>                                            

                                                                    </div>
                                                                </div> <br>
                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-xs-12 control-label">Kelurahan</label>
                                                                    <div class="col-md-9 col-xs-12">                                            
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="fa fa-map-marker"></span></span>
                                                                            <?php echo form_dropdown('kelurahan', array('Kelurahan' => 'Pilih Kecamatan Dahulu'), $baris->id_kelurahan, 'id="kelurahan" class="select2_single form-control" tabindex="-1" required'); ?>
                                                                            <script type="text/javascript">
                                                                                $(document).ready(function () {
                                                                                    function ajax() {
                                                                                        var kecamatan = {id_kecamatan: $("#kecamatan").val()};
                                                                                        $.ajax({
                                                                                            type: "POST",
                                                                                            url: "http://localhost/diagnosastroke/main_controller/getKelurahanByIdKecamatan/",
                                                                                            data: kecamatan,
                                                                                            success: function (msg) {
                                                                                                $('#kelurahan').html(msg);
                                                                                                $('#kelurahan').val(<?= $baris->id_kelurahan ?>);
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                    ajax();
                                                                                });
                                                                            </script>
                                                                        </div>                                            
                                                                    </div>
                                                                </div><br>

                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-xs-12 control-label">Email</label>
                                                                    <div class="col-md-9 col-xs-12">                                            
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                                                                            <input type="text" class="form-control" name="email" value="<?php echo $baris->email; ?>"required="required"/>
                                                                        </div>                                            
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-xs-12 control-label">Nomor Telepon</label>
                                                                    <div class="col-md-9 col-xs-12">                                            
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                                                                            <input type="text" class="form-control" name="hp" value="<?php echo $baris->hp; ?>"required="required"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-xs-12 control-label">Whatsapp</label>
                                                                    <div class="col-md-9 col-xs-12">                                            
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                                                                            <input type="text" class="form-control" name="sosmed1" value="<?php echo $baris->sosmed1; ?>"/>
                                                                        </div>                                            
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-xs-12 control-label">Twitter</label>
                                                                    <div class="col-md-9 col-xs-12">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="fa fa-twitter"></span></span>
                                                                            <input type="text" class="form-control" name="sosmed2" value="<?php echo $baris->sosmed2; ?>"/>
                                                                        </div>                                            
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-xs-12 control-label">BBM</label>
                                                                    <div class="col-md-9 col-xs-12">                                            
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="fa fa-btc"></span></span>
                                                                            <input type="text" class="form-control" name="sosmed3" value="<?php echo $baris->sosmed3; ?>"/>
                                                                        </div>                                            
                                                                    </div>
                                                                </div>
                                                            </div><!--modal body--> 
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary pull-right">Save Change <span class="fa fa-floppy-o fa-right"></span></button>
                                                        </div>
                                                    </form>
                                                </div><!--modal content--> 
                                            </div>
                                        </div> 
                                        <div id="modal-edit-account"  class="modal animated pulse"  tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">  
                                                    <form action="<?php echo site_url('pegawai/dinkes/edit/user/'); ?>" method="post">                            
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h2 class="modal-title" >
                                                                <font color="#000000">Edit Username dan Password</font> 
                                                            </h2>
                                                        </div>
                                                        <!--end modal-header--> 
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <?php foreach ($this->m_index->getUser($this->session->userdata('iduser'))->result() as $baris) { ?>
                                                                    <input type="hidden" class="form-control" name="iduser" value="<?php echo $baris->iduser; ?>"/>
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 col-xs-12 control-label">Username</label>
                                                                        <div class="col-md-9 col-xs-12">                                            
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                                                                <input type="text" class="form-control" name="username" value="<?php echo $baris->username; ?>"required="required"/>
                                                                            </div>                                            
                                                                        </div>
                                                                    </div> <br>
                                                                    <div class="form-group">
                                                                        <label class="col-md-3 col-xs-12 control-label">Password</label>
                                                                        <div class="col-md-9 col-xs-12">                                            
                                                                            <div class="input-group">
                                                                                <span class="input-group-addon"><span class="fa fa-credit-card"></span></span>
                                                                                <input type="password" class="form-control" name="password" value="<?php echo $baris->password; ?>"required="required"/>
                                                                            </div>                                            

                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            </div><!--modal body--> 
                                                            <div class="modal-footer">
                                                                <button class="btn btn-primary pull-right">Save Change <span class="fa fa-floppy-o fa-right"></span></button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div><!--modal content--> 
                                            </div>
                                        </div>  
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
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

        <!-- image cropping -->
        <script src="<?php echo base_url(); ?>assets/backend/js/cropping/cropper.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/backend/js/cropping/main.js"></script>


        <!-- daterangepicker -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/moment.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/datepicker/daterangepicker.js"></script>
        <!-- moris js -->
        <script src="<?php echo base_url(); ?>assets/backend/js/moris/raphael-min.js"></script>
        <script src="<?php echo base_url(); ?>assets/backend/js/moris/morris.js"></script>
        <script type="text/javascript">
                                                                            $("#kecamatan").change(function () {
                                                                                var kecamatan = {id_kecamatan: $("#kecamatan").val()};
                                                                                $.ajax({
                                                                                    type: "POST",
                                                                                    url: "http://localhost/diagnosastroke/main_controller/getKelurahanByIdKecamatan/",
                                                                                    data: kecamatan,
                                                                                    success: function (msg) {
                                                                                        $('#kelurahan').html(msg);
                                                                                    }
                                                                                });
                                                                            });
        </script>
        <script>
            $(function () {
                var day_data = [
                    {
                        "period": "Jan",
                        "Hours worked": 80
                    },
                    {
                        "period": "Feb",
                        "Hours worked": 125
                    },
                    {
                        "period": "Mar",
                        "Hours worked": 176
                    },
                    {
                        "period": "Apr",
                        "Hours worked": 224
                    },
                    {
                        "period": "May",
                        "Hours worked": 265
                    },
                    {
                        "period": "Jun",
                        "Hours worked": 314
                    },
                    {
                        "period": "Jul",
                        "Hours worked": 347
                    },
                    {
                        "period": "Aug",
                        "Hours worked": 287
                    },
                    {
                        "period": "Sep",
                        "Hours worked": 240
                    },
                    {
                        "period": "Oct",
                        "Hours worked": 211
                    }
                ];
                Morris.Bar({
                    element: 'graph_bar',
                    data: day_data,
                    xkey: 'period',
                    hideHover: 'auto',
                    barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
                    ykeys: ['Hours worked', 'sorned'],
                    labels: ['Hours worked', 'SORN'],
                    xLabelAngle: 60
                });
            });</script>
        <!-- datepicker -->
        <script type="text/javascript">
            $(document).ready(function () {
                var cb = function (start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                    //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
                }

                var optionSet1 = {
                    startDate: moment().subtract(29, 'days'),
                    endDate: moment(),
                    minDate: '01/01/2012',
                    maxDate: '12/31/2015',
                    dateLimit: {
                        days: 60
                    },
                    showDropdowns: true,
                    showWeekNumbers: true,
                    timePicker: false,
                    timePickerIncrement: 1,
                    timePicker12Hour: true,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    opens: 'left',
                    buttonClasses: ['btn btn-default'],
                    applyClass: 'btn-small btn-primary',
                    cancelClass: 'btn-small',
                    format: 'MM/DD/YYYY',
                    separator: ' to ',
                    locale: {
                        applyLabel: 'Submit',
                        cancelLabel: 'Clear',
                        fromLabel: 'From',
                        toLabel: 'To',
                        customRangeLabel: 'Custom',
                        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        firstDay: 1
                    }
                };
                $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
                $('#reportrange').daterangepicker(optionSet1, cb);
                $('#reportrange').on('show.daterangepicker', function () {
                    console.log("show event fired");
                });
                $('#reportrange').on('hide.daterangepicker', function () {
                    console.log("hide event fired");
                });
                $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                    console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
                });
                $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
                    console.log("cancel event fired");
                });
                $('#options1').click(function () {
                    $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
                });
                $('#options2').click(function () {
                    $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
                });
                $('#destroy').click(function () {
                    $('#reportrange').data('daterangepicker').remove();
                });
            });</script>
        <!-- /datepicker -->
    </body>

</html>