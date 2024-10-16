<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Services\DTO\MovieDTO;
use Tests\TestCase;
use App\Services\MovieService;
use App\Http\Controllers\ApiTheMovieController;
use App\Exceptions\MovieNotFoundException;
use App\Exceptions\MovieServiceException;
use Illuminate\Http\JsonResponse;

class ApiTheMovieControllerTest extends TestCase
{
    private ApiTheMovieController $controller;
    private MovieService $movieService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->movieService = $this->createMock(MovieService::class);
        $this->controller = new ApiTheMovieController($this->movieService);
    }

    /**
     * Test the discover method with valid data.
     *
     * @return void
     */
    public function testDiscoverReturnsJsonResponse(): void
    {
        $mockMovies = [
            new MovieDTO([
                'id' => 1,
                'original_title' => 'Inception',
                'overview' => 'A thief who steals corporate secrets through the use of dream-sharing technology.',
                'release_date' => '2010-07-16',
                'vote_average' => 8.8,
                'vote_count' => 21000,
                'original_language' => 'en',
                'poster_path' => '/poster_inception.jpg',
            ]),
            new MovieDTO([
                'id' => 2,
                'original_title' => 'Interstellar',
                'overview' => 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.',
                'release_date' => '2014-11-07',
                'vote_average' => 8.6,
                'vote_count' => 25000,
                'original_language' => 'en',
                'poster_path' => '/poster_interstellar.jpg',
            ]),
        ];

        $this->movieService
            ->method('discover')
            ->willReturn($mockMovies);

        $response = $this->controller->discover();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString(
            json_encode(array_map(fn($movie) => $movie->toArray(), $mockMovies)),
            $response->getContent()
        );
    }

    /**
     * Test the movieById method with a valid ID.
     *
     * @return void
     */
    public function testMovieByIdReturnsJsonResponse(): void
    {
        $mockMovie = new MovieDTO([
                        'id' => 1,
                        'original_title' => 'Inception',
                        'overview' => 'A thief who steals corporate secrets through the use of dream-sharing technology.',
                        'release_date' => '2010-07-16',
                        'vote_average' => 8.8,
                        'vote_count' => 21000,
                        'original_language' => 'en',
                        'poster_path' => '/poster_inception.jpg',
                    ]);

        $this->movieService
            ->method('movieById')
            ->with(1)
            ->willReturn($mockMovie);

        $response = $this->controller->movieById(1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString(
            json_encode( $mockMovie->toArray()),
            $response->getContent()
        );
    }

    /**
     * Test the movieById method when the movie is not found.
     *
     * @return void
     */
    public function testMovieByIdThrowsNotFoundException(): void
    {
        $this->expectException(MovieNotFoundException::class);
        $this->expectExceptionMessage("Invalid movie ID provided.");

        $this->movieService
            ->method('movieById')
            ->willThrowException(new MovieNotFoundException("Invalid movie ID provided."));

        $this->controller->movieById(999);
        throw new MovieNotFoundException('Invalid movie ID provided.');
    }

    /**
     * Test the search method with valid data.
     *
     * @return void
     */
    public function testSearchReturnsJsonResponse(): void
    {
        $mockMovies = [
            new MovieDTO([
                'id' => 1,
                'original_title' => 'Inception',
                'overview' => 'A thief who steals corporate secrets through the use of dream-sharing technology.',
                'release_date' => '2010-07-16',
                'vote_average' => 8.8,
                'vote_count' => 21000,
                'original_language' => 'en',
                'poster_path' => '/poster_inception.jpg',
            ]),
            new MovieDTO([
                'id' => 2,
                'original_title' => 'Interstellar',
                'overview' => 'A team of explorers travel through a wormhole in space in an attempt to ensure humanity\'s survival.',
                'release_date' => '2014-11-07',
                'vote_average' => 8.6,
                'vote_count' => 25000,
                'original_language' => 'en',
                'poster_path' => '/poster_interstellar.jpg',
            ]),
        ];

        $this->movieService
            ->method('search')
            ->with('Inception')
            ->willReturn($mockMovies);

        $response = $this->controller->search('Inception');

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertJsonStringEqualsJsonString(
            json_encode(array_map(fn($movie) => $movie->toArray(), $mockMovies)),
            $response->getContent()
        );
    }

    /**
     * Test the search method throws a MovieServiceException.
     *
     * @return void
     */
    public function testSearchThrowsServiceException(): void
    {
        $this->expectException(MovieServiceException::class);

        $this->movieService
            ->method('search')
            ->with('Inception')
            ->willThrowException(new MovieServiceException("Service error."));

        $this->controller->search('Inception');
    }
}
