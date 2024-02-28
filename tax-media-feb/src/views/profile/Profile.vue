<template>
  <div
    id="user-profile"
    class="app-user-edit "
  >
    <div
      id="account"
      class="tab-pane bg-light px-3 py-3"
      aria-labelledby="account-tab"
      role="tabpanel"
      style="background:#fff !important"
    >
      <!-- users edit media object start -->
      <div class="media mb-2">
        <img
          :src="authUser?authUser.avatar:''"
          alt="users avatar"
          class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer"
          height="90"
          width="90"
        >
        <div class="media-body mt-50">
          <h4>{{ form.name }}</h4>
          <div class="col-12 d-flex mt-1 px-0">
            <label
              class="btn btn-primary mr-75 mb-0 waves-effect waves-float waves-light"
              for="change-picture"
            >
              <span class="d-none d-sm-block">Change</span>
              <input
                id="change-picture"
                class="form-control"
                type="file"
                hidden=""
                accept="image/png, image/jpeg, image/jpg"
                @change="setAvatar"
              >
              <span class="d-block d-sm-none">
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
                  class="feather feather-edit mr-0"
                ><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" /><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" /></svg>
              </span>
            </label>
            <!-- <button class="btn btn-outline-secondary d-none d-sm-block waves-effect">
              Remove
            </button> -->
            <!-- <button class="btn btn-outline-secondary d-block d-sm-none waves-effect">
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
                class="feather feather-trash-2 mr-0"
              ><polyline points="3 6 5 6 21 6" /><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" /><line
                x1="10"
                y1="11"
                x2="10"
                y2="17"
              /><line
                x1="14"
                y1="11"
                x2="14"
                y2="17"
              /></svg>
            </button> -->
          </div>
        </div>
      </div>
      <!-- users edit media object ends -->
      <!-- users edit account form start -->
      <form
        class="form-validate bg-light"
        style="background:#fff !important"
        novalidate="novalidate"
      >
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="name">Name</label>
              <input
                id="name"
                v-model="form.name"
                type="text"
                class="form-control"
                placeholder="Name"
                value="Eleanor Aguilar"
              >
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="email">E-mail</label>
              <input
                id="email"
                v-model="form.email"
                type="email"
                class="form-control"
                placeholder="Email"
                name="email"
              >
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="status">Status</label>
              <select
                id="status"
                v-model="form.status"
                class="form-control"
                disabled
              >
                <option
                  :selected="form.status === 'active'"
                  value="active"
                >
                  Active
                </option>
                <option
                  :selected="form.status === 'inactive'"
                  value="inactive"
                >
                  InActive
                </option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div
              v-if="form.type === 'superadmin'"
              class="form-group"
            >
              <label for="role">Role</label>
              <input
                v-model="form.type"
                type="text"
                class="form-control"
                disabled
              >
            </div>
            <div
              v-else
              class="form-group"
            >
              <label for="role">Role</label>
              <select
                id="role"
                class="form-control"
              >
                <option>Admin</option>
                <option>User</option>
                <option>Staff</option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="phone">Phone</label>
              <input
                id="phone"
                v-model="form.phone"
                type="text"
                class="form-control"
                placeholder="Mobile Number"
              >
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="old_password">Old Password</label>
              <input
                id="old_password"
                v-model="form.old_password"
                type="text"
                class="form-control"
                placeholder="Old Password"
              >
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="new_password">New Password</label>
              <input
                id="new_password"
                v-model="form.password"
                type="text"
                class="form-control"
                placeholder="New Password"
              >
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="new_password">Confirm Password</label>
              <input
                id="new_password"
                v-model="form.confirm_password"
                type="text"
                class="form-control"
                placeholder="Confirm Password"
              >
            </div>
          </div>
          <!-- <div class="col-12">
            <div class="table-responsive border rounded mt-1">
              <h6 class="py-1 mx-1 mb-0 font-medium-2">
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
                  class="feather feather-lock font-medium-3 mr-25"
                ><rect
                  x="3"
                  y="11"
                  width="18"
                  height="11"
                  rx="2"
                  ry="2"
                /><path d="M7 11V7a5 5 0 0 1 10 0v4" /></svg>
                <span class="align-middle">Permission</span>
              </h6>
              <table class="table table-striped table-borderless">
                <thead class="thead-light">
                  <tr>
                    <th>Module</th>
                    <th>Read</th>
                    <th>Write</th>
                    <th>Create</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Admin</td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="admin-read"
                          type="checkbox"
                          class="custom-control-input"
                          checked=""
                        >
                        <label
                          class="custom-control-label"
                          for="admin-read"
                        />
                      </div>
                    </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="admin-write"
                          type="checkbox"
                          class="custom-control-input"
                        >
                        <label
                          class="custom-control-label"
                          for="admin-write"
                        />
                      </div>
                    </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="admin-create"
                          type="checkbox"
                          class="custom-control-input"
                        >
                        <label
                          class="custom-control-label"
                          for="admin-create"
                        />
                      </div>
                    </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="admin-delete"
                          type="checkbox"
                          class="custom-control-input"
                        >
                        <label
                          class="custom-control-label"
                          for="admin-delete"
                        />
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Staff</td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="staff-read"
                          type="checkbox"
                          class="custom-control-input"
                        >
                        <label
                          class="custom-control-label"
                          for="staff-read"
                        />
                      </div>
                    </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="staff-write"
                          type="checkbox"
                          class="custom-control-input"
                          checked=""
                        >
                        <label
                          class="custom-control-label"
                          for="staff-write"
                        />
                      </div>
                    </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="staff-create"
                          type="checkbox"
                          class="custom-control-input"
                        >
                        <label
                          class="custom-control-label"
                          for="staff-create"
                        />
                      </div>
                    </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="staff-delete"
                          type="checkbox"
                          class="custom-control-input"
                        >
                        <label
                          class="custom-control-label"
                          for="staff-delete"
                        />
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Author</td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="author-read"
                          type="checkbox"
                          class="custom-control-input"
                          checked=""
                        >
                        <label
                          class="custom-control-label"
                          for="author-read"
                        />
                      </div>
                    </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="author-write"
                          type="checkbox"
                          class="custom-control-input"
                        >
                        <label
                          class="custom-control-label"
                          for="author-write"
                        />
                      </div>
                    </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="author-create"
                          type="checkbox"
                          class="custom-control-input"
                          checked=""
                        >
                        <label
                          class="custom-control-label"
                          for="author-create"
                        />
                      </div>
                    </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="author-delete"
                          type="checkbox"
                          class="custom-control-input"
                        >
                        <label
                          class="custom-control-label"
                          for="author-delete"
                        />
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>Contributor</td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="contributor-read"
                          type="checkbox"
                          class="custom-control-input"
                        >
                        <label
                          class="custom-control-label"
                          for="contributor-read"
                        />
                      </div>
                    </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="contributor-write"
                          type="checkbox"
                          class="custom-control-input"
                        >
                        <label
                          class="custom-control-label"
                          for="contributor-write"
                        />
                      </div>
                    </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="contributor-create"
                          type="checkbox"
                          class="custom-control-input"
                        >
                        <label
                          class="custom-control-label"
                          for="contributor-create"
                        />
                      </div>
                    </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="contributor-delete"
                          type="checkbox"
                          class="custom-control-input"
                        >
                        <label
                          class="custom-control-label"
                          for="contributor-delete"
                        />
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td>User</td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="user-read"
                          type="checkbox"
                          class="custom-control-input"
                        >
                        <label
                          class="custom-control-label"
                          for="user-read"
                        />
                      </div>
                    </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="user-create"
                          type="checkbox"
                          class="custom-control-input"
                        >
                        <label
                          class="custom-control-label"
                          for="user-create"
                        />
                      </div>
                    </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="user-write"
                          type="checkbox"
                          class="custom-control-input"
                        >
                        <label
                          class="custom-control-label"
                          for="user-write"
                        />
                      </div>
                    </td>
                    <td>
                      <div class="custom-control custom-checkbox">
                        <input
                          id="user-delete"
                          type="checkbox"
                          class="custom-control-input"
                          checked=""
                        >
                        <label
                          class="custom-control-label"
                          for="user-delete"
                        />
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div> -->
          <div class="col-12 d-flex flex-sm-row flex-column mt-2">
            <button
              type="submit"
              class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-float waves-light"
              @click.prevent="updateProfile"
            >
              Update
            </button>
          </div>
        </div>
      </form>
      <!-- users edit account form ends -->
    </div>
  </div>
</template>

<script>
/* eslint-disable global-require */
import { mapState } from 'vuex'
import AdminUserApi from '@/api/admin/user'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
import AuthApi from '@/api/auth/AuthApi'
import authConfig from '@/api/auth/authConfig'

export default {
  components: {
  },
  data() {
    return {
      form: {
        name: '',
        email: '',
        phone: '',
        status: '',
        role: '',
        type: '',
        avatar: '',
        old_password: '',
        password: '',
        confirm_password: '',
      },
    }
  },
  computed: {
    ...mapState(['AuthUserEntityRole', 'currentEntity', 'authUser']),
  },
  watch: {
    authUser() {
      console.log(this.authUser)
      this.setProfile()
    },
  },
  mounted() {
    console.log(this.authUser)
    this.setProfile()
  },
  methods: {
    setProfile() {
      this.form.name = this.authUser?.name
      this.form.email = this.authUser?.email
      this.form.phone = this.authUser?.phone
      this.form.type = this.authUser?.type
      this.form.status = this.authUser?.status
      // this.form.avatar = this.authUser?.avatar
    },
    async setAuthUser() {
      try {
        const { data: { user } } = await AuthApi.user()
        this.$store.commit('SET_AUTH_USER', user)
        if (user?.entities?.length) {
          this.$store.commit('UPDATE_CURRENT_ENTITY', user.entities[0])
          // if user has entity role then update current entity
          const role = user.main_role.find(rol => rol.user_role?.entity_id === user?.entities?.[0].id)
          if (role) {
            this.$store.commit('UPDATE_AUTH_USER_ENTITY_ROLE', role)
          }
        }
      } catch {
        localStorage.removeItem(authConfig.storageTokenKeyName)
        this.$router.push({ name: 'login' })
      }
    },
    async updateProfile() {
      try {
        const { data: { message } } = await AdminUserApi.updateProfile(this.setFormData())
        this.$toast({
          component: ToastificationContent,
          props: {
            title: message,
            icon: 'EditIcon',
            variant: 'success',
          },
        })
        this.setAuthUser()
      } catch (error) {
        if (error?.response?.status === 401) {
          this.$toast({
            component: ToastificationContent,
            props: {
              title: error?.response.data.message,
              icon: 'XCircleIcon',
              variant: 'danger',
            },
          })
        }
      }
    },
    setAvatar(event) {
      const avatar = event.target.files[0]
      this.form.avatar = avatar
    },
    setFormData() {
      const formData = new FormData()
      // eslint-disable-next-line no-restricted-syntax
      for (const key in this.form) {
        formData.append(key, this.form[key])
      }
      return formData
    },
  },

}
/* eslint-disable global-require */
</script>

<style lang="scss" >
@import '@core/scss/vue/pages/page-profile.scss';
</style>
