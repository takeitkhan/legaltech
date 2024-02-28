<template>
  <div
    id="user-profile"
    class="app-user-edit"
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
        <h2 class="text-primary">
          Add New User
        </h2>

      </div>
      <!-- users edit media object ends -->
      <!-- users edit account form start -->
      <form
        class="form-validate bg-light"
        style="background:#fff !important"
        novalidate="novalidate"
      >
        <div>
          <p
            v-if="error"
            v-text="error"
          />
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="phone">Phone Number</label>
              <input
                id="phone"
                v-model="form.phone"
                type="text"
                class="form-control"
                placeholder="Phone Number"
                name="phone"
              >
              <span
                v-if="Object.keys(errors).length > 0 && errors.phone"
                class="text-danger"
              >{{ errors.phone[0] }}</span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="username">Name</label>
              <input
                id="name"
                v-model="form.name"
                type="text"
                class="form-control"
                placeholder="Name"
                name="name"
                :readonly="hasUserData==true"
              >
              <span
                v-if="Object.keys(errors).length > 0 && errors.name"
                class="text-danger"
              >{{ errors.name[0] }}</span>
            </div>
          </div>
          <div
            v-if="hasUserData==false"
            class="col-md-4"
          >
            <div class="form-group">
              <label for="username">Avatar</label>
              <input
                id="avatar"
                type="file"
                class="form-control"
                placeholder="avatar"
                name="avatar"

                @change="addavatar"
              >
              <span
                v-if="Object.keys(errors).length > 0 && errors.avatar"
                class="text-danger"
              >{{ errors.avatar[0] }}</span>
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
                :readonly="hasUserData==true"
              >
              <span
                v-if="Object.keys(errors).length > 0 && errors.email"
                class="text-danger"
              >{{ errors.email[0] }}</span>
            </div>
          </div>

          <div
            v-if="hasUserData == false"
            class="col-md-4"
          >
            <div class="form-group">
              <label for="password">Password</label>
              <input
                id="text"
                v-model="form.password"
                type="text"
                class="form-control"
                placeholder="Password"
                name="password"
              >
              <span
                v-if="Object.keys(errors).length > 0 && errors.password"
                class="text-danger"
              >{{ errors.password[0] }}</span>
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="status">Status</label>
              <select
                id="status"
                v-model="form.status"
                class="form-control"
              >
                <option value="active">
                  Active
                </option>
                <option value="inactive">
                  InActive
                </option>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="role">Role</label>

              <select
                v-model="form.role_id"
                class="form-control"
              >
                <option
                  value=""
                  Selected
                >
                  Select Role
                </option>
                <option
                  v-for="role in roles"
                  :key="role.id"
                  :value="role.id"
                >
                  {{ role.role_name }}
                </option>
              </select>
              <span
                v-if="Object.keys(errors).length > 0 && errors.role_id"
                class="text-danger"
              >{{ errors.role_id[0] }}</span>
            </div>
          </div>

        </div>
        <!-- <div class="entity_content">
          <div
            v-for="(permission,index) in form.module_permissions"
            :key="permission+index"
            class="single_entity_content"
          >
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="role">Role</label>

                  <select
                    class="form-control"
                    @change="addRole($event,index)"
                  >
                    <option
                      value=""
                      Selected
                    >
                      Select Role
                    </option>
                    <option
                      v-for="role in roles "
                      :key="role.id"
                      :value="role.id"
                    >
                      {{ role.role_name }}
                    </option>
                  </select>
                  <span
                    v-if="Object.keys(errors).length > 0 && errors.role_id"
                    class="text-danger"
                  >{{ errors.role_id[0] }}</span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="company">Assign Entity</label>
                  <select
                    class="form-control"
                    @change="addEntity($event, index)"
                  >
                    <option
                      value=""
                      selected
                    >
                      Select Entity
                    </option>
                    <option
                      v-for="entity in entities"
                      :key="entity.id"
                      :value="entity.id"
                    >
                      {{ entity.name }}
                    </option>
                  </select>
                  <span
                    v-if="Object.keys(errors).length > 0 && errors.entity_id"
                    class="text-danger"
                  >{{ errors.entity_id[0] }}</span>
                </div>
              </div>
              <div class="col-md-4">
                <div
                  class="button-group d-flex align-items-center"
                  style="margin-top:1.9rem;"
                >
                  <button
                    v-if="index === 0"
                    class="btn btn-sm btn-success"
                    @click.prevent="assignNewPermission"
                  >
                    +
                  </button>
                  <button
                    v-else
                    class="btn btn-sm btn-danger"
                    @click.prevent="removePermission(index)"
                  >
                    -
                  </button>
                </div>
              </div>

            </div>
            <div class="row">
              <div class="col-8">
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
                        <th
                          v-for="permi in module_permissions"
                          :key="permi.title"
                        >
                          {{ permi.title.toUpperCase() }}
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="(module_,index3) in modules"
                        :key="module_.id"
                      >
                        <td>{{ module_.title }}</td>
                        <td
                          v-for="(permi,index1) in module_permissions"
                          :key="permi.title+module_.title"
                        >
                          <div class="custom-control custom-checkbox">
                            <input
                              :id="index3+index+index1+module_.title+permi.title"
                              type="checkbox"
                              class="custom-control-input"
                              :value="permi.id"
                              :checked="checkPermission(index, permi.id, module_.id)"
                              @click="addModule(module_.id,index,permi.id)"
                            >

                            <label
                              class="custom-control-label"
                              :for="index3+index+index1+module_.title+permi.title"
                            />
                          </div>
                        </td>

                      </tr>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
        </div> -->

        <div class="col-12 d-flex flex-sm-row flex-column mt-2">
          <button
            type="submit"
            class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-float waves-light"
            :disabled="buttonDisabled"
            @click.prevent="addNewUser"
          >
            Add New User
          </button>
          <!-- <button
            type="reset"
            class="btn btn-outline-secondary waves-effect"
          >
            Reset
          </button> -->
        </div>
      </form>
      <!-- users edit account form ends -->
    </div>
  </div>
</template>

<script>
// import { BRow, BCol } from 'bootstrap-vue'
import AdminUserApi from '@/api/admin/user'
import AdminApi from '@/api/admin'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
/* eslint-disable global-require */
import { mapState } from 'vuex'

export default {
  components: {
    // BRow,
    // BCol,

  },
  data() {
    return {
      form: {
        id: false,
        name: null,
        email: null,
        phone: null,
        password: null,
        status: 'active',
        // roleEntity: [{ role_id: 0, entity_id: 0 }],
        avatar: '',
        role_id: null,
        entity_id: null,
        // modules: [], // format will be single push {module_id:1,permission:['edit','delete',]}
        // module_permissions: [{
        //   role_id: 0, entity_id: 0, module: [{ module_id: 0, permissions: [] }],
        // }],
      },
      hasUserData: false,
      module_permissions: [],
      modules: [],
      entities: [],
      roles: [],
      errors: {},
      error: null,
      hasUser: false,
      buttonDisabled: false,

    }
  },
  computed: {
    checkPermission() {
      return (index, permission, moduleId) => {
        const modulePermissions = this.form.module_permissions[index].module.findIndex(item => item.module_id === moduleId)
        if (modulePermissions > -1) {
          const module = this.form.module_permissions[index].module[modulePermissions]
          const permissionIndex = module.permissions.findIndex(item => item === permission)
          if (permissionIndex > -1) {
            return true
          }
        }
        return false
      }
    },
    ...mapState(['currentEntity', 'authUser']),
    isSuperAdmin() {
      return this.authUser?.type === 'superadmin'
    },
  },
  watch: {
    currentEntity(newVal) {
      this.form.entity_id = newVal.id
    },
    'form.phone': function (newVal) {
      this.hasUserData = false
      if (newVal.length >= 11) {
        this.getUserViaPhone(newVal)
      }
    },
  },
  mounted() {
    if (!this.isSuperAdmin) {
      this.$router.go(-1)
    }
    this.form.entity_id = this.currentEntity.id
    this.$store.commit('UPDATE_IS_LOADER', true)
    this.getRoles()
    this.getEntites()
    this.getModules()
    this.getModulePermissions()
    this.$store.commit('UPDATE_IS_LOADER', false)
    console.log('this is running for now')
  },
  methods: {
    async getEntites() {
      try {
        const { data: { entities } } = await AdminUserApi.entitesforNewUser()
        this.entities = entities
      } catch (error) {
        console.log(error)
      }
    },
    async getUserViaPhone(phone) {
      try {
        this.$store.commit('UPDATE_IS_LOADER', true)
        const { data: { user } } = await AdminUserApi.getUserViaPhone(phone)
        this.$store.commit('UPDATE_IS_LOADER', false)
        this.hasUserData = true
        this.form.id = user.id
        this.form.name = user.name
        this.form.email = user.email
        this.form.phone = user.phone
        this.form.status = user.status
        this.form.avatar = user.avatar
        // this.form.role_id = user.role.id
      } catch (error) {
        this.$store.commit('UPDATE_IS_LOADER', false)
        console.log(error)
        if (error?.response?.status === 404) {
          this.error = error.response.data.message
        }
      }
    },
    async getRoles() {
      try {
        const { data: { roles } } = await AdminApi.roles()
        this.roles = roles
      } catch (error) {
        console.log(error)
      }
    },
    async getModules() {
      try {
        const { data: { modules } } = await AdminApi.modules()
        this.modules = modules
      } catch (error) {
        console.log(error)
      }
    },
    async getModulePermissions() {
      try {
        const { data: { modulePermissions } } = await AdminApi.permissions()
        this.module_permissions = modulePermissions
      } catch (error) {
        console.log(error)
      }
    },
    addModulePermission(event, module_, permission) {
      const findIndex = this.form.modules.findIndex(item => item.module_id === module_)
      if (event.target.checked) {
        if (findIndex === -1) {
          this.form.modules.push({ module_id: module_, permissions: [permission] })
        } else {
          this.form.modules[findIndex].permissions.push(permission)
        }
      } else if (event.target.checked === false && findIndex > -1) {
        const permissionArray = this.form.modules[findIndex].permissions
        const permissionIndex = permissionArray.findIndex(item => item === permission)
        if (permissionArray.length === 1) {
          this.form.modules.splice(findIndex, 1)
        } else {
          this.form.modules[findIndex].permissions.splice(permissionIndex, 1)
        }
      }
    },

    // add new user methods
    async addNewUser() {
      const formData = this.setFormData()
      this.buttonDisabled = true
      this.$store.commit('UPDATE_IS_LOADER', true)
      AdminUserApi.addNewUser(formData)
        .then(({ data: { message } }) => {
          this.$store.commit('UPDATE_IS_LOADER', false)
          console.log(message)
          this.buttonDisabled = false
          this.resetForm()
          this.$toast({
            component: ToastificationContent,
            props: {
              title: message,
              icon: 'EditIcon',
              variant: 'success',
            },
          })
          this.$router.push({ name: 'Users' })
        })
        .catch(error => {
          this.$store.commit('UPDATE_IS_LOADER', false)
          this.buttonDisabled = false
          console.log(error.response)
          if (error?.response?.status === 422) {
            console.log(error)
            this.errors = error.response.data.errors
          } else if (error?.response?.status === 500) {
            console.log(error.response)
            this.$toast({
              component: ToastificationContent,
              props: {
                title: error.response.data.message,
                icon: 'XCircleIcon',
                variant: 'danger',
              },
            })
          }
        })
    },
    resetForm() {
      // eslint-disable-next-line no-restricted-syntax
      for (const key in this.form) {
        // eslint-disable-next-line no-prototype-builtins
        if (this.form.hasOwnProperty(key)) {
          if (key === 'status') {
            this.form[key] = 'active'
          } else {
            this.form[key] = null
          }
        }
      }
    },
    setFormData() {
      const formData = new FormData()
      // eslint-disable-next-line no-restricted-syntax
      for (const key in this.form) {
        // eslint-disable-next-line no-prototype-builtins
        if (this.form.hasOwnProperty(key)) {
          if (key === 'password') {
            formData.append(key, JSON.stringify(this.form[key]))
          } else {
            formData.append(key, this.form[key])
          }
        }
      }
      return formData
    },
    addavatar(event) {
      console.log(event)
      const file = event.target.files[0]
      this.form.avatar = file
    },
    assignNewPermission() {
      this.form.module_permissions.push({
        role_id: 0, entity_id: 0, module: [{ module_id: 0, permissions: [] }],
      })
      this.form.roleEntity.push({ role_id: 0, entity_id: 0 })
    },
    removePermission(index) {
      this.form.module_permissions.splice(index, 1)
      this.form.roleEntity.splice(index, 1)
    },

    addModule(moduleId, index, permissionId) {
      // first get module permission
      const moduleIndex = this.form.module_permissions.findIndex((_, index1) => index1 === index)
      if (moduleIndex === -1) {
        return
      }
      // if module not exist then add module with permissionId
      const moduleArray = this.form.module_permissions[index].module.findIndex(item => item.module_id === moduleId)

      // if this. form module_permission length is 1
      if (this.form.module_permissions[index] && moduleArray === -1 && this.form.module_permissions[index].module[0].module_id === 0) {
        console.log('running from empty array')
        this.form.module_permissions[index].module[0].module_id = moduleId
        this.form.module_permissions[index].module[0].permissions.push(permissionId)
      } else if (moduleArray === -1) {
        // module not exist then add module to end of the array
        this.form.module_permissions[index].module.push({ module_id: 0, permissions: [] })
        const arrayEnd = this.form.module_permissions[index].module.length - 1
        this.form.module_permissions[index].module[arrayEnd].module_id = moduleId
        // if permission not exist then add permission
        this.form.module_permissions[index].module[arrayEnd].permissions.push(permissionId)
      } else {
        // if module exist then add only permission
        // first check permission exist or not
        const permissionIndex = this.form.module_permissions[index].module[moduleArray].permissions.findIndex(item => item === permissionId)
        // if permission doesn't exist then add permission
        if (permissionIndex === -1) {
          this.form.module_permissions[index].module[moduleArray].permissions.push(permissionId)
        } else {
          // else  if permission exist then remove permission
          // if module permission length 1 then remove module
          const permission = this.form.module_permissions[index].module[moduleArray].permissions.length
          this.form.module_permissions[index].module[moduleArray].permissions.splice(permissionIndex, 1)
          // if permission 1 exist in permissions array and module length is greather then 1 then remove only one module object
          if (permission === 1 && this.form.module_permissions[index].module.length > 1) {
            this.form.module_permissions[index].module.splice(moduleArray, 1)
          } else if (permission === 1 && this.form.module_permissions[index].module.length === 1) {
            // if permission length 1  exist in permissions array but module length is also one then remove module object and replace with new object
            this.form.module_permissions[index].module.splice(moduleArray, 1)
            this.form.module_permissions[index].module.push({ module_id: 0, permissions: [] })
          }
        }
      }
    },
    addRole(event, index) {
      // { role_id: 0, entity_id: 0 }
      console.log(event.target.value)
      this.form.roleEntity[index].role_id = event.target.value
    },
    addEntity(event, index) {
      console.log(event.target.value)
      this.form.roleEntity[index].entity_id = event.target.value
    },
  },
}
/* eslint-disable global-require */
</script>

<style lang="scss" >
@import '@core/scss/vue/pages/page-profile.scss';
</style>
