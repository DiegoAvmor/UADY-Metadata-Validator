<?php
namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class RelationValidator extends RuleValidator{

    private static $instance = null;
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new RelationValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        try {
            $relationTag = $content->relation;
            
            if(!$this->validateExistence($relationTag)){
                return;
            }

            $matches = preg_match('#((https?|http)://(\S*?\.\S*?))([\s)\[\]{},;"\':<]|\.\s|$)#i', (string) $relationTag);

            if($matches) {
                $body = $this->url_exists($relationTag);

                return $this->buildValidationResponse($body, $body? trans('rules.valid') : trans('rules.relation_content') );
            }

            return $this->buildValidationResponse(false, trans('rules.relation_format'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }

    function url_exists( $url = NULL ) {
        $resURL = curl_init();
        curl_setopt($resURL, CURLOPT_URL, $url);
        curl_setopt($resURL, CURLOPT_NOBODY, true);
        curl_setopt($resURL, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($resURL, CURLOPT_HEADER, true);
        curl_exec ($resURL);
        $httpcode = curl_getinfo($resURL, CURLINFO_HTTP_CODE);

        //Headers aceptados como válidos
        $accepted_response = array( 200, 301, 302 ,304 );

        return in_array( $httpcode, $accepted_response );
    }
}