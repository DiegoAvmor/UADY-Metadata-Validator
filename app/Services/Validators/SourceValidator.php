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

            if ($this->validateExistence($sourceTag)){
                $matches = (bool) empty((string)$sourceTag);
                return $this->buildValidationResponse($matches, $matches ? trans('rules.valid'): trans('rules.source_format'));
                
            }
            return $this->buildValidationResponse(true, trans('rules.exists', ['tag' => 'source']));

        }catch (Exception $exception){
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }


    }




}




?>