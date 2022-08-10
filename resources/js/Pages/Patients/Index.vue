<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BreezeLink from '@/Components/Link.vue';
import BreezeButton from '@/Components/Button.vue';

//if patients are undefined set patients to an empty array
const props = defineProps({
    'patients':  { type: Array, required: false, default: []}
}) ;
const form = useForm({terms: false,});

</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-end">
                            <BreezeLink :href="route('patient.create')" >New Patient</BreezeLink>
                        </div>

                        <div class="pt-5">
                            <ul class="patients border-spacing-2 table w-full">
                                <li v-for="patient in this.patients" :key="patient.id" class="patient table-row ">

                                        <div class="patient-name table-cell">
                                            <h3>{{ patient.user.name }}</h3>
                                        </div>

                                        <div class="patient-name table-cell">
                                            <h3>{{ patient.user.phone }}</h3>
                                        </div>

                                        <div class="patient-name table-cell">
                                            <h3>{{ patient.user.email }}</h3>
                                        </div>

                                        <div class="patient-actions table-cell">
                                            <div class="flex justify-end">
                                                    <div class="patient-edit">
                                                        <BreezeLink :href="route('patient.show', patient.id)" class="ml-4">view</BreezeLink>
                                                    </div>
                                            </div>
                                        </div>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
