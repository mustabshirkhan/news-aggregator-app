import axios from 'axios';
import {useCallback, useState} from 'react';
import { useNavigate } from 'react-router-dom';

const useAuth = () => {
    const navigate = useNavigate();
    const getToken = () =>{

        const tokenString = sessionStorage.getItem('token');
        const userToken = tokenString === undefined ? null : JSON.parse(tokenString);
        return userToken;
    }

    const getUser = () =>{
        const user_detail = null;
        return user_detail;
    }



    const [token,setToken] = useState(getToken());
    const [user] = useState(getUser());
    const [error, setError] = useState(null);
    const [successMsg, setSuccessMsg] = useState(null);

    const login  = useCallback((data)=>{
        http.post('/login',data).then((res)=>{
            saveToken(res.data.token);
            setSuccessMsg('Successfully loggedin');
        }).catch((error)=>{
            setError(error.response.data.error);
        })
    })

    const register  = useCallback((data)=>{
        http.post('/register',data).then((res)=>{
            navigate('/login')
        }).catch((error)=>{
            setError(error.response.data.message);
        })
    })
    const saveToken = (token) =>{
        sessionStorage.setItem('token',JSON.stringify(token));

        setToken(token);
        navigate('/dashboard');
    }
    const logout =  () => {
        sessionStorage.clear();
        navigate('/login');
    }

    const http = axios.create({
        baseURL:process.env.REACT_APP_API_BASEURL,
        headers:{
            "Content-type" : "application/json",
            "Authorization" : `Bearer ${token}`
        }
    });
    return {
        setToken:saveToken,
        token,
        user,
        getToken,
        http,
        login,
        register,
        logout,
        error,
        successMsg
    }
}

export default useAuth;