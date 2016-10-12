<?php
$formCallback = $this->session->flashdata('form_clbk');
if (isset($formCallback['role']))
{
    if (strlen(trim($formCallback['role'])) != 0)
    {
        if ($formCallback['role'] == 'dss' || $formCallback['role'] == 'dinkes')
        {

        }
        else
        {
            $formCallback['role'] = 'pasien';
        }
    }
    else
    {
        $formCallback['role'] = 'pasien';
    }
}
else
{
    $formCallback['role'] = 'pasien';
}
?>
<!DOCTYPE HTML>
<!--[if gt IE 8]>
<html class="ie9" lang="en"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml" class="ihome">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <title>Stroke Prevention</title>
    <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'/>
    <link href='http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic' rel='stylesheet' type='text/css'/>-->
    <link href="<?php echo base_url(); ?>assets/frontend/css/jquery-ui-1.10.3.custom.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/frontend/css/animate.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/frontend/css/font-awesome.min.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/blue.css"
          id="style-switch"/>
    <!-- REVOLUTION BANNER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url(); ?>assets/frontend/rs-plugin/css/settings.min.css" media="screen"/>
    <!--[if IE 9]>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/ie9.css"/>
    <![endif]-->
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/slides.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/inline.min.css"/>
</head>
<body>
<div id="loader-overlay">
    <img src="<?php echo base_url(); ?>assets/frontend/images/loader.gif" alt="Loading"/>
</div>
<header>
    <div class="header-bg">
        <!--Topbar-->
        <div id="headerstic">
            <div class=" top-bar container">
                <div class="row">
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle icon-list-ul" data-toggle="collapse"
                                        data-target="#bs-example-navbar-collapse-1">
                                    <span class="sr-only">Toggle navigation</span>
                                </button>
                                <button type="button" class="navbar-toggle icon-rocket" data-toggle="collapse"
                                        data-target="#bs-example-navbar-collapse-2">
                                    <span class="sr-only">Toggle navigation</span>
                                </button>
                                <a href="<?php echo base_url(); ?>">
                                    <div class="logo"></div>
                                </a>
                            </div>
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav navbar-right">
                                    <li>
                                        <a href="<?php echo base_url(); ?>">
                                            <i class="icon-home"></i>
                                            Home
                                        </a>
                                    </li>
                                    <li class="active">
                                        <a href="<?php echo base_url('index.php/'); ?>login">Login</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('index.php/'); ?>contact-us">Contact Us</a>
                                    </li>
                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </div><!-- /.container-fluid -->
                    </nav>
                </div>
            </div><!--Topbar End-->
        </div>
    </div>
</header>
<section class="complete-content content-footer-space">
    <!--Mid Content Start-->
    <div class="about-intro-wrap pull-left">
        <div class="bread-crumb-wrap ibc-wrap-6">
            <div class="container">
                <!--Title / Beadcrumb-->
                <div class="inner-page-title-wrap col-xs-12 col-md-12 col-sm-12">
                    <div class="bread-heading"><h1>Login</h1></div>
                    <div class="bread-crumb pull-right">
                        <ul>
                            <li>
                                <a href="<?php echo base_url(); ?>">Home</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('index.php/'); ?>login">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <br>
                <form action="<?php echo base_url('index.php/'); ?>main_controller/doLogin" method="post"
                      style="padding: 50px 20% 0 20%">
                    <?php
                    $message = $this->session->flashdata('registerCallback');
                    if(!$message)
                    {
                        $message = $this->session->flashdata('notRegistered');
                    }
                    if (isset($message))
                    {
                        echo "<div style=\"font-size: medium; text-align: center\">{$message}</div>";
                    }
                    unset($message);
                    ?>
                    <table width="100%">
                        <tr>
                            <td width="25%" style="padding: 15px 0 15px 0; font-size: medium">Username</td>
                            <td width="5%" style="text-align: center">:</td>
                            <td colspan="3" width="70%">
                                <input style="width: 100%" type="text" name="username" value="<?php echo isset($formCallback['username']) ? $formCallback['username'] : ''?>">
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" style="padding: 15px 0 15px 0; font-size: medium">Password</td>
                            <td width="5%" style="text-align: center">:</td>
                            <td colspan="3" width="70%">
                                <input style="width: 100%" type="password" name="password">
                                <?php
                                $message = $this->session->flashdata('urlCallback');
                                if (isset($message))
                                {
                                    echo "<input type='hidden' value='{$message}' name='urlCallback'>";
                                }
                                unset($message);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" style="padding: 15px 0 15px 0; font-size: medium">Hak Akses</td>
                            <td width="5%" style="text-align: center">:</td>
                            <td colspan="3" width="70%">
                                <input type="radio" name="role" value="pasien" <?php echo ($formCallback['role'] == 'pasien') ? 'checked="true"' : ''; ?>>
                                <span style="font-size: medium"> Pasien</span>
                                <br>
                                <input type="radio" name="role" value="dss" <?php echo ($formCallback['role'] == 'dss') ? 'checked="true"' : ''; ?>>
                                <span style="font-size: medium"> DSS</span>
                                <br>
                                <input type="radio" name="role" value="admin" <?php echo ($formCallback['role'] == 'dinkes') ? 'checked="true"' : ''; ?>>
                                <span style="font-size: medium"> Admin</span>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" style="padding: 15px 0 15px 0">&nbsp;</td>
                            <td width="5%"></td>
                            <td width="15%" align="left">
                                <button type="submit">Login</button>
                            </td>
                            <td width="40%" align="center">&nbsp;</td>
                            <td width="15%" align="right">
                                <a href="<?php echo base_url('index.php/'); ?>register" style="color: inherit;">Registrasi</a>
                            </td>
                        </tr>
                        <tr>
                            <td width="25%" style="padding: 15px 0 15px 0;"></td>
                            <td width="5%" style="text-align: center">&nbsp;</td>
                        </tr>
                    </table>
                </form>
                <br>
            </div>
        </div>
    </div>
</section>
<!--Footer Start-->
<div class="complete-footer">
    <div class="bottom-footer">
        <div class="container">
            <div class="row">
                <!--Foot widget-->
                <div class="col-xs-12 col-sm-12 col-md-12 foot-widget-bottom">
                    <p class="col-xs-12 col-md-5 no-pad">Copyright <?php echo date("Y"); ?> stroke prevention | All
                                                         Rights Reserved |
                                                         Brawijaya University</p>
                    <ul class="foot-menu col-xs-12 col-md-7 no-pad">
                        <div class="social-wrap">
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/Dinkes-Kota-Malang-457079201151496/">
                                        <i
                                            class="icon-facebook foot-social-icon" id="face-foot" data-toggle="tooltip"
                                            data-placement="bottom" title="Facebook"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/dinkes_KoMal">
                                        <i
                                            class="icon-social-twitter foot-social-icon" id="tweet-foot"
                                            data-toggle="tooltip" data-placement="bottom" title="Twitter"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="http://dinkes.malangkota.go.id/feed/">
                                        <i class="icon-rss foot-social-icon"
                                           id="rss-foot"
                                           data-toggle="tooltip"
                                           data-placement="bottom"
                                           title="RSS"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--JS Inclution-->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.min.js"></script>
<script type="text/javascript"
        src="<?php echo base_url(); ?>assets/frontend/js/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript"
        src="<?php echo base_url(); ?>assets/frontend/bootstrap-new/js/bootstrap.min.js"></script>
<script type="text/javascript"
        src="<?php echo base_url(); ?>assets/frontend/rs-plugin/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript"
        src="<?php echo base_url(); ?>assets/frontend/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.scrollUp.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.sticky.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/wow.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.flexisel.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.imedica.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/custom-imedicajs.min.js"></script>
<script type='text/javascript'>
    $(window).load(function ()
    {
        $('#loader-overlay').fadeOut(900);
        $("html").css("overflow", "visible");
    });
</script>
<script type='text/javascript'>
    $('.counter-style').appear(function ()
    {
        var demo = new countUp('myTargetElement', 0, 5000, 0, 4, options);
        demo.start();
    });
    $(document).ready(function ()
    {
        $('.counter-style').appear(function ()
        {
            var demo = new countUp('myTargetElement2', 0, 3000, 0, 4, options);
            demo.start();
        });
    });
    $(document).ready(function ()
    {
        $('.counter-style').appear(function ()
        {
            var demo = new countUp('myTargetElement3', 0, 3500, 0, 4, options);
            demo.start();
        });
    });
    $(document).ready(function ()
    {
        $('.counter-style').appear(function ()
        {
            var demo = new countUp('myTargetElement4', 0, 4000, 0, 4, options);
            demo.start();
        });
    });
</script>
<script type="text/javascript">
    <?php echo $this->session->flashdata('js_cmd')?>
</script>
</body>
</html>