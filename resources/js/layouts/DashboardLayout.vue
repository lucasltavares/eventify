<template>
  <div class="min-h-screen bg-gray-25">
    <aside class="sidebar" :class="{ 'open': sidebarOpen }">
      <div class="p-6 border-b border-gray-100">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-pink-500 flex items-center justify-center shadow-lg shadow-primary-500/25">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
          </div>
          <span class="text-xl font-bold gradient-text">Eventify</span>
        </div>
      </div>

      <nav class="p-4 space-y-1">
        <Link href="/dashboard" class="nav-item" :class="{ 'active': $page.url === '/dashboard' }">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
          </svg>
          Dashboard
        </Link>

        <Link href="/events" class="nav-item" :class="{ 'active': $page.url.startsWith('/events') }">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
          Meus Eventos
        </Link>
      </nav>

      <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-100">
        <div class="flex items-center gap-3 p-3 rounded-xl bg-gray-50">
          <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary-400 to-pink-400 flex items-center justify-center text-white font-medium">
            {{ user.name.charAt(0).toUpperCase() }}
          </div>
          <div class="flex-1 min-w-0">
            <p class="text-sm font-medium text-gray-900 truncate">{{ user.name }}</p>
            <p class="text-xs text-gray-500 truncate">{{ user.email }}</p>
          </div>
        </div>
        <Link href="/logout" method="post" as="button" class="w-full mt-2 btn-ghost text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
          </svg>
          Sair
        </Link>
      </div>
    </aside>

    <div class="main-content">
      <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-lg border-b border-gray-100">
        <div class="flex items-center justify-between px-6 py-4">
          <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden btn-ghost p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </button>

          <div class="hidden lg:block">
            <h2 class="text-xl font-semibold text-gray-900">{{ pageTitle }}</h2>
          </div>

          <div class="flex items-center gap-4">
            <Link href="/events/create" class="btn-primary btn-md">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
              </svg>
              Novo Evento
            </Link>
          </div>
        </div>
      </header>

      <main class="p-6">
        <slot />
      </main>
    </div>

    <div v-if="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/20 z-30 lg:hidden"></div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const props = defineProps({
  title: String,
});

const sidebarOpen = ref(false);
const page = usePage();
const user = computed(() => page.props.auth.user);
const pageTitle = computed(() => props.title || 'Dashboard');
</script>
