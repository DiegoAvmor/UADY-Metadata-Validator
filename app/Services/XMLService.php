<?php
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use SimpleXMLElement;

class XMLService extends ValidatorService{
    private static $instance = null;
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new XMLService();
        }
        return self::$instance;
    }

    public function validateXML($xml) {

        try {
            $xmlObject = new SimpleXMLElement($xml);
            $records = $xmlObject->ListRecords->record;

            $validationResults = [];
            foreach ($records as $record) {
                $metadata = $record->metadata->children('oai_dc', 1)->dc->children('dc', 1);
                $validationResults[] = $this->validateResource($metadata);
            }

            return $this->createQualityArray($validationResults);
        } catch(Exception $e) {
            Log::error($e->getMessage());
        }

    }
}

?>