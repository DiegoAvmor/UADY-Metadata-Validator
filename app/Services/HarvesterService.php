<?php

namespace App\Services;

use Exception;
use Phpoaipmh\Client;
use SimpleXMLElement;
use Phpoaipmh\Endpoint;
use Illuminate\Support\Facades\Log;
use App\Models\MetadataList;

class HarvesterService extends ValidateService {
    private static $instance = null;
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new HarvesterService();
        }
        return self::$instance;
    }

    public function harvest(String $route, String $metadataPrefix = "oai_dc"){
        try {
            $client = new Client($route);
            $routeEndpoint = new Endpoint($client);
            $results = $routeEndpoint->listRecords($metadataPrefix);
            $validationResults = [];

            $limit = 0;
            foreach ($results as $key => $result) {
                $metadata = $result->metadata->children('oai_dc', 1)->dc->children('dc', 1);
                $validationResults[$key] = $this->validateResource($metadata);
                //Dummy limit for testing purposes
                $limit++;
                if($limit>=10){
                    break;
                }
            }
            return $this->createValidationStatisticsFromArray($validationResults);

        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    private function createValidationStatisticsFromArray($responseArray){
        $statArray = [];
        foreach ($responseArray as $item => $response) {
            foreach ($response as $key => $validationResult) {
                if(isset($statArray[$key])){
                    //Se actualiza el contenido de las estadisticas de la regla
                    $ruleStatistic = $statArray[$key];
                    if($validationResult->status){
                        $ruleStatistic->numValid++;
                    }else{
                        //Se adiciona el mensaje de rechazo a la regla
                        $ruleStatistic->rejectMessages[] = trans('rules.reject_msg_template', ['id'=> $item, 'message' => $validationResult->message ]);
                    }
                    $ruleStatistic->total++;
                }else{
                    //Se crea el elemento de la estadistica de la regla asociada
                    $ruleStatistic= (object) array();
                    //Se elimina de los datos de la regla la 'instancia' de la clase de validación
                    $ruleData = $this->rules[$key];
                    unset($ruleData['instance']);
                    $ruleStatistic->data = $ruleData;
                    $ruleStatistic->numValid = 1;
                    $ruleStatistic->total = 1;
                    $ruleStatistic->generalStatus = false;
                    $statArray[$key] = $ruleStatistic;
                }
            }
        }
        //Se obtiene el estatus general de cada metadato (true si todos los recursos pasaron respecto a ese metadoa, false en caso contrario)
        foreach ($statArray as $rule) {
            $rule->generalStatus = ($rule->numValid != $rule->total);
        }
        //Se envuelve las estadisticas de las reglas y el consenso general de validación en un objeto
        $totalCount = count($statArray);
        $data = (object) array();
        $data->statistics = collect($statArray);
        $data->averageSuccess = ($totalCount - count(array_filter( array_column($statArray,'generalStatus')))) * 100 / $totalCount;
        return $data;
    }

    private function validateResource($metadata){
        $responseList = [];
        foreach ($this->rules as $key => $rule) {

            $enforceRule = true;

            //Se valida para el caso de reglas MA (Obligatoria cuando aplique) si su regla predecesor fue exitosa
            if(array_key_exists('rulePredecesor',$rule)){
                //El estatus de la regla predecesora dictara si se aplica la regla MA
                $enforceRule = $responseList[$rule['rulePredecesor']]->status;
            }

            if($enforceRule){
                $response = $rule['instance']->validateMetadata($metadata);

                if(!empty($response)){
                    $responseList[$key] = $response;
                }
            }
        }
        return $responseList;
    }

}

?>