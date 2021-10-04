import {Link} from "react-router-dom";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faArrowLeft} from "@fortawesome/free-solid-svg-icons";
import React from "react";


export function Detail(props) {
    const detail = {
        image: props.image,
        movie: props.movie
    }

    return (
        <div className="container-fluid bg-light">
            <div className="row justify-content-center">
                <div className="col-10 bg-white p-4 shadow m-4 rounded">
                    <h2 className="text-secondary text-start lead pt-3 pb-3">Detalhes</h2>

                    <div className="row">
                        <div className="col-md-2">
                            <img className="img-fluid" src={`${detail.image}/${detail.movie.poster_path}`} alt={detail.movie.original_title} width="150"/>
                        </div>
                        <div className="col-md-8">
                            <p className="pt-4 text-uppercase">{detail.movie.original_title}</p>
                            <p>{detail.movie.overview}</p>
                            <p>{detail.movie.release_date}</p>
                        </div>
                    </div>
                    <hr/>
                    <Link to="/"><FontAwesomeIcon icon={faArrowLeft}/></Link>
                </div>
            </div>
        </div>
    )
}