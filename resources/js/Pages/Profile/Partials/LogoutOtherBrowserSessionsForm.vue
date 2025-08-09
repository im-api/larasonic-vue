<script setup>
import { Icon } from '@iconify/vue'
import { useForm } from '@inertiajs/vue3'
import { inject } from 'vue'
import { toast } from 'vue-sonner'
import ActionSection from '@/components/ActionSection.vue'
import ConfirmsPassword from '@/components/ConfirmsPassword.vue'
import Button from '@/components/ui/button/Button.vue'

defineProps({
  sessions: Array,
})

const route = inject('route')
const form = useForm({
  password: '',
})

function logoutOtherBrowserSessions(password) {
  form.transform(data => ({
    ...data,
    password,
  })).delete(route('other-browser-sessions.destroy'), {
    preserveScroll: true,
    onSuccess: () => {
      form.reset()
      toast.success('با موفقیت انجام شد')
    },
    onFinish: () => form.reset(),
  })
}
</script>

<template>
  <ActionSection>
    <template #title>
      سشن های فعال
    </template>

    <template #description>
      مدیریت و خروج از سشن های فعال
    </template>

    <template #content>
      <div class="max-w-xl text-sm ">
          در صورت لزوم، می‌توانید از تمام جلسات مرورگر دیگر خود در تمام دستگاه‌هایتان خارج شوید. برخی از جلسات اخیر شما در زیر فهرست شده‌اند؛ با این حال، این لیست ممکن است کامل نباشد. اگر احساس می‌کنید حساب شما به خطر افتاده است، باید رمز عبور خود را نیز به‌روزرسانی کنید.
      </div>

      <!-- Other Browser Sessions -->
      <div v-if="sessions.length > 0" class="mt-5 space-y-6">
        <div v-for="(session, i) in sessions" :key="i" class="flex items-center">
          <div>
            <Icon v-if="session.agent.is_desktop" icon="lucide:laptop" class="size-8" />
            <Icon v-else icon="lucide:tablet-smartphone" class="size-8" />
          </div>

          <div class="ms-3">
            <div class="text-sm">
              {{ session.agent.platform ? session.agent.platform : 'Unknown' }} - {{ session.agent.browser
                ? session.agent.browser : 'Unknown' }}
            </div>

            <div>
              <div class="text-xs">
                {{ session.ip_address }},

                <span v-if="session.is_current_device" class="font-semibold text-green-400">
                    همین دستگاه
                </span>
                <span v-else>آخرین فعالیت {{ session.last_active }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-5 flex items-center">
        <ConfirmsPassword
          title="خروج از سایر دستگاه ها"
          content="لطفاً رمز عبور خود را وارد کنید تا تأیید کنید که می‌خواهید از سایر جلسات مرورگر خود در تمام دستگاه‌هایتان خارج شوید."
          button="انجام" @confirmed="logoutOtherBrowserSessions"
        >
          <Button>
              خروج از سایر دستگاه ها
          </Button>
        </ConfirmsPassword>
      </div>
    </template>
  </ActionSection>
</template>
