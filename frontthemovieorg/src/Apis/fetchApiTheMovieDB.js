const apiBase = "https://api-themovieorg.herokuapp.com";

export async function fetchJsonApi() {
    const response = await fetch(`${apiBase}/api/start`);
    return await response.json();
}

export async function fetchJsonMovieById(id) {
    const response = await fetch(`${apiBase}/api/movieById/${id}`);
    return await response.json();
}

export async function fetchJsonQuery(query) {
    const response = await fetch(`${apiBase}/api/search/${query}`);
    return await response.json();
}