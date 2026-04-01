<template>
  <DashboardLayout title="Dashboard">
    <div class="mb-8">
      <h1 class="text-2xl font-bold text-gray-900">Bem-vindo de volta, {{ $page.props.auth.user.name.split(' ')[0] }}!</h1>
      <p class="mt-1 text-gray-500">Aqui está um resumo dos seus eventos</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <div class="stat-card animate-fade-in" style="animation-delay: 0ms">
        <div class="stat-icon bg-primary-100">
          <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
        </div>
        <p class="stat-value">{{ stats.total_events }}</p>
        <p class="stat-label">Total de Eventos</p>
      </div>

      <div class="stat-card animate-fade-in" style="animation-delay: 100ms">
        <div class="stat-icon bg-cyan-100">
          <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
        </div>
        <p class="stat-value">{{ stats.upcoming_events }}</p>
        <p class="stat-label">Eventos Futuros</p>
      </div>

      <div class="stat-card animate-fade-in" style="animation-delay: 200ms">
        <div class="stat-icon bg-pink-100">
          <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
        </div>
        <p class="stat-value">{{ stats.total_rsvps }}</p>
        <p class="stat-label">Total de RSVPs</p>
      </div>

      <div class="stat-card animate-fade-in" style="animation-delay: 300ms">
        <div class="stat-icon bg-success-50">
          <svg class="w-6 h-6 text-success-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
        <p class="stat-value">{{ stats.confirmed_rsvps }}</p>
        <p class="stat-label">Confirmações</p>
      </div>
    </div>

    <div class="card">
      <div class="p-6 border-b border-gray-100">
        <div class="flex items-center justify-between">
          <h2 class="text-lg font-semibold text-gray-900">Eventos Recentes</h2>
          <Link href="/events" class="text-sm font-medium text-primary-600 hover:text-primary-500">
            Ver todos
          </Link>
        </div>
      </div>

      <div v-if="recentEvents.length > 0" class="divide-y divide-gray-100">
        <Link
          v-for="event in recentEvents"
          :key="event.id"
          :href="`/events/${event.id}`"
          class="flex items-center gap-4 p-4 hover:bg-gray-50 transition-colors"
        >
          <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-100 to-pink-100 flex flex-col items-center justify-center">
            <span class="text-xs font-medium text-primary-600">{{ formatMonth(event.event_date) }}</span>
            <span class="text-lg font-bold text-primary-700">{{ formatDay(event.event_date) }}</span>
          </div>
          <div class="flex-1 min-w-0">
            <p class="font-medium text-gray-900 truncate">{{ event.title }}</p>
            <p class="text-sm text-gray-500 truncate">{{ event.location || 'Local a definir' }}</p>
          </div>
          <div class="text-right">
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

      <div v-else class="empty-state p-12">
        <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <p class="empty-title">Nenhum evento ainda</p>
        <p class="empty-description">Crie seu primeiro evento para começar</p>
        <Link href="/events/create" class="btn-primary btn-md mt-4">
          Criar Evento
        </Link>
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
