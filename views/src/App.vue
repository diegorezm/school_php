<script setup lang="ts">
import Toaster from '@/components/ui/toast/Toaster.vue'
import Navbar from './components/Navbar.vue';
</script>

<template>
    <Navbar/>
    <main class="flex justify-center items-center px-12 text-base bg-background text-foreground min-h-screen min-w-full">
        <router-view/>
        <Toaster/>
    </main>
</template>
