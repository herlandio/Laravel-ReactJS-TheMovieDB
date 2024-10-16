<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\DTO\MovieDTO;
use InvalidArgumentException;

class MovieDTOTest extends TestCase
{
    /**
     * Test the MovieDTO constructor with valid data.
     *
     * @return void
     */
    public function testConstructWithValidData(): void
    {
        $data = [
            'id' => 1,
            'original_title' => 'Inception',
            'overview' => 'A thief who steals corporate secrets through the use of dream-sharing technology.',
            'release_date' => '2010-07-16',
            'poster_path' => '/inception.jpg',
            'vote_average' => 8.8,
            'vote_count' => 10000,
            'original_language' => 'en',
        ];

        $movieDTO = new MovieDTO($data);

        $this->assertEquals(1, $movieDTO->id);
        $this->assertEquals('Inception', $movieDTO->title);
        $this->assertEquals('A thief who steals corporate secrets through the use of dream-sharing technology.', $movieDTO->overview);
        $this->assertEquals('2010-07-16', $movieDTO->releaseDate);
        $this->assertEquals('/inception.jpg', $movieDTO->posterPath);
        $this->assertEquals(8.8, $movieDTO->voteAverage);
        $this->assertEquals(10000, $movieDTO->voteCount);
        $this->assertEquals('en', $movieDTO->originalLanguage);
    }

    /**
     * Test the MovieDTO constructor with missing required fields.
     *
     * @return void
     */
    public function testConstructWithMissingFields(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The id is required.");
        
        $data = [
            'original_title' => 'Inception',
            'overview' => 'A thief who steals corporate secrets through the use of dream-sharing technology.',
            'release_date' => '2010-07-16',
            'poster_path' => '/inception.jpg',
            'vote_average' => 8.8,
            'vote_count' => 10000,
            'original_language' => 'en',
        ];

        (new MovieDTO($data));
    }

    /**
     * Test the toArray method.
     *
     * @return void
     */
    public function testToArray(): void
    {
        $data = [
            'id' => 1,
            'original_title' => 'Inception',
            'overview' => 'A thief who steals corporate secrets through the use of dream-sharing technology.',
            'release_date' => '2010-07-16',
            'poster_path' => '/inception.jpg',
            'vote_average' => 8.8,
            'vote_count' => 10000,
            'original_language' => 'en',
        ];

        $movieDTO = new MovieDTO($data);

        $expectedArray = [
            'id' => 1,
            'original_title' => 'Inception',
            'overview' => 'A thief who steals corporate secrets through the use of dream-sharing technology.',
            'release_date' => '2010-07-16',
            'poster_path' => '/inception.jpg',
            'vote_average' => 8.8,
            'vote_count' => 10000,
            'original_language' => 'en',
        ];

        $this->assertEquals($expectedArray, $movieDTO->toArray());
    }

    /**
     * Test the MovieDTO constructor with invalid data types.
     *
     * @return void
     */
    public function testConstructWithInvalidDataTypes(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The vote_average must be a float.");
        
        $data = [
            'id' => 1,
            'original_title' => 'Inception',
            'overview' => 'A thief who steals corporate secrets through the use of dream-sharing technology.',
            'release_date' => '2010-07-16',
            'poster_path' => '/inception.jpg',
            'vote_average' => 'not_a_float',
            'vote_count' => 10000,
            'original_language' => 'en',
        ];

        (new MovieDTO($data));
    }
}
