<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class AuthorValidator extends RuleValidator{

    private static $instance = null;
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new AuthorValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        try {
            $creatorTag = $content->creator;
            $isValid = $this->validateExistence($creatorTag);
            return $this->buildValidationResponse($isValid, $isValid? trans('rules.valid') : trans('rules.exists',['tag'=>'creator']));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }

}

?>