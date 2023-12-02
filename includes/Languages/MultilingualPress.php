<?php

namespace Doctor\Languages;

use Exception;
use LanguageInterface;

class MultilingualPress implements LanguageInterface
{
    public function getLanguages(): array
    {
        // TODO: Implement getLanguages() method.
    }

    public function getLanguageForPost(string $postId): string
    {
        // TODO: Implement getLanguageForPost() method.
    }

    public function getTranslationPost(string $postId, string $codeLanguage)
    {
        // TODO: Implement getTranslationPost() method.
    }

    public function getAllTranslationsPost(string $postId): array
    {
        // TODO: Implement getAllTranslationsPost() method.
    }

}