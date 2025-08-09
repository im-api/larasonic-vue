<script setup>
import { useForm } from '@inertiajs/vue3'
import { inject } from 'vue'
import ActionSection from '@/components/ActionSection.vue'
import ConfirmsPassword from '@/components/ConfirmsPassword.vue'
import Button from '@/components/ui/button/Button.vue'

const route = inject('route')
const form = useForm({})

function deleteUser(password) {
  form.transform(data => ({
    ...data,
    password,
  })).delete(route('current-user.destroy'), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
    onFinish: () => form.reset(),
  })
}
</script>

<template>
  <ActionSection>
    <template #title>
      حذف اکانت
    </template>

    <template #description>
      به صورت دائمی حساب خود را حذف کنید
    </template>

    <template #content>
      <div class="max-w-xl text-sm text-gray-600 dark:text-gray-400">
          پس از حذف حساب کاربری شما، تمام منابع و داده‌های آن به طور دائم حذف خواهند شد. قبل از حذف حساب کاربری خود، لطفاً هرگونه داده یا اطلاعاتی را که مایل به حفظ آن هستید، دانلود کنید.      </div>

      <div class="mt-5">
        <ConfirmsPassword
          title="حذف حساب"
          content="آیا از حذف حساب کاربری خود مطمئن هستید؟ پس از حذف حساب کاربری، تمام منابع و داده‌های آن برای همیشه حذف خواهند شد. لطفاً رمز عبور خود را برای تأیید وارد کنید."
          button="حذف شود!"
          @confirmed="deleteUser"
        >
          <Button variant="destructive">
            حذف حساب
          </Button>
        </ConfirmsPassword>
      </div>
    </template>
  </ActionSection>
</template>
