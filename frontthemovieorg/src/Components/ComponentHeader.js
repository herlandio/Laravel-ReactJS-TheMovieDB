import React from "react";
import {Link} from "react-router-dom";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faSearch } from '@fortawesome/free-solid-svg-icons';

function ComponentHeader(props) {
    const name = props.name
    return (
        <div className="container-fluid">
            <div className="row justify-content-center bg-dark pt-4 pb-4">
                <div className="col-6 pt-4 pb-4">
                    <h1 className="text-light text-start lead">{name}</h1>
                </div>
                <div className="col-2 pt-4 pb-4 text-end">
                    <Link to="/search">
                        <FontAwesomeIcon icon={faSearch}/>
                    </Link>
                </div>
            </div>
        </div>
    )
}

export default ComponentHeader;
