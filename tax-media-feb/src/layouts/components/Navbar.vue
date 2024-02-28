<template>
  <div
    class="navbar-container d-flex content align-items-center"
    style="margin-bottom:5px;border-radius:1px !important;"
  >
    <!-- Nav Menu Toggler -->
    <ul class="nav navbar-nav d-xl-none mt-2 ">
      <li class="nav-item">
        <b-link
          class="nav-link"
          @click="toggleVerticalMenuActive"
        >
          <feather-icon
            icon="MenuIcon"
            size="21"
          />
        </b-link>
      </li>

    </ul>

    <!-- Left Col -->
    <div class="bookmark-wrapper nav align-items-center flex-grow-1 d-lg-flex">
      <!-- <dark-Toggler class="d-none d-lg-block" /> -->
      <li class="nav-item mx-2">
        <div class="selected-div ">
          <p
            class="select-item"
            style="border-radius:5px;"
            @click="showCountryList=!showCountryList"
          >
            <img
              width="35px"
              height="35px"
              class="rounded-circle mr-2"
              :src="getSelectedEntity.company_logo"
            >
            <span v-text="currentEntityName" />
            <span class="downicon">
              <feather-icon
                size="21"
                icon="ChevronDownIcon"
              /></span>
          </p>

          <div
            v-if="showCountryList"
            class="country-list"
          >
            <li
              v-for="(entity,index) in entities"
              :key="index"
              @click="showCountryList=!showCountryList,selectEntity(entity.id)"
            >
              <img :src="entity.company_logo">
              <span>{{ entity.name }}</span>
            </li>
          </div>
        </div>
      </li>

      <!--<li class="nav-item mx-2 ">
        <b-link
          href="#"
          style="font-size:18px;"
        >
          <strong>Dashboard</strong>
        </b-link>
      </li>
      <li class="nav-item mx-2">
          <b-link
            style="font-size:18px;"
            href="#"
          >
            <strong>Docs</strong>
          </b-link>
      </li> -->
    </div>

    <b-navbar-nav class="nav align-items-center ml-auto  text-white">
      <!-- <search-bar /> -->
      <notification-dropdown />
      <!-- <user-dropdown /> -->
      <b-nav-item-dropdown
        right
        toggle-class="d-flex align-items-center dropdown-user-link"
        class="dropdown-user"
      >
        <template #button-content>
          <div class="d-sm-flex d-none user-nav">
            <p
              class="user-name font-weight-bolder mb-0"
              style="color:#fff !important"
              v-text="authUserName"
            />
            <span
              v-if="role === 'superadmin'"
              class="user-status"
              style="color:#fff !important"
              v-text="role"
            />
            <span
              v-else
              class="user-status"
              style="color:#fff !important"
              v-text="AuthUserEntityRole.role_name"
            />
          </div>
          <b-avatar
            size="40"
            badge
            :src="avatar"
            class="badge-minimal"
          />
          <!-- variant="light-primary" -->
          <!-- badge-variant="success" -->
          <!-- :src="require('@/assets/images/avatars/13-small.png')" -->
        </template>

        <b-dropdown-item
          href=""
          link-class="d-flex align-items-center"
        >
          <feather-icon
            size="16"
            icon="UserIcon"
            class="mr-50"
          />
          <router-link :to="{name:'profile'}">
            <span>Profile</span>
          </router-link>
        </b-dropdown-item>

        <b-dropdown-item link-class="d-flex align-items-center ">
          <feather-icon
            size="16"
            icon="CheckSquareIcon"
            class="mr-50"
          />
          <router-link :to="{name:'home'}">
            <span>Settings</span>
          </router-link>
        </b-dropdown-item>

        <b-dropdown-divider />

        <b-dropdown-item
          link-class="d-flex align-items-center"
          @click.prevent="logout"
        >
          <feather-icon
            size="16"
            icon="LogOutIcon"
            class="mr-50"
          />
          <span>Logout</span>
        </b-dropdown-item>
      </b-nav-item-dropdown>
    </b-navbar-nav>
  </div>
</template>

<script>
import {
  BLink, BNavbarNav, BNavItemDropdown, BDropdownItem, BDropdownDivider, BAvatar,
} from 'bootstrap-vue'
// import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
import AuthApi from '@/api/auth/AuthApi'
import authConfig from '@/api/auth/authConfig'
import EntityApi from '@/api/entity/EntityApi'
import { mapState } from 'vuex'
import NotificationDropdown from './NotificationDropdown.vue'

export default {
  components: {
    BLink,
    BNavbarNav,
    BNavItemDropdown,
    BDropdownItem,
    BDropdownDivider,
    BAvatar,
    // ToastificationContent,
    NotificationDropdown,
  },
  props: {
    toggleVerticalMenuActive: {
      type: Function,
      default: () => {},
    },
  },
  data() {
    return {
      selected: { },
      entities: [],
      showCountryList: false,
    }
  },

  computed: {
    authUserName() {
      return this.$store?.state?.authUser?.name
    },
    avatar() {
      return this.$store?.state?.authUser?.avatar
    },
    role() {
      return this.$store?.state?.authUser?.type
    },
    ...mapState(['AuthUserEntityRole', 'currentEntity', 'authUser']),
    getSelectedEntity() {
      return this.selected
    },
    currentEntityName() {
      return this.selected.name
    },
  },
  watch: {
    currentEntity(newVal) {
      const role = this.authUser?.main_role?.find(rol => rol.user_role?.entity_id === this.currentEntity.id)
      if (role) {
        this.$store.commit('UPDATE_AUTH_USER_ENTITY_ROLE', role)
      }
      this.selected = newVal
    },
  },
  mounted() {
    this.getEntities()
  },
  methods: {
    selectEntity(id) {
      this.selected = this.entities.find(option => option.id === id)
      this.$store.commit('UPDATE_CURRENT_ENTITY', this.selected)
    },
    logout() {
      // eslint-disable-next-line no-alert
      AuthApi.logout()
        .then(() => {
          localStorage.removeItem(authConfig.storageTokenKeyName)
          this.$router.push({ name: 'login' })
        })
        .catch(error => {
          console.log(error)
        })
    },
    async getEntities() {
      try {
        const { data: { entities } } = await EntityApi.entityList()
        this.entities = entities
        this.selected = { ...entities[0] }
        this.$store.commit('UPDATE_CURRENT_ENTITY', this.selected)
        this.$store.commit('UPDATE_ENTITES', entities)
      } catch (error) {
        console.log(error)
      }
    },

  },
}
</script>
<style scoped>
.navbar-container{
  background:rgba(115,103,240,0.9);
}
.selected-div{
  position: relative;
  margin:0;
  padding:0;
  box-sizing: border-box;
  width:auto;
  min-width:280px;
  padding:0 2rem 0 0;
  background:#9289F4;
  background:#fff;
  border-radius:10px;
  position:relative;
  z-index:5 !important;
  /* border:1px solid red; */
}
.selected-div span.downicon{
   position:absolute;
   right:10px;
   top:1rem;
   font-weight:900;
}
.country-list{
  position:absolute;
  top:119%;
  left:-8px;
  border:1px solid rgb(233, 228, 228);
  background:#fff;
  color:#9289F4;
  width:300px;
  height:500px;
  overflow-y:auto;
  box-shadow: 0 1px 2px 0 rgb(0 0 0 / 0.05);
}
/* transparent scrollbar */
.country-list::-webkit-scrollbar {
  width: 2px;
}

.country-list::-webkit-scrollbar-thumb {
  border-radius: 10px;
}

.country-list::-webkit-scrollbar-track {
  border-radius: 5px;
  -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
}

.country-list::-webkit-scrollbar-thumb {
  border-radius: 10px;
  background-color: #9289F4;
  outline: 2px solid gray;
}

.country-list li{
  font-size:16px;
  border-bottom:0.1px solid rgba(210, 207, 243,0.3);
  padding:1rem;
}
.country-list li img{
  width:40px;
  height:40px;
  border-radius: 50%;
  margin-right:0.4rem;
}
.country-list li:last-child{
  border-bottom:none;
}
.country-list li:hover{
  color:#fff;
  cursor:pointer;
  background:#aba6e7;
}
.select-item{
  color:#9289F4;
  font-weight: bold;
  font-size:18px;
  border:inset 1px solid rgb(146, 137, 244,0.1);
  padding:0.8rem 0.5rem ;
  /* background:#9289F4; */
  margin-top:0.2rem;
  margin-bottom:-1px;
  cursor:pointer;

}

</style>
