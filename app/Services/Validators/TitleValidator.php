<?php

namespace App\Services\Validators;

class TitleValidator extends RuleValidator{

    private static $instance = null;
    
    public static function getInstance(){
        if (self::$instance == null){
            self::$instance = new TitleValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content){
        return "wow title was validated ";
    }

}

?>