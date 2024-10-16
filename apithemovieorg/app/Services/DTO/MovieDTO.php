<?php

declare(strict_types=1);

namespace App\Services\DTO;

use InvalidArgumentException;

/**
 * Class MovieDTO
 *
 * Data Transfer Object for movie data.
 * This class is responsible for validating and storing movie information.
 */
class MovieDTO
{
    public int $id;
    public string $title;
    public string $overview;
    public string $releaseDate;
    public string $posterPath;
    public float $voteAverage;
    public int $voteCount;
    public string $originalLanguage;

    /**
     * MovieDTO constructor.
     *
     * @param array $data An associative array containing movie data.
     * @throws InvalidArgumentException if any of the fields are invalid.
     */
    public function __construct(array $data)
    {
        $this->id = $this->validateInt($data['id'], 'id');
        $this->title = $this->validateString($data['original_title'], 'original_title');
        $this->overview = $this->validateString($data['overview'], 'overview');
        $this->releaseDate = $this->validateString($data['release_date'], 'release_date');
        $this->posterPath = $this->validateString($data['poster_path'] ?? '', 'poster_path');
        $this->voteAverage = $this->validateFloat($data['vote_average'], 'vote_average');
        $this->voteCount = $this->validateInt($data['vote_count'], 'vote_count');
        $this->originalLanguage = $this->validateString($data['original_language'], 'original_language');
    }

    /**
     * Validate that the given value is a string.
     *
     * @param mixed $value The value to validate.
     * @param string $field The name of the field being validated.
     * @return string The validated string.
     * @throws InvalidArgumentException if the value is not a string.
     */
    private function validateString($value, string $field): string
    {
        if (!is_string($value)) {
            throw new InvalidArgumentException("The {$field} must be a string.");
        }
        return $value;
    }

    /**
     * Validate that the given value is an integer.
     *
     * @param mixed $value The value to validate.
     * @param string $field The name of the field being validated.
     * @return int The validated integer.
     * @throws InvalidArgumentException if the value is not an integer.
     */
    private function validateInt($value, string $field): int
    {
        if (!is_int($value) && !ctype_digit((string)$value)) {
            throw new InvalidArgumentException("The {$field} must be an integer.");
        }
        return (int) $value;
    }

    /**
     * Validate that the given value is a float.
     *
     * @param mixed $value The value to validate.
     * @param string $field The name of the field being validated.
     * @return float The validated float.
     * @throws InvalidArgumentException if the value is not a float.
     */
    private function validateFloat($value, string $field): float
    {
        if (!is_float($value) && !is_numeric($value)) {
            throw new InvalidArgumentException("The {$field} must be a float.");
        }
        return (float) $value;
    }

    /**
     * Convert the MovieDTO to an associative array.
     *
     * @return array An associative array representation of the movie data.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'overview' => $this->overview,
            'release_date' => $this->releaseDate,
            'poster_path' => $this->posterPath,
            'vote_average' => $this->voteAverage,
            'vote_count' => $this->voteCount,
            'original_language' => $this->originalLanguage,
        ];
    }
}
