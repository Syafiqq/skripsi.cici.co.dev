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
    <link rel="icon" href="<?php echo base_url(); ?>assets/favicon.ico" type="image/x-icon"/>

    <link href="<?php echo base_url(); ?>assets/backend/css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/backend/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/backend/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo base_url(); ?>assets/backend/css/customAdmin.css" rel="stylesheet">
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

            <div class="">

                <div class="page-title">
                    <div class="title_left" style="width: 100% !important">
                        <h1 align="center">Data Latih</h1>
                    </div>
                </div>
                <div class="clearfix"></div>
                <?php

                echo '<table style="width:100%; border : 1px solid black; border-collapse: collapse">';
                $data_model = $datalatih['model'][0];
                $model = ucfirst($data_model);
                echo '<tr>';
                echo "<th style=\"padding: 5px; text-align: left\">{$model}</th>";
                foreach ($datalatih['category']['value'] as $kategori)
                {
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$kategori}</th>";
                }
                echo '</tr>';
                foreach ($datalatih['data'] as $no => $value)
                {
                    ++$no;
                    echo '<tr>';
                    echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$no}</td>";
                    foreach ($datalatih['category']['key'] as $kategori)
                    {
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . round($value[$kategori], 4) . "</td>";
                    }
                    echo '</tr>';
                }
                echo '</table>';
                ?>

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
<script>
    if(false)
    {
        $(function ()
        {
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
        });
    }
</script>
<!-- datepicker -->
<script type="text/javascript">
    $(document).ready(function ()
    {

        var cb = function (start, end, label)
        {
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
        $('#reportrange').on('show.daterangepicker', function ()
        {
            console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function ()
        {
            console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function (ev, picker)
        {
            console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function (ev, picker)
        {
            console.log("cancel event fired");
        });
        $('#options1').click(function ()
        {
            $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function ()
        {
            $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function ()
        {
            $('#reportrange').data('daterangepicker').remove();
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
<!-- /datepicker -->
</body>

</html>