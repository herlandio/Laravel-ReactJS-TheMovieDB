<?php

namespace App\Http\Controllers;

use App\Services\MovieService;
use Illuminate\Http\JsonResponse;

class ApiTheMovieController extends Controller
{
    private MovieService $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function discover(): JsonResponse
    {
        $movies = $this->movieService->discover();
        return response()->json($movies);
    }

    public function movieById(int $id): JsonResponse
    {
        $movie = $this->movieService->movieById($id);
        return $movie ? response()->json($movie) : response()->json(['error' => 'Movie not found'], 404);
    }

    public function search(string $query): JsonResponse
    {
        $movies = $this->movieService->search($query);
        return response()->json($movies);
    }
}
