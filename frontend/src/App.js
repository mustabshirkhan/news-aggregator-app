import 'bootstrap/dist/css/bootstrap.min.css';
import "bootstrap/dist/js/bootstrap.bundle.min.js";

import useAuth from './hooks/useAuth';
import Guest from './navbar/guest';
import Auth from './navbar/auth';
function App() {
  const {getToken} = useAuth();
  if(!getToken()){
    return    (
        <Guest />
    )

  }
  return (
        <Auth />
  );

}

export default App;
