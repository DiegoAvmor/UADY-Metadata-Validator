<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class TitleValidator extends RuleValidator{

    private static $instance = null;
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new TitleValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        try {
            $titleTag = $content->title;
            if($this->validateExistence($titleTag)){
                $matches = (bool) preg_match('/(^[^:]+$)|(^(?!\s*$).+[:](?!\s*$).+)/',(string) $titleTag);
                return $this->buildValidationResponse($matches, $matches? trans('rules.valid') : trans('rules.title_format'));
            }
            return $this->buildValidationResponse(false, trans('rules.exists',['tag'=>'title']));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }

}

?>