<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class PublicationTypeValidator extends RuleValidator{

    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new PublicationTypeValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        try{
            $publicType = $content->type;
            if($this->validateExistence($publicType)){
                $matches = (bool) preg_match('/(info:eu\-repo\/semantics\/)/',(string) $publicType);
                return $this->buildValidationResponse($matches, $matches ? trans('rules.valid') : trans('rules.exists', ['tag' => 'type']));
            }
        }catch(Exception $exception){
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }
}
