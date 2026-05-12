<template>
  <GuestLayout>
    <section class="relative z-10 grid gap-10 lg:grid-cols-[1.15fr_0.85fr] lg:items-center">
      <div class="space-y-8">
        <div class="section-kicker">Create events that feel considered</div>

        <div class="space-y-6">
          <h1 class="section-title max-w-3xl">
            Convites digitais para eventos com estética editorial e confirmação sem atrito.
          </h1>
          <p class="section-copy max-w-2xl">
            Ideal para aniversários, casamentos, eventos corporativos e listas VIP. Monte sua página, publique em minutos e acompanhe cada resposta com clareza.
          </p>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row">
          <Link href="/register" class="btn-primary btn-lg justify-center">
            Começar gratuitamente
          </Link>
          <Link href="/login" class="btn-secondary btn-lg justify-center">
            Já tenho conta
          </Link>
        </div>

        <div class="grid gap-4 sm:grid-cols-3">
          <div class="glass-panel p-5">
            <div class="flex h-12 w-12 items-center justify-center rounded-[18px] bg-primary-100 text-primary-700">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
              </svg>
            </div>
            <p class="mt-4 text-base font-bold text-gray-900">Fluxo rápido</p>
            <p class="mt-2 text-sm text-gray-600">Crie a página do evento em poucos minutos.</p>
          </div>

          <div class="glass-panel p-5">
            <div class="flex h-12 w-12 items-center justify-center rounded-[18px] bg-pink-100 text-pink-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
              </svg>
            </div>
            <p class="mt-4 text-base font-bold text-gray-900">Compartilhamento elegante</p>
            <p class="mt-2 text-sm text-gray-600">Um link bonito para enviar no WhatsApp, email ou redes.</p>
          </div>

          <div class="glass-panel p-5">
            <div class="flex h-12 w-12 items-center justify-center rounded-[18px] bg-cyan-100 text-cyan-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <p class="mt-4 text-base font-bold text-gray-900">RSVP intuitivo</p>
            <p class="mt-2 text-sm text-gray-600">Convidados confirmam presença sem criar conta.</p>
          </div>
        </div>
      </div>

      <div class="panel relative overflow-hidden p-6 sm:p-7">
        <div class="absolute inset-x-0 top-0 h-48 bg-gradient-to-br from-primary-200/80 via-primary-50 to-cyan-100"></div>

        <div class="relative space-y-6">
          <div class="rounded-[28px] bg-gray-900 p-5 text-white shadow-xl">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-xs uppercase tracking-[0.18em] text-white/55">Preview</p>
                <h2 class="mt-2 text-2xl font-semibold text-white">Sunset Garden Party</h2>
              </div>
              <div class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-primary-200">
                124 convidados
              </div>
            </div>

            <div class="mt-6 grid gap-3 sm:grid-cols-2">
              <div class="rounded-[22px] bg-white/10 p-4">
                <p class="text-xs uppercase tracking-[0.14em] text-white/50">Data</p>
                <p class="mt-2 text-lg font-semibold">18 setembro</p>
                <p class="text-sm text-white/60">Sexta, 19h30</p>
              </div>
              <div class="rounded-[22px] bg-white/10 p-4">
                <p class="text-xs uppercase tracking-[0.14em] text-white/50">Local</p>
                <p class="mt-2 text-lg font-semibold">Casa Solar</p>
                <p class="text-sm text-white/60">Jardins, Sao Paulo</p>
              </div>
            </div>
          </div>

          <div class="grid gap-4 sm:grid-cols-2">
            <div class="card p-5">
              <p class="text-sm font-semibold uppercase tracking-[0.18em] text-gray-400">Confirmacoes</p>
              <p class="mt-4 text-4xl font-extrabold text-gray-900">92%</p>
              <p class="mt-2 text-sm text-gray-600">Acompanhe respostas, acompanhantes e mensagens especiais.</p>
            </div>

            <div class="card p-5">
              <p class="text-sm font-semibold uppercase tracking-[0.18em] text-gray-400">Experiencia</p>
              <p class="mt-4 text-2xl font-bold text-gray-900">Bonita no desktop e no celular</p>
              <p class="mt-2 text-sm text-gray-600">Uma identidade visual coerente do convite ao painel.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="relative z-10 mt-10 grid gap-4 md:grid-cols-3">
      <div class="card p-6">
        <p class="text-4xl font-extrabold text-gray-900">3x</p>
        <p class="mt-2 text-base font-semibold text-gray-900">Mais organização visual</p>
        <p class="mt-2 text-sm text-gray-600">Painel claro para saber o que está publicado, lotado ou pendente.</p>
      </div>
      <div class="card p-6">
        <p class="text-4xl font-extrabold text-gray-900">1 clique</p>
        <p class="mt-2 text-base font-semibold text-gray-900">Para compartilhar o link</p>
        <p class="mt-2 text-sm text-gray-600">Distribua o convite sem depender de PDF ou grupos confusos.</p>
      </div>
      <div class="card p-6">
        <p class="text-4xl font-extrabold text-gray-900">Zero friccao</p>
        <p class="mt-2 text-base font-semibold text-gray-900">Na confirmacao dos convidados</p>
        <p class="mt-2 text-sm text-gray-600">Experiencia simples, direta e preparada para qualquer tipo de evento.</p>
      </div>
    </section>
  </GuestLayout>
</template>

<script setup>
import GuestLayout from '../layouts/GuestLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>
