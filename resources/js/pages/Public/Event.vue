<template>
  <div class="page-container gradient-bg">
    <Head :title="event.title" />

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

      <div v-if="$page.props.errors?.event" class="mb-8">
        <div class="card border-error-200 bg-error-50 p-6">
          <div class="flex items-center gap-4">
            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-error-100">
              <svg class="h-6 w-6 text-error-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <div>
              <h3 class="font-semibold text-error-800">Confirmações encerradas</h3>
              <p class="text-sm text-error-600">{{ $page.props.errors.event }}</p>
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
              {{ isFinished ? 'Confirmações encerradas' : 'Confirmar Presença' }}
            </h2>

            <div v-if="isFinished" class="mx-auto max-w-lg rounded-[24px] bg-gray-50 p-6 text-center">
              <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-gray-200 text-gray-600">
                <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
              </div>
              <p class="font-semibold text-gray-900">Este evento já foi finalizado.</p>
              <p class="mt-2 text-sm text-gray-500">Novos participantes não podem mais confirmar presença por este link.</p>
            </div>

            <form v-else @submit.prevent="submitRsvp" class="max-w-lg mx-auto space-y-5">
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

      <div v-if="event.photos?.length" class="mt-8 space-y-6">
        <div class="text-center">
          <div class="section-kicker">Galeria do evento</div>
          <h2 class="mt-3 text-3xl font-semibold text-gray-900">Reviva os momentos favoritos</h2>
          <p class="mt-3 text-sm text-gray-500">
            Veja as fotos publicadas pelo organizador, marque suas favoritas e deixe um comentário em cada registro.
          </p>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
          <article
            v-for="photo in event.photos"
            :key="photo.id"
            class="overflow-hidden rounded-[30px] border border-white/60 bg-white/90 shadow-xl shadow-cyan-950/5"
          >
            <img :src="photo.image_url" :alt="`${event.title} photo ${photo.id}`" class="h-80 w-full object-cover" />

            <div class="space-y-5 p-6">
              <div class="flex flex-wrap items-center justify-between gap-3">
                <div class="flex items-center gap-3 text-sm text-gray-500">
                  <span>{{ photo.upvotes_count }} curtidas</span>
                  <span>{{ photo.comments_count }} comentários</span>
                </div>

                <button
                  @click="upvotePhoto(photo.id)"
                  :disabled="isPhotoUpvoted(photo.id)"
                  :class="isPhotoUpvoted(photo.id) ? 'btn-primary btn-sm opacity-70' : 'btn-ghost btn-sm'"
                >
                  {{ isPhotoUpvoted(photo.id) ? 'Você curtiu' : 'Curtir foto' }}
                </button>
              </div>

              <div v-if="photo.comments?.length" class="space-y-3">
                <div
                  v-for="comment in photo.comments"
                  :key="comment.id"
                  class="rounded-[20px] bg-gray-50 p-4"
                >
                  <div class="flex items-center justify-between gap-3">
                    <p class="text-sm font-semibold text-gray-900">{{ comment.author_name }}</p>
                    <p class="text-xs uppercase tracking-[0.14em] text-gray-400">{{ formatCommentDate(comment.created_at) }}</p>
                  </div>
                  <p class="mt-2 text-sm leading-6 text-gray-600">{{ comment.comment }}</p>
                </div>
              </div>

              <div v-else class="rounded-[20px] bg-gray-50 p-4 text-sm text-gray-500">
                Ainda não há comentários nesta foto.
              </div>

              <form @submit.prevent="submitComment(photo.id)" class="grid gap-3">
                <div>
                  <label class="label">Seu nome</label>
                  <input
                    v-model="commentForms[photo.id].author_name"
                    type="text"
                    class="input"
                    placeholder="Como você quer aparecer?"
                  />
                </div>

                <div>
                  <label class="label">Comentário</label>
                  <textarea
                    v-model="commentForms[photo.id].comment"
                    class="input min-h-[100px]"
                    placeholder="Conte o que essa foto te lembra."
                  ></textarea>
                </div>

                <button type="submit" class="btn-primary btn-md justify-center">
                  Publicar comentário
                </button>
              </form>
            </div>
          </article>
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
import { computed, reactive } from 'vue';
import { Head, router, useForm } from '@inertiajs/vue3';

const props = defineProps({
  event: Object,
  rsvps: Array,
  stats: Object,
  upvotedPhotoIds: Array,
});

const form = useForm({
  name: '',
  email: '',
  phone: '',
  guests_count: 1,
  message: '',
});

const isFinished = computed(() => props.event.status === 'finished');
const upvotedPhotoIds = computed(() => props.upvotedPhotoIds || []);
const commentForms = reactive(
  Object.fromEntries(
    (props.event.photos || []).map((photo) => [photo.id, { author_name: '', comment: '' }]),
  ),
);

function formatFullDate(date) {
  return new Date(date).toLocaleDateString('pt-BR', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
}

function submitRsvp() {
  if (isFinished.value) {
    return;
  }

  form.post(`/e/${props.event.slug}/rsvp`, {
    preserveScroll: true,
  });
}

function isPhotoUpvoted(photoId) {
  return upvotedPhotoIds.value.includes(photoId);
}

function upvotePhoto(photoId) {
  router.post(`/e/${props.event.slug}/photos/${photoId}/upvote`, {}, {
    preserveScroll: true,
  });
}

function submitComment(photoId) {
  router.post(`/e/${props.event.slug}/photos/${photoId}/comments`, commentForms[photoId], {
    preserveScroll: true,
    onSuccess: () => {
      commentForms[photoId] = {
        author_name: '',
        comment: '',
      };
    },
  });
}

function formatCommentDate(date) {
  return new Date(date).toLocaleDateString('pt-BR', {
    day: '2-digit',
    month: 'short',
  });
}
</script>
