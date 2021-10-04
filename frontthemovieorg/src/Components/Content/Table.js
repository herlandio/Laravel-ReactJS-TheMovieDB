import {Link} from "react-router-dom";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faSearch} from "@fortawesome/free-solid-svg-icons";
import React from "react";

export function Table(props) {
    const DataTable = {
        image: props.image,
        movie: props.movie
    }
    return (
        <div className="table-responsive">
            <table className="table table-striped">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Data</th>
                    <th scope="col">Ação</th>
                </tr>
                </thead>
                <tbody>
                {
                    DataTable.movie.map((i) =>
                        <tr key={i.id}>
                            <td><img src={`${DataTable.image}/${i.poster_path}`} alt={i.original_title} width="50"/></td>
                            <td>{i.original_title}</td>
                            <td>{i.overview}</td>
                            <td>{i.release_date}</td>
                            <td className="text-center">
                                <Link to={`details/${i.id}`}><FontAwesomeIcon icon={faSearch}/></Link>
                            </td>
                        </tr>
                    )
                }
                </tbody>
            </table>
        </div>
    )
}