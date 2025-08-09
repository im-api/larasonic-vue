<script setup>
import { useForm } from '@inertiajs/vue3'
import { inject, ref } from 'vue'
import { toast } from 'vue-sonner'
import FormSection from '@/components/FormSection.vue'
import InputError from '@/components/InputError.vue'

import Button from '@/components/ui/button/Button.vue'
import Input from '@/components/ui/input/Input.vue'
import Label from '@/components/ui/label/Label.vue'

const route = inject('route')

const passwordInput = ref(null)
const currentPasswordInput = ref(null)

const form = useForm({
  current_password: '',
  password: '',
  password_confirmation: '',
})

function updatePassword() {
  form.put(route('user-password.update'), {
    errorBag: 'updatePassword',
    preserveScroll: true,
    onSuccess: () => {
      form.reset()
      toast.success('رمزعبور تغییر یافت')
    },
    onError: () => {
      if (form.errors.password) {
        form.reset('password', 'password_confirmation')
        passwordInput.value.focus()
      }

      if (form.errors.current_password) {
        form.reset('current_password')
        currentPasswordInput.value.focus()
      }
    },
  })
}
</script>

<template>
  <FormSection @submitted="updatePassword">
    <template #title>
      تغییر رمزعبور
    </template>

    <template #description>
      مطمئن شوید از رمز قوی و طولانی استفاده میکنید
    </template>

    <template #form>
      <div class="col-span-6 sm:col-span-4">
        <Label for="password">رمزعبور جدید</Label>
        <Input
          id="password" ref="passwordInput" v-model="form.password" type="password"
          class="mt-1 block w-full" autocomplete="new-password"
        />
        <InputError :message="form.errors.password" class="mt-2" />
      </div>

      <div class="col-span-6 sm:col-span-4">
        <Label for="password_confirmation">تکرار رمزعبور جدید</Label>
        <Input
          id="password_confirmation" v-model="form.password_confirmation" type="password"
          class="mt-1 block w-full" autocomplete="new-password"
        />
        <InputError :message="form.errors.password_confirmation" class="mt-2" />
      </div>
    </template>

    <template #actions>
      <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
        ذخیره
      </Button>
    </template>
  </FormSection>
</template>
