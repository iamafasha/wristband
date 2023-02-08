<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import BreezeLink from '@/Components/Link.vue';
import BreezeButton from '@/Components/Button.vue';

const props = defineProps({
    'devices': { type: Array, required: false, default: []}
});
const form = useForm({terms: false,});

</script>

<template>
    <Head title="Devices" />

    <BreezeAuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-end">
                            <BreezeLink :href="route('device.create')" >Add Device</BreezeLink>
                        </div>

                        <div class="pt-5">
                            <ul class="devices border-spacing-2 md:table w-full">
                                <li v-for="device in props.devices" :key="device.id" class="device md:table-row ">

                                        <div class="device-name md:table-cell">
                                            <h3>{{ device.mac_address }}</h3>
                                        </div>


                                        <div class="device-actions md:table-cell">
                                        <div class="flex justify-end">
                                                <div class="device-edit">
                                                    <BreezeLink :href="route('device.edit', device.id)" class="ml-4">Edit</BreezeLink>
                                                </div>
                                                <form class="device-delete" @submit.prevent="form.delete(route('device.destroy', device.id ))" >
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
