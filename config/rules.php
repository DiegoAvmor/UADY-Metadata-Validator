<?php
use App\Services\Validators;


return [
    'ruleset'=>[
        //Obligatorias
        "Title" =>[
            'description' => "Valida la existencia del titulo en los metadatos",
            'instance' => Validators\TitleValidator::getInstance(),
            'ruleType' => 'M',
            'tag' => 'dc:title'
        ],
        "Autor" =>[
            'description' => "Valida la existencia del autor en los metadatos",
            'instance' => Validators\AuthorValidator::getInstance(),
            'ruleType' => 'M',
            'tag' => 'dc:creator'
        ],
        "Proyect Identifier" =>[
            'description' => "Valida la existencia del identificador del proyecto en los metadatos",
            'instance' => Validators\ProjectIdentifierValidator::getInstance(),
            'ruleType' => 'M',
            'tag' => 'dc:relation'
        ],
        "Access Level" =>[
            'description' => "Valida el nivel de acceso del recurso",
            'instance' => Validators\AccessLevelValidator::getInstance(),
            'ruleType' => 'M',
            'tag' => 'dc:rights'
        ],
        "License Condition" =>[
            'description' => "Valida la condición de licencia del recurso",
            'instance' => Validators\LicenseValidator::getInstance(),
            'ruleType' => 'M',
            'tag' => 'dc:rights'
        ],
        "Fecha de Publicación" =>[
            'description' => "Valida la condición de licencia del recurso",
            'instance' => Validators\DateValidator::getInstance(),
            'ruleType' => 'M',
            'tag' => 'dc:date'
        ],
        "Contribuidor" =>[
            'description' => "Valida la existencia de un contribuidor",
            'instance' => Validators\ContributorValidator::getInstance(),
            'ruleType' => 'M',
            'tag' => 'dc:contributor'
        ],
        "Tipo de Publicación" => [
            'description' => "Valida la existencia del tipo de publicación de un recurso",
            'instance' => Validators\PublicationTypeValidator::getInstance(),
            'ruleType' => 'M',
            'tag' => 'dc:type'
        ],
        "Language" => [
            'description' => "Valida la existencia del recurso lenguage",
            'instance' => Validators\LanguageValidator::getInstance(),
            'ruleType' => 'M',
            'tag' => 'dc:language'
        ],
        //Obligatorios cuando aplican
        "Fecha de finalización de Embargo" =>[
            'description' => "Valida la fecha de finalización de embargo cuando el nivel de acceso es 'EmbargoedAccess'",
            'instance' => Validators\EmbargoEndDateValidator::getInstance(),
            'ruleType' => 'MA',
            'rulePredecesor' => 'Access Level',
            'tag' => 'dc:date'
        ],
        //Recomendados
        "Relation" => [
            'description' => 'Valida el formato del recurso relation en caso de que exista el tag',
            'instance' => Validators\RelationValidator::getInstance(),
            'ruleType' => 'R',
            'tag' => 'dc:relation'
        ],
        "Coverage" => [
            'description' => 'Valida el formato del recurso coverage en caso de que exista el tag',
            'instance' => Validators\CoverageValidator::getInstance(),
            'ruleType' => 'R',
            'tag' => 'dc:coverage'
        ],
        "Audience" => [
            'description' => 'Valida la existencia del recurso audience en caso de que exista el tag',
            'instance' => Validators\AudienceValidator::getInstance(),
            'ruleType' => 'R',
            'tag' => 'dc:audience'
        ]
    ]

];
