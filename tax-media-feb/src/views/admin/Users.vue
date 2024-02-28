<template>

  <section id="dashboard-ecommerce">

    <div class="row match-height">
      <div class="col-12 ">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h2 class="pb-1 mt-3">
              Total Users
            </h2>
            <p class="font-weight-bolder text-capitalize">Find all of the entity users
              Accounts and their associate roles
            </p>
          </div>
          <router-link
            v-if="isSuperAdmin"
            :to="{name:'AddNewUser'}"
            class="btn btn-primary"
          >
            Add New User
          </router-link>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card">

          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table ">
                <thead>
                  <tr>
                    <th>
                      <b-form-checkbox
                        value="A"
                        class="custom-control-primary"
                      >
                        <!-- Primary -->
                      </b-form-checkbox>
                    </th>
                    <th width="20%">
                      Name
                    </th>
                    <th width="30%">
                      Role
                    </th>
                    <th width="30%">
                      Status
                    </th>
                    <th
                      width="20%"
                      align="center"
                    >
                      Action
                    </th>
                  </tr>
                </thead>
                <tbody>

                  <tr
                    v-for="user in users"
                    :key="user.id"
                  >
                    <td>
                      <b-form-checkbox
                        :value="user.id"
                        class="custom-control-primary"
                      />
                    </td>
                    <td width="20%">
                      <div class="d-flex align-items-center">
                        <div class="avatar rounded rounded-circle">
                          <div
                            class="avatar-content"
                            style="width:60px;height:60px;"
                          >
                            <router-link :to="{name:'User',params:{userId:user.id}}">
                              <img
                                style="width:60px;height:60px;object-fit:cover"
                                :src="user.avatar"
                                alt="Toolbar svg"
                              >
                            </router-link>
                          </div>
                        </div>
                        <div class="ml-1">
                          <div class="font-weight-bolder">
                            <router-link :to="{name:'User',params:{userId:user.id}}">
                              {{ user.name }}
                            </router-link>
                          </div>
                          <div class="font-small-2 text-muted">
                            <router-link :to="{name:'User',params:{userId:user.id}}">
                              {{ user.email }}
                            </router-link>
                          </div>
                          <div class="font-small-2 text-muted">
                            <router-link :to="{name:'User',params:{userId:user.id}}">
                              {{ user.phone }}
                            </router-link>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td
                      width="30%"
                    >
                      <p class="text-success">
                        <router-link :to="{name:'User',params:{userId:user.id}}">
                          {{ role(user.main_role) }}
                        </router-link>
                      </p>
                    </td>
                    <td
                      width="30%"
                      style="text-align:left;padding-right:10%"
                    >
                      <span
                        class="badge"
                        :class="[user.status === 'active'?'badge-success':'badge-danger']"
                      >{{ user.status }}</span>
                    </td>
                    <td
                      width="20%"
                      style="text-align:left;padding-left:0px"
                    >
                      <div class="d-flex align-items-center justify-content-start">
                        <b-dropdown variant="white">
                          <template #button-content>
                            <button class="text-secondary btn">
                              <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="14"
                                height="14"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                class="feather feather-more-vertical font-medium-3 cursor-pointer"
                                data-toggle="dropdown"
                              ><circle
                                cx="12"
                                cy="12"
                                r="1"
                              /><circle
                                cx="12"
                                cy="5"
                                r="1"
                              /><circle
                                cx="12"
                                cy="19"
                                r="1"
                              /></svg>
                            </button>
                          </template>
                          <b-dropdown-item :to="{name:'EditUser',params:{userId:user.id}}">
                            <!-- <router-link :to="{name:'EditUser',params:{userId:user.id}}" /> -->
                            Edit User
                          </b-dropdown-item>
                          <b-dropdown-item
                            href="#"
                            @click="deleteUser(user.id)"
                          >
                            Delete User
                          </b-dropdown-item>
                        </b-dropdown>
                      </div>
                    </td>

                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

</template>

<script>
import {
  BDropdown, BDropdownItem, BFormCheckbox,
} from 'bootstrap-vue'
import AdminUserApi from '@/api/admin/user'
import { mapState } from 'vuex'
import Permissions from '@/helpers/Permissions'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
  components: {
    BFormCheckbox,
    BDropdownItem,
    BDropdown,
  },
  data() {
    return {
      users: [],
      canViewAddUserButton: false,
    }
  },
  computed: {
    role() {
      return mainRole => {
        if (Array.isArray(mainRole)) {
          const roleIndex = mainRole.findIndex(rol => rol.user_role.entity_id === this.currentEntity.id)
          if (roleIndex > -1) {
            return mainRole[roleIndex].role_name
          }
        }
        return 'not assigned'
      }
    },
    ...mapState(['authUser', 'currentEntity', 'AuthUserEntityRole']),
    isSuperAdmin() {
      return this.authUser?.type === 'superadmin'
    },
  },
  watch: {
    currentEntity() {
      console.log('currrent entity is running ')
      this.getAllUsers()
    },
    AuthUserEntityRole() {
      this.canAddPermission()
    },
  },
  // entity_id
  mounted() {
   
    this.getAllUsers()
    this.canAddPermission()
  },
  methods: {
    async getAllUsers() {
      try {
        this.$store.commit('UPDATE_IS_LOADER', true)
        const { data: { users } } = await AdminUserApi.users(this.currentEntity.id)
        this.users = users
        this.$store.commit('UPDATE_IS_LOADER', false)
      } catch (error) {
        console.log(error)
      }
    },

    // permissions sections
    canAddPermission() {
      // eslint-disable-next-line camelcase
      const { role_name = null } = this.AuthUserEntityRole
      if (this.authUser?.type === 'superadmin' || Permissions.addUserPermission(role_name)) {
        this.canViewAddUserButton = true
      } else {
        this.canViewAddUserButton = false
      }
    },
    async deleteUser(userId) {
      try {
        const { isDenied } = await this.$swal.fire({
          title: 'Are your sure? you want to delete  this entity user',
          showDenyButton: true,
          showCancelButton: false,
          confirmButtonText: 'Delete',
          denyButtonText: 'Cancel',
        })
        if (isDenied) {
          return
        }
        this.$store.commit('UPDATE_IS_LOADER', true)
        const { data: { message } } = await AdminUserApi.deleteUser(this.currentEntity.id, userId)
        this.$store.commit('UPDATE_IS_LOADER', false)
        this.getAllUsers()
        this.$toast({
          component: ToastificationContent,
          props: {
            title: message,
            icon: 'EditIcon',
            variant: 'success',
          },
        })
      } catch (error) {
        this.$store.commit('UPDATE_IS_LOADER', false)
        console.log(error)
      }
    },
  },

}
</script>

<style>
.user-timeline-list{
    border-left:1px solid
}
.user-timeline-list .single-timeline .badge{
  width:20px;
  height:20px !important;
  border-radius:50% !important;

}
</style>
