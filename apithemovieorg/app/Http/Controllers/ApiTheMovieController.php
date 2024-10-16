<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\MovieService;
use Illuminate\Http\JsonResponse;
use App\Exceptions\MovieNotFoundException;
use App\Exceptions\MovieServiceException;

/**
 * Class ApiTheMovieController
 *
 * This controller handles API requests related to movies.
 * It utilizes the MovieService to interact with movie data.
 */
class ApiTheMovieController extends Controller
{
    private MovieService $movieService;

    /**
     * ApiTheMovieController constructor.
     *
     * @param MovieService $movieService An instance of the MovieService for movie data operations.
     */
    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    /**
     * Discover movies.
     *
     * @return JsonResponse A JSON response containing an array of discovered movies.
     */
    public function discover(): JsonResponse
    {
        try {
            $movies = $this->movieService->discover();
            return response()->json(array_map(fn($movie) => $movie->toArray(), $movies));
        } catch (Exception $e) {
            throw new MovieServiceException($e->getMessage());
        }
    }

    /**
     * Retrieve a movie by its ID.
     *
     * @param int $id The ID of the movie to retrieve.
     * @return JsonResponse A JSON response containing the movie data or an error message if not found.
     */
    public function movieById(int $id): JsonResponse
    {
        try {
            $movie = $this->movieService->movieById($id);
            if (!$movie) {
                throw new MovieNotFoundException();
            }
            return response()->json($movie->toArray());
        } catch (MovieNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        } catch (Exception $e) {
            throw new MovieServiceException($e->getMessage());
        }
    }

    /**
     * Search for movies based on a query.
     *
     * @param string $query The search query for movies.
     * @return JsonResponse A JSON response containing an array of movies matching the search query.
     */
    public function search(string $query): JsonResponse
    {
        try {
            $movies = $this->movieService->search($query);
            return response()->json(array_map(fn($movie) => $movie->toArray(), $movies));
        } catch (Exception $e) {
            throw new MovieServiceException($e->getMessage());
        }
    }
}
