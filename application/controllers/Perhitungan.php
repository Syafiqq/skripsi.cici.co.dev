<?php
/**
 * This <skripsi.cici.co.dev> project created by :
 * Name         : syafiq
 * Date / Time  : 02 August 2016, 1:51 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Perhitungan extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function index()
    {
        $this->load->view('dump/perhitungan/index.php');
    }

    public function form()
    {
        $this->load->view('dump/perhitungan/form');
    }

    public function doPerhitungan()
    {
        /*Debug*/
        if (true)
        /*Input User*/
        //if (isset($_REQUEST['submit']))
        {
            $setting['kategori'] = array(
                'tekanan_darah',
                'diabetes',
                'riwayat_keluarga',
                'merokok',
                'kolesterol',
                'aktifitas_fisik',
                'diet',
                'bb',
                'tb',
                'riwayat_fa',
                'tingkat_resiko');
            $setting['data_model'] = array('uji', 'latih');
            //Setting banyak k yang digunakan
            $setting['knn']['k']['value'] = array(1, 3, 5, 7, 11, 13,15, 17);

            if (!isset($data))
            {
                $data = array();
                $data['data']['uji'] = array();
                $data['data']['latih'] = array();
            }

            /*
             * Set Data Uji
             * */

            //UNTUK DEBUG COMMENT SALAH SATU  <====================================
            // Kalau mau debug yang dipakai
            //      baris 104 - 114 = uncomment
            //      bbaris 116 - 127 = comment
            // Kalau data diinputkan dari index.php
            //      baris 104 - 114 = comment
            //      baris 116 - 127 = uncomment
            $user_input["id"] = null;
            $user_input[$setting['kategori'][0]] = 1;
            $user_input[$setting['kategori'][1]] = 180;
            $user_input[$setting['kategori'][2]] = 3;
            $user_input[$setting['kategori'][3]] = 1;
            $user_input[$setting['kategori'][4]] = 100;
            $user_input[$setting['kategori'][5]] = 1;
            $user_input[$setting['kategori'][6]] = 20.30;
            $user_input[$setting['kategori'][7]] = 54;
            $user_input[$setting['kategori'][8]] = 1.63;
            $user_input[$setting['kategori'][9]] = 1;
            $user_input[$setting['kategori'][10]] = 3;

            /*$user_input["id"] = null;
            $user_input[$setting['kategori'][0]] = $_REQUEST['tekanan_darah'];
            $user_input[$setting['kategori'][1]] = $_REQUEST['diabetes'];
            $user_input[$setting['kategori'][2]] = $_REQUEST['riwayat_keluarga'];
            $user_input[$setting['kategori'][3]] = $_REQUEST['merokok'];
            $user_input[$setting['kategori'][4]] = $_REQUEST['kolesterol'];
            $user_input[$setting['kategori'][5]] = $_REQUEST['aktifitas_fisik'];
            $user_input[$setting['kategori'][6]] = $_REQUEST['diet'];
            $user_input[$setting['kategori'][7]] = $_REQUEST['bb'];
            $user_input[$setting['kategori'][8]] = $_REQUEST['tb'];
            $user_input[$setting['kategori'][9]] = $_REQUEST['riwayat_fa'];
            $user_input[$setting['kategori'][10]] = $_REQUEST['tingkat_resiko'];*/


            array_push($data['data']['uji'], $user_input);
            unset($user_input);
            //$logger->addDebug('User Input', array('data' => $data['data']));


            /*
             * Baca Data Latih
             * */
            $query_as = $this->m_perhitungan->getDataLatih();
            foreach ($query_as as $db_data)
            {
                $container['id'] = $db_data['id'];
                foreach ($setting['kategori'] as $kategori)
                {
                    $container[$kategori] = $db_data[$kategori];
                }
                array_push($data['data']['latih'], $container);
            }
            unset($container);
            $setting['index_encoder'] = $data['data']['latih'][0]['id'] - 1;
            //$logger->addDebug('User Input', array('data' => $setting['index_encoder']));
            /*
             * Tampilkan Data Training
             * */
            // <editor-fold defaultstate="collapsed" desc="Tampilkan Data Training">
            echo '<button class="accordion">Data Training</button>';
            echo '<div class="panel">';
            echo '<table style="width:100%; border : 1px solid black; border-collapse: collapse">';
            echo '<caption>Data Training</caption>';
            foreach ($setting['data_model'] as $data_model)
            {
                $model = ucfirst($data_model);
                echo '<tr>';
                echo "<th style=\"padding: 5px; text-align: left\">{$model}</th>";
                foreach ($setting['kategori'] as $kategori)
                {
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$kategori}</th>";
                }
                echo '</tr>';
                foreach ($data['data'][$data_model] as $no => $value)
                {
                    ++$no;
                    echo '<tr>';
                    echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$no}</td>";
                    foreach ($setting['kategori'] as $kategori)
                    {
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . round($value[$kategori], 4) . "</td>";
                    }
                    echo '</tr>';
                }
            }
            echo '</table>';
            echo '</div>';
            // </editor-fold>


            /*
             * Cari Nilai Min dan Max Masing Masing Kategori
             * */
            foreach ($setting['kategori'] as $kategori)
            {
                $data['normalisasi']['metadata']['min_max'][$kategori] = array('min' => $data['data']['uji'][0][$kategori], 'max' => $data['data']['uji'][0][$kategori]);
            }
            foreach ($setting['data_model'] as $data_model)
            {
                foreach ($data['data'][$data_model] as $value)
                {
                    foreach ($setting['kategori'] as $kategori)
                    {
                        $data['normalisasi']['metadata']['min_max'][$kategori]['min'] = $data['normalisasi']['metadata']['min_max'][$kategori]['min'] < $value[$kategori] ? $data['normalisasi']['metadata']['min_max'][$kategori]['min'] : $value[$kategori];
                        $data['normalisasi']['metadata']['min_max'][$kategori]['max'] = $data['normalisasi']['metadata']['min_max'][$kategori]['max'] > $value[$kategori] ? $data['normalisasi']['metadata']['min_max'][$kategori]['max'] : $value[$kategori];
                    }
                }
            }

            //$logger->addDebug('User Input', array('data' => $data['normalisasi']['metadata']['min_max']));

            /*
             * Update data dengan normalisasi
             * */
            foreach ($setting['data_model'] as $data_model)
            {
                $data['normalisasi']['data'][$data_model] = array();
                foreach ($data['data'][$data_model] as $value)
                {
                    $container['id'] = $value['id'];
                    foreach ($setting['kategori'] as $kategori)
                    {
                        $container[$kategori] = ($value[$kategori] - $data['normalisasi']['metadata']['min_max'][$kategori]['min']) / ($data['normalisasi']['metadata']['min_max'][$kategori]['max'] - $data['normalisasi']['metadata']['min_max'][$kategori]['min']);
                    }
                    array_push($data['normalisasi']['data'][$data_model], $container);
                }
            }
            unset($container);


            //$logger->addDebug('User Input', array('data' => $data['normalisasi']['data']));

            /*
             *  Normalisasi Data
             *  */
            // <editor-fold defaultstate="collapsed" desc="Normalisasi Data">
            echo '<button class="accordion">Normalisasi Data</button>';
            echo '<div class="panel">';
            echo '<table style="width:100%; border : 1px solid black; border-collapse: collapse">';
            echo '<caption>Normalisasi Data</caption>';
            echo '<tr>';
            echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">No</th>';
            foreach ($setting['kategori'] as $kategori)
            {
                if ($kategori != 'tingkat_resiko')
                {
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$kategori}</th>";
                }
            }
            echo '</tr>';
            echo '<tr>';
            echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">Min</th>';
            foreach ($setting['kategori'] as $kategori)
            {
                if ($kategori != 'tingkat_resiko')
                {
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$data['normalisasi']['metadata']['min_max'][$kategori]['min']}</th>";
                }
            }
            echo '</tr>';
            echo '<tr>';
            echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">Max</th>';
            foreach ($setting['kategori'] as $kategori)
            {
                if ($kategori != 'tingkat_resiko')
                {
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$data['normalisasi']['metadata']['min_max'][$kategori]['max']}</th>";
                }
            }
            echo '</tr>';
            foreach ($setting['data_model'] as $data_model)
            {
                $model = ucfirst($data_model);
                echo '<tr>';
                echo "<th style=\"padding: 5px; text-align: left\">{$model}</th>";
                foreach ($setting['kategori'] as $kategori)
                {
                    if ($kategori != 'tingkat_resiko')
                    {
                        echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$kategori}</th>";
                    }
                }
                echo '</tr>';
                foreach ($data['normalisasi']['data'][$data_model] as $no => $value)
                {
                    ++$no;
                    echo '<tr>';
                    echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$no}</td>";
                    foreach ($setting['kategori'] as $kategori)
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
            echo '</div>';
            // </editor-fold>

            /*
             * Menghitung Euclidian Distance
             * */
            $data['euclidian']['data']['latih'] = array();
            $data_uji = $data['normalisasi']['data']['uji'][0];
            foreach ($data['normalisasi']['data']['latih'] as $index => $data_latih)
            {
                $di = 0;
                $container['id'] = $data_latih['id'];
                foreach ($setting['kategori'] as $kategori)
                {
                    $di += pow(($data_uji[$kategori] - $data_latih[$kategori]), 2.0);
                }
                $di = sqrt($di);
                $container['jarak'] = $di;
                $container['tingkat_resiko'] = $data['data']['latih'][$index]['tingkat_resiko'];
                array_push($data['euclidian']['data']['latih'], $container);
            }
            unset($data_uji, $container);

            //$logger->addDebug('Submit Button', array('data' => $data['euclidian']['data']['latih']));

            /*
             * Update Tabel euclidian
             * */
            /*foreach ($data['euclidian']['data']['latih'] as $data_latih)
            {
                $query = "INSERT INTO cici.euclidean VALUES({$data_latih['id']}, {$data_latih['jarak']}, {$data_latih['tingkat_resiko']}) ON DUPLICATE KEY UPDATE `nilai`={$data_latih['jarak']}, `kelas_asli`={$data_latih['tingkat_resiko']}";
                $koneksi->query($query);
            }*/

            /*
             *  Hitung Jarak
             *  */
            // <editor-fold defaultstate="collapsed" desc="Hitung Jarak">
            echo '<button class="accordion">Jarak</button>';
            echo '<div class="panel">';
            echo '<table style="width:30%; border : 1px solid black; border-collapse: collapse; margin: auto;">';
            echo '<caption>Jarak</caption>';
            echo '<tr>';
            echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">No</th>';
            echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">No Data</th>';
            foreach ($data['euclidian']['data']['latih'][0] as $index => $header)
            {
                if ($index != 'id')
                {
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$index}</th>";
                }
            }
            foreach ($data['euclidian']['data']['latih'] as $no => $data_latih)
            {
                ++$no;
                echo '<tr>';
                echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$no}</td>";
                foreach ($data_latih as $id => $sub_data)
                {
                    if ($id != 'id')
                    {
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . round($sub_data, 4) . "</td>";
                    }
                    else
                    {
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . (round($sub_data, 4) - $setting['index_encoder']) . "</td>";
                    }
                }
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
            // </editor-fold>

            /*
             * Mengurutkan jarak terdekat dari kecil ke besar
             * */
            $data['euclidian']['sort']['data']['latih'] = $data['euclidian']['data']['latih'];

            usort($data['euclidian']['sort']['data']['latih'], function($a, $b)
            {
                if ($a['jarak'] == $b['jarak'])
                {
                    return 0;
                }
                return ($a['jarak'] < $b['jarak']) ? -1 : 1;
            });

            //$logger->addDebug('Submit Button', array('data' => $data['euclidian']['sort']['data']['latih']));

            /*
             *  Debug Mengurutkan jarak terdekat dari kecil ke besar
             *  */
            // <editor-fold defaultstate="collapsed" desc="Debug Mengurutkan jarak terdekat dari kecil ke besar">
            echo '<button class="accordion">Mengurutkan jarak terdekat dari kecil ke besar</button>';
            echo '<div class="panel">';
            echo '<table style="width:30%; border : 1px solid black; border-collapse: collapse; margin: auto;">';
            echo '<caption>Mengurutkan jarak terdekat dari kecil ke besar</caption>';
            echo '<tr>';
            echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">No</th>';
            echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">No Data</th>';
            foreach ($data['euclidian']['sort']['data']['latih'][0] as $index => $header)
            {
                if ($index != 'id')
                {
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$index}</th>";
                }
            }
            foreach ($data['euclidian']['sort']['data']['latih'] as $no => $data_latih)
            {
                ++$no;
                echo '<tr>';
                echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$no}</td>";
                foreach ($data_latih as $id => $sub_data)
                {
                    if ($id != 'id')
                    {
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . round($sub_data, 4) . "</td>";
                    }
                    else
                    {
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . (round($sub_data, 4) - $setting['index_encoder']) . "</td>";
                    }
                }
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
            // </editor-fold>\

            /*
             * Memasukkan nilai k
             * */
            /*foreach ($setting['knn']['k']['value'] as $k_value)
            {
                $data['euclidian']['sort']['k']['data']['latih'] = array();
                foreach ($data['euclidian']['sort']['data']['latih'] as $index => $data_latih)
                {
                    if ($index == $setting['knn']['k']['value'])
                    {
                        break;
                    }
                    else
                    {
                        array_push($data['euclidian']['sort']['k']['data']['latih'], $data_latih);
                    }
                }
            }*/
            //$logger->addDebug('Submit Button', array('data' => $data['euclidian']['sort']['k']['data']['latih']));

            /*
             *  Debug Memasukkan nilai k
             *  */
            // <editor-fold defaultstate="collapsed" desc="Memasukkan nilai k">
            echo '<button class="accordion">Memasukkan nilai k</button>';
            echo '<div class="panel">';
            foreach ($setting['knn']['k']['value'] as $k_value)
            {
                echo '<table style="width:30%; border : 1px solid black; border-collapse: collapse; margin: auto;">';
                echo "<caption> k = ${k_value}</caption>";
                echo '<tr>';
                echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">No</th>';
                echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">No Data</th>';
                foreach ($data['euclidian']['sort']['data']['latih'][0] as $index => $header)
                {
                    if ($index != 'id')
                    {
                        echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$index}</th>";
                    }
                }
                foreach ($data['euclidian']['sort']['data']['latih'] as $no => $data_latih)
                {
                    ++$no;
                    echo '<tr>';
                    echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$no}</td>";
                    foreach ($data_latih as $id => $sub_data)
                    {
                        if ($id != 'id')
                        {
                            echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . round($sub_data, 4) . "</td>";
                        }
                        else
                        {
                            echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . (round($sub_data, 4) - $setting['index_encoder']) . "</td>";
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
            echo '</div>';
            // </editor-fold>\

            /*
             * Nilai Rata-Rata pada Tiap Parameter
             * */
            foreach ($setting['kategori'] as $kategori)
            {
                $data['normalisasi']['metadata']['rata_rata'][$kategori] = 0;
            }
            $total_data = 0;
            foreach ($setting['data_model'] as $data_model)
            {
                $total_data += count($data['data'][$data_model]);
                foreach ($data['normalisasi']['data'][$data_model] as $value)
                {
                    foreach ($setting['kategori'] as $kategori)
                    {
                        $data['normalisasi']['metadata']['rata_rata'][$kategori] += $value[$kategori];
                    }
                }
            }
            foreach ($setting['kategori'] as $kategori)
            {
                $data['normalisasi']['metadata']['rata_rata'][$kategori] /= $total_data;
            }
            //$logger->addDebug('Submit Button', array('data' => $data['normalisasi']['metadata']['rata_rata']));
            unset($total_data);


            /*
             *  Debug untuk Nilai Rata-Rata pada Tiap Parameter
             *  */
            // <editor-fold defaultstate="collapsed" desc="Debug untuk Nilai Rata-Rata pada Tiap Parameter">
            echo '<button class="accordion">Nilai Rata-Rata pada Tiap Parameter</button>';
            echo '<div class="panel">';
            echo '<table style="width:100%; border : 1px solid black; border-collapse: collapse">';
            echo '<caption>Nilai Rata-Rata pada Tiap Parameter</caption>';
            echo '<tr>';
            echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">No</th>';
            foreach ($setting['kategori'] as $kategori)
            {
                if ($kategori != 'tingkat_resiko')
                {
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$kategori}</th>";
                }
            }
            echo '</tr>';
            echo '<tr>';
            echo '<td style="padding: 5px; text-align: left; border : 1px solid black;">Rata_Rata</td>';
            foreach ($data['normalisasi']['metadata']['rata_rata'] as $kategori => $value)
            {
                if ($kategori != 'tingkat_resiko')
                {
                    echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . round($value, 4) . '</td>';
                }
            }
            echo '</tr>';
            echo '</table>';
            echo '</div>';
            // </editor-fold>

            /*
             * Nilai Parameter-(Rata-Rata)
             * */
            $data['koefisien_korelasi']['x_y']['data']['latih'] = $data['normalisasi']['data']['latih'];
            foreach ($data['koefisien_korelasi']['x_y']['data']['latih'] as $index => $value)
            {
                foreach ($setting['kategori'] as $kategori)
                {
                    $value[$kategori] -= $data['normalisasi']['metadata']['rata_rata'][$kategori];
                }
                $data['koefisien_korelasi']['x_y']['data']['latih'][$index] = $value;
            }

            //$logger->addDebug('Submit Button', array('data' => $data['koefisien_korelasi']['x_y']['data']));

            /*
             *  Debug untuk Nilai Parameter-(Rata-Rata)
             *  */
            // <editor-fold defaultstate="collapsed" desc="Debug untuk Nilai Parameter-(Rata-Rata)">
            echo '<button class="accordion">Nilai Parameter-(Rata-Rata)</button>';
            echo '<div class="panel">';
            echo '<table style="width:100%; border : 1px solid black; border-collapse: collapse">';
            echo '<caption>Nilai Parameter-(Rata-Rata)</caption>';
            echo '<tr>';
            echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">No</th>';
            foreach ($setting['kategori'] as $kategori)
            {
                if ($kategori != 'tingkat_resiko')
                {
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$kategori}</th>";
                }
            }
            echo '</tr>';
            foreach ($data['koefisien_korelasi']['x_y']['data']['latih'] as $index => $value)
            {
                echo '<tr>';
                echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . ($index + 1) . '</td>';
                foreach ($setting['kategori'] as $kategori)
                {
                    if ($kategori != 'tingkat_resiko')
                    {
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . round($value[$kategori], 4) . '</td>';
                    }
                }
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
            // </editor-fold>

            /*
             * Nilai Perkalian Antar Parameter a,b,c,..j
             * */
            foreach ($data['koefisien_korelasi']['x_y']['data']['latih'] as $index => $value)
            {
                $power = 1;
                foreach ($setting['kategori'] as $kategori)
                {
                    $power *= $value[$kategori];
                }
                $data['koefisien_korelasi']['x_y']['data']['latih'][$index]['power'] = $power;
                unset($power);
            }
            //$logger->addDebug('Submit Button', array('data' => $data['koefisien_korelasi']['x_y']['data']));

            /*
             *  Debug untuk Perkalian Antar Parameter a,b,c,..j
             *  */
            // <editor-fold defaultstate="collapsed" desc="Debug untuk Perkalian Antar Parameter a,b,c,..j">
            echo '<button class="accordion">Perkalian Antar Parameter a,b,c,..j</button>';
            echo '<div class="panel">';
            echo '<table style="width:50%; border : 1px solid black; border-collapse: collapse; margin: auto;">';
            echo '<caption>Perkalian Antar Parameter a,b,c,..j</caption>';
            echo '<tr>';
            echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">No</th>';
            echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">a x b x c x ... x j</th>';
            echo '</tr>';
            foreach ($data['koefisien_korelasi']['x_y']['data']['latih'] as $index => $value)
            {
                echo '<tr>';
                echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . ($index + 1) . '</td>';
                echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . sprintf("%4e", $value['power']) . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
            // </editor-fold>


            /*
             * Nilai Parameter 2-(Rata-Rata)
             * */
            $data['koefisien_korelasi']['x_y2']['data']['latih'] = $data['koefisien_korelasi']['x_y']['data']['latih'];
            foreach ($data['koefisien_korelasi']['x_y2']['data']['latih'] as $index => $value)
            {
                foreach ($setting['kategori'] as $kategori)
                {
                    $value[$kategori] = pow($value[$kategori], 2);
                }
                $data['koefisien_korelasi']['x_y2']['data']['latih'][$index] = $value;
            }
            //$logger->addDebug('Submit Button', array('data' => $data['koefisien_korelasi']['x_y2']['data']));

            /*
             *  Debug untuk Nilai Parameter 2-(Rata-Rata)
             *  */
            // <editor-fold defaultstate="collapsed" desc="Debug untuk Nilai Parameter 2-(Rata-Rata)">
            echo '<button class="accordion">Nilai Parameter 2-(Rata-Rata)</button>';
            echo '<div class="panel">';
            echo '<table style="width:100%; border : 1px solid black; border-collapse: collapse">';
            echo '<caption>Nilai Parameter 2-(Rata-Rata)</caption>';
            echo '<tr>';
            echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">No</th>';
            foreach ($setting['kategori'] as $kategori)
            {
                if ($kategori != 'tingkat_resiko')
                {
                    echo "<th style=\"padding: 5px; text-align: left; border : 1px solid black;\">{$kategori}</th>";
                }
            }
            echo '</tr>';
            foreach ($data['koefisien_korelasi']['x_y2']['data']['latih'] as $index => $value)
            {
                echo '<tr>';
                echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . ($index + 1) . '</td>';
                foreach ($setting['kategori'] as $kategori)
                {
                    if ($kategori != 'tingkat_resiko')
                    {
                        echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . round($value[$kategori], 4) . '</td>';
                    }
                }
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
            // </editor-fold>

            /*
             * Nilai Perkalian Antar Parameter a2,b2,c2,..j2
             * */
            foreach ($data['koefisien_korelasi']['x_y2']['data']['latih'] as $index => $value)
            {
                $power = 1;
                foreach ($setting['kategori'] as $kategori)
                {
                    $power *= $value[$kategori];
                }
                $data['koefisien_korelasi']['x_y2']['data']['latih'][$index]['power'] = $power;
                unset($power);
            }
            //$logger->addDebug('Submit Button', array('data' => $data['koefisien_korelasi']['x_y2']['data']));

            /*
             *  Debug untuk Perkalian Antar Parameter a2,b2,c2,..j2
             *  */
            // <editor-fold defaultstate="collapsed" desc="Debug untuk Perkalian Antar Parameter a2,b2,c2,..j2">
            echo '<button class="accordion">Perkalian Antar Parameter a2,b2,c2,..j2</button>';
            echo '<div class="panel">';
            echo '<table style="width:50%; border : 1px solid black; border-collapse: collapse; margin: auto;">';
            echo '<caption>Perkalian Antar Parameter a2,b2,c2,..j2</caption>';
            echo '<tr>';
            echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">No</th>';
            echo '<th style="padding: 5px; text-align: left; border : 1px solid black;">a2 x b2 x c2 x ... x j2</th>';
            echo '</tr>';
            foreach ($data['koefisien_korelasi']['x_y2']['data']['latih'] as $index => $value)
            {
                echo '<tr>';
                echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . ($index + 1) . '</td>';
                echo "<td style=\"padding: 5px; text-align: left; border : 1px solid black;\">" . sprintf("%4e", $value['power']) . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
            // </editor-fold>

            /*
             * menghitung nilai K t1
             * */
            $x_y2 = $data['koefisien_korelasi']['x_y2']['data']['latih'];
            $pembilang = 0;
            $penyebut = 0;
            foreach ($data['koefisien_korelasi']['x_y']['data']['latih'] as $index => $x_y)
            {
                $pembilang += $x_y['power'];
                $penyebut += $x_y2[$index]['power'];
            }
            $result = $pembilang / (sqrt($penyebut));
            $setting['knn']['kt1'] = ($result > 0) - ($result < 0);

            //$logger->addDebug('Submit Button', array('data' => number_format($pembilang, 10)));
            //$logger->addDebug('Submit Button', array('data' => number_format($penyebut, 10)));
            //$logger->addDebug('Submit Button', array('data' => number_format(sqrt($penyebut), 10)));
            //$logger->addDebug('Submit Button', array('data' => $setting['knn']));
            unset($x_y2, $penyebut, $pembilang);

            echo '<button class="accordion">Hasil Akhir</button>';
            echo '<div class="panel">';
            echo "<div>Kt1 = {$setting['knn']['kt1']}</div>";

            /*
             * menghitung nilai voting ( V t ti )
             * */
            foreach ($setting['knn']['k']['value'] as $k)
            {
                $vt = 0;
                foreach ($data['euclidian']['sort']['data']['latih'] as $index => $value)
                {
                    if ($index >= $k)
                    {
                        break;
                    }
                    else
                    {
                        $vt += (($value['tingkat_resiko'] * $setting['knn']['kt1']) / pow($value['jarak'], 2.0));
                    }
                }
                $setting['knn']['k']['vt'][$k] = $vt;
                unset($vt);
            }

            //$logger->addDebug('Submit Button', $setting['knn']['k']);

            echo '<br>';
            echo '<br>';
            echo '<div>Menghitung Vt</div>';
            echo '<br>';
            foreach ($setting['knn']['k']['vt'] as $k => $value)
            {
                echo "<div>k = ${k} --> Vt{$k} = ${value}</div>";
                echo "<br>";
            }

            /*
             * Mulai Voting
             * */
            $voting = array_search(max($setting['knn']['k']['vt']), $setting['knn']['k']['vt']);
            echo '<br>';
            echo "<div>k Menang = {$voting}</div>";
            echo "<div>klass Menang = {$data['euclidian']['sort']['data']['latih'][$voting-1]['tingkat_resiko']}</div>";
            echo '<br>';
            log_message('ERROR', var_export(array($voting, $data['euclidian']['sort']['data']['latih'][$voting-1]['tingkat_resiko']), true));


            /*
             * Buat Kandidat
             * */
            $kandidat = array();
            foreach ($data['euclidian']['sort']['data']['latih'] as $index => $value)
            {
                if ($index >= $voting)
                {
                    break;
                }
                else
                {
                    if (!array_key_exists('k'.$value['tingkat_resiko'], $kandidat))
                    {
                        $kandidat['k'.$value['tingkat_resiko']] = array('klas' => $value['tingkat_resiko'], 'value' => 1);
                    }
                    else
                    {
                        ++$kandidat['k'.$value['tingkat_resiko']]['value'];
                    }
                }
            }
            //log_message('ERROR', 'kandidat'."\n".var_export($kandidat, true));
            $sortedKandidat = array();
            foreach ($kandidat as $key => $value)
            {
                array_push($sortedKandidat, $value);
            }
            $kandidat = $sortedKandidat;
            unset($sortedKandidat);
            //log_message('ERROR', 'kandidat'."\n".var_export($kandidat, true));
            //$logger->addDebug('Submit Button', $kandidat);

            /*
             * Sort Kandidat
             * */
/*            function comparatorKandidatDesc($a, $b)
            {

            }*/

            usort($kandidat, function ($a, $b)
            {
                if ($a['value'] == $b['value'])
                {
                    return 0;
                }
                return ($a['value'] > $b['value']) ? -1 : 1;
            });
            //log_message('ERROR', 'Sorted Kandidat'."\n".var_export($kandidat, true));
            //$logger->addDebug('Submit Button', $kandidat);

            echo '<br>';
            echo '<div>Kelas Kandidat</div>';
            echo '<br>';
            foreach ($kandidat as $value)
            {
                echo "<div>klas = {$value['klas']} --> total = {$value['value']}</div>";
                echo '<br>';
            }

            //log_message('ERROR', var_export($data['euclidian']['sort']['data']['latih'], true));

            /*
             * Eliminasi Kandidat
             * */
            $winner_val = $kandidat[0]['value'];
            foreach ($kandidat as $index => $value)
            {
                if ($value['value'] != $winner_val)
                {
                    unset($kandidat[$index]);
                }
            }
            //log_message('ERROR', 'Winning Kandidat'."\n".var_export($kandidat, true));
            //$logger->addDebug('Submit Button', $kandidat);

            /*
             * Pilih Kelas
             * */
            $key_klas = array_rand($kandidat);
            $klas = $kandidat[$key_klas]['klas'];
            //log_message('ERROR', 'Winning Klas '."{$klas}");


            /*
             *  Debug untuk Perkalian Antar Parameter a2,b2,c2,..j2
             *  */

            echo '</br>';
            echo "<div>Klas Terpilih = {$klas}</div>";
            echo '</br>';

        }
    }
}

?>

