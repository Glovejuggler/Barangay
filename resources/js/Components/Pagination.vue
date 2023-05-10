<template>
    <div v-if="links.length > 3" class="text-xs">
        <div class="flex space-x-1">
            <template v-for="(link, p) in links" :key="p">
                <div v-if="link.url === null"
                    class="px-4 py-2 text-xs text-gray-300 cursor-not-allowed border rounded-full items-center flex bg-white"
                    v-html="link.label" />
                <Link v-else v-wave
                    class="p-4 inline-flex justify-center items-center text-xs leading-4 border rounded-full focus:border-gray-500"
                    :href="link.url" v-html="link.label" :class="link.active ? 'bg-sky-600 text-white' : 'bg-white'" />
            </template>
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
        links: Array
    },
}
</script>