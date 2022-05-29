import {Link} from "react-router-dom";
import {FontAwesomeIcon} from "@fortawesome/react-fontawesome";
import {faSearch} from "@fortawesome/free-solid-svg-icons";
import React from "react";

import convertDate from "../../help/help";

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
                    <th scope="col" className="text-center">#</th>
                    <th scope="col" className="text-center">Nome</th>
                    <th scope="col" className="text-center">Descrição</th>
                    <th scope="col" className="text-center">Data</th>
                    <th scope="col" className="text-center">Ação</th>
                </tr>
                </thead>
                <tbody>
                {
                    DataTable.movie.map((i) =>
                        <tr key={i.id}>
                            <td className="align-middle text-center"><img src={`${DataTable.image}/${i.poster_path}`} alt={i.original_title} width="75"/></td>
                            <td className="align-middle text-center"><b>{i.original_title}</b></td>
                            <td className="align-middle text-center">{i.overview.substring(0, 30)}...</td>
                            <td className="align-middle text-center">{convertDate(i.release_date)}</td>
                            <td className="align-middle text-center">
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