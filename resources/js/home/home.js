import axios from 'axios'; 
import $ from 'jquery';



axios.get('user/0')
.then((response)=>{
    console.table(response.data.response);
});