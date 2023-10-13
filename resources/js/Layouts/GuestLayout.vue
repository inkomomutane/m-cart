<script setup lang="ts">
defineProps({
    showFooter: {
        type: Boolean,
    },
});
</script>
<template>
    <div class="bg-slate-50 dark:bg-slate-700 selection:bg-primary-500">
        <slot />
    </div>
</template>
