import React from "react";

import {Table} from "../Table";

function ComponentListSearch(props) {
    let propsObj = {
        image: props.image,
        listMs: props.listMs
    };

    return (
        <div className="row justify-content-center pt-3 bg-light">
            <div className="col-8 p-4">
                <Table image={propsObj.image} movie={propsObj.listMs}/>
            </div>
        </div>
    )
}

export default ComponentListSearch;