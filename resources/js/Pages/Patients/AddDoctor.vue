<script setup>
import {  computed } from 'vue'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeSelect from '@/Components/Select.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';

import { Head , useForm } from '@inertiajs/inertia-vue3';


const props = defineProps(['patient', 'doctors']);


const doctors_options = computed(() => {
  return props.doctors.map(doctor => ({
    label: doctor.user.name,
    value: doctor.id,
  }));
})


const form = useForm({
    'doctor_id': null,
    terms: false,
});

const submit = () => {
    form.post(route('patient.doctor.store', props.patient.id), {
        onFinish: () => form.reset('password'),
    });
};


</script>

<template>
    <BreezeAuthenticatedLayout>
            <Head title="patient Create" />
            <div class="w-full flex flex-col items-center justify-center">
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md sm:rounded-lg">

                    <BreezeValidationErrors class="mb-4" />

                    Adding a device for , {{ props.patient.user.name }}.

                    <div class="mt-4">
                        <v-select :options="doctors_options" :reduce="doctor => doctor.value" v-model="form.doctor_id" placeholder="Search Device to add"></v-select>
                    </div>

                    <div class="mt-4">
                        <p>
                            <span class="font-bold">Note:</span>
                            Devices that are already owned by patients are not listed here. You will have to first detach them from there owners.
                        </p>
                    </div>

                    <div class="mt-4">
                        <BreezeButton type="submit" class="w-full text-center justify-center" @click="submit">
                            Continue
                        </BreezeButton>
                    </div>

                </div>
            </div>
    </BreezeAuthenticatedLayout>
</template>

