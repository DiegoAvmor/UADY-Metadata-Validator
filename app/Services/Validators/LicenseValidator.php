<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class LicenseValidator extends RuleValidator{

    private static $instance = null;
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new LicenseValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        try {
            $rightsTag = $content->rights;
            if($this->validateExistence($rightsTag)){
                //TODO: Replace regular expresion with the consumption of the service of licenses created by CONACYT
                $isLicenseValid = false;
                foreach ($rightsTag as $right) {
                    $matches = preg_match('/(http:\/\/creativecommons\.org\/licenses).+/', (string) $right);
                    if($matches == 1){
                        $isLicenseValid = true;
                        break;
                    }
                }
                return $this->buildValidationResponse($isLicenseValid, $isLicenseValid? trans('rules.valid') : trans('rules.licence_format'));
            }
            return $this->buildValidationResponse(false, trans('rules.exists',['tag'=>'rights']));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }

}

?>