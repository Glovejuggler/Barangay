<template>
    <div class="h-screen flex justify-center items-center bg-gray-100">
        <div class="bg-white rounded-3xl p-5 shadow-md lg:w-1/4 md:w-1/2 w-full">
            <div class="font-bold text-sky-500">
                Register
            </div>
            <div>
                <form @submit="form.post(route('register', {
                    onSuccess: () => {
                        if (errors.length < 1) {
                            form.reset()
                        }
                    },
                    preserveState: false,
                }))">
                    <div class="mt-8">
                        <BreezeLabel for="first_name" value="First name" />
                        <BreezeInput id="first_name" type="text" class="block w-full" v-model="form.first_name" required
                            autofocus />
                    </div>
                    <div class="mt-4">
                        <BreezeLabel for="last_name" value="Last name" />
                        <BreezeInput id="last_name" type="text" class="block w-full" v-model="form.last_name" required />
                    </div>
                    <div class="mt-4">
                        <BreezeLabel for="middle_name" value="Middle name" />
                        <BreezeInput id="middle_name" type="text" class="block w-full" v-model="form.middle_name" />
                    </div>
                    <div class="mt-4">
                        <BreezeLabel for="address" value="Address" />
                        <BreezeInput id="address" type="text" class="block w-full" v-model="form.address" required />
                    </div>
                    <div class="mt-4">
                        <BreezeLabel for="barangay_id" value="Barangay" />
                        <select id="barangay_id" v-model="form.barangay_id"
                            class="border-slate-300 focus:border-sky-500 focus:ring focus:ring-sky-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                            <option value="" selected hidden disabled>Select one</option>
                            <option :value="barangay.id" v-for="barangay in barangays">{{ barangay.name }}</option>
                        </select>
                    </div>
                    <div class="mt-5 flex justify-end">
                        <button v-wave type="submit" :disabled="form.processing" :class="{ 'opacity-25': form.processing }"
                            class="text-sm px-4 py-1 rounded-full bg-sky-600 text-white">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import BreezeLabel from '@/Components/Label.vue';
import BreezeInput from '@/Components/Input.vue';
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    layout: null,
    components: {
        BreezeInput, BreezeLabel
    },
    setup() {
        const form = useForm({
            first_name: '',
            middle_name: '',
            last_name: '',
            address: '',
            barangay_id: '',
        })

        return { form }
    },
    props: {
        barangays: Object,
        errors: Object
    }
}
</script>