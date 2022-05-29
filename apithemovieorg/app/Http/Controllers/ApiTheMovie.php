<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;

class ApiTheMovie extends Controller
{
    private $key;
    private $apiBase = 'https://api.themoviedb.org/3/';

    /**
     * Set Key
     */
    public function __construct()
    {
        $this->key = "TOKEN_M";
        var_dump($this->key);
    }

    /**
     * @return array :: discover movies
     */
    public function discover()
    {
        $response = Http::get("{$this->apiBase}discover/movie?api_key={$this->key}&language=en-US&sort_by=popularity.desc&page=1");
        return $response->json()['results'];
    }

    /**
     * @param $id :: find movie by id
     * @return array|mixed
     */
    public function movieById($id)
    {
        $response = Http::get("{$this->apiBase}movie/{$id}?api_key={$this->key}");
        return $response->json();
    }

    /**
     * @param $query :: search movie by query
     * @return array|mixed
     */
    public function search($query)
    {
        $response = Http::get("{$this->apiBase}search/movie?api_key={$this->key}&query={$this->clearQuery($query)}");
        return $response->json()['results'];
    }

    public function clearQuery($query)
    {
        return strtolower(preg_replace('/\s\s+/', '+', $query));
    }

}
