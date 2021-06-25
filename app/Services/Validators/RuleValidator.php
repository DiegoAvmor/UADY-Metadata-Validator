<?php

namespace App\Services\Validators;

abstract class RuleValidator{

    function validateExistence($content){
        return (isset($content) && !empty((string) $content));
    }

    function buildValidationResponse(bool $status, string $message){
        $response = (object) array();
        $response->status = $status;
        $response->message = $message;
        return $response;
    }

    abstract protected function validateMetadata($content);

}

?>