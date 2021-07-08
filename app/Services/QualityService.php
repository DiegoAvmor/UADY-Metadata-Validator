<?php
namespace App\Services;

class QualityService {
    private static $instance = null;    
    private $rules = [];
    private $tagInfo = [];
    private $tagValues;

    function __construct(){
        //Se realiza la carga de las reglas
        $this->rules = config('rules.ruleset');
        $this->setTagValues();
    }
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new QualityService();
        }
        return self::$instance;
    }

    private function setTagValues() {
        //Se inicializa el valor para cada una de las reglas
        foreach ($this->rules as $ruleKey => $rule) {
            $this->tagValues[$ruleKey] = $rule["qualityTagValue"];
        }
    }

    public function getQualityResults($validatorsResults) {

        foreach($validatorsResults as $item => $record) {
            $this->analyzeRecord($item, $record);
        }
        //Se elimina cualquier campo vacío
        $this->tagInfo = array_filter($this->tagInfo);

        $data = (object) array();
        $data->statistics = collect($this->tagInfo);
        $data->averageSuccess = $this->generateAverage();

        return $data;
    }

    private function analyzeRecord($item, $record) {
        foreach($record as $tagName => $tagContent) {
            if(isset($this->tagInfo[$tagName])) {
                //Se actualiza el valor del tag específico
                if($tagContent->status) {
                    $this->tagInfo[$tagName]->numValid++;
                } else {
                    $this->tagInfo[$tagName]->generalStatus = false;
                    $this->tagInfo[$tagName]->rejectMessages[] = trans('rules.reject_msg_template', ['id'=> $item, 'message' => $tagContent->message ]);
                }

                $this->tagInfo[$tagName]->total++;
            } else {
                //Se crea el valor del tag dentro del array
                $this->tagInfo[$tagName] = $this->createNewTagInfo($item, $tagName, $tagContent);
            }
        }
    }

    private function createNewTagInfo($item, $tagName, $tagContent) {
        $tagStatistic = (object) array();

        //Se elimina los datos de la instancia para cada regla
        $ruleData = $this->rules[$tagName];
        unset($ruleData['instance']);
        $tagStatistic->data = $ruleData;
        
        $tagStatistic->rejectMessages = [];

        //Se modifica el contador dependiendo del valor del estado de la regla
        if($tagContent->status) {
            $tagStatistic->numValid = 1;
        } else {
            $tagStatistic->numValid = 0;
            $tagStatistic->rejectMessages[] = trans('rules.reject_msg_template', ['id'=> $item, 'message' => $tagContent->message ]);
        }

        //Se establece el estado general de acuerdo al primer valor
        $tagStatistic->generalStatus = $tagContent->status;
        $tagStatistic->total = 1;

        return $tagStatistic;
    }

    private function generateAverage() {
        $totalNumValid = 0;
        $totalCount = 0;

        foreach ($this->tagInfo as $tagName => $tagContent) {
            //Se obtiene la fórmula de acuerdo a los valores definidos para cada regla
            $totalNumValid += ($tagContent->numValid * $this->tagValues[$tagName]);
            $totalCount += ($tagContent->total * $this->tagValues[$tagName]);
        }

        return ($totalNumValid * 100) / $totalCount;
    }
}