<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class FormatValidator extends RuleValidator{

    private static $instance = null;

    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new FormatValidator();
        }
        return self::$instance;
    }
    
    public function validateMetadata($content){

        try{
            $formatTag= $content->format;

            if(!$this->validateExistence($formatTag)) {
                return;
            }

            $matches = (bool) empty((string) $formatTag);
            return $this->buildValidationResponse(!$matches, !$matches ? trans('rules.valid'): trans('rules.format_content'));
 
        }catch (Exception $exception){
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }


    }




}




?>