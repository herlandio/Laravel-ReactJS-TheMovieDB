<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\DTO\MovieDTO;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

/**
 * Class MovieService
 *
 * This service handles interactions with The Movie Database API.
 * It provides methods to discover movies, retrieve a movie by ID,
 * and search for movies based on a query.
 */
class MovieService
{
    private string $key;
    private string $apiBase;

    /**
     * MovieService constructor.
     *
     * @param string $key The API key for The Movie Database.
     */
    public function __construct(string $key)
    {
        $this->key = $key;
        $this->apiBase = 'https://api.themoviedb.org/3/';
    }

    /**
     * Discover movies.
     *
     * @return array An array of MovieDTO objects representing discovered movies.
     */
    public function discover(): array
    {
        return Cache::remember('movies_discover', 3600, function () {
            $response = $this->makeRequest('discover/movie', [
                'language' => 'en-US',
                'sort_by' => 'popularity.desc',
                'page' => 1,
            ]);

            return $this->mapToDTOs($response['results'] ?? []);
        });
    }

    /**
     * Retrieve a movie by its ID.
     *
     * @param int $id The ID of the movie to retrieve.
     * @return MovieDTO|null A MovieDTO object representing the movie, or null if not found.
     */
    public function movieById(int $id): ?MovieDTO
    {
        if ($id <= 0) {
            return null;
        }

        return Cache::remember("movie_{$id}", 3600, function () use ($id) {
            $response = $this->makeRequest("movie/{$id}");
            return $response ? new MovieDTO($response) : null;
        });
    }

    /**
     * Search for movies based on a query.
     *
     * @param string $query The search query for movies.
     * @return array An array of MovieDTO objects representing the search results.
     */
    public function search(string $query): array
    {
        $response = $this->makeRequest('search/movie', [
            'query' => $this->clearQuery($query),
        ]);

        return $this->mapToDTOs($response['results'] ?? []);
    }

    /**
     * Make a request to The Movie Database API.
     *
     * @param string $endpoint The API endpoint to call.
     * @param array $params Additional parameters for the API request.
     * @return array|null The response data as an array, or null if the request fails.
     */
    private function makeRequest(string $endpoint, array $params = []): ?array
    {
        $params['api_key'] = $this->key;

        try {
            $response = Http::timeout(10)->get("{$this->apiBase}{$endpoint}", $params);
            if ($response->successful()) {
                return $response->json();
            }

            \Log::error("TheMovieDB API request failed: {$response->body()}");
            return null;
        } catch (\Exception $e) {
            \Log::error("Error communicating with TheMovieDB: {$e->getMessage()}");
            return null;
        }
    }

    /**
     * Clean the search query by converting it to lowercase and replacing spaces with plus signs.
     *
     * @param string $query The search query to clean.
     * @return string The cleaned search query.
     */
    private function clearQuery(string $query): string
    {
        return strtolower(preg_replace('/\s+/', '+', trim($query)));
    }

    /**
     * Map raw data to an array of MovieDTO objects.
     *
     * @param array $data The raw movie data.
     * @return array An array of MovieDTO objects.
     */
    private function mapToDTOs(array $data): array
    {
        return array_map(fn($item) => new MovieDTO($item), $data);
    }
}
