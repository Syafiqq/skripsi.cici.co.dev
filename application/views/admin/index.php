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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/backend/css/maps/jquery-jvectormap-2.0.1.css"/>
    <link href="<?php echo base_url(); ?>assets/backend/css/icheck/flat/green.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/backend/css/floatexamples.css" rel="stylesheet" type="text/css"/>

    <script src="<?php echo base_url(); ?>assets/backend/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/backend/js/nprogress.js"></script>
    <script>
        //NProgress.start();
    </script>
    <!--[if lt IE 9]>
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

        <div class="right_col" role="main">
            <h1>Stroke Monitoring System</h1>
            <!-- top tiles -->
            <div class="row tile_count" style="margin: auto;">
                <div class="col-md-offset-1 animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                    <div class="left"></div>
                    <div class="right">
                        <span class="count_top"><i class="fa fa-user"></i> Total Admin</span>
                        <div class="count"><?php echo $this->db->count_all('pegawai_admin'); ?></div>
                    </div>
                </div>

                <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                    <div class="left"></div>
                    <div class="right">
                        <span class="count_top"><i class="fa fa-user"></i> Total DSS</span>
                        <div class="count"><?php echo $this->db->count_all('data_puskesmas'); ?></div>
                    </div>
                </div>
                <!--<div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                    <div class="left"></div>
                    <div class="right">
                        <span class="count_top"><i class="fa fa-user"></i> Total Posbindu</span>
                        <div class="count"><?php /*echo $this->db->count_all('data_posbindu'); */?></div>
                    </div>
                </div>
                <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                    <div class="left"></div>
                    <div class="right">
                        <span class="count_top"><i class="fa fa-user"></i> Total Kader</span>
                        <div class="count"><?php /*echo $this->db->count_all('data_kader'); */?></div>
                    </div>
                </div>-->
                <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
                    <div class="left"></div>
                    <div class="right">
                        <span class="count_top"><i class="fa fa-user"></i> Total Pasien</span>
                        <div class="count"><?php echo $this->db->count_all('pasien'); ?></div>
                    </div>
                </div>
            </div>
            <!-- /top tiles -->
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="dashboard_graph">
                            <div class="x_title">
                                <h2>5 Puskesmas Penderita Terbanyak</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-6">
                                <div>
                                    <p>Puskesmas Kendalkerep</p>
                                    <div class="">
                                        <div class="progress progress_sm" style="width: 76%;">
                                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="80"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-6">
                                <div>
                                    <p>Puskesmas Buring</p>
                                    <div class="">
                                        <div class="progress progress_sm" style="width: 76%;">
                                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-6">
                                <div>
                                    <p>Puskesmas Kedungkandang</p>
                                    <div class="">
                                        <div class="progress progress_sm" style="width: 76%;">
                                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="40"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-6">
                                <div>
                                    <p>Puskesmas Gribig</p>
                                    <div class="">
                                        <div class="progress progress_sm" style="width: 76%;">
                                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-6">
                                <div>
                                    <p>Puskesmas Janti</p>
                                    <div class="">
                                        <div class="progress progress_sm" style="width: 76%;">
                                            <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Puskesmas location
                                        <small>geo-presentation</small>
                                    </h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="dashboard-widget-content">
                                        <div id="peta" class="col-md-8 col-sm-12 col-xs-12" style="height: 270px;"></div>
                                    </div>
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

<!-- gauge js -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/gauge/gauge.min.js"></script>
<!--<script type="text/javascript" src="<?php /*echo base_url(); */?>assets/backend/js/gauge/gauge_demo.js"></script>-->
<!-- chart js -->
<script src="<?php echo base_url(); ?>assets/backend/js/chartjs/chart.min.js"></script>
<!-- bootstrap progress js -->
<script src="<?php echo base_url(); ?>assets/backend/js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/backend/js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo base_url(); ?>assets/backend/js/icheck/icheck.min.js"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/datepicker/daterangepicker.js"></script>

<script src="<?php echo base_url(); ?>assets/backend/js/custom.js"></script>

<!-- flot js -->
<!--[if lte IE 8]>
<script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/flot/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/flot/jquery.flot.time.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/flot/date.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/flot/jquery.flot.spline.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/flot/jquery.flot.stack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/flot/curvedLines.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/flot/jquery.flot.resize.js"></script>
<script>
    $(document).ready(function ()
    {
        // [17, 74, 6, 39, 20, 85, 7]
        //[82, 23, 66, 9, 99, 6, 2]
        var data1 = [[gd(2012, 1, 1), 17], [gd(2012, 1, 2), 74], [gd(2012, 1, 3), 6], [gd(2012, 1, 4), 39], [gd(2012, 1, 5), 20], [gd(2012, 1, 6), 85], [gd(2012, 1, 7), 7]];
        var data2 = [[gd(2012, 1, 1), 82], [gd(2012, 1, 2), 23], [gd(2012, 1, 3), 66], [gd(2012, 1, 4), 9], [gd(2012, 1, 5), 119], [gd(2012, 1, 6), 6], [gd(2012, 1, 7), 9]];
        $("#canvas_dahs").length && $.plot($("#canvas_dahs"), [
            data1, data2
        ], {
            series: {
                lines: {
                    show: false,
                    fill: true
                },
                splines: {
                    show: true,
                    tension: 0.4,
                    lineWidth: 1,
                    fill: 0.4
                },
                points: {
                    radius: 0,
                    show: true
                },
                shadowSize: 2
            },
            grid: {
                verticalLines: true,
                hoverable: true,
                clickable: true,
                tickColor: "#d5d5d5",
                borderWidth: 1,
                color: '#fff'
            },
            colors: ["rgba(38, 185, 154, 0.38)", "rgba(3, 88, 106, 0.38)"],
            xaxis: {
                tickColor: "rgba(51, 51, 51, 0.06)",
                mode: "time",
                tickSize: [1, "day"],
                //tickLength: 10,
                axisLabel: "Date",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Verdana, Arial',
                axisLabelPadding: 10
                //mode: "time", timeformat: "%m/%d/%y", minTickSize: [1, "day"]
            },
            yaxis: {
                ticks: 8,
                tickColor: "rgba(51, 51, 51, 0.06)",
            },
            tooltip: false
        });

        function gd(year, month, day)
        {
            return new Date(year, month - 1, day).getTime();
        }
    });
</script>

<!-- worldmap -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/maps/jquery-jvectormap-2.0.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/maps/gdp-data.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/maps/jquery-jvectormap-world-mill-en.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/maps/jquery-jvectormap-us-aea-en.js"></script>
<script>
    $(function ()
    {
        $('#world-map-gdp').vectorMap({
            map: 'world_mill_en',
            backgroundColor: 'transparent',
            zoomOnScroll: false,
            series: {
                regions: [{
                    values: gdpData,
                    scale: ['#E6F2F0', '#149B7E'],
                    normalizeFunction: 'polynomial'
                }]
            },
            onRegionTipShow: function (e, el, code)
            {
                el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
            }
        });
    });
</script>
<!-- skycons -->
<script src="<?php echo base_url(); ?>assets/backend/js/skycons/skycons.js"></script>
<script>
    var icons = new Skycons({
            "color": "#73879C"
        }),
        list = [
            "clear-day", "clear-night", "partly-cloudy-day",
            "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
            "fog"
        ],
        i;
    for (i = list.length; i--;)
    {
        icons.set(list[i], list[i]);
    }

    icons.play();
</script>

<!-- dashbord linegraph -->
<script>
    if(false)
    {
        var doughnutData = [
            {
                value: 30,
                color: "#455C73"
            },
            {
                value: 30,
                color: "#9B59B6"
            },
            {
                value: 60,
                color: "#BDC3C7"
            },
            {
                value: 100,
                color: "#26B99A"
            },
            {
                value: 120,
                color: "#3498DB"
            }
        ];
        var myDoughnut = new Chart(document.getElementById("canvas1").getContext("2d")).Doughnut(doughnutData);
    }
</script>
<!-- /dashbord linegraph -->
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
<style type='text/css'>
    #peta {
        width: 100%;
        height: 500px;

    } </style>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">

    if (true)
    {
        window.onload = function ()
        {
            var map;
            //Parameter Google maps
            var options = {
                zoom: 12, //level zoom
                //posisi tengah peta
                center: new google.maps.LatLng(-7.982609, 112.630864),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            // Buat peta di
            var map = new google.maps.Map(document.getElementById('peta'), options);
            // Tambahkan Marker
            var locations = [
                ['Puskesmas Kedungkandang', -7.983096, 112.660950],
                ['Puskesmas Gribig', -7.983096, 112.660950],
                ['Puskesmas Arjowinangun', -8.041562, 112.633605],
                ['Puskesmas Janti', -8.001796, 112.622845],
                ['Puskesmas Ciptomulyo', -7.966620, 112.632632],
                ['Puskesmas Mulyorejo', -8.127605, 112.726254],
                ['Puskesmas Arjuno', -7.978309, 112.626986],
                ['Puskesmas Bareng', -7.975388, 112.623525],
                ['Puskesmas Rampal Celaket', -7.963399, 112.631010],
                ['Puskesmas Kendalkerep', -7.956379, 112.651958],
                ['Puskesmas Cisadea', -7.955430, 112.643086],
                ['Puskesmas Pandanwangi', -7.948142, 112.658648],
                ['Puskesmas Dinoyo', -7.966620, 112.632632],
                ['Puskesmas Kendalsari', -7.945747, 112.630309],
                ['Puskesmas Mojolangu', -7.935343, 112.627002],
            ];
            var infowindow = new google.maps.InfoWindow();

            var marker, i;
            /* kode untuk menampilkan banyak marker */
            for (i = 0; i < locations.length; i++)
            {
                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                    map: map,
                    icon: '<?php echo base_url(); ?>assets/backend/images/grad-icon.png'
                });
                /* menambahkan event clik untuk menampikan
                 infowindows dengan isi sesuai denga
                 marker yang di klik */

                google.maps.event.addListener(marker, 'click', (function (marker, i)
                {
                    return function ()
                    {
                        infowindow.setContent(locations[i][0]);
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
            google.maps.event.addListener(map, 'click', function (event)
            {
                alert('Lat: ' + event.latLng.lat() + ' and Longitude is: ' + event.latLng.lng());
            });
        };
    }
    ;

</script>
<script>
    //NProgress.done();
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
<!-- /footer content -->
</body>
</html>
