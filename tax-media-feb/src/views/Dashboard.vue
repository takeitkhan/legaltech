<template>

  <section id="dashboard-ecommerce">

    <div class="row match-height">
      <!-- Company Table Card -->
      <div class="col-lg-12 col-12">
        <div class="card card-company-table">
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table ">
                <thead>
                  <tr>
                    <th width="20%">
                      Company Name
                    </th>
                    <th width="30%">
                      Assign Users
                    </th>
                    <th width="30%">
                      progress
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
                    v-for="entity in entities"
                    :key="entity.id"
                  >

                    <td width="20%">
                      <router-link
                        class="text-secondary btn"
                        :to="{name:'CompanyPage',params:{companyId:entity.id}}"
                      >
                        <div class="d-flex align-items-center">

                          <div class="avatar rounded rounded-circle">
                            <div
                              class="avatar-content"
                              style="width:60px;height:60px;"
                            >
                              <img
                                style="width:60px;height:60px;object-fit:contain"
                                :src="entity.company_logo"
                                :alt="entity.name"
                              >
                            </div>
                          </div>

                          <div class="ml-1">
                            <div class="font-weight-bolder">
                              {{ entity.name }}
                            </div>
                            <div class="font-small-2 text-muted">
                              {{ entity.address }}
                            </div>
                          </div>
                        </div>
                      </router-link>
                    </td>
                    <td
                      width="30%"
                    >
                      <div class="d-flex align-items-center justify-content-center">
                        <div
                          v-for="user in entity.users"
                          :key="user.id+user.phone"
                        >
                          <router-link
                            :to="{name:'User',params:{userId:user.id}}"
                          >
                            <img
                              style="width:40px;height:40px;margin-left:-10px;"
                              class="rounded-circle"
                              :src="user.avatar"
                              :alt="user.name"
                            >
                          </router-link>
                        </div>
                      </div>
                    </td>
                    <td
                      width="30%"
                      style="text-align:left;padding-right:10%"
                    >
                      <div class=" d-flex">
                        <p style="width: 20%">
                          OverAll
                        </p>
                        <div
                          class="progress progress-bar-primary"
                          style="width:50%;margin-top:5px;"
                        >

                          <div
                            class="progress-bar"
                            role="progressbar"
                            aria-valuenow="50"
                            aria-valuemin="50"
                            aria-valuemax="100"
                            style="width: 100%"
                            aria-describedby="example-caption-3"
                          />
                        </div>
                      </div>
                    </td>
                    <td
                      width="20%"
                      style="text-align:left;padding-left:0px"
                    >
                      <div class="d-flex align-items-center justify-content-start">
                        <button class="text-secondary btn">
                          <mdicon
                            size="18"
                            class="font-weight-bold"
                            name="navigation-variant-outline"
                          />
                        </button>
                        <router-link
                          class="text-secondary btn"
                          :to="{name:'CompanyPage',params:{companyId:entity.id}}"
                        >
                          <mdicon
                            size="18"
                            class="font-weight-bold"
                            name="eye"
                          />
                        </router-link>

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
                            Edit Company
                          </b-dropdown-item>
                          <b-dropdown-item href="#">
                            Users
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
      <!--/ Company Table Card -->

    </div>
  </section>

</template>

<script>
import {
  BDropdown, BDropdownItem,
} from 'bootstrap-vue'
import AdminEntityApi from '@/api/admin/entity'
import { mapState } from 'vuex'

export default {
  components: {
    // BCard,
    // BCardText,
    // BLink,
    // BProgress,
    BDropdownItem, BDropdown,
  },

  data() {
    return {
      entities: [],
    }
  },
  mounted() {
    this.getAllEntities()
  },
  methods: {
    async getAllEntities() {
      try {
        // start
        this.$store.commit('UPDATE_IS_LOADER', true)
        const { data: { entities } } = await AdminEntityApi.entities()
        this.$store.commit('UPDATE_IS_LOADER', false)
        this.entities = entities
        console.log(this.entities)
      } catch (error) {
        this.$store.commit('UPDATE_IS_LOADER', false)
        console.log(error)
      }
    },
  },
}
</script>

<style>

</style>
