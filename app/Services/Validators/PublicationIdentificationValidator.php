<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class PublicationIdentificationValidator extends RuleValidator{

    private static $instance = null;

    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new PublicationIdentificationValidator();
        }
        return self::$instance;
    }
    
    public function validateMetadata($content){

        try{
            $publicationIdTag= $content->type;

            if ($this->validateExistence($publicationIdTag)){
                $matches = (bool) empty((string)$publicationIdTag);
                return $this->buildValidationResponse($matches, $matches ? trans('rules.valid'): trans('rules.publicationId_format'));
                
            }
            return $this->buildValidationResponse(true, trans('rules.exists', ['tag' => 'type']));

        }catch (Exception $exception){
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }


    }




}




?>