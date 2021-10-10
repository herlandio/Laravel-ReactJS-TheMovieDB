export async function fetchJsonApi() {
    const response = await fetch('http://127.0.0.1:8000/api/start');
    return await response.json();
}

export async function fetchJsonMovieById(id) {
    const response = await fetch(`http://127.0.0.1:8000/api/movieById/${id}`);
    return await response.json();
}

export async function fetchJsonQuery(query) {
    const response = await fetch(`http://127.0.0.1:8000/api/search/${query}`);
    return await response.json();
}