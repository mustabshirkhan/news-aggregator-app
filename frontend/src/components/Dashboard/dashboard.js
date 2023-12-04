import { useEffect, useState } from 'react';
import useAuth from '../../hooks/useAuth';

 const  Dashboard = () => {
    const {http} = useAuth();
    const [userdetail,setUserdetail] = useState('');

    const fetchUserDetail = () =>{
        http.get('/me').then((res)=>{
            setUserdetail(res.data);
        });
    }


    useEffect(()=>{
        fetchUserDetail();
    },[]);

    function renderElement(){
        if(userdetail){
            return <div>
                <h4>Name</h4>
                <p>{userdetail.name}</p>
                <h4>Email</h4>
                <p>{userdetail.email}</p>
            </div>
        }else{
            return <p>Loading.....</p>
        }

    }

    return(
        <div>
            <h1 className='mb-4 mt-4'>Dashboard page</h1>
            { renderElement() }
        </div>
    )
}


export default Dashboard;