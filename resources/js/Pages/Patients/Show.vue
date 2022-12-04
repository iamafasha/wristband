<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BreezeLink from '@/Components/Link.vue';
import BreezeButton from '@/Components/Button.vue';
import PatientGraph from '@/Containers/PatientGraph.vue';
import { reactive } from 'vue';

const props = defineProps({
    patient:{
        type:Object
    },
    latest_reading:{
        type: Object,
        required:false,
        default(rawProps) {
            console.log(rawProps)
            return { systolic: 'hello' }
        },
    }
});
const form = useForm({terms: false,});

const data = reactive([["2000-06-05", 116], ["2000-06-06", 129], ["2000-06-07", 135], ["2000-06-08", 86], ["2000-06-09", 73], ["2000-06-10", 85], ["2000-06-11", 73], ["2000-06-12", 68], ["2000-06-13", 92], ["2000-06-14", 130], ["2000-06-15", 245], ["2000-06-16", 139], ["2000-06-17", 115], ["2000-06-18", 111], ["2000-06-19", 309], ["2000-06-20", 206], ["2000-06-21", 137], ["2000-06-22", 128], ["2000-06-23", 85], ["2000-06-24", 94], ["2000-06-25", 71], ["2000-06-26", 106], ["2000-06-27", 84], ["2000-06-28", 93], ["2000-06-29", 85], ["2000-06-30", 73], ["2000-07-01", 83], ["2000-07-02", 125], ["2000-07-03", 107], ["2000-07-04", 82], ["2000-07-05", 44], ["2000-07-06", 72], ["2000-07-07", 106], ["2000-07-08", 107], ["2000-07-09", 66], ["2000-07-10", 91], ["2000-07-11", 92], ["2000-07-12", 113], ["2000-07-13", 107], ["2000-07-14", 131], ["2000-07-15", 111], ["2000-07-16", 64], ["2000-07-17", 69], ["2000-07-18", 88], ["2000-07-19", 77], ["2000-07-20", 83], ["2000-07-21", 111], ["2000-07-22", 57], ["2000-07-23", 55], ["2000-07-24", 60]])
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="">
                    <div class="flex justify-between">
                        <div class="w-4/12" >
                        <div class="p-6 shadow-sm sm:rounded-lg bg-white border-b border-gray-200 h-fit">
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
                        <div   class="p-6 mt-2 shadow-sm sm:rounded-lg bg-white border-b border-gray-200 h-fit">
                            <div v-if="props.latest_reading">
                                <div class="flex flex-col w-full">
                                    <div>Blood Pressure (mmHg)</div>
                                    <div class="text-blue-500"> <span>{{  props.latest_reading && props.latest_reading.systolic }}</span> / <span>{{  props.latest_reading && props.latest_reading.diastolic }}</span></div>
                                </div>

                                <div class="flex justify-around mt-10">
                                    <div class="flex flex-col w-1/2">
                                        <div>Temp (<span>&#176;</span>C)</div>
                                        <div class="text-blue-500">{{  props.latest_reading && props.latest_reading.temperature }}</div>
                                    </div>

                                    <div class="flex flex-col w-1/2">
                                        <div>Heart Rate (bpm)</div>
                                        <div class="text-blue-500">{{ props.latest_reading && props.latest_reading.heart_rate }}</div>
                                    </div>
                                </div>
                            </div>
                            <div v-else >
                                <p>User has no data to show so far. Attach devices to them.</p>
                            </div>

                           </div>
                        </div>
                        <div class="w-8/12 pl-4">
                            <div class="w-full overflow-hidden shadow-sm sm:rounded-lg bg-white border-b border-gray-200">
                                <PatientGraph  :id="patient.id" />
                            </div>
                            <div class="p-6 w-full shadow-sm sm:rounded-lg bg-white border-b border-gray-200 mt-5">
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
