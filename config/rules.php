<?php
use App\Services\Validators;


return [
    'ruleset'=>[
        //Obligatorias
        "Title" =>[
            'description' => "Valida la existencia del titulo en los metadatos",
            'instance' => Validators\TitleValidator::getInstance(),
            'ruleType' => 'M',
            'tag' => 'dc:title',
            'qualityTagValue' => 2
        ],
        "Autor" =>[
            'description' => "Valida la existencia del autor en los metadatos",
            'instance' => Validators\AuthorValidator::getInstance(),
            'ruleType' => 'M',
            'tag' => 'dc:creator',
            'qualityTagValue' => 2
        ],
        "Proyect Identifier" =>[
            'description' => "Valida la existencia del identificador del proyecto en los metadatos",
            'instance' => Validators\ProjectIdentifierValidator::getInstance(),
            'ruleType' => 'M',
            'tag' => 'dc:relation',
            'qualityTagValue' => 2
        ],
        "Access Level" =>[
            'description' => "Valida el nivel de acceso del recurso",
            'instance' => Validators\AccessLevelValidator::getInstance(),
            'ruleType' => 'M',
            'tag' => 'dc:rights',
            'qualityTagValue' => 2
        ],
        "License Condition" =>[
            'description' => "Valida la condición de licencia del recurso",
            'instance' => Validators\LicenseValidator::getInstance(),
            'ruleType' => 'M',
            'tag' => 'dc:rights',
            'qualityTagValue' => 2
        ],
        "Fecha de Publicación" =>[
            'description' => "Valida la condición de licencia del recurso",
            'instance' => Validators\DateValidator::getInstance(),
            'ruleType' => 'M',
            'tag' => 'dc:date',
            'qualityTagValue' => 2
        ],
        "Contribuidor" => [
            'description' => "Valida la existencia de un contribuidor",
            'instance' => Validators\ContributorValidator::getInstance(),
            'ruleType' => 'M',
            'tag' => 'dc:contributor',
            'qualityTagValue' => 2
        ],
        "Tipo de Publicación" => [
            'description' => "Valida la existencia del tipo de publicación de un recurso",
            'instance' => Validators\PublicationTypeValidator::getInstance(),
            'ruleType' => 'M',
            'tag' => 'dc:type',
            'qualityTagValue' => 2
        ],
        "Language" => [
            'description' => "Valida la existencia del recurso lenguage",
            'instance' => Validators\LanguageValidator::getInstance(),
            'ruleType' => 'M',
            'tag' => 'dc:language',
            'qualityTagValue' => 2
        ],
        "Publication Date" => [
            'description' => "Valida el formato y existencia de la fecha de publicación",
            'instance' => Validators\PublicationDateValidator::getInstance(),
            'ruleType' => 'M',
            'tag' => 'dc:date',
            'qualityTagValue' => 2
        ],
        //Obligatorios cuando aplican
        "Fecha de finalización de Embargo" =>[
            'description' => "Valida la fecha de finalización de embargo cuando el nivel de acceso es 'EmbargoedAccess'",
            'instance' => Validators\EmbargoEndDateValidator::getInstance(),
            'ruleType' => 'MA',
            'rulePredecesor' => 'Access Level',
            'tag' => 'dc:date',
            'qualityTagValue' => 2
        ],
        "Dataset Reference" =>[
            'description' => "Valida los enlaces a los conjuntos de datos que esta publicación hace referencia",
            'instance' => Validators\DatasetReferenceValidator::getInstance(),
            'ruleType' => 'MA',
            'tag' => 'dc:relation',
            'qualityTagValue' => 2
        ],
        "Subject" =>[
            'description' => "Valida la existencia de keywords o clasificaciones",
            'instance' => Validators\SubjectValidator::getInstance(),
            'ruleType' => 'MA',
            'tag' => 'dc:subject',
            'qualityTagValue' => 2
        ],
        "Description" =>[
            'description' => "Valida la existencia de texto para la descripción del contenido",
            'instance' => Validators\DescriptionValidator::getInstance(),
            'ruleType' => 'MA',
            'tag' => 'dc:description',
            'qualityTagValue' => 2
        ],
        "Id Contribuidor" => [
            'description' => "Valida que existe un id para el contribuidor",
            'instance' => Validators\ContributorIdValidator::getInstance(),
            'ruleType' => 'MA',
            'tag' => 'dc:contributor',
            'qualityTagValue' => 2
        ],
        "Publisher" => [
            'description' => "Valida que existe un editor",
            'instance' => Validators\PublisherValidator::getInstance(),
            'ruleType' => 'MA',
            'tag' => 'dc:publisher',
            'qualityTagValue' => 2
        ],
        //Recomendados
        "Relation" => [
            'description' => 'Valida el formato del recurso relation en caso de que exista el tag',
            'instance' => Validators\RelationValidator::getInstance(),
            'ruleType' => 'R',
            'tag' => 'dc:relation',
            'qualityTagValue' => 1
        ],
        "Publication Reference" => [
            'description' => "Valida los enlaces a los que esta publicación hace referencia",
            'instance' => Validators\PublicationReferenceValidator::getInstance(),
            'ruleType' => 'R',
            'tag' => 'dc:relation',
            'qualityTagValue' => 1
        ],
        "Coverage" => [
            'description' => 'Valida el formato del recurso coverage en caso de que exista el tag',
            'instance' => Validators\CoverageValidator::getInstance(),
            'ruleType' => 'R',
            'tag' => 'dc:coverage',
            'qualityTagValue' => 1
        ],
        "Audience" => [
            'description' => 'Valida la existencia del recurso audience en caso de que exista el tag',
            'instance' => Validators\AudienceValidator::getInstance(),
            'ruleType' => 'R',
            'tag' => 'dc:audience',
            'qualityTagValue' => 1
        ],
        "Publication Type" => [
            'description' => 'Valida la existencia y el formato de la versión de la publicación',
            'instance' => Validators\PublicationVersionValidator::getInstance(),
            'ruleType' => 'R',
            'tag' => 'dc:type',
            'qualityTagValue' => 1
        ]
    ]

];
