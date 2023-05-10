<template>
    <Head>
        <title>
            Dashboard
        </title>
    </Head>

    <div class="py-12">
        <div class="px-6 lg:px-8">
            <div @click="$inertia.visit(route('residents.index'))" v-wave
                class="bg-white rounded-3xl p-5 lg:w-1/4 w-full relative overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 cursor-pointer group duration-300 ease-in-out">
                <span class="text-sm font-semibold text-neutral-600">Residents</span>
                <div class="font-extrabold text-5xl mt-2 text-purple-600">
                    {{ residents }}
                </div>
                <i
                    class="bx bxs-user absolute -right-7 top-6 text-9xl text-purple-600 group-hover:scale-110 duration-300 ease-in-out"></i>
            </div>

            <div class="flex lg:w-1/4 w-full space-x-2 mt-2">
                <div @click="$inertia.visit(route('residents.index') + '?status=verified')" v-wave
                    class="bg-green-200 rounded-3xl p-3 w-full overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 cursor-pointer group duration-300 ease-in-out">
                    <i class="bx bxs-check-circle text-3xl text-green-600"></i>
                    <p class="font-bold text-3xl">{{ verified }}</p>
                    <p class="text-gray-500 font-semibold text-xs">Verified residents</p>
                </div>
                <div @click="$inertia.visit(route('residents.index') + '?status=unverified')" v-wave
                    class="bg-red-200 rounded-3xl p-3 w-full overflow-hidden shadow-sm hover:shadow-lg hover:-translate-y-1 cursor-pointer group duration-300 ease-in-out">
                    <i class="bx bxs-x-circle text-3xl text-red-700"></i>
                    <p class="font-bold text-3xl">{{ unverified }}</p>
                    <p class="text-gray-500 font-semibold text-xs">Not verified residents</p>
                </div>
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
        residents: Number,
        verified: Number,
        unverified: Number,
    }
}
</script>