<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class ContributorValidator extends RuleValidator{

    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new ContributorValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        try{
            $contributor = $content->contributor;
            $doesExist = $this->validateExistence($contributor);
            return $this->buildValidationResponse($doesExist, $doesExist ? trans('rules.valid') : trans('rules.exists', ['tag' => 'contributor']));
        }catch(Exception $exception){
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }
}

?>