import React from "react";
import {Link} from "react-router-dom";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faArrowLeft} from "@fortawesome/free-solid-svg-icons";

import {Table} from "../Table";

function ComponentListSearch(props) {
    let propsObj = {
        image: props.image,
        listMs: props.listMs
    };

    return (
        <div className="row justify-content-center pt-3 bg-light">
            <div className="col-lg-8 col-md-8 col-sm-8 p-4">
                
                <Link to="/"><FontAwesomeIcon icon={faArrowLeft}/></Link>
                <Table image={propsObj.image} movie={propsObj.listMs}/>
                
            </div>
        </div>
    )
}

export default ComponentListSearch;