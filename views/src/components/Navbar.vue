<script setup lang="ts">
import { useAuth } from '@/store/useAuth';
import Button from './ui/button/Button.vue';
import router from '@/router';
import { toast } from './ui/toast/use-toast';

const { isLoggedIn, logout } = useAuth()
const handleLogout = () => {
  logout()
  toast({
      title: "logout successful!",
    })
  router.push('/login')
}
</script>

<template>
  <nav class="flex align-middle p-2 pr-4 shadow-lg">
    <ul class="flex flex-row items-center justify-end w-full gap-2 text-xl">
      <li v-if="isLoggedIn.perm">
        <Button variant="outline">
          <RouterLink to="/">
            Dashboard
          </RouterLink>
        </Button>
      </li>
      <li v-if="isLoggedIn.perm">
        <Button @click="handleLogout">Logout</Button>
      </li>
      <li v-else>
        <Button variant="outline">
          <RouterLink to="/login">
            Login
          </RouterLink>
        </Button>
      </li>
    </ul>
  </nav>
</template>
