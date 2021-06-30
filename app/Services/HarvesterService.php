<?php

namespace App\Services;

use Exception;
use Phpoaipmh\Client;
use SimpleXMLElement;
use Phpoaipmh\Endpoint;
use Illuminate\Support\Facades\Log;
use App\Models\MetadataList;

class HarvesterService{

    private static $instance = null;
    private $rules = [];

    function __construct(){
        //Se realiza la carga de las reglas
        $this->rules = config('rules.ruleset');
    }
    
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
            dd($validationResults);
            return $validationResults;

        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    private function validateResource($metadata){
        $responseList = [];
        foreach ($this->rules as $key => $rule) {
            $message = $rule['instance']->validateMetadata($metadata);

            if(!empty($message)){
                $responseList[$key] = $rule['instance']->validateMetadata($metadata);
            }
        }
        return $responseList;
    }

}

?>