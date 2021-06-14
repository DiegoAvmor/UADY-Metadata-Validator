<?php
use App\Services\Validators\{TitleValidator};


return [
    'ruleset'=>[
        "title" =>[
            'description' => "Valida la existencia del titulo en los metadatos",
            'required' => true,
            'instance' => TitleValidator::getInstance(),
            'tag' => 'dc:title'
        ],
    ]

];
