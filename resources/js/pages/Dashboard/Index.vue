<template>
  <DashboardLayout title="Dashboard">
    <section class="mb-8 grid gap-6 lg:grid-cols-[1.3fr_0.7fr]">
      <div class="panel relative overflow-hidden px-6 py-8 sm:px-8">
        <div class="absolute inset-y-0 right-0 w-1/2 bg-gradient-to-l from-primary-100/80 to-transparent"></div>
        <div class="relative">
          <div class="section-kicker">Overview</div>
          <h1 class="mt-5 max-w-2xl text-4xl font-semibold text-gray-900">
            Bem-vindo de volta, {{ $page.props.auth.user.name.split(' ')[0] }}.
          </h1>
          <p class="mt-4 max-w-2xl text-base leading-7 text-gray-600">
            Aqui estao seus eventos, confirmacoes e proximos compromissos em um resumo mais claro e direto.
          </p>
        </div>
      </div>

      <div class="card p-6">
        <p class="text-sm font-semibold uppercase tracking-[0.18em] text-gray-400">Pronto para publicar?</p>
        <h2 class="mt-3 text-2xl font-bold text-gray-900">Crie uma nova pagina de convite</h2>
        <p class="mt-3 text-sm leading-6 text-gray-600">
          Configure data, local, capa e mensagem para seus convidados em um unico fluxo.
        </p>
        <Link href="/events/create" class="btn-primary btn-md mt-6">
          Novo evento
        </Link>
      </div>
    </section>

    <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-4">
      <div class="stat-card animate-fade-in" style="animation-delay: 0ms">
        <div class="stat-icon bg-primary-100 text-primary-700">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
        </div>
        <p class="stat-value">{{ stats.total_events }}</p>
        <p class="stat-label">Total de eventos</p>
      </div>

      <div class="stat-card animate-fade-in" style="animation-delay: 100ms">
        <div class="stat-icon bg-cyan-100 text-cyan-600">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
        </div>
        <p class="stat-value">{{ stats.upcoming_events }}</p>
        <p class="stat-label">Eventos futuros</p>
      </div>

      <div class="stat-card animate-fade-in" style="animation-delay: 200ms">
        <div class="stat-icon bg-pink-100 text-pink-600">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
        </div>
        <p class="stat-value">{{ stats.total_rsvps }}</p>
        <p class="stat-label">Total de RSVPs</p>
      </div>

      <div class="stat-card animate-fade-in" style="animation-delay: 300ms">
        <div class="stat-icon bg-success-50 text-success-600">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
        <p class="stat-value">{{ stats.confirmed_rsvps }}</p>
        <p class="stat-label">Confirmacoes</p>
      </div>
    </div>

    <div class="card">
      <div class="flex items-center justify-between border-b border-gray-100 p-6">
        <div>
          <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-400">Recentes</p>
          <h2 class="mt-2 text-2xl font-bold text-gray-900">Eventos recentes</h2>
        </div>
        <Link href="/events" class="text-sm font-medium text-primary-600 hover:text-primary-500">
          Ver todos
        </Link>
      </div>

      <div v-if="recentEvents.length > 0" class="divide-y divide-gray-100">
        <Link
          v-for="event in recentEvents"
          :key="event.id"
          :href="`/events/${event.id}`"
          class="flex items-center gap-4 p-5 transition-colors hover:bg-primary-50/60"
        >
          <div class="flex h-14 w-14 flex-col items-center justify-center rounded-[20px] bg-gradient-to-br from-primary-100 to-pink-100">
            <span class="text-xs font-medium text-primary-600">{{ formatMonth(event.event_date) }}</span>
            <span class="text-lg font-bold text-primary-700">{{ formatDay(event.event_date) }}</span>
          </div>
          <div class="min-w-0 flex-1">
            <p class="truncate font-medium text-gray-900">{{ event.title }}</p>
            <p class="truncate text-sm text-gray-500">{{ event.location || 'Local a definir' }}</p>
          </div>
          <div class="text-right">
            <div class="mb-2">
              <span :class="event.status === 'finished' ? 'badge badge-primary' : 'badge badge-success'">
                {{ event.status === 'finished' ? 'Finalizado' : 'Próximo' }}
              </span>
            </div>
            <div class="flex items-center gap-1 text-sm">
              <svg class="w-4 h-4 text-success-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
              </svg>
              <span class="font-medium text-gray-900">{{ event.confirmed_rsvps_count || 0 }}</span>
              <span class="text-gray-500">confirmados</span>
            </div>
          </div>
        </Link>
      </div>

      <div v-else class="p-6">
        <div class="empty-state">
          <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
          <p class="empty-title">Nenhum evento ainda</p>
          <p class="empty-description">Crie seu primeiro evento para começar</p>
          <Link href="/events/create" class="btn-primary btn-md mt-4">
            Criar evento
          </Link>
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import DashboardLayout from '../../layouts/DashboardLayout.vue';

defineProps({
  stats: Object,
  recentEvents: Array,
});

function formatMonth(date) {
  return new Date(date).toLocaleDateString('pt-BR', { month: 'short' }).toUpperCase();
}

function formatDay(date) {
  return new Date(date).getDate();
}
</script>
