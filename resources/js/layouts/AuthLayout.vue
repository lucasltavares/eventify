<template>
  <div class="min-h-screen gradient-bg">
    <div class="flex items-center justify-center min-h-screen p-4">
      <div class="w-full max-w-md">
        <div class="text-center mb-8 animate-fade-in">
          <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-primary-500 to-pink-500 shadow-lg shadow-primary-500/25">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
          </div>
          <h1 class="mt-6 text-3xl font-bold gradient-text">Eventify</h1>
          <p class="mt-2 text-gray-500">Convites de eventos simples e elegantes</p>
        </div>

        <div class="card p-8 shadow-xl animate-slide-up">
          <slot />
        </div>

        <p class="text-center text-sm text-gray-400 mt-6">
          © 2026 Eventify. Todos os direitos reservados.
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
</script>
