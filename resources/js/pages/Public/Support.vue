<template>
  <div class="page-container bg-[radial-gradient(circle_at_top,_rgba(16,185,129,0.14),_transparent_28%),linear-gradient(180deg,#f8fafc_0%,#ecfdf5_100%)]">
    <Head :title="`Dúvidas: ${event.title}`" />

    <div class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
      <div v-if="$page.props.flash?.success" class="mb-6 rounded-[24px] border border-success-200 bg-success-50 p-5">
        <p class="font-semibold text-success-800">{{ $page.props.flash.success }}</p>
      </div>

      <div class="grid gap-6 xl:grid-cols-[0.95fr_1.05fr]">
        <section class="overflow-hidden rounded-[32px] bg-gray-900 text-white shadow-2xl shadow-emerald-950/10">
          <div
            class="relative min-h-[360px] p-8"
            :style="event.cover_image_url ? { backgroundImage: `linear-gradient(rgba(3,7,18,.55), rgba(3,7,18,.88)), url(${event.cover_image_url})`, backgroundSize: 'cover', backgroundPosition: 'center' } : {}"
          >
            <div v-if="!event.cover_image_url" class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(52,211,153,.28),_transparent_28%),linear-gradient(135deg,#052e16_0%,#111827_48%,#064e3b_100%)]"></div>
            <div class="relative">
              <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-200">Guest Concierge</p>
              <h1 class="mt-4 max-w-xl text-4xl font-semibold leading-tight">{{ event.title }}</h1>
              <p class="mt-4 max-w-xl text-sm leading-7 text-white/75">
                {{ rsvp.name }}, este é seu canal privado com a organização. Em vez de procurar respostas em várias mensagens, concentre tudo aqui.
              </p>

              <div class="mt-8 grid gap-3 sm:grid-cols-2">
                <div class="rounded-[22px] bg-white/10 p-4 backdrop-blur">
                  <p class="text-xs uppercase tracking-[0.16em] text-white/60">Quando</p>
                  <p class="mt-2 font-semibold">{{ formatFullDate(event.event_date) }}</p>
                </div>
                <div class="rounded-[22px] bg-white/10 p-4 backdrop-blur">
                  <p class="text-xs uppercase tracking-[0.16em] text-white/60">Onde</p>
                  <p class="mt-2 font-semibold">{{ event.location || 'Local a confirmar' }}</p>
                </div>
              </div>

              <div class="mt-6 grid gap-3 sm:grid-cols-3">
                <div class="rounded-[20px] bg-white/10 p-4 backdrop-blur">
                  <p class="text-xs uppercase tracking-[0.16em] text-white/60">Perguntas</p>
                  <p class="mt-2 text-2xl font-semibold">{{ questionMetrics.total }}</p>
                </div>
                <div class="rounded-[20px] bg-white/10 p-4 backdrop-blur">
                  <p class="text-xs uppercase tracking-[0.16em] text-white/60">Respondidas</p>
                  <p class="mt-2 text-2xl font-semibold">{{ questionMetrics.answered }}</p>
                </div>
                <div class="rounded-[20px] bg-white/10 p-4 backdrop-blur">
                  <p class="text-xs uppercase tracking-[0.16em] text-white/60">Contato</p>
                  <p class="mt-2 text-sm font-semibold break-all">{{ rsvp.email || rsvp.phone || 'privado' }}</p>
                </div>
              </div>
            </div>
          </div>
        </section>

        <section class="space-y-6">
          <div class="rounded-[32px] border border-white/70 bg-white/92 p-6 shadow-xl shadow-emerald-950/5 backdrop-blur">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
              <div class="max-w-xl">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-700">Canal do convidado</p>
                <h2 class="mt-2 text-3xl font-semibold text-gray-900">Tire dúvidas sem atrito</h2>
                <p class="mt-2 text-sm leading-6 text-gray-500">
                  Pergunte sobre acesso, horário ideal, estacionamento, acompanhantes ou qualquer detalhe do evento. A organização responde no mesmo link.
                </p>
              </div>
              <div class="rounded-[22px] bg-gray-50 px-4 py-3 text-sm text-gray-500">
                <p class="font-semibold text-gray-900">Como funciona</p>
                <p class="mt-1">1. Envie a dúvida.</p>
                <p>2. Acompanhe a resposta aqui.</p>
                <p>3. Volte quando precisar.</p>
              </div>
            </div>

            <form @submit.prevent="submit" class="mt-6 rounded-[28px] border border-gray-100 bg-gradient-to-br from-white to-gray-50 p-5">
              <label class="label">Escreva sua dúvida</label>
              <textarea
                v-model="form.question"
                class="input min-h-[140px] bg-white"
                :class="{ 'input-error': form.errors.question }"
                placeholder="Ex.: tem estacionamento no local? existe dress code? qual é a melhor entrada para chegar sem fila?"
              ></textarea>
              <p v-if="form.errors.question" class="mt-2 text-sm text-error-500">{{ form.errors.question }}</p>

              <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <p class="text-xs leading-5 text-gray-400">
                  Dica: cada dúvida vira um item no histórico. Isso evita respostas perdidas e ajuda a organização a responder melhor.
                </p>
                <button type="submit" class="btn-primary btn-md shrink-0" :disabled="form.processing">
                  Enviar dúvida
                </button>
              </div>
            </form>
          </div>

          <div class="rounded-[32px] border border-white/70 bg-white/92 p-6 shadow-xl shadow-emerald-950/5 backdrop-blur">
            <div class="mb-5 flex items-center justify-between gap-3">
              <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-400">Histórico</p>
                <h3 class="mt-2 text-2xl font-semibold text-gray-900">Linha do tempo de dúvidas</h3>
              </div>
              <span class="rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-500">
                {{ questions.total || 0 }} registro{{ (questions.total || 0) === 1 ? '' : 's' }}
              </span>
            </div>

            <div v-if="questions.data.length > 0" class="space-y-4">
              <article
                v-for="question in questions.data"
                :key="question.id"
                class="rounded-[26px] border border-gray-100 bg-white p-5"
              >
                <div class="flex items-center justify-between gap-3">
                  <span class="badge badge-primary">Pergunta enviada</span>
                  <span class="text-xs text-gray-400">{{ formatDateTime(question.created_at) }}</span>
                </div>

                <p class="mt-4 text-sm leading-7 text-gray-700">{{ question.question }}</p>

                <div
                  v-if="question.answer"
                  class="mt-5 rounded-[22px] border border-emerald-100 bg-emerald-50 p-4"
                >
                  <div class="flex items-center justify-between gap-3">
                    <span class="badge badge-success">Resposta da organização</span>
                    <span class="text-xs text-emerald-700/70">{{ formatDateTime(question.answered_at) }}</span>
                  </div>
                  <p class="mt-3 text-sm leading-7 text-gray-700">{{ question.answer }}</p>
                </div>
                <div
                  v-else
                  class="mt-5 rounded-[22px] border border-amber-100 bg-amber-50 p-4 text-sm leading-6 text-amber-800"
                >
                  Sua pergunta já chegou ao organizador. A resposta aparecerá aqui assim que ele responder.
                </div>
              </article>
            </div>

            <div v-else class="rounded-[24px] bg-gray-50 p-8 text-center text-sm text-gray-500">
              Nenhuma dúvida por enquanto. Quando você enviar a primeira, ela aparecerá nesta linha do tempo.
            </div>

            <div class="mt-5">
              <PaginationNav :pagination="questions" label-prefix="support" />
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import PaginationNav from '../../components/PaginationNav.vue';

const props = defineProps({
  event: Object,
  rsvp: Object,
  questions: Object,
  questionMetrics: Object,
});

const form = useForm({
  question: '',
});

function submit() {
  form.post(`/support/${props.rsvp.support_token}`, {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  });
}

function formatFullDate(date) {
  return new Date(date).toLocaleDateString('pt-BR', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' });
}

function formatDateTime(date) {
  if (!date) {
    return '';
  }

  return new Date(date).toLocaleString('pt-BR', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
  });
}
</script>
