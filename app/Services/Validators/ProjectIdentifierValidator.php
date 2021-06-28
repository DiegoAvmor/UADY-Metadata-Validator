<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class ProjectIdentifierValidator extends RuleValidator{

    private static $instance = null;
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new ProjectIdentifierValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        try {
            $relationTag = $content->relation;
            $isValid = $this->validateExistence($relationTag);
            return $this->buildValidationResponse($isValid, $isValid? trans('rules.valid') : trans('rules.exists',['tag'=>'relation']));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }

}

?>