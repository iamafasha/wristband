<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BreezeLink from '@/Components/Link.vue';
import BreezeButton from '@/Components/Button.vue';

const props = defineProps({
    'doctors':{ type: Array, required: false, default: []}
});

const form = useForm({terms: false,});

</script>

<template>
    <Head title="Doctors" />

    <BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                     <!-- button to create a doctor -->
                        <div class="flex justify-end">
                            <BreezeLink :href="route('doctor.create')" >New Doctor</BreezeLink>
                        </div>

                        <div class="pt-5">
                            <ul class="doctors border-spacing-2 table w-full">
                                <li v-for="doctor in props.doctors" :key="doctor.id" class="doctor md:table-row ">

                                        <div class="doctor-name md:table-cell">
                                            <h3>{{ doctor.user.name }}</h3>
                                        </div>

                                        <div class="doctor-name md:table-cell">
                                            <h3>{{ doctor.user.email }}</h3>
                                        </div>

                                        <div class="doctor-name md:table-cell">
                                            <h3>{{ doctor.user.phone }}</h3>
                                        </div>

                                        <div class="doctor-phone md:table-cell">
                                            <p>{{ doctor.role }}</p>
                                        </div>

                                        <div class="doctor-actions md:table-cell">
                                        <div class="flex justify-end">
                                                <div class="doctor-edit">
                                                    <BreezeLink :href="route('doctor.edit', doctor.id)" class="ml-4">Edit</BreezeLink>
                                                </div>
                                                <form class="doctor-delete" @submit.prevent="form.delete(route('doctor.destroy', doctor.id ))" >
                                                    <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                        Delete
                                                    </BreezeButton>
                                                </form>
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

