<script setup lang="ts">
import Button from '@/components/ui/button/Button.vue';
import {
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage
} from '@/components/ui/form'
import Input from '@/components/ui/input/Input.vue';
import { useToast } from '@/components/ui/toast';
import { BaseError } from '@/error/error';
import { login } from '@/lib/api/auth';
import { Login } from '@/lib/api/auth/interface';
import router from '@/router';
import { useAuth } from '@/store/useAuth';
import { toTypedSchema } from '@vee-validate/zod';
import { useForm } from 'vee-validate';
import { ref } from 'vue';
import { z } from 'zod'

const { toast } = useToast()
const { user, setToken ,setUser, isLoggedIn} = useAuth()

const loading = ref(false)

const formSchema = toTypedSchema(z.object({
  email: z.string().email().min(15, { message: "Not enough characters." }),
  password: z.string()
    .min(4, { message: "Pleave provide the correct number of characters. (4 - 16)" })
    .max(15, { message: "Pleave provide the correct number of characters. (4 - 16)" })
}))

const form = useForm({
  validationSchema: formSchema,
})

const onSubmit = form.handleSubmit(async (values) => {
  try {
    loading.value = true
    const request: Login = {
      email: values.email,
      password: values.password
    }

    const response = await login(request)
    setToken(response.token)
    setUser(response.user)
    isLoggedIn.perm = true
    toast({
      title: "Login successful!",
      description: `Hello ${user?.name ?? "and welcome!"}!`
    })
    loading.value = false
    router.push('/')
  } catch (error: any) {
    if (error instanceof BaseError) {
      toast({
        title: "Login error.",
        variant: "destructive",
        description: `${error.message}`
      })
    }
    toast({
      title: "Login error.",
      variant: "destructive",
      description: `Something went wrong!`
    })
    loading.value = false
  }
})
</script>

<template>
  <form @submit="onSubmit" class="flex flex-col gap-5 border border-input w-3/4 h-3/4 p-6 rounded">
    <h1 class="text-4xl text-center">Login</h1>
    <FormField v-slot="{ componentField }" name="email">
      <FormItem class="flex flex-col text-2xl">
        <FormLabel class="text-2xl">Email</FormLabel>
        <FormControl>
          <Input type="text" placeholder="email" class="border border-accent w-full text-2xl" v-bind="componentField" />
        </FormControl>
        <FormMessage />
      </FormItem>
    </FormField>

    <FormField v-slot="{ componentField }" name="password">
      <FormItem class="flex flex-col">
        <FormLabel class="text-2xl">Password</FormLabel>
        <FormControl>
          <Input type="password" placeholder="password" class="border border-accent w-full text-2xl" v-bind="componentField" />
        </FormControl>
        <FormMessage />
      </FormItem>
    </FormField>
    <Button type="submit" class="w-1/6" :disabled='loading'>
      Submit
    </Button>
  </form>
</template>