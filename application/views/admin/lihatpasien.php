<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Admin - Deteksi Dini Penyakit Stroke</title>

        <!-- Bootstrap core CSS -->
        <link rel="icon" href="<?php echo base_url(); ?>assets/favicon.ico" type="image/x-icon" />

        <link href="<?php echo base_url(); ?>assets/backend/css/bootstrap.min.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/backend/fonts/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/backend/css/animate.min.css" rel="stylesheet">

        <!-- Custom styling plus plugins -->
        <link href="<?php echo base_url(); ?>assets/backend/css/customAdmin.css" rel="stylesheet">
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
                        <div class="left_col">
                            <div class="navbar nav_title" style="border: 0;">
                                <a href="<?php echo base_url('index.php/admin/beranda'); ?>" class="site_title">
                                    <i class="fa fa-plus-circle"></i>
                                    <span>Stroke Prevention</span>
                                </a>
                            </div>
                            <!-- sidebar menu -->
                            <div id="sidebar-menu" class="main_menu_side hidden-print">
                                <div class="menu_section">
                                    <h3><?php echo $role ?></h3>
                                    <ul class="nav side-menu">
                                        <li>
                                            <a href="<?php echo base_url('index.php/admin/beranda'); ?>">
                                                <i class="fa fa-home"></i>
                                                Beranda</span></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('index.php/admin/artikel'); ?>">
                                                <i class="fa fa-user"></i>
                                                Artikel</span></a>
                                        </li>
                                        <li>
                                            <a>
                                                <i class="fa fa-edit"></i>
                                                Data User
                                                <span class="fa fa-chevron-down"></span>
                                            </a>
                                            <ul class="nav child_menu" style="display: none">
                                                <li>
                                                    <a href="<?php echo base_url('index.php/admin/view/dss'); ?>">Dokter Spesialis Saraf</a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo base_url('index.php/admin/view/pasien'); ?>">Pasien</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('index.php/admin/datalatih'); ?>">
                                                <i class="fa fa-bullhorn"></i>
                                                Data Latih</span></a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('index.php/admin/deteksi'); ?>">
                                                <i class="fa fa-bullhorn"></i>
                                                Deteksi</span></a>
                                        </li>
                                    </ul>
                                </div>
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
                                <a id="menu_toggle">
                                    <i class="fa fa-bars"></i>
                                </a>
                            </div>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="<?php echo base_url(); ?>assets/backend/images/login.png" alt=""><?php echo $_SESSION['user']['name']; ?>
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                        <li>
                                            <a href="<?php echo base_url('index.php/admin/profil'); ?>">
                                                <i class="fa fa-user pull-right"></i>
                                                Profil
                                            </a>
                                        </li>
                                        <li>
                                            <a id="logout">
                                                <i class="fa fa-sign-out pull-right"></i>
                                                Log Out
                                            </a>
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
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table table-bordered">
                                        <thead>
                                            <tr class="heading">
                                                <th style="vertical-align: middle; text-align: center">Nomor KTP</th>
                                                <th style="vertical-align: middle; text-align: center">Nama</th>
                                                <th style="vertical-align: middle; text-align: center">Tempat, Tanggal Lahir</th>
                                                <th style="vertical-align: middle; text-align: center">Alamat</th>
                                                <th style="vertical-align: middle; text-align: center">Jenis Kelamin</th>
                                                <th style="vertical-align: middle; text-align: center">Telepon</th>              
                                                <th>Action</span></th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($listpasien->result() as $baris) : ?>
                                                <tr class="even pointer">
                                                    <td> <?php echo $baris->ktp; ?></td>
                                                    <td> <?php echo $baris->nama; ?></td>
                                                    <td><?php echo $baris->alamat . ' Kecamatan ' . $this->m_index->getNamaKecamatan($baris->id_kecamatan) . ' Kelurahan ' . $this->m_index->getNamaKelurahan($baris->id_kelurahan) . ' RT ' . $baris->rt . ' RW ' . $baris->rw; ?></td>
                                                    <td> <?php
                                                        $jk = $baris->jenis_kelamin;
                                                        if ($jk == 0) {
                                                            echo "Laki-laki";
                                                        } else {
                                                            echo "Perempuan";
                                                        }
                                                        ?></td>
                                                    <td style="width: 8%;">
                                                        <?php
                                                        $rubah = date_format(date_create($baris->tgl_lahir), 'Y');
                                                        $thn_skrg = date('Y');
                                                        $usia = $thn_skrg - $rubah;
                                                        echo $usia . ' tahun';
                                                        ?>
                                                    </td>
                                                    <td> <?php echo $baris->hp; ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url('index.php/admin/riwayat/'. $baris->id)?>" data-toggle="modal" data-placement="bottom" title="Lihat Detail" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> Lihat Riwayat Pasien</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
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
                            'aTargets': [6]
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
        <script type="text/javascript">
            $(document).ready(function ()
            {
                document.getElementById('logout').addEventListener("click", function (e)
                {
                    e.preventDefault();
                    if (confirm("Anda yakin akan keluar ? ") == true)
                    {
                        window.location.href = "<?php echo base_url('index.php/logout')?>";
                    } else
                    {
                    }
                });
            });
        </script>
    </body>
</html>