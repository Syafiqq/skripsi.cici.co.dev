<?php
/**
 * This <skripsi.cici.co.dev> project created by :
 * Name         : syafiq
 * Date / Time  : 16 July 2016, 4:53 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Account Login Contact Form Widget Responsive Widget Template | Home :: w3layouts</title>
    <link href="<?php echo base_url('assets/frontend/css/dump/perhitungan/style.css'); ?>" rel="stylesheet" type="text/css" media="all"/>
    <!-- Custom Theme files -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<!--header strat here-->
<div class="element">
        <div class="signup">
            <h3>Formulir </h3>
            <form action="perhitungan.php" method="post">
                <label>Tekanan Darah</label>
                <select class="form-control bfh-countries" data-country="US" name="tekanan_darah">
                    <option value="1">Rendah</option>
                    <option value="2">Sedang</option>
                    <option value="3">Tinggi</option>
                </select>
                <label>Diabetes</label>
                <input class="user" type="text" name="diabetes" placeholder="" required="">
                <label>Riwayat Keluarga</label>
                <select class="form-control bfh-countries" data-country="US" name="riwayat_keluarga">
                    <option value="1">Tidak Ada</option>
                    <option value="2">Tidak Tahu</option>
                    <option value="3">Ada</option>
                </select>
                <label>Merokok</label>
                <select class="form-control bfh-countries" data-country="US" name="merokok">
                    <option value="1">Tidak</option>
                    <option value="2">Kadang</option>
                    <option value="3">Iya</option>
                </select>
                <label>Kolesterol</label>
                <input class="user" type="text" name="kolesterol" placeholder="" required="">
                <label>Aktifitas Fisik</label>
                <select class="form-control bfh-countries" data-country="US" name="aktifitas_fisik">
                    <option value="1">Rutin</option>
                    <option value="2">Kadang</option>
                    <option value="3">Tidak Pernah</option>
                </select>
                <label>Diet (kg/m2)</label>
                <input class="user" type="text" name="diet" placeholder="" required="">
                <label>Berat Badan</label>
                <input class="user" type="text" name="bb" placeholder="" required="">
                <label>Tinggi Badan</label>
                <input class="user" type="text" name="tb" placeholder="" required="">
                <label>Riwayat Fibrilasi Atrium</label>
                <select class="form-control bfh-countries" data-country="US" name="riwayat_fa">
                    <option value="1">Beraturan</option>
                    <option value="2">Tidak Tahu</option>
                    <option value="3">Tidak Beraturan</option>
                </select>
                <label>Tingkat Resiko</label>
                <select class="form-control bfh-countries" data-country="US" name="tingkat_resiko">
                    <option value="1">Rendah</option>
                    <option value="2">Sedang</option>
                    <option value="3">Tinggi</option>
                </select>
                <label>Nilai k</label>
                <input class="user" type="text" name="k" placeholder="" required="">
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
</div>
</body>
</html>
