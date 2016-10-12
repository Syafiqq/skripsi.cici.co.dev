<?php
/**
 * This <skripsi.cici.co.dev> project created by :
 * Name         : syafiq
 * Date / Time  : 07 September 2016, 2:14 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */

/*
 * Define Constants
 * */
$__LOW_PRECISION = 4;
$__MEDIUM_PRECISION = 9;
$__HIGH_PRECISION = 17;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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

        .custom_breadcrumb li + li:before {
            content: "» ";
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
<body>
<h1>Hasil Deteksi</h1>

<?php echo '<button class="custom_accordion" style="font-size: x-large">Data Latih</button>' ?>
<?php echo '<div class="custom_accordion_panel">' ?>
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
                    echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . $value[$kategori] . " (" . ucfirst($data['data']['metadata']['class'][$value[$kategori]]) . ")</td>";
                }
            }
            echo '</tr>';
        }
    }
}
echo '</table>';
//</editor-fold>
?>
<?php echo '</div>' ?>


<?php echo '<button class="custom_accordion" style="font-size: x-large">Data Uji</button>' ?>
<?php echo '<div class="custom_accordion_panel">' ?>
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
                if ($kategori != 'tingkat_resiko')
                {
                    echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . round($value[$kategori], 4) . "</td>";
                }
                else
                {
                    echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . $value[$kategori] . " (" . ucfirst($data['data']['metadata']['class'][$value[$kategori]]) . ")</td>";
                }
            }
            echo '</tr>';
        }
    }
}
echo '</table>';
//</editor-fold>
?>
<?php echo '</div>' ?>


<?php echo '<button class="custom_accordion" style="font-size: x-large">Normalisasi Data</button>' ?>
<?php echo '<div class="custom_accordion_panel">' ?>
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
        echo "<th style=\"padding: 5px; text-align: right; border : 1px solid black;\">".sprintf("%.{$__LOW_PRECISION}g", $data['data']['metadata']['minmax'][$kategori]['min'])."</th>";
    }
}
echo '</tr>';
echo '<tr>';
echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">Max</th>';
foreach ($data['category']['key'] as $kategori)
{
    if ($kategori != 'tingkat_resiko')
    {
        echo "<th style=\"padding: 5px; text-align: right; border : 1px solid black;\">".sprintf("%.{$__LOW_PRECISION}g", $data['data']['metadata']['minmax'][$kategori]['max'])."</th>";
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
                echo "<td style=\"padding: 5px; text-align: right; border : 1px solid black;\">".sprintf("%.{$__LOW_PRECISION}g", $value[$kategori])."</td>";
            }
        }
        echo '</tr>';
    }
}
echo '</table>';
//</editor-fold>
?>
<?php echo '</div>' ?>


<?php echo '<button class="custom_accordion" style="font-size: x-large">Menghitung Jarak</button>' ?>
<?php echo '<div class="custom_accordion_panel">' ?>
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
        if ($id == 'tingkat_resiko')
        {
            echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . $sub_data . " (" . ucfirst($data['data']['metadata']['class'][$sub_data]) . ")</td>";
        }
        else if ($id == 'no')
        {
            echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . $sub_data . "</td>";
        }
        else if ($id == 'id')
        {
        }
        else
        {
            echo "<td style=\"padding: 5px; text-align: right; border : 1px solid black;\">".sprintf("%.{$__LOW_PRECISION}f", $sub_data). "</td>";
        }
    }
    echo '</tr>';
}
echo '</table>';
// </editor-fold>
?>
<?php echo '</div>' ?>


<?php echo '<button class="custom_accordion" style="font-size: x-large">Mengurutkan jarak dari terdekat hingga terjauh</button>' ?>
<?php echo '<div class="custom_accordion_panel">' ?>
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
        if ($id == 'tingkat_resiko')
        {
            echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . $sub_data . " (" . ucfirst($data['data']['metadata']['class'][$sub_data]) . ")</td>";
        }
        else if ($id == 'no')
        {
            echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . $sub_data . "</td>";
        }
        else if ($id == 'id')
        {
        }
        else
        {
            echo "<td style=\"padding: 5px; text-align: right; border : 1px solid black;\">" .sprintf("%.{$__LOW_PRECISION}f", $sub_data). "</td>";
        }
    }
    echo '</tr>';
}
echo '</table>';
// </editor-fold>
?>
<?php echo '</div>' ?>


<?php echo '<button class="custom_accordion" style="font-size: x-large">Mengelompokkan jarak Berdasasrkan nilai K</button>' ?>
<?php echo '<div class="custom_accordion_panel">' ?>
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
            if ($id == 'tingkat_resiko')
            {
                echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . $sub_data . " (" . ucfirst($data['data']['metadata']['class'][$sub_data]) . ")</td>";
            }
            else if ($id == 'no')
            {
                echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . $sub_data . "</td>";
            }
            else if ($id == 'id')
            {
            }
            else
            {
                echo "<td style=\"padding: 5px; text-align: right; border : 1px solid black;\">" .sprintf("%.{$__LOW_PRECISION}f", $sub_data). "</td>";
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
<?php echo '</div>' ?>

<?php echo '<button class="custom_accordion" style="font-size: x-large">Nilai Rata Rata Tiap Parameter</button>' ?>
<?php echo '<div class="custom_accordion_panel">' ?>
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
        echo "<td style=\"padding: 5px; text-align: right; border : 1px solid black;\">" .sprintf("%.{$__LOW_PRECISION}f", $value).'</td>';
    }
}
echo '</tr>';
echo '</table>';
// </editor-fold>

?>
<?php echo '</div>' ?>


<?php echo '<button class="custom_accordion" style="font-size: x-large">Nilai Parameter (Rata - Rata)</button>' ?>
<?php echo '<div class="custom_accordion_panel">' ?>
<?php
// <editor-fold defaultstate="collapsed" desc="Nilai Parameter (Rata - Rata)">
echo '<table style="width:100%; border : 1px solid black; border-collapse: collapse">';
foreach ($data['model'] as $data_model)
{
    echo '<tr>';
    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . ucfirst($data_model) . "</th>";
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
                echo "<td style=\"padding: 5px; text-align: right; border : 1px solid black;\">" .sprintf("%.{$__MEDIUM_PRECISION}f", $value[$kategori]). '</td>';
            }
        }
        echo '</tr>';
    }
}
echo '</table>';
// </editor-fold>
?>
<?php echo '</div>' ?>


<?php echo '<button class="custom_accordion" style="font-size: x-large">Perkalian antar parameter (a x b x c x ... x j)</button>' ?>
<?php echo '<div class="custom_accordion_panel">' ?>
<?php
// <editor-fold defaultstate="collapsed" desc="Perkalian antar parameter (a x b x c x ... x j)">
echo '<table align="center" style="width:40%; border : 1px solid black; border-collapse: collapse">';
foreach ($data['model'] as $data_model)
{
    echo '<tr>';
    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . ucfirst($data_model) . "</th>";
    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">No Data</th>";
    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">a x b x c x ... x j</th>";
    echo '</tr>';
    foreach ($data['coefficientCorrelation']['xy']['dataset'][$data_model] as $index => $value)
    {
        echo '<tr>';
        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . ($index + 1) . '</td>';
        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . ($value['no']) . '</td>';
        echo "<td style=\"padding: 5px; text-align: right; border : 1px solid black;\">" .sprintf("%.{$__HIGH_PRECISION}f", $value['power']). '</td>';
        echo '</tr>';
    }
}
echo '</table>';
// </editor-fold>
?>
<?php echo '</div>' ?>


<?php echo '<button class="custom_accordion" style="font-size: x-large">Nilai Parameter 2(Rata - Rata)</button>' ?>
<?php echo '<div class="custom_accordion_panel">' ?>
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
                echo "<td style=\"padding: 5px; text-align: right; border : 1px solid black;\">" .sprintf("%.{$__MEDIUM_PRECISION}f", $value[$kategori]). '</td>';
            }
        }
        echo '</tr>';
    }
}
echo '</table>';
// </editor-fold>
?>
<?php echo '</div>' ?>


<?php echo '<button class="custom_accordion" style="font-size: x-large">Perkalian antar parameter (a<sup>2</sup> x b<sup>2</sup> x c<sup>2</sup> x ... x j<sup>2</sup>)</button>' ?>
<?php echo '<div class="custom_accordion_panel">' ?>
<?php
// <editor-fold defaultstate="collapsed" desc="Perkalian antar parameter (a2 x b2 x c2 x ... x j2)">
echo '<table align="center" style="width:40%; border : 1px solid black; border-collapse: collapse">';
foreach ($data['model'] as $data_model)
{
    echo '<tr>';
    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . ucfirst($data_model) . "</th>";
    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">No Data</th>";
    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">a<sup>2</sup> x b<sup>2</sup> x c<sup>2</sup> x ... x j<sup>2</sup></th>";
    echo '</tr>';
    foreach ($data['coefficientCorrelation']['xy2']['dataset'][$data_model] as $index => $value)
    {
        echo '<tr>';
        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . ($index + 1) . '</td>';
        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . ($value['no']) . '</td>';
        echo "<td style=\"padding: 5px; text-align: right; border : 1px solid black;\">".sprintf("%.{$__HIGH_PRECISION}f", $value['power']). '</td>';
        echo '</tr>';
    }
}
echo '</table>';
// </editor-fold>
?>
<?php echo '</div>' ?>

<?php echo '<button class="custom_accordion" style="font-size: x-large">Hasil Akhir</button>' ?>
<?php echo '<div class="custom_accordion_panel">' ?>
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
echo "<td style=\"padding: 5px; text-align: right; border : 1px solid black;\">{$data['data']['metadata']['kt1']}</td>";
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
    echo '<td style="padding: 5px; text-align: right; border : 1px solid black;">' .sprintf("%.{$__LOW_PRECISION}f", $value). '</td>';
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
echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">k={$data['data']['metadata']['voting']['k']} (" .sprintf("%.{$__LOW_PRECISION}f", $data['data']['metadata']['vt'][$data['data']['metadata']['voting']['k']]). ")</td>";
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
<?php echo '</div>' ?>
<script type="text/javascript">
    var acc = document.getElementsByClassName("custom_accordion");
    var i;

    for (i = 0; i < acc.length; i++)
    {
        acc[i].onclick = function ()
        {
            this.classList.toggle("active");
            this.nextElementSibling.classList.toggle("show");
        }
    }
</script>


</body>

</html>