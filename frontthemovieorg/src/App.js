import React from "react";
import {BrowserRouter as Router, Route, Switch} from "react-router-dom";

import ComponentHeader from "./Components/ComponentHeader";
import ComponentMain from "./Components/ComponentMain";
import ComponentDetails from "./Components/Content/Details/ComponentDetails";
import ComponentSearch from "./Components/Content/Search/ComponentSearch";

function App() {
  const Name = 'Test themoviedb.org';
  const imageBase = 'https://image.tmdb.org/t/p/w500'

  return (
      <Router>
        <div>
            <ComponentHeader name={Name}/>
        </div>

        <Switch>
            <Route exact path="/">
                <ComponentMain image={imageBase}/>
            </Route>
            <Route path="/details/:id">
                <ComponentDetails image={imageBase}/>
            </Route>
            <Route path="/search">
                <ComponentSearch image={imageBase}/>
            </Route>
        </Switch>
    </Router>
  );
}

export default App;
