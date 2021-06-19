<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class DateValidator extends RuleValidator{

    private static $instance = null;
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new DateValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        try {
            $dateTag = $content->date;
            if($this->validateExistence($dateTag)){
                $matches = (bool) preg_match('/[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', (string) $dateTag);
                return $this->buildValidationResponse($matches, $matches? trans('rules.valid') : trans('rules.date_format'));
            }
            return $this->buildValidationResponse(false, trans('rules.exists',['tag'=>'date']));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }

}

?>