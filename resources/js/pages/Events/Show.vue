<template>
  <DashboardLayout title="Detalhes do Evento">
    <div class="mx-auto max-w-6xl">
      <div class="mb-6">
        <Link href="/events" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
          </svg>
          Voltar para eventos
        </Link>
      </div>

      <div class="mb-6 panel overflow-hidden">
        <div
          class="relative h-64 bg-gradient-to-br from-primary-100 via-primary-50 to-cyan-100"
        >
          <img
            v-if="event.cover_image_url"
            :src="event.cover_image_url"
            :alt="event.title"
            class="absolute inset-0 h-full w-full object-cover"
          />
          <div class="absolute inset-0 bg-gray-900/20"></div>
          <div class="absolute inset-x-0 bottom-0 p-8">
            <div class="max-w-3xl rounded-[28px] bg-white/78 p-6 backdrop-blur-xl">
              <div class="flex flex-wrap items-center gap-3">
                <span class="badge badge-primary">{{ formatFullDate(event.event_date) }}</span>
                <span :class="event.status === 'finished' ? 'badge badge-primary' : 'badge badge-success'">
                  {{ event.status === 'finished' ? 'Finalizado' : 'Próximo' }}
                </span>
                <span v-if="event.event_time" class="badge badge-warning">{{ event.event_time }}</span>
                <span v-if="event.location" class="badge badge-success">{{ event.location }}</span>
              </div>
              <h1 class="mt-4 text-4xl font-semibold text-gray-900">{{ event.title }}</h1>
              <p class="mt-3 text-sm text-gray-600">Gerencie detalhes, convidados e distribuicao do link publico.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
          <div v-if="$page.props.flash?.success" class="rounded-[24px] border border-success-200 bg-success-50 p-4 text-success-800">
            {{ $page.props.flash.success }}
          </div>

          <div class="card p-6">
            <div class="mb-4 flex items-start justify-between">
              <div class="flex items-center gap-4">
                <div class="flex h-16 w-16 flex-col items-center justify-center rounded-[22px] bg-gradient-to-br from-primary-100 to-pink-100">
                  <span class="text-xs font-medium text-primary-600">{{ formatMonth(event.event_date) }}</span>
                  <span class="text-2xl font-bold text-primary-700">{{ formatDay(event.event_date) }}</span>
                </div>
                <div>
                  <h2 class="text-2xl font-bold text-gray-900">{{ event.title }}</h2>
                  <p class="text-gray-500">{{ formatFullDate(event.event_date) }}</p>
                </div>
              </div>
              <span :class="event.status === 'finished' ? 'badge badge-primary' : 'badge badge-success'">
                {{ event.status === 'finished' ? 'Finalizado' : 'Próximo' }}
              </span>
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
            <div class="flex items-center justify-between border-b border-gray-100 p-4">
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

          <div class="card overflow-hidden">
            <div class="border-b border-gray-100 p-5">
              <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-400">Galeria pública</p>
              <h2 class="mt-2 text-2xl font-semibold text-gray-900">Fotos do evento</h2>
              <p class="mt-2 text-sm text-gray-500">
                Envie imagens para que os convidados possam ver, curtir e comentar seus momentos favoritos.
              </p>
            </div>

            <form @submit.prevent="uploadGalleryPhotos" class="border-b border-gray-100 p-5">
              <div class="flex flex-col gap-4 sm:flex-row sm:items-end">
                <div class="flex-1">
                  <label class="label">Adicionar fotos</label>
                  <input
                    type="file"
                    accept="image/png,image/jpeg,image/jpg,image/webp,image/gif"
                    multiple
                    class="input py-3"
                    @change="handleGallerySelection"
                  />
                  <p class="mt-2 text-xs text-gray-500">Até 12 imagens por envio, com no máximo 4 MB cada.</p>
                  <p v-if="galleryForm.errors.photos" class="mt-2 text-sm text-error-500">{{ galleryForm.errors.photos }}</p>
                </div>

                <button type="submit" class="btn-primary btn-md" :disabled="galleryForm.processing || !galleryForm.photos.length">
                  Enviar galeria
                </button>
              </div>
            </form>

            <div v-if="event.photos.length > 0" class="grid gap-4 p-5 sm:grid-cols-2 xl:grid-cols-3">
              <div
                v-for="photo in event.photos"
                :key="photo.id"
                class="overflow-hidden rounded-[24px] border border-gray-100 bg-white"
              >
                <img :src="photo.image_url" :alt="`${event.title} gallery photo ${photo.id}`" class="h-48 w-full object-cover" />
                <div class="space-y-3 p-4">
                  <div class="flex items-center gap-3 text-sm text-gray-500">
                    <span>{{ photo.upvotes_count }} curtidas</span>
                    <span>{{ photo.comments_count }} comentários</span>
                  </div>

                  <div v-if="photo.comments?.length" class="space-y-2">
                    <div
                      v-for="comment in photo.comments"
                      :key="comment.id"
                      class="rounded-[18px] bg-gray-50 p-3"
                    >
                      <p class="text-sm font-medium text-gray-900">{{ comment.author_name }}</p>
                      <p class="mt-1 text-sm text-gray-600">{{ comment.comment }}</p>
                    </div>
                  </div>

                  <button @click="deletePhoto(photo.id)" class="btn-ghost btn-sm text-error-500 hover:bg-error-50">
                    Remover foto
                  </button>
                </div>
              </div>
            </div>

            <div v-else class="p-5 text-sm text-gray-500">
              Nenhuma foto na galeria ainda. Envie as primeiras imagens para liberar a experiência pública.
            </div>
          </div>
        </div>

        <div class="space-y-6">
          <div class="card overflow-hidden">
            <div class="border-b border-gray-100 bg-gradient-to-r from-emerald-900 via-teal-800 to-cyan-900 p-5 text-white">
              <p class="text-xs font-semibold uppercase tracking-[0.18em] text-emerald-200">Guest Concierge</p>
              <h2 class="mt-2 text-2xl font-semibold">Dúvidas dos participantes</h2>
              <p class="mt-2 text-sm text-white/75">
                Todo convidado confirmado recebe um link privado para perguntar diretamente à organização. Responda aqui e a resposta aparece no mesmo canal.
              </p>
            </div>

            <div class="grid gap-3 border-b border-gray-100 p-5 sm:grid-cols-3">
              <div class="rounded-[20px] bg-gray-50 p-4">
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-gray-400">Perguntas</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">{{ questionMetrics.total }}</p>
                <p class="mt-1 text-sm text-gray-500">registradas no canal</p>
              </div>
              <div class="rounded-[20px] bg-amber-50 p-4">
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-amber-700">Aguardando</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">{{ pendingQuestionsCount }}</p>
                <p class="mt-1 text-sm text-gray-500">sem resposta ainda</p>
              </div>
              <div class="rounded-[20px] bg-emerald-50 p-4">
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-emerald-700">Respondidas</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">{{ questionMetrics.answered }}</p>
                <p class="mt-1 text-sm text-gray-500">com retorno publicado</p>
              </div>
            </div>

            <div class="p-5">
              <div class="mb-5 flex flex-col gap-4 rounded-[24px] bg-gray-50 p-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                  <p class="text-sm font-semibold text-gray-900">Fila de atendimento</p>
                  <p class="mt-1 text-sm text-gray-500">A lista abaixo está paginada para manter a triagem rápida mesmo com muitos convidados.</p>
                </div>
                <span class="rounded-full bg-white px-3 py-1 text-sm font-medium text-gray-500">
                  Página {{ questions.current_page }} de {{ questions.last_page }}
                </span>
              </div>

              <div v-if="questions.data.length > 0" class="space-y-4">
                <div
                  v-for="question in questions.data"
                  :key="question.id"
                  class="rounded-[24px] border border-gray-100 bg-white p-5"
                >
                  <div class="flex flex-wrap items-start justify-between gap-3">
                    <div class="min-w-0">
                      <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-emerald-500 to-cyan-500 text-sm font-semibold text-white">
                          {{ question.rsvp.name.charAt(0).toUpperCase() }}
                        </div>
                        <div>
                          <p class="font-medium text-gray-900">{{ question.rsvp.name }}</p>
                          <p class="text-sm text-gray-500">
                            {{ question.rsvp.email || question.rsvp.phone || 'Contato não informado' }}
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                      <button @click="copySupportLink(question.rsvp.support_url)" class="btn-ghost btn-sm">
                        Copiar canal
                      </button>
                      <span :class="question.answer ? 'badge badge-success' : 'badge badge-warning'">
                        {{ question.answer ? 'Respondido' : 'Aguardando resposta' }}
                      </span>
                    </div>
                  </div>

                  <div class="mt-4 flex items-center justify-between gap-3">
                    <p class="text-xs font-semibold uppercase tracking-[0.16em] text-gray-400">Pergunta</p>
                    <span class="text-xs text-gray-400">{{ formatDateTime(question.created_at) }}</span>
                  </div>
                  <div class="mt-3 rounded-[20px] bg-gray-50 p-4">
                    <p class="mt-2 text-sm leading-6 text-gray-700">{{ question.question }}</p>
                  </div>

                  <div v-if="question.answer" class="mt-4 rounded-[20px] bg-emerald-50 p-4">
                    <div class="flex items-center justify-between gap-3">
                      <p class="text-xs font-semibold uppercase tracking-[0.16em] text-emerald-700">Sua resposta</p>
                      <span class="text-xs text-emerald-700/70">{{ formatDateTime(question.answered_at) }}</span>
                    </div>
                    <p class="mt-2 text-sm leading-6 text-gray-700">{{ question.answer }}</p>
                  </div>
                  <form v-else @submit.prevent="replyToQuestion(question)" class="mt-4 space-y-3">
                    <textarea
                      v-model="replyDrafts[question.id]"
                      class="input min-h-[110px]"
                      placeholder="Escreva uma resposta clara, útil e objetiva para o participante."
                    ></textarea>
                    <button type="submit" class="btn-primary btn-sm" :disabled="replyProcessingId === question.id">
                      Publicar resposta
                    </button>
                  </form>
                </div>
              </div>

              <div v-else class="rounded-[20px] bg-gray-50 p-5 text-sm text-gray-500">
                Nenhuma dúvida recebida ainda. Assim que um convidado confirmado abrir o canal privado, as perguntas aparecerão aqui.
              </div>

              <div class="mt-5">
                <PaginationNav :pagination="questions" label-prefix="questions" />
              </div>
            </div>
          </div>

          <div class="card p-6">
            <h2 class="mb-4 font-semibold text-gray-900">Estatisticas</h2>
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
                  Total de convidados
                </div>
                <span class="font-semibold text-gray-900">{{ totalGuests }}</span>
              </div>
            </div>
          </div>

          <div v-if="event.status === 'finished'" class="card overflow-hidden">
            <div class="border-b border-gray-100 bg-gradient-to-r from-gray-900 via-gray-800 to-cyan-900 p-5 text-white">
              <p class="text-xs font-semibold uppercase tracking-[0.18em] text-cyan-200">Pulse pós-evento</p>
              <h2 class="mt-2 text-2xl font-semibold">Colete o clima real do evento</h2>
              <p class="mt-2 text-sm text-white/75">
                Links individuais foram preparados para cada participante confirmado. Quem tem email recebe automaticamente; os demais podem ser acionados manualmente.
              </p>
            </div>

            <div class="grid gap-3 border-b border-gray-100 p-5 sm:grid-cols-3">
              <div class="rounded-[20px] bg-gray-50 p-4">
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-gray-400">Convites</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">{{ feedbackSummary.total }}</p>
                <p class="mt-1 text-sm text-gray-500">participantes com link</p>
              </div>
              <div class="rounded-[20px] bg-cyan-50 p-4">
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-cyan-700">Respostas</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">{{ feedbackSummary.responded }}</p>
                <p class="mt-1 text-sm text-gray-500">{{ feedbackSummary.responseRate }}% de retorno</p>
              </div>
              <div class="rounded-[20px] bg-amber-50 p-4">
                <p class="text-xs font-semibold uppercase tracking-[0.16em] text-amber-700">Nota média</p>
                <p class="mt-2 text-2xl font-bold text-gray-900">{{ feedbackSummary.averageRating }}</p>
                <p class="mt-1 text-sm text-gray-500">experiência geral</p>
              </div>
            </div>

            <div class="p-5">
              <div class="mb-5 flex flex-col gap-4 rounded-[24px] bg-gray-50 p-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                  <p class="text-sm font-semibold text-gray-900">Caixa de avaliações</p>
                  <p class="mt-1 text-sm text-gray-500">As respostas são carregadas em páginas para manter a leitura e a operação confortáveis em eventos maiores.</p>
                </div>
                <span class="rounded-full bg-white px-3 py-1 text-sm font-medium text-gray-500">
                  {{ feedbackMetrics.emailed }} enviados por email
                </span>
              </div>

              <div v-if="feedbackInsights.length > 0" class="mb-5 grid gap-3">
                <div
                  v-for="insight in feedbackInsights"
                  :key="insight.label"
                  class="rounded-[18px] border border-gray-100 bg-white p-4"
                >
                  <p class="text-xs font-semibold uppercase tracking-[0.16em] text-gray-400">{{ insight.label }}</p>
                  <p class="mt-2 text-sm leading-6 text-gray-700">{{ insight.text }}</p>
                </div>
              </div>

              <div v-if="feedbacks.data.length > 0" class="space-y-3">
                <div
                  v-for="feedback in feedbacks.data"
                  :key="feedback.id"
                  class="rounded-[22px] border border-gray-100 p-4"
                >
                  <div class="flex flex-wrap items-start justify-between gap-3">
                    <div class="min-w-0">
                      <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-cyan-500 to-primary-500 text-sm font-semibold text-white">
                          {{ feedback.recipient_name.charAt(0).toUpperCase() }}
                        </div>
                        <div>
                          <p class="font-medium text-gray-900">{{ feedback.recipient_name }}</p>
                          <p class="text-sm text-gray-500">
                            {{ feedback.recipient_email || feedback.recipient_phone || 'Sem email ou telefone cadastrado' }}
                          </p>
                        </div>
                      </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                      <span :class="feedback.submitted_at ? 'badge badge-success' : 'badge badge-primary'">
                        {{ feedback.submitted_at ? 'Respondido' : 'Aguardando' }}
                      </span>
                      <span :class="feedback.invitation_sent_at ? 'badge badge-success' : 'badge badge-warning'">
                        {{ feedback.invitation_sent_at ? 'Enviado por email' : 'Compartilhar manualmente' }}
                      </span>
                    </div>
                  </div>

                  <div class="mt-4 flex flex-wrap gap-2">
                    <button @click="copyFeedbackLink(feedback.public_url)" class="btn-ghost btn-sm">
                      Copiar link
                    </button>
                    <button @click="shareFeedbackWhatsApp(feedback)" class="btn-ghost btn-sm">
                      WhatsApp
                    </button>
                  </div>

                  <div v-if="feedback.submitted_at" class="mt-4 rounded-[18px] bg-gray-50 p-4">
                    <div class="flex flex-wrap gap-2">
                      <span class="badge badge-success">Geral {{ feedback.overall_rating }}/5</span>
                      <span class="badge badge-success">Organização {{ feedback.organization_rating }}/5</span>
                      <span class="badge badge-success">Experiência {{ feedback.experience_rating }}/5</span>
                      <span class="badge badge-primary">{{ feedback.would_recommend ? 'Recomendaria' : 'Não recomendaria' }}</span>
                    </div>
                    <p v-if="feedback.highlight" class="mt-3 text-sm text-gray-700">
                      <span class="font-semibold text-gray-900">Ponto alto:</span>
                      {{ feedback.highlight }}
                    </p>
                    <p v-if="feedback.improvement" class="mt-2 text-sm text-gray-700">
                      <span class="font-semibold text-gray-900">Pode melhorar:</span>
                      {{ feedback.improvement }}
                    </p>
                  </div>
                </div>
              </div>

              <div v-else class="rounded-[20px] bg-gray-50 p-5 text-sm text-gray-500">
                Nenhum participante confirmado ainda. As avaliações serão liberadas automaticamente quando houver convidados confirmados.
              </div>

              <div class="mt-5">
                <PaginationNav :pagination="feedbacks" label-prefix="feedbacks" />
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
import { Link, router, useForm } from '@inertiajs/vue3';
import DashboardLayout from '../../layouts/DashboardLayout.vue';
import ConfirmModal from '../../components/ConfirmModal.vue';
import PaginationNav from '../../components/PaginationNav.vue';

const props = defineProps({
  event: Object,
  questions: Object,
  feedbacks: Object,
  questionMetrics: Object,
  feedbackMetrics: Object,
});

const showDeleteModal = ref(false);
const galleryForm = useForm({
  photos: [],
});
const replyDrafts = ref({});
const replyProcessingId = ref(null);

const eventPublicUrl = computed(() => `${window.location.origin}/e/${props.event.slug}`);

const totalGuests = computed(() => {
  return props.event.rsvps.reduce((sum, rsvp) => sum + rsvp.guests_count, 0);
});

const pendingQuestionsCount = computed(() => {
  return props.questionMetrics.pending;
});

const feedbackSummary = computed(() => {
  return {
    total: props.feedbackMetrics.total,
    responded: props.feedbackMetrics.responded,
    responseRate: props.feedbackMetrics.total ? Math.round((props.feedbackMetrics.responded / props.feedbackMetrics.total) * 100) : 0,
    averageRating: Number(props.feedbackMetrics.average_rating || 0).toFixed(1),
  };
});

const feedbackInsights = computed(() => {
  const submitted = props.feedbacks?.data?.filter((feedback) => feedback.submitted_at) || [];

  if (!submitted.length) {
    return [];
  }

  const bestHighlight = submitted.find((feedback) => feedback.highlight)?.highlight;
  const mainImprovement = submitted.find((feedback) => feedback.improvement)?.improvement;

  return [
    bestHighlight
      ? { label: 'Momento mais citado', text: bestHighlight }
      : null,
    mainImprovement
      ? { label: 'Oportunidade mais clara', text: mainImprovement }
      : null,
    { label: 'Chance de recomendação', text: `${props.feedbackMetrics.recommendation_rate}% dos participantes que responderam recomendariam a experiência.` },
  ].filter(Boolean);
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

function handleGallerySelection(event) {
  galleryForm.photos = Array.from(event.target.files || []);
}

function uploadGalleryPhotos() {
  galleryForm.post(`/events/${props.event.id}/photos`, {
    forceFormData: true,
    preserveScroll: true,
    onSuccess: () => {
      galleryForm.reset();
      galleryForm.clearErrors();
    },
  });
}

function copyFeedbackLink(url) {
  navigator.clipboard.writeText(url);
}

function copySupportLink(url) {
  navigator.clipboard.writeText(url);
}

function shareWhatsApp() {
  const text = encodeURIComponent(`Confirme sua presenca em ${props.event.title}.\n${eventPublicUrl.value}`);
  window.open(`https://wa.me/?text=${text}`, '_blank');
}

function shareFacebook() {
  const url = encodeURIComponent(eventPublicUrl.value);
  window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
}

function shareTwitter() {
  const text = encodeURIComponent(`Confirme sua presenca em ${props.event.title}.`);
  const url = encodeURIComponent(eventPublicUrl.value);
  window.open(`https://twitter.com/intent/tweet?text=${text}&url=${url}`, '_blank');
}

function shareNative() {
  if (navigator.share) {
    navigator.share({
      title: props.event.title,
      text: `Confirme sua presenca em ${props.event.title}.`,
      url: eventPublicUrl.value,
    });
  } else {
    copyLink();
  }
}

function shareFeedbackWhatsApp(feedback) {
  const text = encodeURIComponent(
    `Oi ${feedback.recipient_name}, o ${props.event.title} terminou e queremos ouvir sua opinião. Responda aqui: ${feedback.public_url}`,
  );
  window.open(`https://wa.me/?text=${text}`, '_blank');
}

function replyToQuestion(question) {
  const answer = replyDrafts.value[question.id];

  if (!answer?.trim()) {
    return;
  }

  replyProcessingId.value = question.id;

  router.post(`/events/${props.event.id}/questions/${question.id}/reply`, {
    answer,
  }, {
    preserveScroll: true,
    onSuccess: () => {
      replyDrafts.value[question.id] = '';
    },
    onFinish: () => {
      replyProcessingId.value = null;
    },
  });
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

function confirmDelete() {
  showDeleteModal.value = true;
}

function deletePhoto(photoId) {
  router.delete(`/events/${props.event.id}/photos/${photoId}`, {
    preserveScroll: true,
  });
}

function handleDelete() {
  router.delete(`/events/${props.event.id}`);
}
</script>

<style scoped>
.share-btn {
  @apply flex h-11 w-11 items-center justify-center rounded-[16px] bg-primary-50 text-primary-700 transition hover:bg-primary-100;
}
</style>
