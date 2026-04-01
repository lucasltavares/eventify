<template>
  <DashboardLayout title="Detalhes do Evento">
    <div class="max-w-4xl">
      <div class="mb-6">
        <Link href="/events" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
          </svg>
          Voltar para eventos
        </Link>
      </div>

      <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
          <div class="card p-6">
            <div class="flex items-start justify-between mb-4">
              <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-primary-100 to-pink-100 flex flex-col items-center justify-center">
                  <span class="text-xs font-medium text-primary-600">{{ formatMonth(event.event_date) }}</span>
                  <span class="text-2xl font-bold text-primary-700">{{ formatDay(event.event_date) }}</span>
                </div>
                <div>
                  <h1 class="text-2xl font-bold text-gray-900">{{ event.title }}</h1>
                  <p class="text-gray-500">{{ formatFullDate(event.event_date) }}</p>
                </div>
              </div>
              <div class="flex gap-2">
                <Link :href="`/events/${event.id}/edit`" class="btn-ghost btn-sm">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                  </svg>
                </Link>
                <button @click="confirmDelete" class="btn-ghost btn-sm text-error-500 hover:bg-error-50">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                  </svg>
                </button>
              </div>
            </div>

            <div v-if="event.location" class="flex items-center gap-2 text-gray-600 mb-4">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
              {{ event.location }}
            </div>

            <div v-if="event.event_time" class="flex items-center gap-2 text-gray-600 mb-4">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              {{ event.event_time }}
            </div>

            <div v-if="event.description" class="prose prose-sm text-gray-600 mt-4 pt-4 border-t border-gray-100">
              {{ event.description }}
            </div>
          </div>

          <div class="card">
            <div class="p-4 border-b border-gray-100 flex items-center justify-between">
              <h2 class="font-semibold text-gray-900">Compartilhar evento</h2>
            </div>
            <div class="p-4 space-y-4">
              <div class="flex gap-2">
                <input
                  type="text"
                  :value="eventPublicUrl"
                  readonly
                  class="input flex-1 text-sm"
                />
                <button @click="copyLink" class="btn-ghost btn-md" title="Copiar link">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                  </svg>
                </button>
              </div>
              
              <div class="flex items-center gap-2">
                <button @click="shareWhatsApp" class="share-btn" title="WhatsApp">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                  </svg>
                </button>
                
                <button @click="shareFacebook" class="share-btn" title="Facebook">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                  </svg>
                </button>
                
                <button @click="shareTwitter" class="share-btn" title="X (Twitter)">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                  </svg>
                </button>
                
                <button @click="shareNative" class="share-btn" title="Compartilhar">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="space-y-6">
          <div class="card p-6">
            <h2 class="font-semibold text-gray-900 mb-4">Estatísticas</h2>
            <div class="space-y-4">
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 text-gray-600">
                  <svg class="w-5 h-5 text-success-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                  </svg>
                  Confirmações
                </div>
                <span class="font-semibold text-gray-900">{{ event.rsvps.length }}</span>
              </div>
              <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 text-gray-600">
                  <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                  Total de guests
                </div>
                <span class="font-semibold text-gray-900">{{ totalGuests }}</span>
              </div>
            </div>
          </div>

          <div class="card">
            <div class="p-4 border-b border-gray-100">
              <h2 class="font-semibold text-gray-900">Confirmados</h2>
            </div>
            <div v-if="event.rsvps.length > 0" class="divide-y divide-gray-100 max-h-80 overflow-y-auto">
              <div v-for="rsvp in event.rsvps" :key="rsvp.id" class="p-3">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-400 to-pink-400 flex items-center justify-center text-white text-sm font-medium">
                    {{ rsvp.name.charAt(0).toUpperCase() }}
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">{{ rsvp.name }}</p>
                    <p v-if="rsvp.message" class="text-xs text-gray-500 truncate">{{ rsvp.message }}</p>
                  </div>
                  <span class="badge badge-success text-xs">{{ rsvp.guests_count }} {{ rsvp.guests_count === 1 ? 'pessoa' : 'pessoas' }}</span>
                </div>
              </div>
            </div>
            <div v-else class="p-6 text-center">
              <svg class="w-12 h-12 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
              <p class="mt-2 text-sm text-gray-500">Nenhuma confirmação ainda</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <ConfirmModal
      :show="showDeleteModal"
      title="Excluir evento"
      message="Tem certeza que deseja excluir este evento? Esta ação não pode ser desfeita."
      confirm-text="Excluir"
      @confirm="handleDelete"
      @cancel="showDeleteModal = false"
    />
  </DashboardLayout>
</template>

<script setup>
import { computed, ref } from 'vue';
import { Link, useForm, router } from '@inertiajs/vue3';
import DashboardLayout from '../../layouts/DashboardLayout.vue';
import ConfirmModal from '../../components/ConfirmModal.vue';

const props = defineProps({
  event: Object,
});

const showDeleteModal = ref(false);

const eventPublicUrl = computed(() => `${window.location.origin}/e/${props.event.slug}`);

const totalGuests = computed(() => {
  return props.event.rsvps.reduce((sum, rsvp) => sum + rsvp.guests_count, 0);
});

function formatMonth(date) {
  return new Date(date).toLocaleDateString('pt-BR', { month: 'short' }).toUpperCase();
}

function formatDay(date) {
  return new Date(date).getDate();
}

function formatFullDate(date) {
  return new Date(date).toLocaleDateString('pt-BR', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
}

function copyLink() {
  navigator.clipboard.writeText(eventPublicUrl.value);
}

function shareWhatsApp() {
  const text = encodeURIComponent(`Confa حضورك في ${props.event.title}!\n${eventPublicUrl.value}`);
  window.open(`https://wa.me/?text=${text}`, '_blank');
}

function shareFacebook() {
  const url = encodeURIComponent(eventPublicUrl.value);
  window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
}

function shareTwitter() {
  const text = encodeURIComponent(`Confa حضورك في ${props.event.title}!`);
  const url = encodeURIComponent(eventPublicUrl.value);
  window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank');
}

function shareNative() {
  if (navigator.share) {
    navigator.share({
      title: props.event.title,
      text: `Confa حضورك في ${props.event.title}!`,
      url: eventPublicUrl.value,
    });
  } else {
    copyLink();
  }
}

function confirmDelete() {
  showDeleteModal.value = true;
}

function handleDelete() {
  router.delete(`/events/${props.event.id}`);
}
</script>

<style scoped>
.share-btn {
  @apply w-10 h-10 rounded-xl bg-gray-100 text-gray-600 flex items-center justify-center hover:bg-gray-200 transition-colors;
}
</style>
