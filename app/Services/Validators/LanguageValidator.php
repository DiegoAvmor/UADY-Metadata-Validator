<?php
namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class LanguageValidator extends RuleValidator{

    private static $instance = null;
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new LanguageValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        try {
            $languageTag = $content->language;

            if($this->validateExistence($languageTag)){
                $matches = preg_match('/^(spa|eng|fra)$/', (string) $languageTag);

                return $this->buildValidationResponse($matches, $matches? trans('rules.valid') : trans('rules.language_format'));
            }

            return $this->buildValidationResponse(false, trans('rules.exists',['tag'=>'language']));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }

}
