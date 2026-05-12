<template>
  <Teleport to="body">
    <Transition name="modal">
      <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="$emit('cancel')"></div>
        
        <div class="relative w-full max-w-md transform rounded-[28px] border border-white/60 bg-white/90 p-6 shadow-2xl backdrop-blur-xl transition-all">
          <div class="text-center">
            <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-error-50">
              <svg class="w-8 h-8 text-error-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
              </svg>
            </div>
            
            <h3 class="mb-2 text-xl font-bold text-gray-900">{{ title }}</h3>
            <p class="mb-6 text-gray-500">{{ message }}</p>
            
            <div class="flex gap-3">
              <button @click="$emit('cancel')" class="flex-1 btn-ghost btn-md">
                Cancelar
              </button>
              <button @click="$emit('confirm')" class="btn-danger btn-md flex-1">
                {{ confirmText }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<script setup>
defineProps({
  show: Boolean,
  title: {
    type: String,
    default: 'Confirmar ação',
  },
  message: {
    type: String,
    default: 'Tem certeza que deseja continuar?',
  },
  confirmText: {
    type: String,
    default: 'Confirmar',
  },
});

defineEmits(['confirm', 'cancel']);
</script>

<style scoped>
.modal-enter-active,
.modal-leave-active {
  transition: all 0.2s ease;
}

.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}

.modal-enter-from > div:last-child,
.modal-leave-to > div:last-child {
  transform: scale(0.95);
}
</style>
