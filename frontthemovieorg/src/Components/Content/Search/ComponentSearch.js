import React, {useState, useEffect} from "react";

import ComponentListSearch from "./ComponentListSearch";
import {fetchJsonQuery} from "../../../Apis/fetchApiTheMovieDB";
import {Input} from "./Input";


function ComponentSearch(props) {
    let image = props.image;
    const [movie, setMovie] = useState([]);
    const [search, setSearch] = useState('start');

    const inputValue = ev => {
        setSearch(ev.target.value);
    }

    useEffect(() => {
        let usedEffect = true;
        if (usedEffect === true && search !== '') {
            fetchJsonQuery(search).then(movieId => {
                setMovie(movieId);
            });
        }
        return () => (usedEffect = false)
    }, [search]);

    return (
        <div className="container-fluid">
            <Input search={search.value} value={inputValue}/>
            <ComponentListSearch listMs={movie} image={image}/>
        </div>
    )
}

export default ComponentSearch;