<template>
    <Head>
        <title>
            Dashboard
        </title>
    </Head>

    <div class="py-12">
        <div class="sm:px-6 lg:px-8">
            <div @click="$inertia.visit(route('residents.index'))"
                class="bg-white rounded-3xl p-5 lg:w-1/4 w-full m-1 relative overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 cursor-pointer group duration-300 ease-in-out">
                <span class="text-sm font-semibold text-neutral-600">Residents</span>
                <div class="font-extrabold text-5xl mt-2 text-purple-600">
                    {{ residents }}
                </div>
                <i
                    class="bx bxs-user absolute -right-7 top-6 text-9xl text-purple-600 group-hover:scale-110 duration-300 ease-in-out"></i>
            </div>
        </div>
    </div>
</template>

<script>
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Head
    },
    props: {
        residents: Number
    }
}
</script>