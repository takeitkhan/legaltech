<template>
  <div
    id="topNavbar"
    class="shadow-md"
  >
    <ul class="flex flex-row space-x-10 justify-center items-center text-xl">
      <li
        v-for="(nav,index) in navList"
        :key="index"
      >
        <router-link
          :to="{name:nav.linkName}"
          exact
        >
          {{ nav.name }}
        </router-link>
      </li>
    </ul>
    <button
      v-if="isButton"
      class="order-last text-white font-bold rounded-md"
    >
      {{ buttonText }}
    </button>
  </div>
</template>

<script>
export default {
  props: {
    navList: {
      required: true,
      default: [],
    },
    isButton: {
      default: false,
    },
    buttonText: {
      default: 'new Expense',
    },
  },
  mounted() {
    console.log(this.navList)
  },

}
</script>

<style scoped>
 #topNavbar{
background:#fff;
color:#fff;
display:flex;
justify-content:space-between;
padding-left:5rem;
padding-top:0.5rem;
padding-bottom:0.5rem;
padding-right:5rem;
}

#topNavbar ul li a {
color:#7A7575;
font-weight:500;
}

.router-link-exact-active{
  color:#000000 !important;
  font-weight:bold !important;
}
button{
background:#5BA367;
text-align:right;
padding:0.5rem;
letter-spacing:0.1ch;
}
</style>
