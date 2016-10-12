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
    <style type="text/css">
        /* Style the buttons that are used to open and close the accordion panel */
        button.custom_accordion {
            background-color: #eee;
            color: #444;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            text-align: left;
            border: none;
            outline: none;
            transition: 0.4s;
        }

        /* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
        button.custom_accordion.active, button.custom_accordion:hover {
            background-color: #ddd;
        }

        /* Style the accordion panel. Note: hidden by default */
        div.custom_accordion_panel {
            padding: 0 18px;
            background-color: white;
            display: none;
        }

        /* The "show" class is added to the accordion panel when the user clicks on one of the buttons. This will show the panel content */
        div.custom_accordion_panel.show {
            display: block;
        }
    </style>

    <style type="text/css">
        .custom_breadcrumb li {
            display: inline;
        }
        .custom_breadcrumb li+li:before {
            content:"» ";
        }
    </style>
    <script type="text/x-mathjax-config">
      MathJax.Hub.Config({
        extensions: ["tex2jax.js"],
        jax: ["input/TeX", "output/HTML-CSS"],
        displayAlign: "left",
        tex2jax: {
          inlineMath: [ ['$','$'], ["\\(","\\)"] ],
          displayMath: [ ['$$','$$'], ["\\[","\\]"] ],
          processEscapes: true
        },
        "HTML-CSS": { availableFonts: ["TeX"] }
      });

    </script>
    <script src="<?php echo base_url(); ?>assets/frontend/js/MathJax/MathJax.js"></script>
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
                                <li class="current-page">
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
                <ol class="custom_breadcrumb">
                    <li ><a href="<?php echo base_url('index.php/admin/deteksi')?>">Deteksi</a></li>
                    <li class="current"><a href="<?php echo base_url('index.php/admin/hasil-deteksi')?>">Hasil Deteksi</a></li>
                </ol>
                <div class="page-title">
                    <div class="title_left">
                        <h1>Hasil Deteksi</h1>
                    </div>
                </div>
                <div class="clearfix"></div>

                <?php echo '<button class="custom_accordion" style="font-size: x-large">Data Latih</button>'?>
                <?php echo '<div class="custom_accordion_panel">'?>
                <?php
                //<editor-fold desc="Data Latih">
                echo '<table style="width:100%; border : 1px solid black; border-collapse: collapse">';
                foreach ($data['model'] as $data_model)
                {
                    if ($data_model == 'training')
                    {
                        $model = ucfirst($data_model);
                        echo '<tr>';
                        echo "<th style=\"padding: 5px; text-align: left\">{$model}</th>";
                        foreach ($data['category']['value'] as $kategori)
                        {
                            echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$kategori}</th>";
                        }
                        echo '</tr>';
                        foreach ($data['data']['dataset'][$data_model] as $no => $value)
                        {
                            ++$no;
                            echo '<tr>';
                            echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$no}</td>";
                            foreach ($data['category']['key'] as $kategori)
                            {
                                if ($kategori != 'tingkat_resiko')
                                {
                                    echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . round($value[$kategori], 4) . "</td>";
                                }
                                else
                                {
                                    echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">". $value[$kategori] ." (" . ucfirst($data['data']['metadata']['class'][$value[$kategori]]). ")</td>";
                                }
                            }
                            echo '</tr>';
                        }
                    }
                }
                echo '</table>';
                //</editor-fold>
                ?>
                <?php echo '</div>'?>


                <?php echo '<button class="custom_accordion" style="font-size: x-large">Data Uji</button>'?>
                <?php echo '<div class="custom_accordion_panel">'?>
                <?php
                //<editor-fold desc="Data Uji">
                echo '<table style="width:100%; border : 1px solid black; border-collapse: collapse">';
                foreach ($data['model'] as $data_model)
                {
                    if ($data_model == 'testing')
                    {
                        $model = ucfirst($data_model);
                        echo '<tr>';
                        echo "<th style=\"padding: 5px; text-align: left\">{$model}</th>";
                        foreach ($data['category']['value'] as $kategori)
                        {
                            echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$kategori}</th>";
                        }
                        echo '</tr>';
                        foreach ($data['data']['dataset'][$data_model] as $no => $value)
                        {
                            ++$no;
                            echo '<tr>';
                            echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$no}</td>";
                            foreach ($data['category']['key'] as $kategori)
                            {
                                if($kategori != 'tingkat_resiko')
                                {
                                    echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . round($value[$kategori], 4) . "</td>";
                                }
                                else
                                {
                                    echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">". $value[$kategori] ." (" . ucfirst($data['data']['metadata']['class'][$value[$kategori]]). ")</td>";
                                }
                            }
                            echo '</tr>';
                        }
                    }
                }
                echo '</table>';
                //</editor-fold>
                ?>
                <?php echo '</div>'?>


                <?php echo '<button class="custom_accordion" style="font-size: x-large">Normalisasi Data</button>'?>
                <?php echo '<div class="custom_accordion_panel">'?>
                <?php
                //<editor-fold desc="Normalisasi Data">
                echo '<table style="width:100%; border : 1px solid black; border-collapse: collapse">';
                echo '<tr>';
                echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">No</th>';
                foreach ($data['category']['value'] as $kategori)
                {
                    if ($kategori != 'Tingkat Resiko')
                    {
                        echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$kategori}</th>";
                    }
                }
                echo '</tr>';
                echo '<tr>';
                echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">Min</th>';
                foreach ($data['category']['key'] as $kategori)
                {
                    if ($kategori != 'tingkat_resiko')
                    {
                        echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$data['data']['metadata']['minmax'][$kategori]['min']}</th>";
                    }
                }
                echo '</tr>';
                echo '<tr>';
                echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">Max</th>';
                foreach ($data['category']['key'] as $kategori)
                {
                    if ($kategori != 'tingkat_resiko')
                    {
                        echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$data['data']['metadata']['minmax'][$kategori]['max']}</th>";
                    }
                }
                echo '</tr>';
                foreach ($data['model'] as $data_model)
                {
                    $model = ucfirst($data_model);
                    echo '<tr>';
                    echo "<th style=\"padding: 5px; text-align: left\">{$model}</th>";
                    foreach ($data['category']['value'] as $kategori)
                    {
                        if ($kategori != 'Tingkat Resiko')
                        {
                            echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$kategori}</th>";
                        }
                    }
                    echo '</tr>';
                    foreach ($data['normalization']['dataset'][$data_model] as $no => $value)
                    {
                        ++$no;
                        echo '<tr>';
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$no}</td>";
                        foreach ($data['category']['key'] as $kategori)
                        {
                            if ($kategori != 'tingkat_resiko')
                            {
                                echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . round($value[$kategori], 4) . "</td>";
                            }
                        }
                        echo '</tr>';
                    }
                }
                echo '</table>';
                //</editor-fold>
                ?>
                <?php echo '</div>'?>


                <?php echo '<button class="custom_accordion" style="font-size: x-large">Menghitung Jarak</button>'?>
                <?php echo '<div class="custom_accordion_panel">'?>
                <?php
                // <editor-fold defaultstate="collapsed" desc="Hitung Jarak">
                echo '<table style="width:30%; border : 1px solid black; border-collapse: collapse; margin: auto;">';
                echo '<tr>';
                echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">No</th>';
                echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">No Data</th>';
                echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">Jarak</th>';
                echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">Tingkat Resiko</th>';
                echo '</tr>';

                foreach ($data['euclidian']['dataset']['training'] as $no => $data_latih)
                {
                    ++$no;
                    echo '<tr>';
                    echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$no}</td>";
                    foreach ($data_latih as $id => $sub_data)
                    {
                        if($id == 'tingkat_resiko')
                        {
                            echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . $sub_data ." (". ucfirst($data['data']['metadata']['class'][$sub_data]). ")</td>";
                        }
                        else if($id == 'no')
                        {
                            echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . $sub_data . "</td>";
                        }
                        else if($id == 'id')
                        {
                        }
                        else
                        {
                            echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . round($sub_data, 4) . "</td>";
                        }
                    }
                    echo '</tr>';
                }
                echo '</table>';
                // </editor-fold>
                ?>
                <?php echo '</div>'?>


                <?php echo '<button class="custom_accordion" style="font-size: x-large">Mengurutkan jarak dari terdekat hingga terjauh</button>'?>
                <?php echo '<div class="custom_accordion_panel">'?>
                <?php
                // <editor-fold defaultstate="collapsed" desc="Mengurutkan Jarak">
                echo '<table style="width:30%; border : 1px solid black; border-collapse: collapse; margin: auto;">';
                echo '<tr>';
                echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">No</th>';
                echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">No Data</th>';
                echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">Jarak</th>';
                echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">Tingkat Resiko</th>';
                echo '</tr>';

                foreach ($data['euclidian']['sorted']['dataset']['training'] as $no => $data_latih)
                {
                    ++$no;
                    echo '<tr>';
                    echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$no}</td>";
                    foreach ($data_latih as $id => $sub_data)
                    {
                        if($id == 'tingkat_resiko')
                        {
                            echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . $sub_data ." (". ucfirst($data['data']['metadata']['class'][$sub_data]). ")</td>";
                        }
                        else if($id == 'no')
                        {
                            echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . $sub_data . "</td>";
                        }
                        else if($id == 'id')
                        {
                        }
                        else
                        {
                            echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . round($sub_data, 4) . "</td>";
                        }
                    }
                    echo '</tr>';
                }
                echo '</table>';
                // </editor-fold>
                ?>
                <?php echo '</div>'?>


                <?php echo '<button class="custom_accordion" style="font-size: x-large">Mengelompokkan jarak Berdasasrkan nilai K</button>'?>
                <?php echo '<div class="custom_accordion_panel">'?>
                <?php
                // <editor-fold defaultstate="collapsed" desc="Mengelompokkan Jarak">
                foreach ($data['data']['metadata']['k'] as $k_value)
                {
                    echo '<h1>&nbsp;</h1>';
                    echo "<h4 align='center'>Nilai K : {$k_value}</h4>";
                    echo '<table style="width:30%; border : 1px solid black; border-collapse: collapse; margin: auto;">';
                    echo '<tr>';
                    echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">No</th>';
                    echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">No Data</th>';
                    echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">Jarak</th>';
                    echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">Tingkat Resiko</th>';
                    echo '</tr>';
                    foreach ($data['euclidian']['sorted']['dataset']['training'] as $no => $data_latih)
                    {
                        ++$no;
                        echo '<tr>';
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$no}</td>";
                        foreach ($data_latih as $id => $sub_data)
                        {
                            if($id == 'tingkat_resiko')
                            {
                                echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . $sub_data ." (". ucfirst($data['data']['metadata']['class'][$sub_data]). ")</td>";
                            }
                            else if($id == 'no')
                            {
                                echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . $sub_data . "</td>";
                            }
                            else if($id == 'id')
                            {
                            }
                            else
                            {
                                echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . round($sub_data, 4) . "</td>";
                            }
                        }
                        echo '</tr>';
                        if ($no >= $k_value)
                        {
                            break;
                        }
                    }
                    echo '</table>';
                }
                // </editor-fold>
                ?>
                <?php echo '</div>'?>

                <?php echo '<button class="custom_accordion" style="font-size: x-large">Nilai Rata Rata Tiap Parameter</button>'?>
                <?php echo '<div class="custom_accordion_panel">'?>
                <?php
                // <editor-fold defaultstate="collapsed" desc="Nilai Rata-Rata pada Tiap Parameter">
                echo '<table style="width:100%; border : 1px solid black; border-collapse: collapse">';
                echo '<tr>';
                echo "<th style=\"padding: 5px; text-align: left\">No</th>";
                foreach ($data['category']['value'] as $kategori)
                {
                    if ($kategori != 'Tingkat Resiko')
                    {
                        echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$kategori}</th>";
                    }
                }
                echo '</tr>';
                echo '<tr>';
                echo '<td style="padding: 5px; text-align: left; border : 1px solid black;">Rata_Rata</td>';
                foreach ($data['data']['metadata']['mean']['normalization'] as $kategori => $value)
                {
                    if ($kategori != 'tingkat_resiko')
                    {
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . round($value, 4) . '</td>';
                    }
                }
                echo '</tr>';
                echo '</table>';
                // </editor-fold>

                ?>
                <?php echo '</div>'?>


                <?php echo '<button class="custom_accordion" style="font-size: x-large">Nilai Parameter (Rata - Rata)</button>'?>
                <?php echo '<div class="custom_accordion_panel">'?>
                <?php
                // <editor-fold defaultstate="collapsed" desc="Nilai Parameter (Rata - Rata)">
                echo '<table style="width:100%; border : 1px solid black; border-collapse: collapse">';
                foreach ($data['model'] as $data_model)
                {
                    echo '<tr>';
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">".ucfirst($data_model)."</th>";
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">No Data</th>";
                    foreach ($data['category']['value'] as $kategori)
                    {
                        if ($kategori != 'Tingkat Resiko')
                        {
                            echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$kategori}</th>";
                        }
                    }
                    echo '</tr>';
                    foreach ($data['coefficientCorrelation']['xy']['dataset'][$data_model] as $index => $value)
                    {
                        echo '<tr>';
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . ($index + 1) . '</td>';
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . ($value['no']) . '</td>';
                        foreach ($data['category']['key'] as $kategori)
                        {
                            if ($kategori != 'tingkat_resiko')
                            {
                                echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . round($value[$kategori], 4) . '</td>';
                            }
                        }
                        echo '</tr>';
                    }
                }
                echo '</table>';
                // </editor-fold>
                ?>
                <?php echo '</div>'?>


                <?php echo '<button class="custom_accordion" style="font-size: x-large">Perkalian antar parameter (a x b x c x ... x j)</button>'?>
                <?php echo '<div class="custom_accordion_panel">'?>
                <?php
                // <editor-fold defaultstate="collapsed" desc="Perkalian antar parameter (a x b x c x ... x j)">
                echo '<table align="center" style="width:40%; border : 1px solid black; border-collapse: collapse">';
                foreach ($data['model'] as $data_model)
                {
                    echo '<tr>';
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">".ucfirst($data_model)."</th>";
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">No Data</th>";
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">a x b x c x ... x j</th>";
                    echo '</tr>';
                    foreach ($data['coefficientCorrelation']['xy']['dataset'][$data_model] as $index => $value)
                    {
                        echo '<tr>';
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . ($index + 1) . '</td>';
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . ($value['no']) . '</td>';
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . sprintf('%.20f', ($value['power'])) . '</td>';
                        echo '</tr>';
                    }
                }
                echo '</table>';
                // </editor-fold>
                ?>
                <?php echo '</div>'?>


                <?php echo '<button class="custom_accordion" style="font-size: x-large">Nilai Parameter 2(Rata - Rata)</button>'?>
                <?php echo '<div class="custom_accordion_panel">'?>
                <?php
                // <editor-fold defaultstate="collapsed" desc="Nilai Parameter 2(Rata - Rata)">
                echo '<table style="width:100%; border : 1px solid black; border-collapse: collapse">';
                foreach ($data['model'] as $data_model)
                {
                    echo '<tr>';
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">No</th>";
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">No Data</th>";
                    foreach ($data['category']['value'] as $kategori)
                    {
                        if ($kategori != 'Tingkat Resiko')
                        {
                            echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$kategori}</th>";
                        }
                    }
                    echo '</tr>';
                    foreach ($data['coefficientCorrelation']['xy2']['dataset'][$data_model] as $index => $value)
                    {
                        echo '<tr>';
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . ($index + 1) . '</td>';
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . ($value['no']) . '</td>';
                        foreach ($data['category']['key'] as $kategori)
                        {
                            if ($kategori != 'tingkat_resiko')
                            {
                                echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . round($value[$kategori], 4) . '</td>';
                            }
                        }
                        echo '</tr>';
                    }
                }
                echo '</table>';
                // </editor-fold>
                ?>
                <?php echo '</div>'?>


                <?php echo '<button class="custom_accordion" style="font-size: x-large">Perkalian antar parameter (a<sup>2</sup> x b<sup>2</sup> x c<sup>2</sup> x ... x j<sup>2</sup>)</button>'?>
                <?php echo '<div class="custom_accordion_panel">'?>
                <?php
                // <editor-fold defaultstate="collapsed" desc="Perkalian antar parameter (a2 x b2 x c2 x ... x j2)">
                echo '<table align="center" style="width:40%; border : 1px solid black; border-collapse: collapse">';
                foreach ($data['model'] as $data_model)
                {
                    echo '<tr>';
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">".ucfirst($data_model)."</th>";
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">No Data</th>";
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">a<sup>2</sup> x b<sup>2</sup> x c<sup>2</sup> x ... x j<sup>2</sup></th>";
                    echo '</tr>';
                    foreach ($data['coefficientCorrelation']['xy2']['dataset'][$data_model] as $index => $value)
                    {
                        echo '<tr>';
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . ($index + 1) . '</td>';
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . ($value['no']) . '</td>';
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . sprintf('%.30f', ($value['power'])) . '</td>';
                        echo '</tr>';
                    }
                }
                echo '</table>';
                // </editor-fold>
                ?>
                <?php echo '</div>'?>

                <?php echo '<button class="custom_accordion" style="font-size: x-large">Hasil Akhir</button>'?>
                <?php echo '<div class="custom_accordion_panel">'?>
                <?php
                // <editor-fold defaultstate="collapsed" desc="Hasil Akhir">
                echo '<table align="center" style="width:50%; border-collapse: collapse">';
                echo '<tr>';
                echo '<td>';
                foreach ($data['data']['metadata']['stepbystep']['kt1'] as $step)
                {
                    echo "<p>{$step}</p>";
                }
                echo '</td>';
                echo '</tr>';
                echo '</table>';
                echo '<table align="center" style="width:20%; border : 1px solid black; border-collapse: collapse">';
                echo '<tr>';
                echo '<th colspan="2" style="border : 1px solid black;"><h5 align="center">Menghitung Kt1</h5></th>';
                echo '</tr>';
                echo '<tr>';
                echo '<td style="padding: 5px; text-align: left; border : 1px solid black;">Kt1</td>';
                echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$data['data']['metadata']['kt1']}</td>";
                echo '</tr>';
                echo '</table>';
                echo '<h1>&nbsp</h1>';
                echo '<table align="center" style="width:20%; border : 1px solid black; border-collapse: collapse">';
                echo '<tr>';
                echo '<th colspan="2" style="border : 1px solid black;"><h5 align="center">Menghitung Vt</h5></th>';
                echo '</tr>';
                echo '<tr>';
                echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">K</th>';
                echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">Vt-k</th>';
                echo '</tr>';
                foreach ($data['data']['metadata']['vt'] as $k => $value)
                {
                    echo '<tr>';
                    echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$k}</td>";
                    echo '<td style="padding: 5px; text-align: left; border : 1px solid black;">'.round($value,4).'</td>';
                    echo '</tr>';
                }
                echo '<tr>';
                echo '<th colspan="2" style="border : 1px solid black;"><h1>&nbsp;</h1></th>';
                echo '</tr>';
                echo '<tr>';
                echo '<th colspan="2" style="border : 1px solid black;"><h5 align="center">Memilih K Menang</h5></th>';
                echo '</tr>';
                echo '<tr>';
                echo '<td style="padding: 5px; text-align: left; border : 1px solid black;">k</td>';
                echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">k={$data['data']['metadata']['voting']['k']} (". round($data['data']['metadata']['vt'][$data['data']['metadata']['voting']['k']],4) .")</td>";
                echo '</tr>';
                echo '<tr>';
                echo '<th colspan="2" style="border : 1px solid black;"><h1>&nbsp;</h1></th>';
                echo '</tr>';
                echo '<tr>';
                echo '<th colspan="2" style="border : 1px solid black;"><h5 align="center">Memilih Klas Menang</h5></th>';
                echo '</tr>';
                echo '<tr>';
                echo '<td style="padding: 5px; text-align: left; border : 1px solid black;">Klas</td>';
                echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$data['data']['metadata']['voting']['class']} ({$data['data']['metadata']['class'][$data['data']['metadata']['voting']['class']]})</td>";
                echo '</tr>';
                echo '</table>';


                // </editor-fold>
                echo '</table>';
                ?>
                <?php echo '</div>'?>
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
<!-- /datepicker -->
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
<script type="text/javascript">
    var acc = document.getElementsByClassName("custom_accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function(){
            this.classList.toggle("active");
            this.nextElementSibling.classList.toggle("show");
        }
    }
</script>


</body>

</html>