<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeSelect from '@/Components/Select.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';

import { Head , useForm } from '@inertiajs/inertia-vue3';

 const props = defineProps(['patient']);

const form = useForm({
    name: props.patient.user.name,
    email: props.patient.user.email,
    phone: props.patient.user.phone,
    terms: false,
});

const submit = () => {
    form.patch(route('patient.update', props.patient.id ), {
        onFinish: () => form.reset('password'),
    });
};


</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
            <Head title="patient Create" />
            <div class="w-full flex justify-center">
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

                    <BreezeValidationErrors class="mb-4" />

                            <form @submit.prevent="submit">
                    <div>
                        <BreezeLabel for="name" value="Name" />
                        <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-4">
                        <BreezeLabel for="email" value="Email" />
                        <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
                    </div>


                    <div class="mt-4">
                        <BreezeLabel for="phone_number" value="Phone Number" />
                        <BreezeInput id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required autocomplete="phone" />
                    </div>
                    
                    <div class="flex items-center justify-end mt-4">
                        <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Add
                        </BreezeButton>
                    </div>
                </form>

                </div>
            </div>
    </BreezeAuthenticatedLayout>
</template>
