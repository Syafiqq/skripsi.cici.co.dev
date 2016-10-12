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

        <link href="<?php echo base_url(); ?>assets/backend/css/bootstrap.min.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/backend/fonts/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/backend/css/animate.min.css" rel="stylesheet">

        <!-- Custom styling plus plugins -->
        <link href="<?php echo base_url(); ?>assets/backend/css/customPuskesmas.css" rel="stylesheet">
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
                    <div class="">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_content">
                                        <form class="form-horizontal" action="<?php echo site_url('puskesmas/add/createposbindu/') ?>" method="post" enctype="multipart/form-data">
                                            <span class="section">Formulir Tambah Posbindu</span>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Lokasi Posbindu</label>
                                                <div class="col-md-6 col-sm-9 col-xs-12" id="lokasi">
                                                    <div id="peta" class="col-md-8 col-sm-12 col-xs-12" style="height: 270px;"></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                                <div class="col-md-3 col-sm-6 col-xs-9">
                                                    <input type="text" id='latitude' class="autocomplete nama form-control" placeholder="Latitude" name="latitude" readonly>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-9">
                                                    <input type="text" id='longitude' class="autocomplete nama form-control" placeholder="Longitude" name="longitude" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Posbindu</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="name" class="form-control col-md-7 col-xs-12" name="nama" required>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Alamat<span class="required"></span></label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <textarea id="alamat" required="required" name="alamat" class="form-control col-md-7 col-xs-12" placeholder="Isikan Alamat Lengkap"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Pilih Kecamatan</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <?php echo form_dropdown('kecamatan', $kecamatan, '', 'id="kecamatan" class="select2_single form-control" tabindex="-1" required'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Pilih Kelurahan</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <?php echo form_dropdown('kelurahan', array('Kelurahan' => 'Pilih Kecamatan Dahulu'), '', 'id="kelurahan" class="select2_single form-control" tabindex="-1" required'); ?>
                                                </div>

                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">RT/RW <span class="required"></span>
                                                </label>
                                                <div class="col-md-3 col-sm-3 col-xs-3">
                                                    <input type="number" id="rt" name="rt" required="required" data-validate-minmax="1,100" class="form-control col-md-7 col-xs-12" placeholder="RT">
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-3">
                                                    <input type="number" id="rw" name="rw" required="required" data-validate-minmax="1,100" class="form-control col-md-7 col-xs-12" placeholder="RW">
                                                </div>
                                            </div>
                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-3">
                                                    <button type="reset" class="btn btn-primary">Clear</button>
                                                    <button type="submit" class="btn btn-success pull-right">Submit</button>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
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
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
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
        <!-- tags -->
        <script src="<?php echo base_url(); ?>assets/backend/js/tags/jquery.tagsinput.min.js"></script>
        <!-- switchery -->
        <script src="<?php echo base_url(); ?>assets/backend/js/switchery/switchery.min.js"></script>
        <!-- daterangepicker -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/moment.min2.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/datepicker/daterangepicker.js"></script>
        <!-- richtext editor -->
        <script src="<?php echo base_url(); ?>assets/backend/js/editor/bootstrap-wysiwyg.js"></script>
        <script src="<?php echo base_url(); ?>assets/backend/js/editor/external/jquery.hotkeys.js"></script>
        <script src="<?php echo base_url(); ?>assets/backend/js/editor/external/google-code-prettify/prettify.js"></script>
        <!-- daterangepicker -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/moment.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/datepicker/daterangepicker.js"></script>
        <!-- select2 -->
        <script src="<?php echo base_url(); ?>assets/backend/js/select/select2.full.js"></script>
        <!-- form validation -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/parsley/parsley.min.js"></script>
        <!-- textarea resize -->
        <script src="<?php echo base_url(); ?>assets/backend/js/textarea/autosize.min.js"></script>


        <script>
            autosize($('.resizable_textarea'));
        </script>


        <!-- chart js -->

        <script src="<?php echo base_url(); ?>assets/backend/js/custom.js"></script>

        <script src="<?php echo base_url(); ?>assets/backend/js/validator/validator.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/moment.min2.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/datepicker/daterangepicker.js"></script>

        <script src="<?php echo base_url(); ?>assets/backend/js/input_mask/jquery.inputmask.js"></script>
        <style type='text/css'>
            #peta {
                width: 100%;
                height: 500px;
            };
        </style>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript">
            (function () {
                window.onload = function () {
                    var map;
                    var markersArray = [];

                    //Parameter Google maps
                    var options = {
                        zoom: 12, //level zoom
                        styles: [
                            {featureType: "poi",
                                elementType: "labels",
                                stylers: [{visibility: "off"}]
                            }],
                        center: new google.maps.LatLng(-7.982609, 112.630864),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    // Buat peta di 
                    var map = new google.maps.Map(document.getElementById('peta'), options);
                    /* menambahkan event clik untuk menampikan
                     infowindows dengan isi sesuai denga
                     marker yang di klik */
                    google.maps.event.addListener(map, 'click', function (event) {
                        document.getElementById("latitude").value = event.latLng.lat().toFixed(5);
                        document.getElementById("longitude").value = event.latLng.lng().toFixed(5);
                        placeMarker(event.latLng);
                    });

                    function placeMarker(location) {
                        // first remove all markers if there are any
                        deleteOverlays();

                        var marker = new google.maps.Marker({
                            position: location,
                            map: map
                        });

                        // add marker in markers array
                        markersArray.push(marker);
                        map.setCenter(location);
                    }

                    // Deletes all markers in the array by removing references to them
                    function deleteOverlays() {
                        if (markersArray) {
                            for (i in markersArray) {
                                markersArray[i].setMap(null);
                            }
                            markersArray.length = 0;
                        }
                    }
                };
            })();
            ;
        </script>
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
    </body>

</html>