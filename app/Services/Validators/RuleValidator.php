<?php

namespace App\Services\Validators;

abstract class RuleValidator{

    //TODO: Implement function to validate existences
    public function validateExistence(){
        return "wow it exists";
    }

    abstract protected function validateMetadata($content);

}

?>