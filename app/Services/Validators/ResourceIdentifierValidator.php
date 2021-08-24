<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class ResourceIdentifierValidator extends RuleValidator{

    private static $instance = null;

    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new ResourceIdentifierValidator();
        }
        return self::$instance;
    }
    
    public function validateMetadata($content){

        try{
            $resourceId= $content->identifier;

            if ($this->validateExistence($resourceId)){
                $matches = (bool) preg_match("/^([a-z][a-z0-9+.-]*):(?:\\/\\/((?:(?=((?:[a-z0-9-._~!$&'()*+,;=:]|%[0-9A-F]{2})*))(\\3)@)?(?=(\\[[0-9A-F:.]{2,}\\]|(?:[a-z0-9-._~!$&'()*+,;=]|%[0-9A-F]{2})*))\\5(?::(?=(\\d*))\\6)?)(\\/(?=((?:[a-z0-9-._~!$&'()*+,;=:@\\/]|%[0-9A-F]{2})*))\\8)?|(\\/?(?!\\/)(?=((?:[a-z0-9-._~!$&'()*+,;=:@\\/]|%[0-9A-F]{2})*))\\10)?)(?:\\?(?=((?:[a-z0-9-._~!$&'()*+,;=:@\\/?]|%[0-9A-F]{2})*))\\11)?(?:#(?=((?:[a-z0-9-._~!$&'()*+,;=:@\\/?]|%[0-9A-F]{2})*))\\12)?$/i",(string) $resourceId);
                return $this->buildValidationResponse($matches, $matches ? trans('rules.valid'): trans('rules.resourceId_format'),(string) $resourceId);
                
            }
            return $this->buildValidationResponse(false, trans('rules.exists', ['tag' => 'identifier']));

        }catch (Exception $exception){
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }


    }




}




?>