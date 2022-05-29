const apiBase = "https://api-themovieorg.herokuapp.com";

export async function fetchJsonApi() {
    const response = await fetch(`${apiBase}/start`);
    return await response.json();
}

export async function fetchJsonMovieById(id) {
    const response = await fetch(`${apiBase}/movieById/${id}`);
    return await response.json();
}

export async function fetchJsonQuery(query) {
    const response = await fetch(`${apiBase}/search/${query}`);
    return await response.json();
}