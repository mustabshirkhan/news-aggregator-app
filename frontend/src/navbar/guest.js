import {BrowserRouter, Routes, Route, Link} from 'react-router-dom';
import Home from '../components/home';
import Login from '../components/Auth/login';
import Register from '../components/Auth/register';
import NewsAggregator from "../components/News/newsAggregator";

function Guest() {
    return (
        <>
            <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
                <ul className="navbar-nav mr-auto">
                    <li className="nav-item">
                        <Link className="nav-link" to="/">Home</Link>
                    </li>
                </ul>
                <ul className="navbar-nav ms-auto">
                    <li className="nav-item">
                        <Link className="nav-link" to="/login">Login</Link>
                    </li>
                    <li className="nav-item">
                        <Link className="nav-link" to="/register">Register</Link>
                    </li>

                </ul>

            </nav>
            <div className="container">
                <Routes>
                    <Route path="/" element={<NewsAggregator/>}/>
                    <Route path="/login" element={<Login/>}/>
                    <Route path="/register" element={<Register/>}/>
                </Routes>

            </div>
        </>
    );
}

export default Guest;
