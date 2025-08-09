<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import {
    Card,
    CardAction,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
import { Separator } from "@/components/ui/separator"
import { Alert, AlertDescription, AlertTitle } from "@/components/ui/alert"
import { BadgeInfo,Drum  } from 'lucide-vue-next';
</script>

<template>
    <AppLayout title="داشبورد">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight">
                داشبورد
            </h2>
        </template>
        <div>
            <div>
                <Alert>
                    <BadgeInfo size="100" />
                    <AlertTitle>درجریان باش!</AlertTitle>
                    <AlertDescription>
                        میتونی با استفاده از داکیومنت Tailwind و Shadcn/ui کامپوننت های جدید ایجاد کنی!
                    </AlertDescription>
                </Alert>
                <Alert class="mt-3">
                    <Drum  />
                    <AlertTitle>
                        قرار یه چیز خفن باهم بسازیم 😉
                    </AlertTitle>
                </Alert>
            </div>
            <Separator class="mt-5 mb-5" />
            <div class="grid grid-cols-4 gap-4">

                <div>
                    <Card>
                        <CardHeader>
                            <CardTitle>کاربران</CardTitle>
                            <CardDescription>تعداد کل کاربران</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <p>0</p>
                        </CardContent>
                    </Card>
                </div>
                <div>
                    <Card>
                        <CardHeader>
                            <CardTitle>کاربران</CardTitle>
                            <CardDescription>تعداد کل کاربران</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <p>0</p>
                        </CardContent>
                    </Card>
                </div>
                <div>
                    <Card>
                        <CardHeader>
                            <CardTitle>کاربران</CardTitle>
                            <CardDescription>تعداد کل کاربران</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <p>0</p>
                        </CardContent>

                    </Card>
                </div>
                <div>
                    <Card>
                        <CardHeader>
                            <CardTitle>کاربران</CardTitle>
                            <CardDescription>تعداد کل کاربران</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <p>0</p>
                        </CardContent>
                    </Card>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
