<?php
namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class CoverageValidator extends RuleValidator{

    private static $instance = null;
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new CoverageValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        try {
            $coverageTag = $content->coverage;
            
            if(!$this->validateExistence($coverageTag)) {
                return;
            }
            
            $matches = (preg_match('/^[A-Z]{1,3}.$/', (string) $coverageTag) || $this->validateISO15836((string)$coverageTag) );

            return $this->buildValidationResponse($matches, $matches? trans('rules.valid') : trans('rules.coverage_format'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }

    public function validateISO15836($coverage) {
        $ISO15836 = "/^name=[A-Za-z\s]{2,}; northlimit=-?[0-9]{1,3}(.[0-9])?; southlimit=-?[0-9]{0,3}(.[0-9])?; westlimit=-?[0-9]{0,3}(.[0-9])?; eastlimit=-?[0-9]{0,3}(.[0-9])?;$/";

        return preg_match($ISO15836, $coverage);
    }

}
