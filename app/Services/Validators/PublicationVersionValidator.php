<?php

namespace App\Services\Validators;

use Exception;
use Illuminate\Support\Facades\Log;

class PublicationVersionValidator extends RuleValidator
{
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new PublicationVersionValidator();
        }
        return self::$instance;
    }

    public function validateMetadata($content)
    {
        try {
            $typeTag = $content->type;

            if (!$this->validateExistence($typeTag)) {
                return;
            }

            $matches = (bool) preg_match('(draft|submittedVersion|acceptedVersion|publishedVersion|updatedVersion)',(string) $typeTag);
            return $this->buildValidationResponse($matches, $matches ? trans('rules.valid') : trans('rules.type'));
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
            return $this->buildValidationResponse(false, $exception->getMessage());
        }
    }
}
