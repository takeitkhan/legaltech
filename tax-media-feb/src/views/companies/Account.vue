<template>
  <section>
    <div class="maincontent mt-2 row">

      <!-- //account section  -->
      <article class="tab-section col-md-8">
        <div class="tabs-box d-flex ">
          <button
            class="btn btn-lg account"
            :class="[activeTab == 'account'? 'btn-primary':'btn-outline-primary']"
            @click="activeTab='account'"
          >
            Account
          </button>
          <button
            class="btn adjustment"
            :class="[activeTab == 'treasury_deposit'? 'btn-primary':'btn-outline-primary']"
            @click="activeTab='treasury_deposit'"
          >
          Treasury Deposit
          </button>
          <button
            class="btn adjustment"
            :class="[activeTab == 'vat_adjustment'? 'btn-primary':'btn-outline-primary']"
            @click="activeTab='vat_adjustment'"
          >
            VAT Adjustment
          </button>
          <button
            class="btn btn-outline-primary settings"
            :class="[activeTab == 'settings'? 'btn-primary':'btn-outline-primary']"
            @click="activeTab='settings'"
          >Settings</button>
        </div>
        <!-- //card section  -->
        <!-- <div class="account-box-header my-1">
          <h2>Header section</h2>
        </div> -->
        <div class="account-box-content d-flex my-2">
          <b-card
            bg-variant="secondary"
            text-variant="white"
            class="mr-1"
            header="VAT Balance"
          >
            <b-card-text>BDT: <span>50,000</span></b-card-text>
          </b-card>
          <b-card
            bg-variant="warning"
            text-variant="white"
            class="mr-1"
            header="Recent Balance"
          >
            <b-card-text>BDT: <span>50,000</span></b-card-text>
          </b-card>
          <b-card
            bg-variant="success"
            text-variant="white"
            class=""
            header="SD Balance"
          >
            <b-card-text>BDT: <span>50,000</span></b-card-text>
          </b-card>
        </div>
      </article>
      <!-- end of card section  -->
      <article class="sidebar-section col-md-4" />
    </div>
  </section>
</template>

<script>
import { ref } from '@vue/composition-api'
import { mapState } from 'vuex'
import {
  BCard, BCardText,
} from 'bootstrap-vue'
// import EntityApi from '@/api/entity/EntityApi'
// import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
// import authConfig from '@/api/auth/authConfig'

export default {
  components: {
    BCard, BCardText,
  },
  setup() {
    const showFolderTab = ref(true)
    return {
      showFolderTab,
    }
  },

  // for contacts list via entity
  data() {
    return {
      activeTab: 'account',
    }
  },
  computed: {
    ...mapState(['currentEntity', 'AuthUserEntityRole']),
  },

  mounted() {
    // this.$store.commit('UPDATE_IS_LOADER', false)
  },

}
</script>

<style scoped>
.maincontent{
  width:100vw;
}

.file-type-nav{
    background:#F4F7FE;
    padding:0.4rem;
}

.btn-nav,.active_btn_nav{
    margin-right:8px;
    border:1px solid #6259CF !important;
    padding:0.3rem 0.8rem;
    border-radius: 0.3rem;
    color:#6259CF;
    background:#fff;
    font-weight:500;
    text-transform: capitalize;
    font-size:0.9rem;
}
.active_btn_nav{
  background:#6259CF;
  color:#fff;
  border:1px solid #6259CF !important;
}
.btn-approve{
    background:#2f92e9;
    color:#fff;
}
</style>
