<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class PublisherValidator extends RuleValidator{

    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new PublisherValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        try{
            //TODO: we have to validate the name using a db or smthng
            $publisherTag = $content->publisher;
            $doesExist = $this->validateExistence($publisherTag);
            return $this->buildValidationResponse($doesExist, $doesExist ? trans('rules.valid') : trans('rules.exists', ['tag' => 'publisher']));
        }catch(Exception $exception){
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }
}
