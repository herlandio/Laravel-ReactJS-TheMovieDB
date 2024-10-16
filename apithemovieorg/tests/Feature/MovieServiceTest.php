<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\MovieService;
use App\Services\DTO\MovieDTO;
use App\Exceptions\MovieNotFoundException;
use App\Exceptions\MovieServiceException;
use Illuminate\Support\Facades\Http;

/**
 * Class MovieServiceTest
 *
 * Test suite for the MovieService class.
 * This class contains unit tests to ensure the correct functionality of
 * the MovieService methods, including discovering movies, retrieving movies by ID,
 * and searching for movies based on a query.
 */
class MovieServiceTest extends TestCase
{
    /**
     * @var MovieService
     */
    private MovieService $movieService;

    /**
     * @var string
     */
    private string $apiKey = 'test_api_key';

    /**
     * Set up the test environment.
     *
     * This method initializes a new instance of MovieService
     * with a test API key before each test runs.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->movieService = new MovieService($this->apiKey);
    }

    /**
     * Test discovering movies.
     *
     * This test verifies that the discover method returns an array of MovieDTO objects.
     *
     * @return void
     */
    public function testDiscoverReturnsMovies(): void
    {
        Http::fake([
            'https://api.themoviedb.org/3/discover/movie*' => Http::sequence()
                ->push(['results' => [['id' => 1, 'original_title' => 'Test Movie', 'overview' => 'Description', 'release_date' => '2024-01-01', 'poster_path' => '/test.jpg', 'vote_average' => 8.5, 'vote_count' => 100, 'original_language' => 'en']]])
        ]);

        $movies = $this->movieService->discover();

        $this->assertCount(1, $movies);
        $this->assertInstanceOf(MovieDTO::class, $movies[0]);
        $this->assertEquals('Test Movie', $movies[0]->title);
    }

    /**
     * Test retrieving a movie by ID.
     *
     * This test checks that the movieById method returns a MovieDTO object
     * for a valid movie ID.
     *
     * @return void
     */
    public function testMovieByIdReturnsMovie(): void
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/1*' => Http::sequence()
                ->push(['id' => 1, 'original_title' => 'Test Movie', 'overview' => 'Description', 'release_date' => '2024-01-01', 'poster_path' => '/test.jpg', 'vote_average' => 8.5, 'vote_count' => 100, 'original_language' => 'en'])
        ]);

        $movie = $this->movieService->movieById(1);

        $this->assertInstanceOf(MovieDTO::class, $movie);
        $this->assertEquals(1, $movie->id);
        $this->assertEquals('Test Movie', $movie->title);
    }

    /**
     * Test retrieving a movie by invalid ID.
     *
     * This test expects a MovieNotFoundException to be thrown
     * when an invalid movie ID is provided.
     *
     * @return void
     */
    public function testMovieByIdThrowsExceptionForInvalidId(): void
    {
        $this->expectException(MovieNotFoundException::class);
        $this->movieService->movieById(-1);
    }

    /**
     * Test searching for movies.
     *
     * This test verifies that the search method returns an array of MovieDTO objects
     * based on a search query.
     *
     * @return void
     */
    public function testSearchReturnsMovies(): void
    {
        Http::fake([
            'https://api.themoviedb.org/3/search/movie*' => Http::sequence()
                ->push(['results' => [['id' => 1, 'original_title' => 'Search Test Movie', 'overview' => 'Description', 'release_date' => '2024-01-01', 'poster_path' => '/test.jpg', 'vote_average' => 8.5, 'vote_count' => 100, 'original_language' => 'en']]])
        ]);

        $movies = $this->movieService->search('Test');

        $this->assertCount(1, $movies);
        $this->assertInstanceOf(MovieDTO::class, $movies[0]);
        $this->assertEquals('Search Test Movie', $movies[0]->title);
    }

    /**
     * Test searching for movies when the API fails.
     *
     * This test expects a MovieServiceException to be thrown
     * when the search fails due to a server error.
     *
     * @return void
     */
    public function testSearchThrowsServiceExceptionOnFailure(): void
    {
        Http::fake([
            'https://api.themoviedb.org/3/search/movie*' => Http::sequence()
                ->push([], 500)
        ]);

        $this->expectException(MovieServiceException::class);
        $this->movieService->search('Test');
    }
}
