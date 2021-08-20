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
        $data->generalQualityStatistics = $this->generateGeneralStatistics();

        return $data;
    }

    private function analyzeRecord($item, $record) {
        $id = isset($record['Resource Identifier'])?$record['Resource Identifier']->aditionalData:$item;
        foreach($record as $tagName => $tagContent) {
            if(isset($this->tagInfo[$tagName])) {
                //Se actualiza el valor del tag específico
                if($tagContent->status) {
                    $this->tagInfo[$tagName]->numValid++;
                } else {
                    $this->tagInfo[$tagName]->generalStatus = false;
                    $errorObject = (object) array();
                    $errorObject->id = $id;
                    $errorObject->message = $tagContent->message;
                    $this->tagInfo[$tagName]->rejectMessages[] = $errorObject;
                }

                $this->tagInfo[$tagName]->total++;
            } else {
                //Se crea el valor del tag dentro del array
                $this->tagInfo[$tagName] = $this->createNewTagInfo($id, $tagName, $tagContent);
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
            $errorObject = (object) array();
            $errorObject->id = $item;
            $errorObject->message = $tagContent->message;
            $tagStatistic->rejectMessages[] = $errorObject;
        }

        //Se establece el estado general de acuerdo al primer valor
        $tagStatistic->generalStatus = $tagContent->status;
        $tagStatistic->total = 1;

        return $tagStatistic;
    }

    private function generateGeneralStatistics() {
        $totalNumValid = 0;
        $totalCount = 0;

        $successNumber = 0;
        $errorNumber = 0;

        foreach ($this->tagInfo as $tagName => $tagContent) {
            $tagContent->generalStatus ? $successNumber++ : $errorNumber++;

            //Se obtiene la fórmula de acuerdo a los valores definidos para cada regla
            $totalNumValid += ($tagContent->numValid * $this->tagValues[$tagName]);
            $totalCount += ($tagContent->total * $this->tagValues[$tagName]);
        }
        $generalQualityStatistics = (object) array();
        $generalQualityStatistics->averageSuccess = ($totalNumValid * 100) / $totalCount;
        $generalQualityStatistics->successNumber = $successNumber;
        $generalQualityStatistics->errorNumber = $errorNumber;

        return $generalQualityStatistics;
    }
}