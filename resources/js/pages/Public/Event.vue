<template>
  <div class="page-container gradient-bg">
    <div class="public-shell">
      <div v-if="$page.props.flash?.success" class="mb-8">
        <div class="card animate-scale-in border-success-200 bg-success-50 p-6">
          <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-success-100 flex items-center justify-center">
              <svg class="w-6 h-6 text-success-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-success-800">Presença confirmada!</h3>
              <p class="text-sm text-success-600">Obrigado por confirmar. Te vemos no evento!</p>
            </div>
          </div>
        </div>
      </div>

      <div class="public-card animate-fade-in shadow-xl">
        <div class="relative h-64" :style="event.cover_image ? { backgroundImage: `url(/storage/${event.cover_image})`, backgroundSize: 'cover', backgroundPosition: 'center' } : {}" :class="event.cover_image ? '' : 'bg-gradient-to-br from-primary-500 via-primary-300 to-cyan-400'">
          <div class="absolute inset-0 bg-gray-900/20"></div>
          <div class="absolute inset-0 flex items-center justify-center" v-if="!event.cover_image">
            <div class="text-center text-white">
              <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-[24px] bg-white/20 backdrop-blur">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
              </div>
              <p class="text-sm font-medium opacity-80">Você está convidado!</p>
            </div>
          </div>
        </div>

        <div class="p-8">
          <div class="text-center mb-8">
            <div class="section-kicker">You are invited</div>
            <h1 class="mt-4 text-4xl font-semibold text-gray-900">{{ event.title }}</h1>
            <p class="mt-3 text-gray-500">Voce foi convidado para este evento especial.</p>
          </div>

          <div class="mb-8 grid gap-6 md:grid-cols-2">
            <div class="card border-0 bg-gray-50 p-4">
              <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-primary-100 flex items-center justify-center">
                  <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                  </svg>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Data</p>
                  <p class="font-semibold text-gray-900">{{ formatFullDate(event.event_date) }}</p>
                </div>
              </div>
            </div>

            <div v-if="event.event_time" class="card border-0 bg-gray-50 p-4">
              <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-pink-100 flex items-center justify-center">
                  <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                  </svg>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Horário</p>
                  <p class="font-semibold text-gray-900">{{ event.event_time }}</p>
                </div>
              </div>
            </div>

            <div v-if="event.location" class="card border-0 bg-gray-50 p-4 md:col-span-2">
              <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-cyan-100 flex items-center justify-center">
                  <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                </div>
                <div>
                  <p class="text-sm text-gray-500">Local</p>
                  <p class="font-semibold text-gray-900">{{ event.location }}</p>
                </div>
              </div>
            </div>
          </div>

          <div v-if="event.description" class="mb-8 rounded-[24px] bg-gray-50 p-6">
            <h3 class="font-semibold text-gray-900 mb-2">Sobre o evento</h3>
            <p class="text-gray-600">{{ event.description }}</p>
          </div>

          <div class="border-t border-gray-100 pt-8">
            <h2 class="mb-6 text-center text-2xl font-bold text-gray-900">
              Confirmar Presença
            </h2>

            <form @submit.prevent="submitRsvp" class="max-w-lg mx-auto space-y-5">
              <div>
                <label class="label">Seu Nome *</label>
                <input
                  v-model="form.name"
                  type="text"
                  class="input"
                  :class="{ 'input-error': form.errors.name }"
                  placeholder="Como você quer ser chamado?"
                  required
                />
                <p v-if="form.errors.name" class="mt-1 text-sm text-error-500">{{ form.errors.name }}</p>
              </div>

              <div>
                <label class="label">Email (opcional)</label>
                <input
                  v-model="form.email"
                  type="email"
                  class="input"
                  :class="{ 'input-error': form.errors.email }"
                  placeholder="seu@email.com"
                />
              </div>

              <div>
                <label class="label">Telefone (opcional)</label>
                <input
                  v-model="form.phone"
                  type="tel"
                  class="input"
                  placeholder="(00) 00000-0000"
                />
              </div>

              <div>
                <label class="label">Quantas pessoas vão? (incluindo você)</label>
                <select v-model="form.guests_count" class="input">
                  <option :value="1">1 pessoa</option>
                  <option :value="2">2 pessoas</option>
                  <option :value="3">3 pessoas</option>
                  <option :value="4">4 pessoas</option>
                  <option :value="5">5 pessoas</option>
                  <option :value="6">6 pessoas</option>
                </select>
              </div>

              <div>
                <label class="label">Mensagem (opcional)</label>
                <textarea
                  v-model="form.message"
                  class="input min-h-[100px]"
                  placeholder="Deixe uma mensagem para os anfitriões..."
                ></textarea>
              </div>

              <button type="submit" class="btn-primary btn-lg w-full" :disabled="form.processing">
                <span v-if="form.processing" class="animate-spin">
                  <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                  </svg>
                </span>
                <span v-else class="flex items-center gap-2">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                  </svg>
                  Confirmar Presença
                </span>
              </button>
            </form>
          </div>
        </div>
      </div>

      <div class="mt-8 text-center">
        <p class="text-sm text-gray-400">
          Feito com
          <span class="gradient-text font-semibold">Eventify</span>
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  event: Object,
  rsvps: Array,
  stats: Object,
});

const form = useForm({
  name: '',
  email: '',
  phone: '',
  guests_count: 1,
  message: '',
});

function formatFullDate(date) {
  return new Date(date).toLocaleDateString('pt-BR', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
}

function submitRsvp() {
  form.post(`/e/${props.event.slug}/rsvp`, {
    preserveScroll: true,
  });
}
</script>
