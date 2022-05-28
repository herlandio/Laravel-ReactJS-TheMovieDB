import React from "react";

class ApiTheMovieDB extends React.Component {

    async fetchJsonApi() {
        const response = await fetch('https://api-themovieorg.herokuapp.com/api');
        return await response.json();
    }

    async fetchJsonMovieById(id) {
        const response = await fetch(`https://api-themovieorg.herokuapp.com/movieById/${id}`);
        return await response.json();
    }

    async fetchJsonQuery(query) {
        const response = await fetch(`https://api-themovieorg.herokuapp.com/search/${query}`);
        return await response.json();
    }
}
export default ApiTheMovieDB;