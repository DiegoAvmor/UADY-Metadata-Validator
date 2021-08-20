<?php

namespace App\Services\Validators;

abstract class RuleValidator{

    function validateExistence($content){
        return (isset($content) && !empty((string) $content));
    }

    function buildValidationResponse(bool $status, string $message, $aditionalData = null){
        $response = (object) array();
        $response->status = $status;
        $response->message = $message;
        if(isset($aditionalData)){
            $response->aditionalData = $aditionalData;
        }
        return $response;
    }

    abstract protected function validateMetadata($content);

}

?>