<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class SubjectValidator extends RuleValidator{

    private static $instance = null;
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new SubjectValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        try {
            //dd($content->subject);
            $subjects = $content->subject;
            if ($this->validateExistence($subjects)) {
                foreach ($subjects as $key => $value) {
                    if(!$this->validateExistence($value)){
                        return;
                    }
                }
                return $this->buildValidationResponse(true, trans('rules.valid'));
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }

}

?>