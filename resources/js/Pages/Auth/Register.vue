<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import { inject } from 'vue'
import InputError from '@/components/InputError.vue'
import AuthenticationCardLogo from '@/components/LogoRedirect.vue'

import Button from '@/components/ui/button/Button.vue'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import Checkbox from '@/components/ui/checkbox/Checkbox.vue'
import Input from '@/components/ui/input/Input.vue'
import Label from '@/components/ui/label/Label.vue'
import { useSeoMetaTags } from '@/composables/useSeoMetaTags.js'

useSeoMetaTags({
  title: 'ثبت نام',
})

const route = inject('route')
const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  terms: false,
})

function submit() {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}
</script>

<template>
  <div class="flex min-h-screen flex-col items-center justify-center">
    <Card class="mx-auto max-w-lg">
      <CardHeader>
        <CardTitle class="flex justify-center">
          <AuthenticationCardLogo />
        </CardTitle>
        <CardDescription class="text-center text-2xl">
            ایجاد حساب کاربری جدید
        </CardDescription>
      </CardHeader>

      <CardContent>
        <form @submit.prevent="submit">
          <div class="grid gap-4">
            <div class="grid gap-2">
              <Label for="name">نام و نام خانوادگی</Label>
              <Input id="name" v-model="form.name" type="text" required autofocus autocomplete="name" />
              <InputError :message="form.errors.name" />
            </div>

            <div class="grid gap-2">
              <Label for="email">آدرس ایمیل</Label>
              <Input dir="ltr" id="email" v-model="form.email" type="email" required autocomplete="username" />
              <InputError :message="form.errors.email" />
            </div>

            <div class="grid gap-2">
              <Label for="password">رمزعبور</Label>
              <Input
                id="password" v-model="form.password" type="password" required
                autocomplete="new-password"
              />
              <InputError :message="form.errors.password" />
            </div>

            <div class="grid gap-2">
              <Label for="password_confirmation">تکرار رمزعبور</Label>
              <Input
                id="password_confirmation" v-model="form.password_confirmation" type="password"
                required autocomplete="new-password"
              />
              <InputError :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end gap-4">
              <Link :href="route('login')" class="text-sm underline">
                    درصورتی که قبلا ثبت نام کردید اینجا کلیک کنید
              </Link>

              <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                ایجاد حساب کاربری
              </Button>
            </div>
          </div>
        </form>
      </CardContent>
    </Card>
  </div>
</template>
