export async function fetchJsonApi() {
    const response = await fetch('http://api-themovieorg.herokuapp.com/api/start');
    return await response.json();
}

export async function fetchJsonMovieById(id) {
    const response = await fetch(`http://api-themovieorg.herokuapp.com/api/movieById/${id}`);
    return await response.json();
}

export async function fetchJsonQuery(query) {
    const response = await fetch(`http://api-themovieorg.herokuapp.com/api/search/${query}`);
    return await response.json();
}