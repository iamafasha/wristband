<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeSelect from '@/Components/Select.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';

import { Head , useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    mac_address: '',
    terms: false,
});

const submit = () => {
    form.post(route('device.store'));
};


</script>

<template>
    <BreezeAuthenticatedLayout>
            <Head title="Add Device" />
            <div class="w-full flex justify-center">
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

                    <BreezeValidationErrors class="mb-4" />

                    <form @submit.prevent="submit">
                    <div>
                        <BreezeLabel for="mac_address" value="Name" />
                        <BreezeInput id="mac_address" type="text" class="mt-1 block w-full" v-model="form.mac_address" required autofocus autocomplete="name" />
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

