<template>
  <div v-if="pagination?.last_page > 1" class="flex flex-col gap-3 border-t border-gray-100 pt-4 sm:flex-row sm:items-center sm:justify-between">
    <p class="text-sm text-gray-500">
      Mostrando {{ pagination.from || 0 }}-{{ pagination.to || 0 }} de {{ pagination.total || 0 }}
    </p>

    <div class="flex flex-wrap gap-2">
      <Link
        v-for="link in filteredLinks"
        :key="`${labelPrefix}-${link.label}`"
        :href="link.url || '#'"
        :preserve-scroll="true"
        class="rounded-full px-4 py-2 text-sm font-medium transition-colors"
        :class="[
          link.active ? 'bg-gray-900 text-white' : 'bg-gray-50 text-gray-600 hover:bg-gray-100',
          !link.url ? 'pointer-events-none opacity-45' : '',
        ]"
      >
        <span v-html="normalizeLabel(link.label)"></span>
      </Link>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  pagination: Object,
  labelPrefix: {
    type: String,
    default: 'page',
  },
});

const filteredLinks = computed(() => {
  return props.pagination?.links || [];
});

function normalizeLabel(label) {
  return label
    .replace('&laquo; Previous', 'Anterior')
    .replace('Next &raquo;', 'Próxima');
}
</script>
