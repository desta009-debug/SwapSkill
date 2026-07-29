<?php

namespace App\Services;

use App\Models\ModerationLog;

class ModerationService
{
    /**
     * List of prohibited words loaded from configuration.
     *
     * @var array
     */
    protected array $prohibitedWords;

    /**
     * Create a new ModerationService instance.
     */
    public function __construct()
    {
        $this->prohibitedWords = config('profanity.words', []);
    }

    /**
     * Check if the given text contains any prohibited words.
     *
     * @param string $text
     * @return bool
     */
    public function contains(string $text): bool
    {
        if (empty(trim($text)) || empty($this->prohibitedWords)) {
            return false;
        }

        $pattern = $this->buildRegexPattern();

        return (bool) preg_match($pattern, $text);
    }

    /**
     * Replace prohibited words in text with '****'.
     *
     * @param string $text
     * @return string
     */
    public function clean(string $text): string
    {
        if (empty(trim($text)) || empty($this->prohibitedWords)) {
            return $text;
        }

        $pattern = $this->buildRegexPattern();

        return preg_replace($pattern, '****', $text);
    }

    /**
     * Get all prohibited words detected within the text.
     *
     * @param string $text
     * @return array
     */
    public function matchedWords(string $text): array
    {
        if (empty(trim($text)) || empty($this->prohibitedWords)) {
            return [];
        }

        $pattern = $this->buildRegexPattern();
        $matches = [];

        preg_match_all($pattern, $text, $matches);

        if (empty($matches[0])) {
            return [];
        }

        return array_values(array_unique(array_map('strtolower', $matches[0])));
    }

    /**
     * Record a moderation event into database.
     *
     * @param int|null $userId
     * @param string $contentType
     * @param string $originalContent
     * @param string $cleanedContent
     * @param array $matchedWords
     * @return ModerationLog
     */
    public function logEvent(?int $userId, string $contentType, string $originalContent, string $cleanedContent, array $matchedWords = []): ModerationLog
    {
        if (empty($matchedWords)) {
            $matchedWords = $this->matchedWords($originalContent);
        }

        return ModerationLog::create([
            'user_id' => $userId,
            'content_type' => $contentType,
            'matched_words' => $matchedWords,
            'original_content' => $originalContent,
            'cleaned_content' => $cleanedContent,
        ]);
    }

    /**
     * Build regex pattern for prohibited words matching.
     * Case insensitive, boundary aware.
     *
     * @return string
     */
    protected function buildRegexPattern(): string
    {
        $escapedWords = array_map(function ($word) {
            return preg_quote($word, '/');
        }, $this->prohibitedWords);

        return '/\b(' . implode('|', $escapedWords) . ')\b/i';
    }
}
