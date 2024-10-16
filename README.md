# API Laravel e ReactJS

### Introdução
Este projeto consiste em uma aplicação que integra uma API Laravel com uma interface em ReactJS, utilizando a [TMDB](https://developer.themoviedb.org/reference/intro/getting-started) para fornecer informações sobre filmes.

### Pré-requisitos
Para testar a aplicação, você precisará criar uma API key no [TMDB](https://developer.themoviedb.org/docs/getting-started)

1. Clone o repositório:

    ```
    git clone https://github.com/herlandio/Laravel-ReactJS-TheMovieDB
    ```

2. Configure sua API key:

    Após clonar o projeto, adicione sua API key no arquivo .env.example na seguinte linha:

    ```
    TOKEN_THEDBMOVIE=""
    ```
3. Executando a aplicação:

    Para iniciar a aplicação, utilize o seguinte comando:
    ```
    docker-compose up -d
    ```
4. Acessando a aplicação:

    Abra seu navegador e acesse o seguinte endereço:

    ```
    http://localhost:8000
    ```

### Testando a Aplicação
Para executar os testes automatizados da aplicação, utilize o seguinte comando:
```
docker run --rm -it laravel-reactjs-themoviedb-api:latest vendor/bin/phpunit tests
```
