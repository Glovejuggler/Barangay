<template>
    <div class="inset-y-0 left-0 fixed bg-white flex-col flex py-6 duration-300 ease-in-out overflow-hidden z-40"
        :class="sidebarOpen === 'open' ? 'w-64' : 'w-16', { '-translate-x-full': isMobile && sidebarOpen === 'close' }">
        <div class="uppercase font-bold flex justify-center text-xl text-sky-600"
            :class="{ 'invisible': sidebarOpen === 'close' }">
            Barangay
        </div>

        <div class="mt-10">
            <Link :href="route('dashboard')" class="flex group py-3" v-wave
                :class="$page.url === '/dashboard' ? 'bg-sky-50' : 'hover:bg-gray-50'">
            <div class="flex items-center px-4 border-l-4 border-transparent"
                :class="{ 'border-sky-600': $page.url === '/dashboard' }">
                <i :class="$page.url === '/dashboard' ? 'bxs-grid-alt text-sky-600' : 'bx-grid-alt group-hover:text-black'"
                    class='bx w-10 text-2xl'></i><span class="font-semibold duration-200 ease-in-out"
                    :class="$page.url === '/dashboard' ? 'text-sky-600' : 'text-gray-600 group-hover:text-black', { 'invisible': sidebarOpen === 'close' }">Dashboard</span>
            </div>
            </Link>
            <Link :href="route('residents.index')" class="flex group py-3" v-wave
                :class="$page.component.startsWith('Residents') ? 'bg-sky-50' : 'hover:bg-gray-50'">
            <div class="flex items-center px-4 border-l-4 border-transparent"
                :class="{ 'border-sky-600': $page.component.startsWith('Residents') }">
                <i :class="$page.component.startsWith('Residents') ? 'bxs-user text-sky-600' : 'bx-user text-gray-500 group-hover:text-black'"
                    class='bx w-10 text-2xl'></i><span class="font-semibold duration-200 ease-in-out"
                    :class="$page.component.startsWith('Residents') ? 'text-sky-600' : 'text-gray-500 group-hover:text-black', { 'invisible': sidebarOpen === 'close' }">Residents</span>
            </div>
            </Link>
        </div>
    </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Link
    },
    props: {
        sidebarOpen: String,
        isMobile: Boolean
    },
    watch: {
        sidebarOpen: {
            deep: true,
            handler: function () {
                localStorage.setItem('sidebar', this.sidebarOpen)
            }
        }
    },
}
</script>