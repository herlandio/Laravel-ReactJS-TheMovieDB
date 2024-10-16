<?php

declare(strict_types=1);

namespace App\Services\DTO;

use App\Services\Validators\MovieValidator;

/**
 * Class MovieDTO
 *
 * Data Transfer Object for movie data.
 * This class is responsible for storing movie information.
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

    private MovieValidator $validator;

    /**
     * MovieDTO constructor.
     *
     * @param array $data An associative array containing movie data.
     * @throws \InvalidArgumentException if any of the fields are invalid.
     */
    public function __construct(array $data)
    {
        $this->validator = new MovieValidator();

        $requiredFields = ['id', 'original_title', 'overview', 'release_date', 'vote_average', 'vote_count', 'original_language'];
        
        foreach ($requiredFields as $field) {
            if (!array_key_exists($field, $data)) {
                throw new \InvalidArgumentException("The {$field} is required.");
            }
        }

        $this->id = $this->validator->validateInt($data['id'], 'id');
        $this->title = $this->validator->validateString($data['original_title'], 'original_title');
        $this->overview = $this->validator->validateString($data['overview'], 'overview');
        $this->releaseDate = $this->validator->validateString($data['release_date'], 'release_date');
        $this->posterPath = $this->validator->validateString($data['poster_path'] ?? '', 'poster_path');
        $this->voteAverage = $this->validator->validateFloat($data['vote_average'], 'vote_average');
        $this->voteCount = $this->validator->validateInt($data['vote_count'], 'vote_count');
        $this->originalLanguage = $this->validator->validateString($data['original_language'], 'original_language');
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
            'original_title' => $this->title,
            'overview' => $this->overview,
            'release_date' => $this->releaseDate,
            'poster_path' => $this->posterPath,
            'vote_average' => $this->voteAverage,
            'vote_count' => $this->voteCount,
            'original_language' => $this->originalLanguage,
        ];
    }
}
