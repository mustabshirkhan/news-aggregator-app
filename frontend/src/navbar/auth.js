import React, {useEffect} from "react";
import {Routes, Route, Link, BrowserRouter} from 'react-router-dom';
import Dashboard from '../components/Dashboard/dashboard';
import useAuth from '../hooks/useAuth';
import {useNavigate} from "react-router-dom";
import NewAggregator from "../components/News/newsAggregator";
import Preferences from "../components/Preferences/preferences";

function Auth() {
    const {token, logout, user} = useAuth();
    const navigate = useNavigate();
    const logoutUser =  () => {
        if (token !== undefined) {
            logout();
        }
    }

    useEffect(() => {
        if(!token){
            navigate("/login");
        }
    }, [token]);

    return (
        <>
            <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
                <div className="container">

                <ul className="navbar-nav mr-auto">
                    <li className="nav-item">
                        <Link className="nav-link" to="/">Home</Link>
                    </li>
                </ul>
                <ul className="navbar-nav ms-auto">
                    <li className="nav-item dropdown">
                        <a className="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            My Account
                        </a>
                        <div className="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <Link className="dropdown-item" to="/dashboard">Dashboard</Link>
                            <Link className="dropdown-item" to="/preferences">Preference</Link>
                            <span role="button" className="dropdown-item" onClick={logoutUser}>Logout</span>
                        </div>
                    </li>
                </ul>
                </div>
            </nav>
             <div className="container">
                    <Routes>
                        <Route path="/" element={<NewAggregator/>}/>
                        <Route path="/dashboard" element={<Dashboard/>}/>
                        <Route path="/preferences" element={<Preferences/>}/>
                    </Routes>
            </div>
        </>
    );
}

export default Auth;
