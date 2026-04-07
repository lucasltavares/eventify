<template>
  <div class="min-h-screen gradient-bg">
    <div class="flex items-center justify-center min-h-screen p-4">
      <div class="w-full max-w-md">
        <div class="text-center mb-8 animate-fade-in">
          <div class="inline-flex items-center justify-center">
            <img src="/logo.png" alt="Eventify" class="w-60 h-20 object-contain" />
          </div>
          <p class="mt-4 text-gray-500">Convites de eventos simples e elegantes</p>
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
