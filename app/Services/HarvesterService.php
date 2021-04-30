<?php

namespace App\Services;

use Exception;
use Phpoaipmh\Client;
use SimpleXMLElement;
use Phpoaipmh\Endpoint;
use Illuminate\Support\Facades\Log;

class HarvesterService{

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
            dd($results->next()->metadata->children('oai_dc', 1)->dc->children('dc', 1));
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

}

?>