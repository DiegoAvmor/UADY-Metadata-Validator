<?php

namespace App\Services;

class ValidateService {
    private $rules = [];

    function __construct(){
        //Se realiza la carga de las reglas
        $this->rules = config('rules.ruleset');
    }

    protected function validateResource($metadata){
        $responseList = [];
        foreach ($this->rules as $key => $rule) {

            $enforceRule = true;

            //Se valida para el caso de reglas MA (Obligatoria cuando aplique) si su regla predecesor fue exitosa
            if(array_key_exists('rulePredecesor',$rule)){
                //El estatus de la regla predecesora dictara si se aplica la regla MA
                $enforceRule = $responseList[$rule['rulePredecesor']]->status;
            }

            if($enforceRule){
                $response = $rule['instance']->validateMetadata($metadata);

                if(!empty($response)){
                    $responseList[$key] = $response;
                }
            }
        }
        return $responseList;
    }
}
