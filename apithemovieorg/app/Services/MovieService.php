<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MovieService
{
    private string $key;
    private string $apiBase;

    public function __construct()
    {
        $this->key = env("TOKEN_THEDBMOVIE");
        $this->apiBase = 'https://api.themoviedb.org/3/';
    }

    public function discover(): array
    {
        $response = $this->makeRequest('discover/movie', [
            'language' => 'en-US',
            'sort_by' => 'popularity.desc',
            'page' => 1,
        ]);

        return $response['results'] ?? [];
    }

    public function movieById(int $id): ?array
    {
        $response = $this->makeRequest("movie/{$id}");
        return $response ?? null;
    }

    public function search(string $query): array
    {
        $response = $this->makeRequest('search/movie', [
            'query' => $this->clearQuery($query),
        ]);

        return $response['results'] ?? [];
    }

    private function makeRequest(string $endpoint, array $params = []): ?array
    {
        $params['api_key'] = $this->key;
        $response = Http::get("{$this->apiBase}{$endpoint}", $params);

        return $response->successful() ? $response->json() : null;
    }

    private function clearQuery(string $query): string
    {
        return strtolower(preg_replace('/\s+/', '+', trim($query)));
    }
}
