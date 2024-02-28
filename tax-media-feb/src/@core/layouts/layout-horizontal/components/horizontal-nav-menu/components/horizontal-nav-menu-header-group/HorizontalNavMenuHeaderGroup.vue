<template>
  <li
    v-if="canViewItem"
    class="dropdown nav-item"
    :class="{
      'sidebar-group-active active open': isActive,
      'show': isOpen,

    }"
    @mouseenter="() => updateGroupOpen(true)"
    @mouseleave="() => updateGroupOpen(false)"
  >
    <!-- v-if="canViewHorizontalNavMenuHeaderGroup(item)" -->
    <b-link
      class="nav-link dropdown-toggle d-flex align-items-center"
      :class="{'gradient-primary':item.company}"
    >
      <feather-icon
        size="14"
        :icon="item.icon || ''"
      />
      <span>{{ t(item.header) }}</span>
    </b-link>
    <ul class="dropdown-menu">
      <component
        :is="resolveHorizontalNavMenuItemComponent(child)"
        v-for="child in item.children"
        :key="child.title"
        :item="child"
      />
    </ul>
  </li>
</template>

<script>
import { BLink } from 'bootstrap-vue'
import { resolveHorizontalNavMenuItemComponent } from '@core/layouts/utils'
import { useUtils as useAclUtils } from '@core/libs/acl'
import { useUtils as useI18nUtils } from '@core/libs/i18n'
import { mapState } from 'vuex'
import Permissions from '@/helpers/Permissions'
import useHorizontalNavMenuHeaderGroup from './useHorizontalNavMenuHeaderGroup'
import mixinHorizontalNavMenuHeaderGroup from './mixinHorizontalNavMenuHeaderGroup'

import HorizontalNavMenuGroup from '../horizontal-nav-menu-group/HorizontalNavMenuGroup.vue'
import HorizontalNavMenuLink from '../horizontal-nav-menu-link/HorizontalNavMenuLink.vue'

export default {
  components: {
    BLink,
    HorizontalNavMenuGroup,
    HorizontalNavMenuLink,
  },
  mixins: [mixinHorizontalNavMenuHeaderGroup],
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
    const {
      isActive,
      updateIsActive,
      isOpen,
      updateGroupOpen,
    } = useHorizontalNavMenuHeaderGroup(props.item)

    const { t } = useI18nUtils()
    const { canViewHorizontalNavMenuHeaderGroup } = useAclUtils()

    return {
      isOpen,
      isActive,
      updateGroupOpen,
      updateIsActive,
      resolveHorizontalNavMenuItemComponent,

      // ACL
      canViewHorizontalNavMenuHeaderGroup,

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
    console.log(this.item, 'from dynamic header group')
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
      } else if (item.header === 'Users' && Permissions.viewUserPermission(role_name)) {
        this.canViewItem = true
      } else if (item.header === 'Reports' && Permissions.viewReportsPermissions(role_name)) {
        this.canViewItem = true
      } else {
        this.canViewItem = false
      }
    },
  },
}
</script>
