<template>
  <div class="page-container bg-[radial-gradient(circle_at_top,_rgba(14,165,233,0.18),_transparent_32%),linear-gradient(180deg,#f8fafc_0%,#eef6ff_100%)]">
    <Head :title="`Feedback: ${event.title}`" />

    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
      <div v-if="$page.props.flash?.success" class="mb-6 rounded-[24px] border border-success-200 bg-success-50 p-5">
        <p class="font-semibold text-success-800">{{ $page.props.flash.success }}</p>
      </div>

      <div class="grid gap-6 xl:grid-cols-[0.92fr_1.08fr]">
        <section class="overflow-hidden rounded-[32px] bg-gray-900 text-white shadow-2xl shadow-cyan-950/10">
          <div
            class="relative min-h-[380px] p-8"
            :style="event.cover_image_url ? { backgroundImage: `linear-gradient(rgba(2,6,23,.58), rgba(2,6,23,.9)), url(${event.cover_image_url})`, backgroundSize: 'cover', backgroundPosition: 'center' } : {}"
          >
            <div v-if="!event.cover_image_url" class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(34,211,238,.34),_transparent_30%),linear-gradient(135deg,#0f172a_0%,#111827_45%,#083344_100%)]"></div>
            <div class="relative">
              <p class="text-xs font-semibold uppercase tracking-[0.2em] text-cyan-200">Eventify Pulse</p>
              <h1 class="mt-4 max-w-xl text-4xl font-semibold leading-tight">{{ event.title }}</h1>
              <p class="mt-4 max-w-xl text-sm leading-7 text-white/75">
                {{ feedback.recipient_name }}, sua percepção ajuda o organizador a entender o que brilhou e o que precisa evoluir na próxima experiência.
              </p>

              <div class="mt-8 grid gap-3 sm:grid-cols-2">
                <div class="rounded-[22px] bg-white/10 p-4 backdrop-blur">
                  <p class="text-xs uppercase tracking-[0.16em] text-white/60">Quando</p>
                  <p class="mt-2 font-semibold">{{ formatFullDate(event.event_date) }}</p>
                </div>
                <div class="rounded-[22px] bg-white/10 p-4 backdrop-blur">
                  <p class="text-xs uppercase tracking-[0.16em] text-white/60">Onde</p>
                  <p class="mt-2 font-semibold">{{ event.location || 'Local não informado' }}</p>
                </div>
              </div>

              <div class="mt-6 rounded-[24px] bg-white/10 p-5 backdrop-blur">
                <p class="text-sm font-semibold text-white">O que você vai responder</p>
                <div class="mt-3 grid gap-3 sm:grid-cols-3">
                  <div>
                    <p class="text-xs uppercase tracking-[0.16em] text-white/60">1. Notas</p>
                    <p class="mt-1 text-sm text-white/80">Geral, organização e clima.</p>
                  </div>
                  <div>
                    <p class="text-xs uppercase tracking-[0.16em] text-white/60">2. Memória</p>
                    <p class="mt-1 text-sm text-white/80">O ponto alto e o ajuste ideal.</p>
                  </div>
                  <div>
                    <p class="text-xs uppercase tracking-[0.16em] text-white/60">3. Indicação</p>
                    <p class="mt-1 text-sm text-white/80">Se recomendaria a experiência.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="rounded-[32px] border border-white/70 bg-white/92 p-6 shadow-xl shadow-cyan-950/5 backdrop-blur">
          <div v-if="feedback.submitted_at" class="rounded-[28px] bg-gradient-to-br from-emerald-50 to-cyan-50 p-8 text-center">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-success-100 text-success-600">
              <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
            </div>
            <h2 class="mt-4 text-3xl font-semibold text-gray-900">Feedback recebido</h2>
            <p class="mt-3 text-sm leading-7 text-gray-500">
              Sua avaliação já foi registrada. Obrigado por dedicar esse tempo e ajudar a elevar a próxima edição.
            </p>

            <div class="mt-6 grid gap-3 sm:grid-cols-3">
              <div class="rounded-[20px] bg-white p-4">
                <p class="text-xs uppercase tracking-[0.16em] text-gray-400">Geral</p>
                <p class="mt-2 text-2xl font-semibold text-gray-900">{{ feedback.overall_rating }}/5</p>
              </div>
              <div class="rounded-[20px] bg-white p-4">
                <p class="text-xs uppercase tracking-[0.16em] text-gray-400">Organização</p>
                <p class="mt-2 text-2xl font-semibold text-gray-900">{{ feedback.organization_rating }}/5</p>
              </div>
              <div class="rounded-[20px] bg-white p-4">
                <p class="text-xs uppercase tracking-[0.16em] text-gray-400">Experiência</p>
                <p class="mt-2 text-2xl font-semibold text-gray-900">{{ feedback.experience_rating }}/5</p>
              </div>
            </div>
          </div>

          <form v-else @submit.prevent="submit" class="space-y-6">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
              <div class="max-w-xl">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-cyan-700">Feedback guiado</p>
                <h2 class="mt-2 text-3xl font-semibold text-gray-900">Como foi a experiência?</h2>
                <p class="mt-2 text-sm leading-6 text-gray-500">
                  O fluxo foi pensado para ser rápido. Primeiro as notas, depois o contexto. Em menos de dois minutos você termina.
                </p>
              </div>
              <div class="rounded-[22px] bg-gray-50 px-4 py-3 text-sm text-gray-500">
                <p class="font-semibold text-gray-900">Tempo médio</p>
                <p class="mt-1">1 a 2 minutos</p>
              </div>
            </div>

            <div class="grid gap-4 xl:grid-cols-3">
              <div class="rounded-[26px] border border-gray-100 p-5">
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-gray-400">1. Nota geral</p>
                <p class="mt-2 text-sm leading-6 text-gray-500">A sensação final que o evento deixou.</p>
                <div class="mt-4 flex flex-wrap gap-2">
                  <button
                    v-for="score in [1, 2, 3, 4, 5]"
                    :key="`overall-${score}`"
                    type="button"
                    @click="form.overall_rating = score"
                    :class="scoreButtonClass(form.overall_rating === score)"
                  >
                    {{ score }}
                  </button>
                </div>
                <p v-if="form.errors.overall_rating" class="mt-3 text-sm text-error-500">{{ form.errors.overall_rating }}</p>
              </div>

              <div class="rounded-[26px] border border-gray-100 p-5">
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-gray-400">2. Organização</p>
                <p class="mt-2 text-sm leading-6 text-gray-500">Clareza, fluxo, pontualidade e preparação.</p>
                <div class="mt-4 flex flex-wrap gap-2">
                  <button
                    v-for="score in [1, 2, 3, 4, 5]"
                    :key="`organization-${score}`"
                    type="button"
                    @click="form.organization_rating = score"
                    :class="scoreButtonClass(form.organization_rating === score)"
                  >
                    {{ score }}
                  </button>
                </div>
                <p v-if="form.errors.organization_rating" class="mt-3 text-sm text-error-500">{{ form.errors.organization_rating }}</p>
              </div>

              <div class="rounded-[26px] border border-gray-100 p-5">
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-gray-400">3. Clima</p>
                <p class="mt-2 text-sm leading-6 text-gray-500">Energia, conexão e experiência vivida no local.</p>
                <div class="mt-4 flex flex-wrap gap-2">
                  <button
                    v-for="score in [1, 2, 3, 4, 5]"
                    :key="`experience-${score}`"
                    type="button"
                    @click="form.experience_rating = score"
                    :class="scoreButtonClass(form.experience_rating === score)"
                  >
                    {{ score }}
                  </button>
                </div>
                <p v-if="form.errors.experience_rating" class="mt-3 text-sm text-error-500">{{ form.errors.experience_rating }}</p>
              </div>
            </div>

            <div class="grid gap-4">
              <div class="rounded-[26px] border border-gray-100 p-5">
                <label class="text-sm font-semibold text-gray-900">Qual foi o ponto alto da experiência?</label>
                <textarea
                  v-model="form.highlight"
                  class="input mt-3 min-h-[110px]"
                  placeholder="Conte o detalhe, momento ou sensação que mais vale repetir."
                ></textarea>
              </div>

              <div class="rounded-[26px] border border-gray-100 p-5">
                <label class="text-sm font-semibold text-gray-900">O que mais faria diferença melhorar?</label>
                <textarea
                  v-model="form.improvement"
                  class="input mt-3 min-h-[110px]"
                  placeholder="Diga o ajuste que deixaria a próxima edição mais forte."
                ></textarea>
              </div>
            </div>

            <div class="rounded-[26px] border border-gray-100 p-5">
              <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                <div>
                  <p class="text-sm font-semibold text-gray-900">Você recomendaria essa experiência?</p>
                  <p class="mt-1 text-sm text-gray-500">Essa resposta ajuda a medir confiança, não só satisfação.</p>
                </div>
                <span class="text-xs uppercase tracking-[0.16em] text-gray-400">Resposta direta</span>
              </div>

              <div class="mt-4 grid gap-2 sm:grid-cols-2">
                <button
                  type="button"
                  @click="form.would_recommend = true"
                  :class="choiceButtonClass(form.would_recommend === true)"
                >
                  Sim, recomendaria
                </button>
                <button
                  type="button"
                  @click="form.would_recommend = false"
                  :class="choiceButtonClass(form.would_recommend === false)"
                >
                  Ainda não recomendaria
                </button>
              </div>
              <p v-if="form.errors.would_recommend" class="mt-3 text-sm text-error-500">{{ form.errors.would_recommend }}</p>
            </div>

            <div class="rounded-[24px] bg-gray-50 p-4">
              <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-sm leading-6 text-gray-500">
                  Sua resposta fica vinculada a este convite privado e ajuda o organizador a melhorar as próximas experiências com base em sinais reais.
                </p>
                <button type="submit" class="btn-primary btn-lg shrink-0" :disabled="form.processing">
                  Enviar avaliação
                </button>
              </div>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
  feedback: Object,
  event: Object,
});

const form = useForm({
  overall_rating: props.feedback.overall_rating ?? null,
  organization_rating: props.feedback.organization_rating ?? null,
  experience_rating: props.feedback.experience_rating ?? null,
  highlight: props.feedback.highlight ?? '',
  improvement: props.feedback.improvement ?? '',
  would_recommend: props.feedback.would_recommend,
});

function submit() {
  form.post(`/feedback/${props.feedback.token}`, {
    preserveScroll: true,
  });
}

function scoreButtonClass(selected) {
  return selected
    ? 'flex h-12 w-12 items-center justify-center rounded-full bg-gray-900 text-sm font-semibold text-white shadow-lg shadow-gray-900/10'
    : 'flex h-12 w-12 items-center justify-center rounded-full border border-gray-200 bg-white text-sm font-semibold text-gray-600 transition hover:border-cyan-300 hover:text-cyan-700';
}

function choiceButtonClass(selected) {
  return selected
    ? 'rounded-[20px] border border-cyan-500 bg-cyan-50 px-4 py-4 text-sm font-semibold text-cyan-800'
    : 'rounded-[20px] border border-gray-200 bg-white px-4 py-4 text-sm font-semibold text-gray-600 transition hover:border-cyan-300 hover:text-cyan-700';
}

function formatFullDate(date) {
  return new Date(date).toLocaleDateString('pt-BR', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
}
</script>
