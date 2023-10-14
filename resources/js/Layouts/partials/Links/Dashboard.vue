<script setup lang="ts">
import { tooltip } from "@/helprs";
import { Link } from "@inertiajs/vue3";

const authorized = () => true;
</script>
<template>
    <Link
        v-if="authorized()"
        :href="route('dashboard')"
        v-tooltip.value="tooltip('Painel de administrador')"
    >
        <li
            class="px-3 py-2 rounded mb-0.5 last:mb-0"
            :class="
                route().current('dashboard')
                    ? ' bg-slate-950'
                    : 'hover:bg-slate-900'
            "
        >
            <a class="block text-slate-200 truncate transition duration-150">
                <div class="flex items-center justify-between">
                    <div class="grow flex items-center">

                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M1 10h3v10H1V10zM6 0h3v20H6V0zm5 8h3v12h-3V8zm5-4h3v16h-3V4z"></path></svg>
                        <span
                            class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200"
                            >Dashboard</span
                        >
                    </div>
                </div>
            </a>
        </li>
    </Link>
</template>
