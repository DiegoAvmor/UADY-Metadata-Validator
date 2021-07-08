<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class DescriptionValidator extends RuleValidator{

    private static $instance = null;
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new DescriptionValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        try {
            //dd($content->description);
            $descriptionTag = $content->description;
            $isValid = $this->validateExistence($descriptionTag);
            if ($isValid) {
                return $this->buildValidationResponse(true, trans('rules.valid'));
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }

}

?>