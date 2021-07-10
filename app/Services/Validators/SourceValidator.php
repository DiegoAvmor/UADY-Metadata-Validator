<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class SourceValidator extends RuleValidator{

    private static $instance = null;

    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new SourceValidator();
        }
        return self::$instance;
    }
    
    public function validateMetadata($content){

        try{
            $sourceTag= $content->source;
            
            if(!$this->validateExistence($sourceTag)) {
                return;
            }

            if ($this->validateExistence($sourceTag)){
                $matches = (bool)empty((string)$sourceTag);
                return $this->buildValidationResponse( !$matches ,trans('rules.valid'));
                
            }
            

        }catch (Exception $exception){
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }


    }




}




?>