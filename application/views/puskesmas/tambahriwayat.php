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
                                    <div class="x_title">
                                        <h2>Pasien Baru</h2>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content">
                                        <!-- Smart Wizard -->
                                        <p>Ini Adalah Formulir Tambah Riwayat Sakit Pasien Baru</p>

                                        <div >
                                            <form class="form-horizontal" action="<?php echo base_url(); ?>puskesmas/add/createriwayat" method="post">
                                                <input name="id_puskesmas" value="<?php echo $this->m_index->getIdPuskesmasByPegawaiPuskesmas($this->session->userdata('id_users')); ?>" type="hidden">
                                                <input name="id_pasien" value="<?php echo $this->uri->segment(4); ?>" type="hidden">
                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="occupation">Anggota Keluarga<span class="required"></span></label>
                                                    <div class="col-md-6">                                                                                            
                                                        <select class="form-control select" name="anggota_keluarga" required>
                                                            <option hidden="">Pilih Anggota Keluarga</option>
                                                            <option value="Ayah">Ayah</option>
                                                            <option value="Ibu">Ibu</option>
                                                            <option value="Saudara">Saudara</option>
                                                            <option value="Diri Sendiri">Diri Sendiri</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Tekanan Darah Sistole/Diastole <span class="required"></span>
                                                    </label>
                                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                                        <input type="number" id="sistole" name="sistole" required="required" data-validate-minmax="50,200" class="form-control col-md-7 col-xs-12" placeholder="sistole">
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                                        <input type="number" id="diastole" name="diastole" required="required" data-validate-minmax="60,120" class="form-control col-md-7 col-xs-12" placeholder="diastole">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Irama Denyut</label>
                                                    <div class="col-md-6">                                                                                            
                                                        <select class="form-control select" name="irama" required>
                                                            <option hidden="">Pilih Irama Denyut</option>
                                                            <option value="0">Irama</option>
                                                            <option value="1">Tak berirama</option>
                                                        </select>
                                                    </div>
                                                </div> 


                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Merokok</label>
                                                    <div class="col-md-6 ">
                                                        <input type="number" id="merokok" name="merokok" required="required" data-validate-minmax="0,1000" class="form-control col-md-7 col-xs-12" placeholder="Isi jumlah batang per hari">/Hari
                                                    </div>
                                                    <span class="help-block">Jika Tidak Pernah, isi dengan 0</span>
                                                </div> 

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Kolesterol</label>
                                                    <div class="col-md-6">                                                                                            
                                                        <select class="form-control select" name="kolesterol" required>
                                                            <option hidden="">Pilih Kolesterol</option>
                                                            <option value="0">Kurang dari 200</option>
                                                            <option value="1">200-239</option>
                                                            <option value="2">Lebih dari 240</option>

                                                        </select>
                                                        <span class="help-block">Pilih Kolesterol</span>
                                                    </div>
                                                </div> 

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Diabetes Melitus</label>
                                                    <div class="col-md-6">                                                                                            
                                                        <select class="form-control select" name="diabetes" required>
                                                            <option hidden="">Pilih Diabetes</option>
                                                            <option value="1">Ya</option>
                                                            <option value="0">Tidak</option>

                                                        </select>
                                                        <span class="help-block">Pilih pernah diabetes melitus atau tidak</span>
                                                    </div>
                                                </div> 


                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Kegiatan Olahraga</label>
                                                    <div class="col-md-6">                                                                                            
                                                        <select class="form-control select" name="olahraga" required>
                                                            <option hidden="">Apakah sering berolahraga?</option>
                                                            <option value="0">Ya</option>
                                                            <option value="2">Tidak</option>
                                                            <option value="1">Jarang</option>

                                                        </select>
                                                        <span class="help-block">Pilih keseringan melakukan Kegiatan Olahraga </span>
                                                    </div>
                                                </div> 



                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Tinggi / Berat Badan <span class="required"></span>
                                                    </label>
                                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                                        <input type="number" id="tinggi_badan" name="tinggi_badan" required="required" data-validate-minmax="50,200" class="form-control col-md-7 col-xs-12" placeholder="tinggi badan">
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-3">
                                                        <input type="number" id="berat_badan" name="berat_badan" required="required" data-validate-minmax="20,250" class="form-control col-md-7 col-xs-12" placeholder="berat badan">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Riwayat Sakit</label>
                                                    <div class="col-md-6">                                                                                            
                                                        <select class="form-control select" name="sakit" required>
                                                            <option hidden="">Apakah Pernah Sakit Sebelumnya?</option>
                                                            <option value="1">Ya</option>
                                                            <option value="0">Tidak</option>


                                                        </select>
                                                        <span class="help-block">Pilih pernah sakit atau tidak</span>
                                                    </div>
                                                </div> 

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Riwayat Keluarga</label>
                                                    <div class="col-md-6">                                                                                            
                                                        <select class="form-control select" name="keluarga" required>
                                                            <option hidden="">Apakah Memiliki Keturunan Stroke?</option>
                                                            <option value="1">Ya</option>
                                                            <option value="0">Tidak</option>


                                                        </select>
                                                        <span class="help-block">Pilih ya atau tidak jika ada keturunan sakit</span>
                                                    </div>
                                                </div> 

                                                <div class="form-group">
                                                    <div class="col-md-6 col-md-offset-3">
                                                        <button type="reset" class="btn btn-warning">Bersihkan</button>
                                                        <button type="submit" class="btn btn-primary pull-right" id="send">Simpan</button>
                                                    </div>
                                                </div>                        
                                            </form>

                                        </div>
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

        <!-- form validation -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/parsley/parsley.min.js"></script>

        <script src="<?php echo base_url(); ?>assets/backend/js/custom.js"></script>
        <!-- form wizard -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/wizard/jquery.smartWizard.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                // Smart Wizard 	
                $('#wizard').smartWizard();

                function onFinishCallback() {
                    $('#wizard').smartWizard('showMessage', 'Finish Clicked');
                    //alert('Finish Clicked');
                }
            });

            $(document).ready(function () {
                // Smart Wizard	
                $('#wizard_verticle').smartWizard({
                    transitionEffect: 'slide'
                });

            });
        </script>
        <script src="<?php echo base_url(); ?>assets/backend/js/validator/validator.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/moment.min2.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/datepicker/daterangepicker.js"></script>

        <script src="<?php echo base_url(); ?>assets/backend/js/input_mask/jquery.inputmask.js"></script>
        <script>
            // initialize the validator function
            validator.message['date'] = 'not a real date';

            // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
            $('form')
                    .on('blur', 'input[required], input.optional, select.required', validator.checkField)
                    .on('change', 'select.required', validator.checkField)
                    .on('keypress', 'input[required][pattern]', validator.keypress);

            $('.multi.required')
                    .on('keyup blur', 'input', function () {
                        validator.checkField.apply($(this).siblings().last()[0]);
                    });

            // bind the validation to the form submit event
            //$('#send').click('submit');//.prop('disabled', true);

            //        $('form').submit(function (e) {
            //            e.preventDefault();
            //            var submit = true;
            //            // evaluate the form using generic validaing
            //            if (!validator.checkAll($(this))) {
            //                submit = false;
            //            }
            //
            //            if (submit)
            //                this.submit();
            //            return true;
            //        });

            /* FOR DEMO ONLY */
            $('#vfields').change(function () {
                $('form').toggleClass('mode2');
            }).prop('checked', false);

            $('#alerts').change(function () {
                validator.defaults.alerts = (this.checked) ? false : true;
                if (this.checked)
                    $('form .alert').remove();
            }).prop('checked', false);
        </script>

        <!-- datepicker -->
        <script type="text/javascript">
            $(document).ready(function () {

                var cb = function (start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                    $('#reportrange_right span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
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
                    opens: 'right',
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

                $('#reportrange_right span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

                $('#reportrange_right').daterangepicker(optionSet1, cb);

                $('#reportrange_right').on('show.daterangepicker', function () {
                    console.log("show event fired");
                });
                $('#reportrange_right').on('hide.daterangepicker', function () {
                    console.log("hide event fired");
                });
                $('#reportrange_right').on('apply.daterangepicker', function (ev, picker) {
                    console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
                });
                $('#reportrange_right').on('cancel.daterangepicker', function (ev, picker) {
                    console.log("cancel event fired");
                });

                $('#options1').click(function () {
                    $('#reportrange_right').data('daterangepicker').setOptions(optionSet1, cb);
                });

                $('#options2').click(function () {
                    $('#reportrange_right').data('daterangepicker').setOptions(optionSet2, cb);
                });

                $('#destroy').click(function () {
                    $('#reportrange_right').data('daterangepicker').remove();
                });

            });
        </script>
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
            });
        </script>
        <!-- /datepicker -->
        <script type="text/javascript">
            $(document).ready(function () {
                $('#single_cal1').daterangepicker({
                    singleDatePicker: true,
                    calender_style: "picker_1"
                }, function (start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                });
                $('#single_cal2').daterangepicker({
                    singleDatePicker: true,
                    calender_style: "picker_2"
                }, function (start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                });
                $('#single_cal3').daterangepicker({
                    singleDatePicker: true,
                    calender_style: "picker_3"
                }, function (start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                });
                $('#single_cal4').daterangepicker({
                    singleDatePicker: true,
                    calender_style: "picker_4"
                }, function (start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#reservation').daterangepicker(null, function (start, end, label) {
                    console.log(start.toISOString(), end.toISOString(), label);
                });
            });
        </script>
        <!-- /datepicker -->
        <!-- input_mask -->
        <script>
            $(document).ready(function () {
                $(":input").inputmask();
            });
        </script>
        <!-- /input mask -->
        <!-- ion_range -->
        <script>
            $(function () {
                $("#range_27").ionRangeSlider({
                    type: "double",
                    min: 1000000,
                    max: 2000000,
                    grid: true,
                    force_edges: true
                });
                $("#range").ionRangeSlider({
                    hide_min_max: true,
                    keyboard: true,
                    min: 0,
                    max: 5000,
                    from: 1000,
                    to: 4000,
                    type: 'double',
                    step: 1,
                    prefix: "$",
                    grid: true
                });
                $("#range_25").ionRangeSlider({
                    type: "double",
                    min: 1000000,
                    max: 2000000,
                    grid: true
                });
                $("#range_26").ionRangeSlider({
                    type: "double",
                    min: 0,
                    max: 10000,
                    step: 500,
                    grid: true,
                    grid_snap: true
                });
                $("#range_31").ionRangeSlider({
                    type: "double",
                    min: 0,
                    max: 100,
                    from: 30,
                    to: 70,
                    from_fixed: true
                });
                $(".range_min_max").ionRangeSlider({
                    type: "double",
                    min: 0,
                    max: 100,
                    from: 30,
                    to: 70,
                    max_interval: 50
                });
                $(".range_time24").ionRangeSlider({
                    min: +moment().subtract(12, "hours").format("X"),
                    max: +moment().format("X"),
                    from: +moment().subtract(6, "hours").format("X"),
                    grid: true,
                    force_edges: true,
                    prettify: function (num) {
                        var m = moment(num, "X");
                        return m.format("Do MMMM, HH:mm");
                    }
                });
            });
        </script>
    </body>
</html>