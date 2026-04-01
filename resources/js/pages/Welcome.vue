<template>
  <GuestLayout>
    <div class="text-center mb-8">
      <h1 class="text-4xl font-bold text-gray-900">
        Crie eventos <span class="gradient-text">incríveis</span>
      </h1>
      <p class="mt-4 text-lg text-gray-600">
        Convites digitais elegantes para casamentos, aniversário e muito mais
      </p>
    </div>

    <div class="space-y-4">
      <Link href="/register" class="btn-primary btn-lg w-full justify-center">
        Começar Gratuitamente
      </Link>
      <Link href="/login" class="btn-secondary btn-lg w-full justify-center">
        Já tenho conta
      </Link>
    </div>

    <div class="mt-12 grid grid-cols-3 gap-6 text-center">
      <div class="p-4">
        <div class="w-12 h-12 mx-auto rounded-xl bg-primary-100 flex items-center justify-center">
          <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
          </svg>
        </div>
        <p class="mt-3 text-sm font-medium text-gray-900">Crie em segundos</p>
        <p class="mt-1 text-xs text-gray-500">Sem complicação</p>
      </div>
      <div class="p-4">
        <div class="w-12 h-12 mx-auto rounded-xl bg-pink-100 flex items-center justify-center">
          <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
          </svg>
        </div>
        <p class="mt-3 text-sm font-medium text-gray-900">Compartilhe fácil</p>
        <p class="mt-1 text-xs text-gray-500">Link único</p>
      </div>
      <div class="p-4">
        <div class="w-12 h-12 mx-auto rounded-xl bg-cyan-100 flex items-center justify-center">
          <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
        <p class="mt-3 text-sm font-medium text-gray-900">RSVP confirmado</p>
        <p class="mt-1 text-xs text-gray-500">Sem login</p>
      </div>
    </div>
  </GuestLayout>
</template>

<script setup>
import GuestLayout from '../layouts/GuestLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>
