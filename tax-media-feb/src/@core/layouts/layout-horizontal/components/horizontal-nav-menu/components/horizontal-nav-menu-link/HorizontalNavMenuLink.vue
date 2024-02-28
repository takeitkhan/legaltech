<template>
  <li
    v-if="canViewItem"
    :class="{
      'active': isActive,
      'disabled': item.disabled,
    }"
  >
    <!-- v-if="canViewHorizontalNavMenuLink(item)" -->
    <b-link
      v-bind="linkProps"
      class="dropdown-item"
    >
      <feather-icon
        :icon="item.icon || ''"
        size="24"
      />
      <span class="menu-title">{{ t(item.title) }}</span>
    </b-link>
  </li>
</template>

<script>
import { BLink } from 'bootstrap-vue'
import { useUtils as useI18nUtils } from '@core/libs/i18n'
import { useUtils as useAclUtils } from '@core/libs/acl'
import { mapState } from 'vuex'
import Permissions from '@/helpers/Permissions'
import useHorizontalNavMenuLink from './useHorizontalNavMenuLink'
import mixinHorizontalNavMenuLink from './mixinHorizontalNavMenuLink'

export default {
  components: {
    BLink,
  },
  mixins: [mixinHorizontalNavMenuLink],
  props: {
    item: {
      type: Object,
      required: true,
    },
  },
  data: () => ({
    canViewItem: false,
  }),
  setup(props) {
    const { isActive, linkProps, updateIsActive } = useHorizontalNavMenuLink(props.item)

    const { t } = useI18nUtils()
    const { canViewHorizontalNavMenuLink } = useAclUtils()

    return {
      isActive,
      linkProps,
      updateIsActive,

      // ACL
      canViewHorizontalNavMenuLink,

      // i18n
      t,
    }
  },
  computed: {
    ...mapState(['AuthUserEntityRole', 'authUser']),
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
    console.log('menu link', this.item)
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
      } else if (item.title === 'Vat Form 9.1 Form' && Permissions.viewReportNinePointOne(role_name)) {
        this.canViewItem = true
      } else if (item.title === 'Vat Form 9.1 Sub Form' && Permissions.viewReportNinePointOneSubForm(role_name)) {
        this.canViewItem = true
      } else if (item.title === 'User List' && Permissions.viewUserPermission(role_name)) {
        this.canViewItem = true
      } else {
        this.canViewItem = false
      }
    },
  },

}
</script>
