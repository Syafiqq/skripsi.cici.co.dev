<?php
/**
 * This <skripsi.cici.co.dev> project created by :
 * Name         : syafiq
 * Date / Time  : 02 August 2016, 1:05 PM.
 * Email        : syafiq.rezpector@gmail.com
 * Github       : syafiqq
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class M_iknn_debug extends CI_Model
{
    private $category;
    private $dataModel;
    private $data;
    private $normalization;
    private $euclidian;
    private $coefficientCorrelation;

    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    public function calculate($inputData)
    {
        $this->generateCategory();
        $this->generateDataModel();
        $this->initializeDataContainer();
        $this->initializeKConst($inputData['k_val']);
        $this->generateClassCategory();
        unset($inputData['k_val']);
        $this->loadDataTraining($inputData['total_latih']);
        $this->storeDataTesting($inputData);
        unset($inputData);
        $this->findMinMax();
        $this->calculateNormalization();
        $this->calculateEuclidianDistance();
        $this->sortDistanceAscending();
        $this->calculateMeanNormalizationData();
        $this->calculateCoefficientCorrelation();
        $this->calculateCoefficientCorrelationPower();
        $this->calculateCoefficientCorrelation2();
        $this->calculateCoefficientCorrelation2Power();
        $this->calculateKt1();
        $this->calculateKt1StepByStep();
        $this->calculateVtT1();
        $this->beginVoting();
        $this->chooseClass();
        return array('data' => &$this->data, 'model' => &$this->dataModel, 'category' => &$this->category, 'normalization' => &$this->normalization, 'euclidian' => &$this->euclidian, 'coefficientCorrelation' => &$this->coefficientCorrelation);
    }

    private function generateCategory()
    {
        $this->category = array(
            'key' => array(
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
                'tingkat_resiko'),
            'value' => array(
                'Tekanan Darah',
                'Diabetes',
                'Riwayat Keluarga',
                'Merokok',
                'Kolesterol',
                'Aktifitas Fisik',
                'Diet',
                'Berat Badan',
                'Tinggi Badan',
                'Riwayat Fibrilasi Atrium',
                'Tingkat Resiko'
            ));
    }

    private function generateDataModel()
    {
        $this->dataModel = array('training', 'testing');
    }

    private function initializeDataContainer()
    {
        unset($this->data);
        $this->data = array();
        foreach ($this->dataModel as $model)
        {
            $this->data['dataset'][$model] = array();
        }
    }

    private function initializeKConst($k)
    {
        $this->data['metadata']['k'] = $k;
    }

    private function generateClassCategory()
    {
        $this->data['metadata']['class'] = array(1 => 'Rendah', 2 => 'Sedang', 3 => 'Tinggi');
    }

    public function loadDataTesting($testing_index)
    {
        $result = $this->db->query("SELECT ALL * FROM debug_data WHERE debug_data.type = 2 AND debug_data.id = {$testing_index} ORDER BY debug_data.id ASC LIMIT 1")->result_array()[0];
        $result['no'] = 1;
        return $result;
    }

    private function loadDataTraining($total_latih)
    {
        foreach ($this->db->query("SELECT ALL * FROM data_latih ORDER BY data_latih.id ASC LIMIT {$total_latih}")->result_array() as $index => $result)
        {
            $result['no'] = ($index + 1);
            array_push($this->data['dataset']['training'], $result);
        }
        unset($index, $result);
    }

    private function storeDataTesting($inputData)
    {
        $inputData['no'] = 1;
        array_push($this->data['dataset']['testing'], $inputData);
    }

    private function findMinMax()
    {
        foreach ($this->category['key'] as $category)
        {
            $this->data['metadata']['minmax'][$category] = array('min' => PHP_INT_MAX, 'max' => PHP_INT_MIN);
        }
        foreach ($this->dataModel as $dataModel)
        {
            foreach ($this->data['dataset'][$dataModel] as $value)
            {
                foreach ($this->category['key'] as $category)
                {
                    $this->data['metadata']['minmax'][$category]['min'] = $this->data['metadata']['minmax'][$category]['min'] < $value[$category] ? $this->data['metadata']['minmax'][$category]['min'] : $value[$category];
                    $this->data['metadata']['minmax'][$category]['max'] = $this->data['metadata']['minmax'][$category]['max'] > $value[$category] ? $this->data['metadata']['minmax'][$category]['max'] : $value[$category];
                }
            }
        }
    }

    private function calculateNormalization()
    {
        log_message('ERROR', var_export($this->data['metadata']['minmax'], true));
        $this->normalization = array();
        foreach ($this->dataModel as $dataModel)
        {
            $this->normalization['dataset'][$dataModel] = array();
            foreach ($this->data['dataset'][$dataModel] as $value)
            {
                $container = $value;
                foreach ($this->category['key'] as $category)
                {
                    $container[$category] = ($container[$category] - $this->data['metadata']['minmax'][$category]['min']) / ($this->data['metadata']['minmax'][$category]['max'] - $this->data['metadata']['minmax'][$category]['min']);
                }
                array_push($this->normalization['dataset'][$dataModel], $container);
            }
        }
        unset($container);
    }

    private function calculateEuclidianDistance()
    {
        $this->euclidian = array();
        $this->euclidian['dataset']['training']  = array();
        $dataTesting = $this->normalization['dataset']['testing'][0];
        foreach ($this->normalization['dataset']['training'] as $index => $dataTraining)
        {
            $distance = 0;
            $container['id'] = $dataTraining['id'];
            $container['no'] = $dataTraining['no'];
            foreach ($this->category['key'] as $category)
            {
                if($category != 'tingkat_resiko')
                {
                    $distance += pow(($dataTesting[$category] - $dataTraining[$category]), 2.0);
                }
            }
            $container['distance'] = sqrt($distance);
            $container['tingkat_resiko'] = $this->data['dataset']['training'][$index]['tingkat_resiko'];
            array_push($this->euclidian['dataset']['training'], $container);
        }
        unset($dataTesting, $container, $distance);
    }

    private function sortDistanceAscending()
    {
        $this->euclidian['sorted']['dataset']['training'] = $this->euclidian['dataset']['training'];
        usort($this->euclidian['sorted']['dataset']['training'], function($data1, $data2)
        {
            return ($data1['distance'] > $data2['distance']) ? 1 : -1;
        });
    }

    private function calculateMeanNormalizationData()
    {
        foreach ($this->category['key'] as $category)
        {
            $this->data['metadata']['mean']['normalization'][$category] = 0;
        }
        $totalData = 0;
        foreach ($this->dataModel as $dataModel)
        {
            $totalData += count($this->data['dataset'][$dataModel]);
            foreach ($this->normalization['dataset'][$dataModel] as $value)
            {
                foreach ($this->category['key'] as $category)
                {
                    $this->data['metadata']['mean']['normalization'][$category] += $value[$category];
                }
            }
        }
        foreach ($this->category['key'] as $category)
        {
            $this->data['metadata']['mean']['normalization'][$category] /= $totalData;
        }
        unset($totalData);
    }

    private function calculateCoefficientCorrelation()
    {
        $this->coefficientCorrelation = array();
        foreach ($this->dataModel as $dataModel)
        {
            $this->coefficientCorrelation['xy']['dataset'][$dataModel] = $this->normalization['dataset'][$dataModel];
            foreach ($this->coefficientCorrelation['xy']['dataset'][$dataModel] as $index => $value)
            {
                foreach ($this->category['key'] as $category)
                {
                    $value[$category] -= $this->data['metadata']['mean']['normalization'][$category];
                }
                $this->coefficientCorrelation['xy']['dataset'][$dataModel][$index] = $value;
            }
        }
    }

    private function calculateCoefficientCorrelationPower()
    {
        foreach ($this->dataModel as $dataModel)
        {
            foreach ($this->coefficientCorrelation['xy']['dataset'][$dataModel] as $index => $value)
            {
                $power = 1;
                foreach ($this->category['key'] as $category)
                {
                    $power *= $value[$category];
                }
                $this->coefficientCorrelation['xy']['dataset'][$dataModel][$index]['power'] = $power;
            }
        }
        unset($power);
    }

    private function calculateCoefficientCorrelation2()
    {
        foreach ($this->dataModel as $dataModel)
        {
            $this->coefficientCorrelation['xy2']['dataset'][$dataModel] = $this->coefficientCorrelation['xy']['dataset'][$dataModel];
            foreach ($this->coefficientCorrelation['xy2']['dataset'][$dataModel] as $index => $value)
            {
                foreach ($this->category['key'] as $category)
                {
                    $value[$category] = pow($value[$category], 2);
                }
                $this->coefficientCorrelation['xy2']['dataset'][$dataModel][$index] = $value;
            }
        }
    }

    private function calculateCoefficientCorrelation2Power()
    {
        foreach ($this->dataModel as $dataModel)
        {
            foreach ($this->coefficientCorrelation['xy2']['dataset'][$dataModel] as $index => $value)
            {
                $power = 1;
                foreach ($this->category['key'] as $category)
                {
                    $power *= $value[$category];
                }
                $this->coefficientCorrelation['xy2']['dataset'][$dataModel][$index]['power'] = $power;
            }
        }
        unset($power);
    }

    private function calculateKt1()
    {
        $nominator = 0;
        $denominator = 0;
        foreach ($this->dataModel as $dataModel)
        {
            $denominator_value =& $this->coefficientCorrelation['xy2']['dataset'][$dataModel];
            foreach ($this->coefficientCorrelation['xy']['dataset'][$dataModel] as $index => $xy)
            {
                $nominator += $xy['power'];
                $denominator += $denominator_value[$index]['power'];
            }
        }
        $this->data['metadata']['stepbystep']['kt1'][3] = '\(k_{t1}=sign\left(\frac{'.sprintf("%.20f", $nominator).'}{\sqrt{'.sprintf("%.20f", $denominator).'}}\right)\)';
        $this->data['metadata']['stepbystep']['kt1'][4] = '\(k_{t1}=sign\left('.sprintf('%.20f', $nominator / (sqrt($denominator))).'\right)\)';
        $this->data['metadata']['kt1'] = $this->signum($nominator / (sqrt($denominator)));
        $this->data['metadata']['stepbystep']['kt1'][5] = '\(k_{t1}='.$this->data['metadata']['kt1'].'\)';
        unset($denominator_value, $nominator, $denominator);
    }

    private function calculateKt1StepByStep()
    {
        $total = 0;
        foreach ($this->dataModel as $dataModel)
        {
            $total += count($this->coefficientCorrelation['xy']['dataset'][$dataModel]);
        }
        $this->data['metadata']['stepbystep']['kt1'][0] = '\(k_{t1}=sign\left(\frac{{\displaystyle\sum_{i=1}^{'.$total.'}}\left(\left(a_i-\overline a\right)\;\cdot\dots\cdot\left(j_i-\overline j\right)\right)}{\sqrt{{\displaystyle\sum_{i=1}^{'.$total.'}}\left(\left(a_i-\overline a\right)^2\;\cdot\dots\cdot\left(j_i-\overline j\right)^2\right)}}\right)\)';
        $this->data['metadata']['stepbystep']['kt1'][1] = '\(k_{t1}=sign\left(\frac{{\displaystyle\sum_{i=1}^{'.$total.'}}\left(\left('.$this->normalization['dataset']['training'][0]['tekanan_darah'].'-'.$this->data['metadata']['mean']['normalization']['tekanan_darah'].'\right)\;\cdot\dots\cdot\left('.$this->normalization['dataset']['training'][0]['tingkat_resiko'].'-'.$this->data['metadata']['mean']['normalization']['tingkat_resiko'].'\right)\right)}{\sqrt{{\displaystyle\sum_{i=1}^{'.$total.'}}\left(\left('.$this->normalization['dataset']['training'][0]['tekanan_darah'].'-'.$this->data['metadata']['mean']['normalization']['tekanan_darah'].'\right)^2\;\cdot\dots\cdot\left('.$this->normalization['dataset']['training'][0]['tingkat_resiko'].'-'.$this->data['metadata']['mean']['normalization']['tingkat_resiko'].'\right)^2\right)}}\right)\)';
        $this->data['metadata']['stepbystep']['kt1'][2] = '\(k_{t1}=sign\left(\frac{'.sprintf("%.20f",$this->coefficientCorrelation['xy']['dataset']['training'][0]['power']).'\;+\;\cdots\;+\;'.sprintf("%.20f",$this->coefficientCorrelation['xy']['dataset']['training'][0]['power']).'}{\sqrt{'.sprintf("%.20f",$this->coefficientCorrelation['xy2']['dataset']['training'][0]['power']).'\;+\;\cdots\;+\;'.sprintf("%.20f",$this->coefficientCorrelation['xy2']['dataset']['training'][0]['power']).'}}\right)\)';
        ksort($this->data['metadata']['stepbystep']['kt1']);
    }

    private function signum($value)
    {
        return ($value > 0) - ($value < 0);
    }

    private function calculateVtT1()
    {
        $kt =& $this->data['metadata']['kt1'];
        foreach ($this->data['metadata']['k'] as $k)
        {
            $vt = 0;
            foreach ($this->euclidian['sorted']['dataset']['training'] as $index => $value)
            {
                if ($index >= $k)
                {
                    break;
                }
                else
                {
                    $vt += (($value['tingkat_resiko'] * $kt) / pow($value['distance'], 2.0));
                }
            }
            $this->data['metadata']['vt'][$k] = $vt;
        }
        unset($vt, $kt);
    }

    private function beginVoting()
    {
        $this->data['metadata']['voting']['k'] = array_search(max($this->data['metadata']['vt']), $this->data['metadata']['vt']);
    }

    private function chooseClass()
    {
        $this->data['metadata']['voting']['class'] = $this->euclidian['sorted']['dataset']['training'][$this->data['metadata']['voting']['k']-1]['tingkat_resiko'];
    }




}