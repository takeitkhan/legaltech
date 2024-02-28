import {ref } from '@vue/composition-api';
export default function UseLogin(){
    const form = ref({
        name:null,
        email:null,
        password:null,
        
    });
    const SignUp = (event)=>{
        alert(event.target)
    }
   return {
       SignUp,
       form
   }
     
}