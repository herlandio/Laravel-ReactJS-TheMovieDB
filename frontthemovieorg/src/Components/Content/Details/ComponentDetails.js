import {useParams} from "react-router-dom";
import React, {useState, useEffect} from "react";

import {fetchJsonMovieById} from "../../../Apis/fetchApiTheMovieDB";
import {Detail} from "./Detail";


function ComponentDetails(props) {
    let image = props.image;
    const [movie, setMovie] = useState([]);
    let { id } = useParams();

    useEffect(() => {
        let usedEffect = true;
        if (usedEffect === true) {
            fetchJsonMovieById(id).then(movieId => {
                setMovie(movieId);
            });
        }
        return () => (usedEffect = false)
    }, [id]);

    return (
        <div>
            <Detail image={image} movie={movie}/>
        </div>
    )

}

export default ComponentDetails;