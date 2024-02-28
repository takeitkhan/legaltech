<template>
<div id="topNavbar">
   <a href="#" id="logo" class="font-bold">Nifty It Solutions LTD</a>
   <ul class="flex flex-row space-x-2 justify-center items-center text-xl">
     <li><router-link :to="{name:'home'}" exact>Home</router-link></li>
     <li><router-link :to="{name:'dashboard'}" exact>Dasboard</router-link></li>
     <li class="dropdown-nav">
        <a href="#" exact>Reports</a>
        <div class="dropdown shadow-md rounded-md">
          <li ><router-link :to="{name:'home'}" exact>Vat Form 6.2</router-link></li>
          <li><router-link :to="{name:'dashboard'}" exact>Vat Form 6.2.1</router-link></li>
          <li><router-link :to="{name:'option1'}" exact>Vat Form 9.1</router-link></li>
        </div>
      </li>
      <li><router-link :to="{name:'draftInvoice'}"  exact>Docs</router-link></li>
      <li class="dropdown-nav">
        <a href="#" exact>Contacts</a>
        <div class="dropdown shadow-md rounded-md">
          <li ><router-link :to="{name:'contacts'}" exact>All contacts</router-link></li>
          <li><router-link :to="{name:'dashboard'}" exact>Customer</router-link></li>
          <li><router-link :to="{name:'option1'}" exact>Suppliers</router-link></li>
          <li><router-link :to="{name:'draftInvoice'}">Employees</router-link></li>
          <li><router-link :to="{name:'draftInvoice'}"><Mdi-Icon icon="mdi-light:home" /></router-link></li>
        </div>
      </li>
   </ul>
</div>
</template>


<script>
export default {
    
}
</script>

<style scoped>
#topNavbar{
  background:#85C7FF;
  color:#fff;
  display:flex;
  padding-left:1.5rem;
  padding-top:1rem;
  padding-bottom:1rem;
}
#topNavbar #logo{
  background:#5B62A3;
  color:#fff;
  margin:0 2rem;
  padding:1rem;
  letter-spacing:0.1rem;
}
#topNavbar ul li a{
  padding:1rem;

}
.router-link-exact-active{
  color:#5B62A3;
  font-weight:bold;
  /* background:#fff; */
}

.dropdown-nav{
position:relative;
}
.dropdown-nav:hover .dropdown{
 display:block;
}
.dropdown{
  position:absolute;
  background:#fff;
  color:#000000 !important;
  top:2.8rem;
  z-index:4;
  /* left:1%; */
  width:200px;
  font-size:1.2rem;
  display:none;
}
.dropdown li{
   padding:0.5rem 1rem;
}

.dropdown li:hover{
  background:#D1D5DB;
 
}
</style>