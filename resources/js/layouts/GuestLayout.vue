<template>
  <div class="page-container">
    <div class="marketing-shell">
      <header class="marketing-hero mb-8">
        <div class="relative z-10 flex flex-col gap-8">
          <nav class="flex items-center justify-between rounded-full bg-gray-900 px-5 py-3 text-white shadow-lg shadow-gray-900/10">
            <div class="flex items-center gap-3">
              <div class="flex h-10 w-10 items-center justify-center rounded-full bg-primary-500 text-sm font-bold text-white">
                E
              </div>
              <div>
                <p class="text-sm font-semibold tracking-[0.18em] text-white/70 uppercase">Eventify</p>
                <p class="text-xs text-white/55">Event planning and guest lists</p>
              </div>
            </div>

            <div class="hidden items-center gap-3 sm:flex">
              <Link href="/login" class="btn-ghost btn-sm text-white/80 hover:bg-white/10 hover:text-white">
                Entrar
              </Link>
              <Link href="/register" class="rounded-full bg-primary-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-primary-400">
                Comece agora
              </Link>
            </div>
          </nav>

          <slot />
        </div>
      </header>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
