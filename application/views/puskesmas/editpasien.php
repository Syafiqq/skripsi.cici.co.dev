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

                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Form Edit Data Puskesmas</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <form class="form-horizontal form-label-left" action="<?php echo site_url('puskesmas/edit/updatepuskesmas') ?>" method="POST">
                                        <?php foreach ($listpuskesmas->result() as $baris) : ?>
                                            <input type="hidden" value="<?= $baris->id ?>" id="id" name="id">
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Lokasi Puskesmas</label>
                                                <div class="col-md-6 col-sm-9 col-xs-12" id="lokasi">
                                                    <div id="peta" class="col-md-8 col-sm-12 col-xs-12" style="height: 270px;"></div>
                                                    <script>
                                                        var markersArray = [];
                                                        var map;

                                                        function initialize() {
                                                            var location = new google.maps.LatLng(<?= $baris->latitude ?>, <?= $baris->longitude ?>);
                                                            var mapProp = {
                                                                center: location,
                                                                zoom: 17,
                                                                styles: [
                                                                    {featureType: "poi",
                                                                        elementType: "labels",
                                                                        stylers: [{visibility: "off"}]
                                                                    }],
                                                                mapTypeId: google.maps.MapTypeId.ROADMAP
                                                            };
                                                            map = new google.maps.Map(document.getElementById("peta"), mapProp);
                                                            placeMarker(location)
                                                            google.maps.event.addListener(map, 'click', function (event) {
                                                                document.getElementById("latitude").value = event.latLng.lat().toFixed(5);
                                                                document.getElementById("longitude").value = event.latLng.lng().toFixed(5);
                                                                placeMarker(event.latLng);
                                                            });
                                                        }

                                                        function loadScript() {
                                                            var script = document.createElement("script");
                                                            script.type = "text/javascript";
                                                            script.src = "http://maps.googleapis.com/maps/api/js?key=&sensor=false&callback=initialize";
                                                            document.body.appendChild(script);
                                                        }

                                                        function placeMarker(location) {
                                                            // first remove all markers if there are any
                                                            deleteOverlays();

                                                            var marker = new google.maps.Marker({
                                                                position: location,
                                                                draggable: true,
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

                                                        window.onload = loadScript;
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                                <div class="col-md-3 col-sm-6 col-xs-9">
                                                    <input type="text" id='latitude' class="autocomplete nama form-control" placeholder="Latitude" name="latitude" readonly value="<?= $baris->latitude ?>">
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-9">
                                                    <input type="text" id='longitude' class="autocomplete nama form-control" placeholder="Longitude" name="longitude" readonly value="<?= $baris->longitude ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Puskesmas</label>
                                                <div class="col-md-6 col-sm-9 col-xs-12">
                                                    <input type="text" class="form-control" data-validate-length-range="6" data-validate-words="1" id="kode" placeholder="Ketik Kode Puskesmas" name="kode" value="<?= $baris->kode_puskesmas; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Puskesmas</label>
                                                <div class="col-md-6 col-sm-9 col-xs-12">
                                                    <input type="text" class="form-control"placeholder="Ketik Nama Puskesmas" required name="nama" value="<?= $baris->nama_puskesmas; ?>">
                                                </div>
                                            </div>  
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Jenis Puskesmas</label>
                                                <div class="col-md-6 col-sm-9 col-xs-12">
                                                    <select id="jenis" class="form-control" required name="jenis">
                                                        <option>Pilih Jenis Puskesmas</option>
                                                        <option value="0"
                                                        <?php
                                                        if ($baris->jenis_puskesmas == 0) {
                                                            echo 'selected';
                                                        };
                                                        ?>
                                                                >Rawat Inap</option>
                                                        <option value="1"
                                                        <?php
                                                        if ($baris->jenis_puskesmas == 1) {
                                                            echo 'selected';
                                                        };
                                                        ?>
                                                                >Non-Rawat Inap</option>                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Alamat</label>
                                                <div class="col-md-6 col-sm-9 col-xs-12">
                                                    <input type="text" id="v_alamat" class="form-control"placeholder="Ketik Alamat Lengkap" required name="alamat" value="<?= $baris->alamat; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Pilih Kecamatan</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <?php echo form_dropdown('kecamatan', $kecamatan, $baris->id_kecamatan, 'id="kecamatan" class="select2_single form-control" tabindex="-1" required'); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Pilih Kelurahan</label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
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
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">RT/RW <span class="required"></span></label>
                                                <div class="col-md-3 col-sm-3 col-xs-3">
                                                    <input type="number" id="rt" name="rt" required="required" data-validate-minmax="1,100" class="form-control col-md-7 col-xs-12" placeholder="RT" value="<?= $baris->rt ?>">
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-3">
                                                    <input type="number" id="rw" name="rw" required="required" data-validate-minmax="1,100" class="form-control col-md-7 col-xs-12" placeholder="RW" value="<?= $baris->rw ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nomor Telepon</label>
                                                <div class="col-md-6 col-sm-9 col-xs-12">
                                                    <input type="tel" class="form-control" placeholder="Ketik Nomor Telepon Puskesmas" required name="telepon"  value="<?= $baris->telepon ?>">
                                                </div>
                                            </div>
                                            <div class="ln_solid"><?php endforeach; ?></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-3">
                                                <button type="submit" class="btn btn-success pull-right">Submit</button>
                                            </div>
                                        </div>
                                    </form>
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