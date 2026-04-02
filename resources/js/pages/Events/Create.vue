<template>
  <DashboardLayout title="Criar Eventox">
    <div class="max-w-2xl">
      <div class="mb-6">
        <Link href="/events" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-gray-700">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
          </svg>
          Voltar para eventoss
        </Link>
      </div>

      <div class="card p-8">
        <h1 class="text-2xl font-bold text-gray-900 mb-6">Criar Novo Evento</h1>

        <form @submit.prevent="form.post('/events')" class="space-y-6">
          <div>
            <label class="label">Banner do Evento</label>
            <div class="mt-2">
              <div v-if="!form.cover_image" class="flex items-center gap-4">
                <input 
                  id="file-upload" 
                  name="cover_image" 
                  type="file" 
                  accept="image/*" 
                  class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0
                    file:text-sm file:font-semibold
                    file:bg-primary-50 file:text-primary-700
                    hover:file:bg-primary-100
                    cursor-pointer"
                  @change="handleFileChange" 
                />
              </div>
              <div v-else class="relative inline-block">
                <img :src="previewUrl" class="max-h-48 rounded-lg" />
                <button type="button" @click="removeImage" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
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
              placeholder="Ex: Aniversário da Maria"
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
              placeholder="Conte mais sobre o evento..."
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
                :min="today"
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
              <p v-if="form.errors.event_time" class="mt-1 text-sm text-error-500">{{ form.errors.event_time }}</p>
            </div>
          </div>

          <div>
            <label class="label">Local</label>
            <input
              v-model="form.location"
              type="text"
              class="input"
              :class="{ 'input-error': form.errors.location }"
              placeholder="Ex: Salão de Festas XYZ"
            />
            <p v-if="form.errors.location" class="mt-1 text-sm text-error-500">{{ form.errors.location }}</p>
          </div>

          <div class="flex gap-4 pt-4">
            <Link href="/events" class="btn-secondary btn-lg">
              Cancelar
            </Link>
            <button type="submit" class="btn-primary btn-lg flex-1" :disabled="form.processing">
              <span v-if="form.processing" class="animate-spin">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
              </span>
              <span v-else>Criar Evento</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </DashboardLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import DashboardLayout from '../../layouts/DashboardLayout.vue';

const form = useForm({
  title: '',
  description: '',
  event_date: '',
  event_time: '',
  location: '',
  cover_image: null,
});

const previewUrl = ref(null);

const handleFileChange = (event) => {
  const file = event.target.files[0];
  if (file) {
    form.cover_image = file;
    previewUrl.value = URL.createObjectURL(file);
  }
};

const removeImage = () => {
  form.cover_image = null;
  previewUrl.value = null;
};

const today = new Date().toISOString().split('T')[0];
</script>
