<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class AccessLevelValidator extends RuleValidator{

    private static $instance = null;
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new AccessLevelValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        try {
            $rightsTag = $content->rights;
            if($this->validateExistence($rightsTag)){
                //TODO: Replace regular expresion with the consumption of the service of access levels created by CONACYT
                $matches = (bool) preg_match('/(info:eu\-repo\/semantics\/)(closedAccess|embargoedAccess|restrictedAccess|openAccess)/', (string) $rightsTag);
                return $this->buildValidationResponse($matches, $matches? trans('rules.valid') : trans('rules.access_level_format'));
            }
            return $this->buildValidationResponse(false, trans('rules.exists',['tag'=>'rights']));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }

}

?>