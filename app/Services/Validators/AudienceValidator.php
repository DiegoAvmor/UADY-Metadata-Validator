<?php
namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AudienceValidator extends RuleValidator{

    private static $instance = null;
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new AudienceValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        try {
            $audienceTag = $content->audience;
            
            if(!$this->validateExistence($audienceTag)) {
                return;
            }
            
            $existence = $this->validateAudience($audienceTag);

            return $this->buildValidationResponse($existence, $existence? trans('rules.valid') : trans('rules.audience_content'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }

    public function validateAudience($audience) : bool{
        $rawInfo = strtolower(Storage::get('AudienceCatalogue.txt'));
        $audienceCatalogue = explode("\r\n", $rawInfo);

        return in_array(strtolower ($audience), $audienceCatalogue);
    }

}