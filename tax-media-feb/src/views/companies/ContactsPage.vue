<template>

  <section id="dashboard-ecommerce">

    <div class="row match-height">
      <div class="col-12 ">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h2 class="pb-1 mt-3">
              Total Contacts
            </h2>
            <p class="font-weight-bolder text-capitalize">Find all of the entity users
              Contacts and their associate Entity
            </p>
          </div>
          <router-link
            :to="{name:'NewContact'}"
            class="btn btn-primary"
          >
            Add New Contacts
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
                      Contact Name
                    </th>
                    <th width="30%">
                      associate Entity
                    </th>
                    <th width="30%">
                      Address
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
                            <img
                              style="width:60px;height:60px;object-fit:cover"
                              :src="user.avatar"
                              alt="Toolbar svg"
                            >
                          </div>
                        </div>
                        <div class="ml-1">
                          <div class="font-weight-bolder">
                            {{ user.name }}
                          </div>
                          <div class="font-small-2 text-muted">
                            {{ user.email }}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td
                      width="30%"
                    >
                      <p class="text-success">
                        {{ role(user.role) }}
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
                          <b-dropdown-item href="#">
                            Edit Contact
                          </b-dropdown-item>
                          <b-dropdown-item href="#">
                            Settings
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

export default {
  components: {
    BFormCheckbox,
    BDropdownItem,
    BDropdown,
  },
  data() {
    return {
      users: [],
    }
  },
  computed: {
    role() {
      return role => {
        if (role) return role?.role_name
        return 'not assigned'
      }
    },
  },
  mounted() {
    this.getAllContacts()
  },
  methods: {
    async getAllContacts() {
      try {
        const { data: { users } } = await AdminUserApi.users()
        this.users = users
        console.log(this.users)
      } catch (error) {
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
