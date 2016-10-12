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
                <div class="right_col" role="main">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Data Kader</h2>
                                    <div class="btn-group pull-right">
                                        <button class="btn btn-success dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo base_url(); ?>puskesmas/puskesmas/export/xls/kader">XLS</a></li>
                                            <li><a href="<?php echo base_url(); ?>puskesmas/puskesmas/export/pdf/kader">PDF</a></li>
                                        </ul>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table datatable table-bordered">
                                        <thead>
                                            <tr class="headings">
                                                <th style="vertical-align: middle; text-align: center">Nama Kader</th>
                                                <th style="vertical-align: middle; text-align: center">Nama Posbindu</th>
                                                <th style="vertical-align: middle; text-align: center">Kecamatan</th>
                                                <th style="vertical-align: middle; text-align: center">Kelurahan</th>
                                                <th style="vertical-align: middle; text-align: center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($listkader->result() as $baris) : ?>
                                                <tr class="even pointer">
                                                    <td> <?php echo $baris->nama_kader; ?></td>
                                                    <td> <?php echo $this->m_index->getNamaPosbindu($baris->id_posbindu); ?></td>
                                                    <td> <?php echo $this->m_index->getNamaKecamatan($baris->id_kecamatan); ?></td>
                                                    <td> <?php echo $this->m_index->getNamaKelurahan($baris->id_kelurahan); ?></td>
                                                    <td style="vertical-align: middle; text-align: center; width: 5%;">
                                                        <a href="#modal-lihat-pegawai<?php echo $baris->id; ?>" data-toggle="modal" data-placement="bottom" title="Lihat Detail" class="btn btn-xs btn-info"><i class="fa fa-eye"></i> Lihat Detail Kader</a>
                                                    </td>
                                                </tr>
                                            <div id="modal-lihat-pegawai<?php echo $baris->id; ?>"  class="modal animated pulse"  tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">  
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h2 class="modal-title" >
                                                                <font color="#000000"><?php echo $baris->nama_kader; ?></font> 
                                                            </h2>
                                                        </div>  <!--end modal-header--> 
                                                        <div class="modal-body">
                                                            <div class="row"> 
                                                                <!-- Current avatar -->
                                                                <div class="col-md-6 col-sm-6 col-xs-6">	
                                                                    <center>
                                                                        <div class="avatar-view" >
                                                                            <img src="<?php echo base_url(); ?><?php echo '/assets/foto/' . $baris->foto; ?>" alt="Sales"/>
                                                                        </div>
                                                                    </center>
                                                                </div>
                                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                                    <ul class="list-unstyled user_data">                                                                            
                                                                        <li><i class="fa fa-smile-o user-profile-icon"></i> <?php echo $baris->tempat_lahir; ?>/<?php echo $baris->tanggal_lahir; ?></li>
                                                                        <li><i class="fa fa-map-marker user-profile-icon"></i> <?php echo $baris->alamat . ' ' . $baris->rt . ' ' . $baris->rw; ?></li>
                                                                        <li><i class="fa fa-phone user-profile-icon"></i> <?php echo $baris->hp; ?></li>
                                                                        <li><i class="fa fa-google user-profile-icon"></i> <?php echo $baris->email; ?></li>
                                                                        <li><i class="fa fa-weixin user-profile-icon"></i> <?php echo $baris->sosmed1; ?></li>
                                                                        <li><i class="fa fa-twitter user-profile-icon"></i> <?php echo $baris->sosmed2; ?></li>
                                                                        <li><i class="fa fa-bitcoin user-profile-icon"></i> <?php echo $baris->sosmed3; ?></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div><!--modal body--> 
                                                    </div><!--modal content--> 
                                                </div>
                                            </div>              
                                            <div id="modal-edit-pegawai<?php echo $baris->id; ?>"  class="modal animated pulse"  tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">  
                                                        <form action="<?php echo site_url('c_posbindu/editkader/' . $baris->id); ?>" method="post">                            
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h2 class="modal-title" >
                                                                    <font color="#000000">Edit Pegawai</span></font> 
                                                                </h2>
                                                            </div>  <!--end modal-header--> 

                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-xs-12 control-label">Nama Pegawai</label>
                                                                    <div class="col-md-9 col-xs-12">                                            
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                                                            <input type="text" class="form-control" name="nama" value="<?php echo $baris->nama_kader; ?>"required="required"/>
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
                                                                </div> <br><br><br>
                                                                <div class="form-group">
                                                                    <label class="col-md-3 col-xs-12 control-label">Email</label>
                                                                    <div class="col-md-9 col-xs-12">                                            
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><span class="fa fa-newspaper-o"></span></span>
                                                                            <input type="text" class="form-control" name="email" value="<?php echo $baris->email; ?>"required="required"/>
                                                                        </div>                                            

                                                                    </div>
                                                                </div><br><br><br>
                                                            </div><!--modal body--> 
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
                                                        <form action="<?php echo site_url('c_posbindu/deletekader/' . $baris->id); ?>" method="post">                            
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h2 class="modal-title" >
                                                                    <font color="#000000">Hapus Pegawai <?php echo $baris->nama; ?>?</span></font> 
                                                                </h2>
                                                            </div>  <!--end modal-header--> 
                                                            <div class="modal-footer">
                                                                <!-- <a href="pages-login.html" class="btn btn-success btn-lg">Yes</a> -->
                                                                <a href="<?php echo site_url('c_posbindu/deletekader/' . $baris->id); ?>" class="btn btn-success btn-lg">Ya</a>
                                                                <button class="btn btn-default btn-lg mb-control-close">Batal</button>
                                                            </div>
                                                        </form>
                                                    </div><!--modal content--> 

                                                </div>
                                            </div> 

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
                            'aTargets': [4]
                        } //disables sorting for column one
                    ],
                    'iDisplayLength': 10,
                    "sPaginationType": "full_numbers",
                    "tableTools": {
                        "sSwfPath": "<?php echo base_url('assets/js/Datatables/tools/swf/copy_csv_xls_pdf.swf'); ?>"
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