<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mensajes de resultado de las reglas
    |--------------------------------------------------------------------------
    |
    | las siguientes lineas de codigo representan los mensajes que se manejaran de acuerdo a las reglas correspondientes
    | y los casos de validación que se aplique por el sistema
    |
    */

    'exists' => 'El metadato :tag no existe.',
    'valid' => 'El metadato fue validado correctamente.',
    'reject_msg_template' => "Recurso :id ':message'",
    'title_format' => 'El formato del titulo no se apega al definido por la CONACYT (Título:Subtítulo).',
    'access_level_format' => 'El nivel de acceso definido no se apega a los definidos en el sistema (closedAccess,embargoedAccess,restrictedAccess,openAccess).',
    'licence_format' => 'El recurso no cuenta con una licencia valida.',
    'date_format' => 'El formato de la fecha no se apega al de la norma ISO-8601',
    'language_format' => 'El formato del lenguaje no se apega al de la norma ISO 639-3',
    'relation_format' => 'El formato del link no es válido',
    'relation_content' => 'No existe ningún recurso en el URL presentado',
    'coverage_format' => 'El formato del coverage no se apega al de la norma ISO 3166 o ISO 15836',
    'audience_content' => 'No existe el recurso en el catálogo Audience de CONACYT',
    'resourceId_format' => 'El formato del identificador del recurso no es válido'

];
