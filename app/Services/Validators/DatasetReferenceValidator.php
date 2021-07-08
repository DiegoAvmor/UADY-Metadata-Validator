<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class DatasetReferenceValidator extends RuleValidator{

    private static $instance = null;
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new DatasetReferenceValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        try {
            //dd($content->relation);
            $datasetReferenceTags = $content->relation;
            $matches = false;
            if ($this->validateExistence($datasetReferenceTags)) {
                foreach ($datasetReferenceTags as $key => $dataset) {
                    $matches = (bool) preg_match('/(\/{1}(ark|doi|hdl|purl|url|urn)\/{1}[^\s]{1,}))$/', (string) $dataset);
                    if($matches==false){
                        return;
                    }
                }
                return $this->buildValidationResponse(true,trans('rules.valid'));
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }

}

?>