import {useState} from "react"
import useAuth from '../../hooks/useAuth';

const Login = () => {
    const {login, error} = useAuth();
    const [email, setEmail] = useState();
    const [password, setPassword] = useState();
    const handleLogin = () => {
        // api call
        login({email: email, password: password})
    }

    return (<div className="row justify-content-center pt-5">
            <div className="col-sm-6">
                <div className="card p-4">
                    <h1 className="text-center mb-3">Login </h1>

                    {error && <div className="justify-content-center text-danger">{error}</div>}
                    <div className="form-group">
                        <label>Email address:</label>
                        <input type="email" className="form-control" placeholder="Enter email"
                               onChange={e => setEmail(e.target.value)}
                               id="email"/>
                    </div>
                    <div className="form-group mt-3">
                        <label>Password:</label>
                        <input type="password" className="form-control" placeholder="Enter password"
                               onChange={e => setPassword(e.target.value)}
                               id="pwd"/>
                    </div>
                    <button type="button" onClick={handleLogin} className="btn btn-primary mt-4">Login</button>
                </div>
            </div>
        </div>)
}


export default Login;