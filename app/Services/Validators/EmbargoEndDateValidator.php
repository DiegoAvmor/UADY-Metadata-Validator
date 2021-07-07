<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class EmbargoEndDateValidator extends RuleValidator{

    private static $instance = null;
    private $regex = '/info:eu\-repo\/date\/embargoEnd\/([0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$)/';
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new EmbargoEndDateValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        try {
            $rightsTag = $content->rights;
            if(str_contains((string) $rightsTag, 'embargoedAccess')){
                $matches = (bool) preg_match($this->regex, (string) $content->date);
                return $this->buildValidationResponse($matches, $matches? trans('rules.valid') : trans('rules.date_format'));
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }

}

?>