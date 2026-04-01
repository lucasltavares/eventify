<template>
  <AuthLayout>
    <h2 class="text-2xl font-bold text-gray-900 text-center">Bem-vindo de volta</h2>
    <p class="mt-2 text-sm text-gray-500 text-center">Entre para gerenciar seus eventos</p>

    <form @submit.prevent="form.post('/login')" class="mt-8 space-y-5">
      <div>
        <label class="label">Email</label>
        <input
          v-model="form.email"
          type="email"
          class="input"
          :class="{ 'input-error': form.errors.email }"
          placeholder="seu@email.com"
          required
        />
        <p v-if="form.errors.email" class="mt-1 text-sm text-error-500">{{ form.errors.email }}</p>
      </div>

      <div>
        <label class="label">Senha</label>
        <input
          v-model="form.password"
          type="password"
          class="input"
          :class="{ 'input-error': form.errors.password }"
          placeholder="••••••••"
          required
        />
        <p v-if="form.errors.password" class="mt-1 text-sm text-error-500">{{ form.errors.password }}</p>
      </div>

      <div class="flex items-center justify-between">
        <label class="flex items-center gap-2">
          <input v-model="form.remember" type="checkbox" class="w-4 h-4 rounded border-gray-300 text-primary-500 focus:ring-primary-500" />
          <span class="text-sm text-gray-600">Lembrar-me</span>
        </label>
      </div>

      <button type="submit" class="btn-primary btn-lg w-full" :disabled="form.processing">
        <span v-if="form.processing" class="animate-spin">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
          </svg>
        </span>
        <span v-else>Entrar</span>
      </button>
    </form>

    <p class="mt-6 text-center text-sm text-gray-500">
      Não tem conta? 
      <Link href="/register" class="font-medium text-primary-600 hover:text-primary-500">Criar conta</Link>
    </p>
  </AuthLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import AuthLayout from '../../layouts/AuthLayout.vue';

const form = useForm({
  email: '',
  password: '',
  remember: false,
});
</script>
