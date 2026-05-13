<template>
  <div class="page-container">
    <Head :title="pageTitle" />

    <aside class="sidebar" :class="{ 'open': sidebarOpen }">
      <div class="border-b border-white/10 px-4 pb-5">
        <div class="flex items-center gap-3">
          <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary-500 text-base font-bold text-white shadow-lg shadow-primary-500/20">
            E
          </div>
          <div>
            <p class="text-sm font-semibold tracking-[0.18em] text-white/65 uppercase">Eventify</p>
            <p class="text-sm text-white">Studio de eventos</p>
          </div>
        </div>
      </div>

      <div class="px-4 pt-5">
        <div class="rounded-[24px] border border-white/10 bg-white/5 p-4">
          <p class="text-xs font-semibold uppercase tracking-[0.2em] text-white/45">Workspace</p>
          <p class="mt-3 text-2xl font-bold tracking-tight text-white">{{ user.name.split(' ')[0] }}</p>
          <p class="mt-1 text-sm text-white/60">Organize convites, RSVP e listas com mais estilo.</p>
        </div>
      </div>

      <nav class="space-y-1 p-4">
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

      <div class="absolute bottom-0 left-0 right-0 p-4">
        <div class="rounded-[26px] border border-white/10 bg-white/5 p-3">
          <div class="flex items-center gap-3 rounded-[20px] bg-white/10 p-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-full bg-white text-sm font-bold text-gray-900">
            {{ user.name.charAt(0).toUpperCase() }}
            </div>
            <div class="min-w-0 flex-1">
              <p class="truncate text-sm font-semibold text-white">{{ user.name }}</p>
              <p class="truncate text-xs text-white/55">{{ user.email }}</p>
            </div>
          </div>

          <Link href="/logout" method="post" as="button" class="btn-ghost mt-3 w-full justify-center text-sm text-white/80 hover:bg-white/10 hover:text-white">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
            </svg>
            Sair
          </Link>
        </div>
      </div>
    </aside>

    <div class="main-content">
      <header class="topbar">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
          <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden btn-ghost p-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
          </button>

          <div>
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-gray-400">Painel</p>
            <h2 class="text-2xl font-semibold text-gray-900">{{ pageTitle }}</h2>
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

      <main class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <slot />
      </main>
    </div>

    <div v-if="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-30 bg-black/25 backdrop-blur-sm lg:hidden"></div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const props = defineProps({
  title: String,
});

const sidebarOpen = ref(false);
const page = usePage();
const user = computed(() => page.props.auth.user);
const pageTitle = computed(() => props.title || 'Dashboard');
</script>
