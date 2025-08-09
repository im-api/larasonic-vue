<script setup>
import { Icon } from '@iconify/vue'
import { Link, usePage } from '@inertiajs/vue3'
import { useColorMode } from '@vueuse/core'
import { computed, inject } from 'vue'
import {
  SidebarContent,
  SidebarGroup,
  SidebarGroupLabel,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
} from '@/components/ui/sidebar'

const route = inject('route')
const mode = useColorMode({
  attribute: 'class',
  modes: { light: '', dark: 'dark' },
})

const navigationConfig = [
  {
    label: 'پلتفرم',
    items: [
      { name: 'داشبورد', icon: 'lucide:layout-dashboard', route: 'dashboard' },
      { name: 'تنظیمات', icon: 'lucide:settings', route: 'profile.show' },
    ],
  },
  {
    label: 'وب سرویس',
    items: [
      { name: 'توکن وب سرویس', icon: 'lucide:key', route: 'api-tokens.index' },
      { name: 'داکیومنت وب سرویس', icon: 'lucide:book-heart', route: 'scribe', external: true },
    ],
  },
  {
    label: 'مدیریت (ادمین)',
    items: [
      { name: 'صفحه ساده ادمین', icon: 'lucide:shield-ellipsis', route: 'admin.simple-admin' },
    ],
  },
  {
    label: null,
    class: 'mt-auto',
    items: [
      {
        name: 'پشتیبانی',
        icon: 'lucide:life-buoy',
        href: '#',
        external: true,
      },
    ],
  },
]

const isDarkMode = computed(() => mode.value === 'dark')
const page = usePage()
const isAdmin = computed(() => page.props.auth.isAdmin)
const filteredNavigationConfig = computed(() => {
  return navigationConfig.filter((group) => {
    return !(group.label === 'Admin' && !isAdmin.value)
    // include everything else
  })
})
function renderLink(item) {
  if (item.external) {
    return {
      is: 'a',
      href: item.href || route(item.route),
      target: '_blank',
    }
  }
  return {
    is: Link,
    href: route(item.route),
  }
}
</script>

<template>
  <SidebarContent>
    <SidebarGroup v-for="(group, index) in filteredNavigationConfig" :key="index" :class="group.class">
      <SidebarGroupLabel v-if="group.label">
        {{ group.label }}
      </SidebarGroupLabel>
      <SidebarMenu>
        <SidebarMenuItem
          v-for="item in group.items"
          :key="item.name"
          :class="{ 'font-semibold text-primary bg-secondary rounded': !item.external && route().current(item.route) }"
        >
          <SidebarMenuButton as-child>
            <component v-bind="renderLink(item)" :is="item.external ? 'a' : Link" prefetch>
              <Icon :icon="item.icon" />
              {{ item.name }}
            </component>
          </SidebarMenuButton>
        </SidebarMenuItem>
        <SidebarMenuItem v-if="index === navigationConfig.length - 1">
          <SidebarMenuButton @click="mode = isDarkMode ? 'light' : 'dark'">
            <Icon :icon="isDarkMode ? 'lucide:moon' : 'lucide:sun'" />
              حالت
            {{ isDarkMode ? 'تاریک' : 'روشن' }}
          </SidebarMenuButton>
        </SidebarMenuItem>
      </SidebarMenu>
    </SidebarGroup>
  </SidebarContent>
</template>
