<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class ContributorIdValidator extends RuleValidator{

    private static $instance = null;
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new ContributorIdValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        try {
            $contributorTag = $content->contributor;
            $isValid = $this->validateExistence($contributorTag);
            return $this->buildValidationResponse($isValid, $isValid? trans('rules.valid') : trans('rules.exists',['tag'=>'contributor']));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }

}
