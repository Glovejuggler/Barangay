<template>
    <Head>
        <title>
            Residents
        </title>
    </Head>

    <div class="py-12">
        <div class="sm:px-6 lg:px-8">
            <div class="mb-4 flex justify-between">
                <div class="font-bold text-lg ">
                    Residents
                </div>
                <div class="flex space-x-2">
                    <div>
                        <label class="relative block">
                            <i class='bx bx-search absolute inset-y-0 left-0 flex items-center pl-3'></i>
                            <input v-model="field.search"
                                class="placeholder:italic placeholder:text-slate-400 block bg-white w-96 border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:border-sky-500 focus:ring-sky-200 focus:ring focus:ring-opacity-50 sm:text-sm"
                                placeholder="Search..." type="text" name="search" />
                        </label>
                    </div>
                    <button type="button" @click="showNewModal = true"
                        class="text-sm bg-sky-600 hover:bg-sky-700 active:bg-sky-900 rounded-full px-3 py-1 text-white inline-flex items-center"><i
                            class='bx bx-user-plus w-5'></i>New resident</button>
                </div>
            </div>
            <div v-if="residents.data.length" class="relative overflow-x-auto rounded-lg shadow-md">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Barangay number
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Address
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="resident in residents.data" class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ resident.barangay_number }}
                            </th>
                            <td class="px-6 py-4">
                                {{ resident.full_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ resident.complete_address }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="space-x-2">
                                    <button type="button" @click="edit(resident)"
                                        class="px-4 py-2 rounded-full text-xs bg-green-500 hover:bg-green-600 active:bg-green-700 text-white font-semibold">Edit</button>
                                    <a :href="route('residents.pdf', resident)" target="_blank"><button type="button"
                                            class="px-4 py-2 rounded-full text-xs bg-white text-sky-600 font-semibold border border-sky-600 hover:bg-sky-600 hover:text-white">Print</button></a>
                                    <button type="button" @click="remove(resident)"
                                        class=" px-4 py-2 rounded-full text-xs bg-red-500 font-semibold text-white hover:bg-red-600 active:bg-red-700">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mt-4 flex justify-end px-4">
                <Pagination :links="residents.links" />
            </div>
            <div v-if="!residents.data.length" class="flex flex-col mt-14">
                <div class="flex justify-center">
                    <div class="w-36 h-36 bg-sky-200 rounded-full flex justify-center items-center">
                        <i class="bx bxs-user text-8xl text-sky-600"></i>
                    </div>
                </div>
                <div class="flex justify-center mt-4 text-gray-700">
                    No data
                </div>
            </div>
        </div>
    </div>

    <!-- New resident modal -->
    <div>
        <Transition enter-active-class="duration-200 ease-out" enter-from-class="transform opacity scale-75"
            enter-to-class="opacity-100 scale-100" leave-active-class="duration-200 ease-out"
            leave-from-class="opacity-100 scale-100" leave-to-class="transform opacity-0 scale-75">
            <div v-show="showNewModal"
                class="overflow-auto inset-0 fixed z-50 h-screen w-screen flex justify-center items-center"
                @click.self="this.showNewModal = false">
                <div class="bg-white shadow-lg rounded-lg w-1/4">
                    <div class="flex justify-between items-center p-3">
                        <span class="font-semibold">New resident</span>
                        <i @click="this.showNewModal = false"
                            class="bx bx-x w-8 h-8 text-lg inline-flex justify-center items-center hover:bg-black/10 rounded-full cursor-pointer"></i>
                    </div>
                    <form @submit.prevent="form.post(route('residents.store'), {
                        onSuccess: () => { this.showNewModal = errors.length ? true : false; if (!errors.length) { form.reset() } },
                        preserveScroll: true,
                    })">
                        <div class="px-4">
                            <div>
                                <Label for="first_name" value="First name" />
                                <Input id="first_name" type="text" class="block w-full" v-model="form.first_name" required
                                    autofocus />
                            </div>

                            <div class="mt-3">
                                <Label for="middle_name" value="Middle name" />
                                <Input id="middle_name" type="text" class="block w-full" v-model="form.middle_name" />
                            </div>

                            <div class="mt-3">
                                <Label for="last_name" value="Last name" />
                                <Input id="last_name" type="text" class="block w-full" v-model="form.last_name" required />
                            </div>

                            <div class="mt-3">
                                <Label for="address" value="Complete address" />
                                <Input id="address" type="text" class="block w-full" v-model="form.address" required />
                            </div>

                            <div class="mt-3">
                                <Label for="barangay_id" value="Barangay" />
                                <select id="barangay_id" v-model="form.barangay_id"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                                    <option value="" selected hidden disabled>Select one</option>
                                    <option :value="barangay.id" v-for="barangay in barangays">{{ barangay.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-5 bg-gray-100 p-3 rounded-b-lg flex justify-end">
                            <button type="submit" :disabled="form.processing" :class="{ 'opacity-25': form.processing }"
                                class="text-sm px-4 py-1 rounded-full bg-sky-600 text-white">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </Transition>
        <Transition enter-active-class="duration-200 ease opacity-0" enter-from-class="opacity-0"
            enter-to-class="opacity-100" leave-active-class="duration-200 ease opacity-90" leave-from-class="opacity-90"
            leave-to-class="transform opacity-0" appear>
            <div v-if="showNewModal" class="fixed inset-0 z-40 backdrop-brightness-50 backdrop-blur-sm"></div>
        </Transition>
    </div>

    <!-- Edit resident modal -->
    <div>
        <Transition enter-active-class="duration-200 ease-out" enter-from-class="transform opacity scale-75"
            enter-to-class="opacity-100 scale-100" leave-active-class="duration-200 ease-out"
            leave-from-class="opacity-100 scale-100" leave-to-class="transform opacity-0 scale-75">
            <div v-show="showEditModal"
                class="overflow-auto inset-0 fixed z-50 h-screen w-screen flex justify-center items-center"
                @click.self="this.showEditModal = false">
                <div class="bg-white shadow-lg rounded-lg w-1/4">
                    <div class="flex justify-between items-center p-3">
                        <span class="font-semibold">{{ editResident.full_name }}</span>
                        <i @click="this.showEditModal = false"
                            class="bx bx-x w-8 h-8 text-lg inline-flex justify-center items-center hover:bg-black/10 rounded-full cursor-pointer"></i>
                    </div>
                    <form @submit.prevent="editForm.put(route('residents.update', editResident), {
                        onSuccess: () => this.showEditModal = errors.length ? true : false,
                        preserveScroll: true,
                        preserveState: false
                    })">
                        <div class="px-4 mt-3">
                            <div>
                                <Label for="first_name" value="First name" />
                                <Input id="first_name" type="text" class="block w-full" v-model="editForm.first_name"
                                    required />
                            </div>

                            <div class="mt-3">
                                <Label for="middle_name" value="Middle name" />
                                <Input id="middle_name" type="text" class="block w-full" v-model="editForm.middle_name" />
                            </div>

                            <div class="mt-3">
                                <Label for="last_name" value="Last name" />
                                <Input id="last_name" type="text" class="block w-full" v-model="editForm.last_name"
                                    required />
                            </div>

                            <div class="mt-3">
                                <Label for="address" value="Complete address" />
                                <Input id="address" type="text" class="block w-full" v-model="editForm.address" required />
                            </div>

                            <div class="mt-3">
                                <Label for="barangay_id" value="Barangay" />
                                <select id="barangay_id" v-model="editForm.barangay_id"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full">
                                    <option value="" selected hidden disabled>Select one</option>
                                    <option :value="barangay.id" v-for="barangay in barangays">{{ barangay.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-5 bg-gray-100 p-3 rounded-b-lg flex justify-end">
                            <button type="submit" class="text-sm px-4 py-1 rounded-full bg-sky-600 text-white"
                                :disabled="editForm.processing" :class="{ 'opacity-25': editForm.processing }">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </Transition>
        <Transition enter-active-class="duration-200 ease opacity-0" enter-from-class="opacity-0"
            enter-to-class="opacity-100" leave-active-class="duration-200 ease opacity-90" leave-from-class="opacity-90"
            leave-to-class="transform opacity-0" appear>
            <div v-if="showEditModal" class="fixed inset-0 z-40 backdrop-brightness-50 backdrop-blur-sm"></div>
        </Transition>
    </div>

    <!-- Delete resident modal -->
    <div>
        <Transition enter-active-class="duration-200 ease-out" enter-from-class="transform opacity scale-75"
            enter-to-class="opacity-100 scale-100" leave-active-class="duration-200 ease-out"
            leave-from-class="opacity-100 scale-100" leave-to-class="transform opacity-0 scale-75">
            <div v-show="showDeleteModal"
                class="overflow-auto inset-0 fixed z-50 h-screen w-screen flex justify-center items-center"
                @click.self="this.showDeleteModal = false">
                <div class="bg-white shadow-lg rounded-lg w-1/4">
                    <div class="flex justify-between items-center p-3">
                        <span class="font-semibold">Confirmation</span>
                        <i @click="this.showDeleteModal = false"
                            class="bx bx-x w-8 h-8 text-lg inline-flex justify-center items-center hover:bg-black/10 rounded-full cursor-pointer"></i>
                    </div>
                    <div class="px-4">
                        Are you sure you want to delete <span class="font-semibold">{{ deleteResident.full_name }}</span>?
                    </div>
                    <div class="my-4 px-4 flex justify-end space-x-3">
                        <button @click="this.showDeleteModal = false" type="button"
                            class="hover:underline text-sm">Cancel</button>
                        <button type="button" @click="$inertia.delete(route('residents.destroy', deleteResident), {
                            onSuccess: () => { this.showDeleteModal = false; this.deleteResident = '' },
                            preserveScroll: true,
                        })"
                            class="px-4 py-2 bg-red-500 hover:bg-red-600 active:bg-red-700 rounded-full text-white text-xs">
                            Delete</button>
                    </div>
                </div>
            </div>
        </Transition>
        <Transition enter-active-class="duration-200 ease opacity-0" enter-from-class="opacity-0"
            enter-to-class="opacity-100" leave-active-class="duration-200 ease opacity-90" leave-from-class="opacity-90"
            leave-to-class="transform opacity-0" appear>
            <div v-if="showDeleteModal" class="fixed inset-0 z-40 backdrop-brightness-50 backdrop-blur-sm"></div>
        </Transition>
    </div>
</template>

<script>
import { Head, useForm, Link } from '@inertiajs/inertia-vue3';
import Label from '@/Components/Label.vue';
import Input from '@/Components/Input.vue';
import Pagination from '@/Components/Pagination.vue';
import throttle from 'lodash/throttle';
import pickBy from 'lodash/pickBy';

export default {
    components: {
        Head, Label, Input, Pagination, Link
    },
    props: {
        residents: Object,
        barangays: Object,
        errors: Object
    },
    data() {
        return {
            showNewModal: false,
            showEditModal: false,
            showDeleteModal: false,
            editResident: '',
            deleteResident: '',
            field: {
                search: ''
            }
        }
    },
    setup() {
        const form = useForm({
            first_name: '',
            middle_name: '',
            last_name: '',
            barangay_id: '',
            address: '',
        })

        const editForm = useForm({
            first_name: '',
            middle_name: '',
            last_name: '',
            barangay_id: '',
            address: '',
        })

        return { form, editForm }
    },
    methods: {
        edit(data) {
            this.editResident = data
            this.showEditModal = true
            this.editForm.first_name = this.editResident.first_name
            this.editForm.middle_name = this.editResident.middle_name
            this.editForm.last_name = this.editResident.last_name
            this.editForm.address = this.editResident.address
            this.editForm.barangay_id = this.editResident.barangay_id
        },
        remove(data) {
            this.deleteResident = data
            this.showDeleteModal = true
        }
    },
    watch: {
        field: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get('/residents', pickBy(this.field), {
                    preserveScroll: true,
                    preserveState: true,
                    replace: true,
                });
            }, 150),
        }
    }
}
</script>