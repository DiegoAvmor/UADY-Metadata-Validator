<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class ResourceIdentifierValidator extends RuleValidator{

    private static $instance = null;

    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new ResourceIdentifierValidator();
        }
        return self::$instance;
    }
    
    public function validateMetadata($content){

        try{
            $resourceId= $content->identifier;

            if ($this->validateExistence($resourceId)){
                $matches = (bool) preg_match('/(\/{1}(ark|doi|hdl|purl|url|urn)\/{1}[^\s]{1,})$/',(string) $resourceId);
                return $this->buildValidationResponse($matches, $matches ? trans('rules.valid'): trans('rules.resourceId_format'),(string) $resourceId);
                
            }
            return $this->buildValidationResponse(false, trans('rules.exists', ['tag' => 'identifier']));

        }catch (Exception $exception){
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }


    }




}




?>