/* eslint-disable camelcase */
<template>
  <li
    v-if="canViewItem"
    class="nav-item"
    :class="{'sidebar-group-active active': isActive}"
  >
    <!-- v-if="canViewHorizontalNavMenuHeaderLink(item)" -->
    <b-link
      class="nav-link"
      :to="{ name: item.route }"
    >
      <feather-icon
        size="14"
        :icon="item.icon"
      />
      <span>{{ t(item.title) }}</span>
    </b-link>
  </li>
</template>

<script>
import { BLink } from 'bootstrap-vue'
import { useUtils as useI18nUtils } from '@core/libs/i18n'
import { useUtils as useAclUtils } from '@core/libs/acl'
import Permissions from '@/helpers/Permissions'
import { mapState } from 'vuex'
import useHorizontalNavMenuHeaderLink from './useHorizontalNavMenuHeaderLink'
import mixinHorizontalNavMenuHeaderLink from './mixinHorizontalNavMenuHeaderLink'

export default {
  components: {
    BLink,
  },
  mixins: [mixinHorizontalNavMenuHeaderLink],
  props: {
    item: {
      type: Object,
      required: true,
    },
  },
  data: () => ({
    canViewItem: false,
  }),
  computed: {
    ...mapState(['AuthUserEntityRole', 'authUser']),
  },
  setup(props) {
    const { isActive, updateIsActive } = useHorizontalNavMenuHeaderLink(props.item)

    const { t } = useI18nUtils()
    const { canViewHorizontalNavMenuHeaderLink } = useAclUtils()

    return {
      isActive,
      updateIsActive,

      // ACL
      canViewHorizontalNavMenuHeaderLink,

      // i18n
      t,
    }
  },
  watch: {
    AuthUserEntityRole() {
      this.canViewLink(this.item)
    },
    authUser() {
      this.canViewLink(this.item)
    },
  },
  mounted() {
    console.log(this.item, 'from can view Link')
    this.canViewLink(this.item)
  },
  methods: {
    canViewLink(item) {
      // eslint-disable-next-line camelcase
      const { role_name = null } = this.AuthUserEntityRole
      // eslint-disable-next-line camelcase
      if (role_name == null) {
        this.canViewItem = false
      }
      if (this.authUser?.type === 'superadmin') {
        this.canViewItem = true
      } else if (item.title === 'Users' && Permissions.viewUserPermission(role_name)) {
        this.canViewItem = true
      } else if (item.title === 'Docs' && Permissions.viewDocsPagePermission(role_name)) {
        this.canViewItem = true
      } else if (item.title === 'Dashboard') {
        this.canViewItem = true
      } else {
        this.canViewItem = false
      }
    },
  },
}
</script>
