<script setup>
import { ref, watch, onUnmounted } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import BreezeDropdown from '@/Components/Dropdown.vue';
import BreezeDropdownLink from '@/Components/DropdownLink.vue';
import Sidebar from '@/Components/Sidebar.vue';
import { useBreakpoints } from '@/Composables/useBreakpoint';

const sidebarOpen = ref(localStorage.getItem('sidebar') ?? 'open');
const width = ref(useBreakpoints());

let finishEventListener = Inertia.on('finish', () => {
    sidebarOpen.value = width.value < 1024 ? 'close' : sidebarOpen.value
});

onUnmounted(() => {
    finishEventListener();
})

watch(width, () => {
    if (width.value < 1024) {
        sidebarOpen.value = 'close'
    } else {
        sidebarOpen.value = 'open'
    }
})
</script>

<template>
    <div>
        <Sidebar :isMobile="width < 1024" :sidebarOpen="sidebarOpen" />
        <div class="fixed lg:hidden inset-0 bg-black/30 z-30" @click="sidebarOpen = 'close'" v-if="sidebarOpen === 'open'">
        </div>
        <div class="min-h-screen bg-gray-100 duration-300 ease-in-out"
            :class="sidebarOpen === 'open' ? 'lg:pl-64' : 'lg:pl-16'">
            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="px-4 sm:px-6 lg:px-2">
                    <div class="flex justify-between h-16 items-center">
                        <div @click="sidebarOpen = sidebarOpen === 'open' ? 'close' : 'open'" v-wave
                            class="flex items-center justify-center rounded-full hover:bg-black/5 w-12 h-12 cursor-pointer">
                            <i class='bx bx-menu text-3xl'></i>
                        </div>
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <BreezeDropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </BreezeDropdownLink>
                                    </template>
                                </BreezeDropdown>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>