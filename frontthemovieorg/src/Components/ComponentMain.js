import React from "react";

import ComponentListMovies from "./Content/ComponentListMovies";

function ComponentMain(props) {
    let image = props.image;
    return (
        <div className="container-fluid bg-light">
            <div className="row justify-content-center">
                <div className="col-8 bg-white p-4 shadow m-4 rounded">
                    <ComponentListMovies image={image}/>
                </div>
            </div>
        </div>
    )
}

export default ComponentMain;
