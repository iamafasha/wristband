<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BreezeLink from '@/Components/Link.vue';
import BreezeButton from '@/Components/Button.vue';

const props = defineProps(['patient']);
const form = useForm({terms: false,});

</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="">
                    <div class="flex justify-between">
                        <div class=" w-4/12 p-6 shadow-sm sm:rounded-lg bg-white border-b border-gray-200 h-fit">
                            <!-- User data -->
                            <div class="flex flex-col justify-center items-center">
                                <div class="flex justify-center">
                                    <img class="w-32 h-32 rounded-full mx-auto mb-4" :src="`https://ui-avatars.com/api/?name=${props.patient.user.name}&background=random&color=random`" alt="">
                                </div>
                                <div class="flex justify-center">
                                    <h1 class="text-center text-2xl font-bold">{{ props.patient.user.name }}</h1>
                                </div>
                                <div class="flex justify-center">
                                    <h2 class="text-center text-sm font-bold">{{ props.patient.user.email }}</h2>
                                </div>

                                <div class="flex justify-center">
                                    <h2 class="text-center text-sm font-bold">+{{ props.patient.user.phone }}</h2>
                                </div>
                            </div>

                            <!-- User actions -->
                            <div class="flex flex-row justify-center mt-4">
                                <div class="flex">
                                    <BreezeLink :href="route('patient.edit', props.patient.id)" class="ml-4">Edit</BreezeLink>
                                </div>
                                <form class="device-delete"  @submit.prevent="form.delete(route('patient.destroy', props.patient.id ))" >
                                    <BreezeButton  class="ml-4 w-23" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Delete
                                    </BreezeButton>
                                </form>
                            </div>
                        </div>
                        <div class="p-6 mt-2 shadow-sm sm:rounded-lg bg-white border-b border-gray-200 h-fit">
                            <div class="flex flex-col w-full">
                                <div>Blood Pressure (mmHg)</div>
                                <div class="text-blue-500"> <span>{{ props.latest_reading.systolic }}</span> / <span>{{ props.latest_reading.diastolic }}</span></div>
                            </div>

                            <div class="flex justify-around mt-10">
                                <div class="flex flex-col w-1/2">
                                    <div>Temp (<span>&#176;</span>C)</div>
                                    <div class="text-blue-500">{{ props.latest_reading.temperature }}</div>
                                </div>

                                <div class="flex flex-col w-1/2">
                                    <div>Heart Rate (bpm)</div>
                                    <div class="text-blue-500">{{ props.latest_reading.heart_rate }}</div>
                                </div>
                            </div>
                           </div>
                        </div>
                        <div class="w-8/12 pl-4">
                            <div class="p-6 w-full shadow-sm sm:rounded-lg bg-white border-b border-gray-200">
                                <h2>Devices</h2>

                                <div class="pt-5">
                                    <ul class="devices border-spacing-2 table w-full">
                                        <li v-for="device in props.patient.devices" :key="device.id" class="device table-row ">
                                                <div class="device-name table-cell">
                                                    <h3>{{ device.mac_address }}</h3>
                                                </div>
                                                <div class="device-actions table-cell">
                                                    <div class="flex justify-end">
                                                        <form class="device-delete" @submit.prevent="form.delete(route('patient.device.detach', [
                                                               props.patient.id,
                                                            device.id,
                                                        ] ))" >
                                                            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                                DETACH
                                                            </BreezeButton>
                                                        </form>
                                                    </div>
                                                </div>
                                        </li>
                                    </ul>
                                </div>

                                <div>
                                    <div class="flex justify-end m-2">
                                        <BreezeLink :href="route('patient.device.add', props.patient.id )" >
                                            ADD
                                        </BreezeLink>
                                    </div>
                                </div>
                            </div>

                            <div class="p-6 w-full shadow-sm sm:rounded-lg bg-white border-b border-gray-200 mt-5">
                                <h2>Doctors</h2>
                                <div>
                                    <ul v-for="doctor in props.patient.doctors" :key="doctor.id" class="devices border-spacing-2 table w-full ">
                                        <li class="device table-row ">
                                                <div class="device-name table-cell">
                                                    <h3>{{ doctor.user.name }}</h3>
                                                </div>
                                                <div class="device-actions table-cell">
                                                    <div class="flex justify-end">
                                                        <form class="device-delete" @submit.prevent="form.delete(route('patient.doctor.detach', [
                                                               props.patient.id,
                                                               doctor.id,
                                                            ]))" >
                                                            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                                DETACH
                                                            </BreezeButton>
                                                        </form>
                                                    </div>
                                                </div>
                                        </li>
                                    </ul>
                                </div>

                                <div>
                                    <!-- Add a new contact person -->
                                    <div class="flex justify-end m-2">
                                        <BreezeLink  :href="route('patient.doctor.add', props.patient.id )" >
                                            ADD
                                        </BreezeLink>
                                    </div>
                                </div>

                            </div>

                            <div class="p-6 w-full shadow-sm sm:rounded-lg bg-white border-b border-gray-200 mt-5">
                                <h2>Contact Persons</h2>
                                <div class="">
                                    <ul class="devices border-spacing-2 table w-full ">
                                        <li v-for="contact_person in props.patient.contact_persons" :key="contact_person.id" class="device table-row ">
                                                <div class="name table-cell">
                                                    <h3>{{ contact_person.name }}</h3>
                                                </div>

                                                <div class="email table-cell">
                                                    <h3>{{ contact_person.email }}</h3>
                                                </div>

                                                <div class="phone table-cell">
                                                    <h3>{{ contact_person.phone }}</h3>
                                                </div>


                                                <div class="device-actions table-cell">
                                                    <div class="flex justify-end">
                                                        <form class="device-delete" @submit.prevent="form.delete(route('patient.contact.detach',[
                                                            props.patient.id,
                                                            contact_person.id,
                                                        ] ))" >
                                                            <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                                DETACH
                                                            </BreezeButton>
                                                        </form>
                                                    </div>
                                                </div>
                                        </li>
                                    </ul>
                                </div>

                                <div>
                                    <!-- Add a new contact person -->
                                    <div class="flex justify-end m-2">
                                        <BreezeLink :href="route('patient.contact.add', props.patient.id)" >
                                            ADD
                                        </BreezeLink>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
