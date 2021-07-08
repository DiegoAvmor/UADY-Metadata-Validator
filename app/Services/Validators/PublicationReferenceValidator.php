<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class PublicationReferenceValidator extends RuleValidator{

    private static $instance = null;
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new PublicationReferenceValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        try {
            //dd($content->relation);
            $publicationReferenceTags = $content->relation;
            $matches = false;
            if ($this->validateExistence($publicationReferenceTags)) {
                foreach ($publicationReferenceTags as $key => $publicationReference) {
                    $matches = (bool) preg_match('(\/{1}(ark|arxiv|doi|isbn|issn|pmid|purl|url|urn|wos)\/{1}[^\s]{1,})', (string) $publicationReference);
                    if($matches==false){
                        return;
                    }
                }
                return $this->buildValidationResponse(true,trans('rules.valid'));
            }
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }

}

?>