<?php
use App\Services\Validators\{TitleValidator,AuthorValidator,ProjectIdentifierValidator,AccessLevelValidator,LicenseValidator,DateValidator};


return [
    'ruleset'=>[
        "Title" =>[
            'description' => "Valida la existencia del titulo en los metadatos",
            'instance' => TitleValidator::getInstance(),
            'tag' => 'dc:title'
        ],
        "Autor" =>[
            'description' => "Valida la existencia del autor en los metadatos",
            'instance' => AuthorValidator::getInstance(),
            'tag' => 'dc:creator'
        ],
        "Proyect Identifier" =>[
            'description' => "Valida la existencia del identificador del proyecto en los metadatos",
            'instance' => ProjectIdentifierValidator::getInstance(),
            'tag' => 'dc:relation'
        ],
        "Access Level" =>[
            'description' => "Valida el nivel de acceso del recurso",
            'instance' => AccessLevelValidator::getInstance(),
            'tag' => 'dc:rights'
        ],
        "License Condition" =>[
            'description' => "Valida la condición de licencia del recurso",
            'instance' => LicenseValidator::getInstance(),
            'tag' => 'dc:rights'
        ],
        "Fecha de Publicación" =>[
            'description' => "Valida la condición de licencia del recurso",
            'instance' => DateValidator::getInstance(),
            'tag' => 'dc:date'
        ],
    ]

];
