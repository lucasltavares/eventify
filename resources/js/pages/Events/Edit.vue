<template>
  <DashboardLayout title="Editar Evento">
    <div class="max-w-2xl">
      <div class="mb-6">
        <Link :href="`/events/${event.id}`" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
          </svg>
          Voltar para evento
        </Link>
      </div>

      <div class="card p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Editar Evento</h1>

        <form @submit.prevent="form.post(`/events/${event.id}`)" class="space-y-6">
          <input type="hidden" name="_method" value="put" />
          
          <div>
            <label class="label">Banner do Evento</label>
            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
              <div class="text-center" v-if="!form.cover_image && !event.cover_image">
                <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                  <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-primary-600 hover:text-primary-500">
                    <span>Upload de arquivo</span>
                    <input id="file-upload" name="cover_image" type="file" accept="image/*" class="sr-only" @change="handleFileChange" />
                  </label>
                  <p class="pl-1">ou arraste e solte</p>
                </div>
                <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF até 2MB</p>
              </div>
              <div v-else class="relative w-full">
                <img :src="previewUrl || `/storage/${event.cover_image}`" class="max-h-48 rounded-lg mx-auto" />
                <button type="button" @click="removeImage" class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
            </div>
            <p v-if="form.errors.cover_image" class="mt-1 text-sm text-error-500">{{ form.errors.cover_image }}</p>
          </div>

          <div>
            <label class="label">Título do Evento *</label>
            <input
              v-model="form.title"
              type="text"
              class="input"
              :class="{ 'input-error': form.errors.title }"
              required
            />
            <p v-if="form.errors.title" class="mt-1 text-sm text-error-500">{{ form.errors.title }}</p>
          </div>

          <div>
            <label class="label">Descrição</label>
            <textarea
              v-model="form.description"
              class="input min-h-[120px]"
              :class="{ 'input-error': form.errors.description }"
            ></textarea>
            <p v-if="form.errors.description" class="mt-1 text-sm text-error-500">{{ form.errors.description }}</p>
          </div>

          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="label">Data do Evento *</label>
              <input
                v-model="form.event_date"
                type="date"
                class="input"
                :class="{ 'input-error': form.errors.event_date }"
                required
              />
              <p v-if="form.errors.event_date" class="mt-1 text-sm text-error-500">{{ form.errors.event_date }}</p>
            </div>

            <div>
              <label class="label">Horário</label>
              <input
                v-model="form.event_time"
                type="time"
                class="input"
                :class="{ 'input-error': form.errors.event_time }"
              />
            </div>
          </div>

          <div>
            <label class="label">Local</label>
            <input
              v-model="form.location"
              type="text"
              class="input"
              :class="{ 'input-error': form.errors.location }"
            />
          </div>

          <div class="flex gap-4 pt-4">
            <Link :href="`/events/${event.id}`" class="btn-secondary btn-lg">
              Cancelar
            </Link>
            <button type="submit" class="btn-primary btn-lg flex-1" :disabled="form.processing">
              <span v-if="form.processing" class="animate-spin">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
              </span>
              <span v-else>Salvar Alterações</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </DashboardLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import DashboardLayout from '../../layouts/DashboardLayout.vue';

const props = defineProps({
  event: Object,
});

const form = useForm({
  title: props.event.title,
  description: props.event.description || '',
  event_date: props.event.event_date,
  event_time: props.event.event_time || '',
  location: props.event.location || '',
  cover_image: null,
  remove_cover_image: false,
});

const previewUrl = ref(null);

const handleFileChange = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.cover_image = file;
    form.remove_cover_image = false;
    previewUrl.value = URL.createObjectURL(file);
  }
};

const removeImage = () => {
  form.cover_image = null;
  form.remove_cover_image = true;
  previewUrl.value = null;
};
</script>
