import { useState } from "react"
import useAuth from '../../hooks/useAuth';

export default function Register() {
    const {register, error} = useAuth();
    const [name,setName] = useState();
    const [email,setEmail] = useState();
    const [password,setPassword] = useState();

    const handleLogin = () =>{
        register({email:email,password:password,name:name});
    }

    return(
        <div className="row justify-content-center pt-5">
            <div className="col-sm-6">
                <div className="card p-4">
                    <h1 className="text-center mb-3">Register </h1>
                    {error && <div className="justify-content-center text-danger">{error}</div>}
                    <div className="form-group">
                        <label>Name:</label>
                        <input type="test" className="form-control" placeholder="Enter name"
                            onChange={e=>setName(e.target.value)}
                        id="email" />
                    </div>
                    <div className="form-group mt-3">
                        <label>Email address:</label>
                        <input type="email" className="form-control" placeholder="Enter email"
                            onChange={e=>setEmail(e.target.value)}
                        id="email" />
                    </div>

                    <div className="form-group mt-3">
                        <label>Password:</label>
                        <input type="password" className="form-control" placeholder="Enter password"
                            onChange={e => setPassword(e.target.value)}
                        id="pwd" />
                    </div>
                    <button type="button" onClick={handleLogin} className="btn btn-primary mt-4">Register</button>
                </div>
            </div>
        </div>
    )
}