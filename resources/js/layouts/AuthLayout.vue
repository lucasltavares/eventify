<template>
  <div class="page-container gradient-bg">
    <Head :title="pageTitle" />

    <div class="auth-shell">
      <section class="space-y-8 animate-fade-in">
        <div class="section-kicker">Event design studio</div>

        <div class="space-y-5">
          <h1 class="section-title max-w-xl">
            Convites e listas de convidados com aparência premium desde o primeiro clique.
          </h1>
          <p class="section-copy max-w-2xl">
            Crie eventos memoráveis, compartilhe links elegantes e acompanhe confirmações em um painel simples e intuitivo.
          </p>
        </div>

        <div class="grid gap-4 sm:grid-cols-3">
          <div class="glass-panel p-5">
            <p class="text-3xl font-extrabold text-gray-900">1 link</p>
            <p class="mt-2 text-sm text-gray-600">Convide todos com uma página bonita e pronta para celular.</p>
          </div>

          <div class="glass-panel p-5">
            <p class="text-3xl font-extrabold text-gray-900">RSVP</p>
            <p class="mt-2 text-sm text-gray-600">Receba confirmações e mensagens sem complicar a experiência do convidado.</p>
          </div>

          <div class="glass-panel p-5">
            <p class="text-3xl font-extrabold text-gray-900">Painel</p>
            <p class="mt-2 text-sm text-gray-600">Gerencie eventos, banners e lotação com clareza visual.</p>
          </div>
        </div>
      </section>

      <section class="mx-auto w-full max-w-md animate-slide-up">
        <div class="mb-6 text-center">
          <div class="inline-flex items-center justify-center">
            <img src="/logo.png" alt="Eventify" class="h-20 w-60 object-contain" />
          </div>
          <p class="mt-3 text-sm text-gray-500">Uma experiência mais elegante para seus eventos.</p>
        </div>

        <div class="auth-card">
          <slot />
        </div>

        <p class="mt-6 text-center text-sm text-gray-400">
          © 2026 Eventify. Todos os direitos reservados.
        </p>
      </section>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
  title: {
    type: String,
    default: 'Acessar Conta',
  },
});

const pageTitle = computed(() => props.title || 'Acessar Conta');
</script>
