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
          Add New Contact
        </h2>

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
              <label for="company">Assign Entity</label>
              <select
                id="entity"
                v-model="form.entity_id"
                name="entity"
                class="form-control"
              >
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
            <div class="form-group">
              <label for="username">Contact Name</label>
              <input
                id="name"
                v-model="form.name"
                type="text"
                class="form-control"
                placeholder="Name"
                name="name"
              >
              <span
                v-if="Object.keys(errors).length > 0 && errors.name"
                class="text-danger"
              >{{ errors.name[0] }}</span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="username">Contact Person</label>
              <input
                id="contact_person"
                v-model="form.contact_person"
                type="text"
                class="form-control"
                placeholder="Contact Person"
              >
              <span
                v-if="Object.keys(errors).length > 0 && errors.name"
                class="text-danger"
              >{{ errors.name[0] }}</span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="nid">NID</label>
              <input
                id="nid"
                v-model="form.nid"
                type="text"
                class="form-control"
                placeholder="National ID Number"
              >
              <span
                v-if="Object.keys(errors).length > 0 && errors.nid"
                class="text-danger"
              >{{ errors.nid[0] }}</span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="bin">Contact Bin</label>
              <input
                id="bin"
                v-model="form.bin"
                type="email"
                class="form-control"
                placeholder="Bin"
              >
              <span
                v-if="Object.keys(errors).length > 0 && errors.bin"
                class="text-danger"
              >{{ errors.bin[0] }}</span>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="phone">Contact Address</label>
              <input
                id="address"
                v-model="form.address"
                type="text"
                class="form-control"
                placeholder="Address"
                name="address"
              >
              <span
                v-if="Object.keys(errors).length > 0 && errors.phone"
                class="text-danger"
              >{{ errors.phone[0] }}</span>
            </div>
          </div>
          <div class="col-12 d-flex flex-sm-row flex-column mt-2">
            <button
              type="submit"
              class="btn btn-primary mb-1 mb-sm-0 mr-0 mr-sm-1 waves-effect waves-float waves-light"
              :disabled="buttonDisabled"
              @click.prevent="addNewUser"
              v-text="buttonDisabled?'Please Wait':'Add New Contact'"
            />
            <button
              type="reset"
              class="btn btn-outline-secondary waves-effect"
            >
              Reset
            </button>
          </div>
        </div>
      </form>
      <!-- users edit account form ends -->
    </div>
  </div>
</template>

<script>
// import { BRow, BCol } from 'bootstrap-vue'
import AdminUserApi from '@/api/admin/user'
import AdminContactApi from '@/api/admin/contact'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'
/* eslint-disable global-require */
export default {
  components: {
    // BRow,
    // BCol,

  },
  data() {
    return {
      form: {
        name: null,
        bin: null,
        contact_person: null,
        entity_id: null,
        nid: null,
        address: null,
      },
      entities: [],
      errors: {},
      buttonDisabled: false,
    }
  },
  created() {
    // this.$http.get('/profile/data').then(res => { this.profileData = res.data })
  },
  mounted() {
    this.getEntites()
  },
  methods: {
    async getEntites() {
      try {
        const { data: { entities } } = await AdminUserApi.entitesforNewUser()
        this.entities = entities
      } catch {
        console.log('some error')
      }
    },

    // add new user methods
    async addNewUser() {
      const formData = this.setFormData()
      this.buttonDisabled = true
      AdminContactApi.store(formData)
        .then(({ data: { message } }) => {
          console.log(message)
          this.buttonDisabled = false
          this.$toast({
            component: ToastificationContent,
            props: {
              title: message,
              icon: 'EditIcon',
              variant: 'success',
            },
          })
        })
        .catch(error => {
          this.buttonDisabled = false
          if (error.response.status === 422) {
            console.log(error)
            this.errors = error.response.data.errors
          } else {
            this.$toast({
              component: ToastificationContent,
              props: {
                title: 'Some Error Occured',
                icon: 'EditIcon',
                variant: 'error',
              },
            })
          }
        })
    },
    setFormData() {
      const formData = new FormData()
      // eslint-disable-next-line no-restricted-syntax
      for (const key in this.form) {
        // eslint-disable-next-line no-prototype-builtins
        if (this.form.hasOwnProperty(key)) {
          if (key === 'modules') {
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
  },
}
/* eslint-disable global-require */
</script>

<style lang="scss" >
@import '@core/scss/vue/pages/page-profile.scss';
</style>
