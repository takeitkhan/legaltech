<template>
  <div class="container main-content mx-auto my-4 py-4">
    <div id="expenses-list">
      <h1 class="expenses-list-title text-2xl font-bold mb-2">
        To Review BDT 25,000/=
      </h1>

      <div class="list-container ml-6 mt-6">
        <h4 class="expense-user text-xl mb-2 font-bold">
          Rahim Steel
        </h4>
        <div class="single-list space-x-4 shadow-md shadow-500/40  py-9  pl-4 pr-4 mb-3">
          <div class="single-left flex space-x-5">
            <img
              :src="logo"
              width="50"
              height="50"
            >
            <div class="single-content">
              <p class="font-semibold text-xl mb-1 pb-1">
                Stationary Purchase
              </p>
              <div class="color-div" />
            </div>
          </div>
          <button class="text-black text-xl px-10 py-3 border-2 border-indigo-600">
            Review
          </button>
        </div>
        <div class="single-list space-x-4 shadow-md shadow-500/40  py-9  pl-4 pr-4 mb-3">
          <div class="single-left flex space-x-5">
            <img
              :src="logo"
              width="50"
              height="50"
            >
            <div class="single-content">
              <p class="font-semibold text-xl mb-1 pb-1">
                Stationary Purchase
              </p>
              <div class="color-div" />
            </div>
          </div>
          <button class="text-black text-xl px-10 py-3 border-2 border-indigo-600">
            Review
          </button>
        </div>
        <div class="single-list space-x-4 shadow-md shadow-500/40  py-9  pl-4 pr-4 mb-3">
          <div class="single-left flex space-x-5">
            <img
              :src="logo"
              width="50"
              height="50"
            >
            <div class="single-content">
              <p class="font-semibold text-xl mb-1 pb-1">
                Stationary Purchase
              </p>
              <div class="color-div" />
            </div>
          </div>
          <button class="text-black text-xl px-10 py-3 border-2 border-indigo-600">
            Review
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import logo from '../../assets/logo.png'

export default {
  data() {
    return {
      logo,
    }
  },
  mounted() {
    console.log(this.logo)
  },
}
</script>

<style scoped>
#expenses-list{

}
#expenses-list .expense-user{

}

.single-list{
   display:flex;
   justify-content:space-between;
   margin-top:-0.1rem;
}
.single-left .single-content p {
  /*margin-top:-0.1rem !important;*/

}
.single-content p{
    color:#000000;
}
.single-content .color-div{
   width:200px;
   background:#C4C4C4;
   height:20px;
}
.single-list{
  background:#ffff;
}
.single-list img{
object-fit:contain;
border:1px solid transparent;
padding:0.2rem;
width:60px;height:60px;
border-radius:50%;
}
</style>
