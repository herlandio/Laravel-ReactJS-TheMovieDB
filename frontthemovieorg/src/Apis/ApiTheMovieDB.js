import React from "react";

class ApiTheMovieDB extends React.Component {

    async fetchJsonApi() {
        const response = await fetch('http://127.0.0.1:8000/api');
        return await response.json();
    }

    async fetchJsonMovieById(id) {
        const response = await fetch(`http://127.0.0.1:8000/movieById/${id}`);
        return await response.json();
    }

    async fetchJsonQuery(query) {
        const response = await fetch(`http://127.0.0.1:8000/search/${query}`);
        return await response.json();
    }
}
export default ApiTheMovieDB;