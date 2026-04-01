<template>
  <DashboardLayout title="Meus Eventos">
    <div class="flex items-center justify-between mb-6">
      <div>
        <h1 class="text-2xl font-bold text-gray-900">Meus Eventos</h1>
        <p class="mt-1 text-gray-500">Gerencie todos os seus eventos</p>
      </div>
      <Link href="/events/create" class="btn-primary btn-md">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Novo Evento
      </Link>
    </div>

    <div v-if="events.data.length > 0" class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
      <div
        v-for="(event, index) in events.data"
        :key="event.id"
        class="event-card animate-fade-in"
        :style="{ animationDelay: `${index * 50}ms` }"
      >
        <div class="flex items-start justify-between">
          <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-primary-100 to-pink-100 flex flex-col items-center justify-center">
            <span class="text-xs font-medium text-primary-600">{{ formatMonth(event.event_date) }}</span>
            <span class="text-xl font-bold text-primary-700">{{ formatDay(event.event_date) }}</span>
          </div>
          <span
            class="badge"
            :class="isUpcoming(event.event_date) ? 'badge-success' : 'badge-primary'"
          >
            {{ isUpcoming(event.event_date) ? 'Próximo' : 'Realizado' }}
          </span>
        </div>

        <h3 class="event-title">{{ event.title }}</h3>
        
        <div v-if="event.location" class="event-location">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
          {{ event.location }}
        </div>

        <div class="event-stats">
          <div class="event-stat">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            {{ event.confirmed_rsvps_count || 0 }} confirmações
          </div>
        </div>

        <div class="flex gap-2 mt-4">
          <Link :href="`/events/${event.id}`" class="btn-secondary btn-sm flex-1">
            Ver detalhes
          </Link>
          <button
            @click="copyLink(event.slug)"
            class="btn-ghost btn-sm"
            title="Copiar link"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
            </svg>
          </button>
        </div>
      </div>
    </div>

    <div v-else class="card p-12">
      <div class="empty-state">
        <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <p class="empty-title">Nenhum evento criado</p>
        <p class="empty-description">Comece criando seu primeiro evento</p>
        <Link href="/events/create" class="btn-primary btn-md mt-4">
          Criar Primeiro Evento
        </Link>
      </div>
    </div>

    <div v-if="events.last_page > 1" class="mt-6 flex justify-center gap-2">
      <Link
        v-for="link in events.links"
        :key="link.label"
        :href="link.url || '#'"
        class="px-4 py-2 rounded-lg text-sm font-medium transition-colors"
        :class="link.active ? 'bg-primary-500 text-white' : 'bg-white text-gray-600 hover:bg-gray-50'"
        :disabled="!link.url"
      >
        <span v-html="link.label"></span>
      </Link>
    </div>
  </DashboardLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import DashboardLayout from '../../layouts/DashboardLayout.vue';

defineProps({
  events: Object,
});

function formatMonth(date) {
  return new Date(date).toLocaleDateString('pt-BR', { month: 'short' }).toUpperCase();
}

function formatDay(date) {
  return new Date(date).getDate();
}

function isUpcoming(date) {
  return new Date(date) >= new Date(new Date().setHours(0, 0, 0, 0));
}

function copyLink(slug) {
  const url = `${window.location.origin}/e/${slug}`;
  navigator.clipboard.writeText(url);
}
</script>
