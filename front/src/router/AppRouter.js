import {
  BrowserRouter as Router,
  Redirect,
  Route,
  Switch,
} from "react-router-dom";

import { AuthProvider } from "../auth/authContext";

// import PrivateRoute from "./PrivateRoute";
// import PublicRoute from "./PublicRoute";

import Navbar from "components/layout/Navbar";
import Sidebar from "components/layout/Sidebar";

import Products from "pages/Products";
import Reports from "pages/Reports";
import Returns from "pages/Returns";
import Tutorials from "pages/Tutorials";
import Advertising from "pages/Advertising";
import Deposits from "pages/Deposits";
import Funds from "pages/Funds";
import Data from "pages/Data";

//prettier-ignore
export default function AppRouter() {
  return (
    <Router>
      <AuthProvider>
      <div className="app-content">
        <Sidebar />

        <div className="body-content">
          <Navbar />

          <Switch>
            <Route exact path="/productos" component={Data}/>
            <Route exact path="/reportes" component={Reports}/>
            <Route exact path="/devoluciones" component={Returns}/>
            <Route exact path="/tutoriales" component={Tutorials}/>
            <Route exact path="/publicidad" component={Advertising}/>
            <Route exact path="/depositos" component={Deposits}/>
            <Route exact path="/depositos" component={Deposits}/>
            <Route exact path="/fondos" component={Funds}/>
            <Route exact path="/datos" component={Data}/>

            <Route path="*">
              <Redirect to="/Data" />
            </Route>
          </Switch>
        </div>
      </div>
      </AuthProvider>
    </Router>
  );
}
