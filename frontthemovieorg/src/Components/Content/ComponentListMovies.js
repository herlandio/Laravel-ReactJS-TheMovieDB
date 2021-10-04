import React, {useEffect, useState} from 'react';

import {fetchJsonApi} from "../../Apis/fetchApiTheMovieDB";

import {Table} from "./Table";

function ComponentListMovies(props) {
    let image = props.image;
    const [movie, setMovie] = useState([]);

    useEffect(() => {
        let usedEffect = true;
        if (usedEffect === true) {
            fetchJsonApi()
                .then(movies => {
                    setMovie(movies);
                });
        }
        return () => (usedEffect = false)
    },[]);

    return (
        <div>
            <Table image={image} movie={movie}/>
        </div>
    )
}

export default ComponentListMovies;
