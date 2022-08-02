<script setup>
import { reactive, computed } from 'vue'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeSelect from '@/Components/Select.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';

import { Head , useForm } from '@inertiajs/inertia-vue3';

//props
const props = defineProps(['users']);

// a computed ref
const users_options = computed(() => {
  return props.users.map(user => ({
    label: user.name,
    value: user.id,
  }));
})


const form = useForm({
    user_type: 'existing',
    selected_user: null,
    name: '',
    email: '',
    phone:'',

    terms: false,
});

const submit = () => {
    form.post(route('patient.store'), {
        onFinish: () => form.reset('password'),
    });
};


</script>

<template>
    <BreezeAuthenticatedLayout>
            <Head title="patient Create" />
            <div class="w-full flex flex-col items-center justify-center">
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg mb-2">
                    <h2>Choose if user is an existing user</h2>

                        <div class="flex mt-5">
                            <BreezeLabel class="w-1/2">
                                <input type="radio" name="user_type" value="existing" v-model="form.user_type" checked />
                                Existing User
                            </BreezeLabel>

                            <BreezeLabel class="w-1/2">
                                <input type="radio" name="user_type" value="new" v-model="form.user_type" />
                                New User
                            </BreezeLabel>
                        </div>

                </div>





                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md  sm:rounded-lg">


                    <BreezeValidationErrors class="mb-4" />

                    <form @submit.prevent="submit">


                    <div v-if="form.user_type == 'existing'" >
                        <h2>Select a user</h2>

                        <div class="mt-4">
                            <v-select :options="users_options" :reduce="user => user.value" v-model="form.selected_user" placeholder="Type a name here"></v-select>
                        </div>
                    </div>



                      <div  v-if="form.user_type == 'new'" >

                            <h2>Patient Bio Data</h2>

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
                      </div>

                    <div class="flex items-center justify-end mt-4">
                        <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Continue
                        </BreezeButton>
                    </div>
                   </form>

                </div>


            </div>
    </BreezeAuthenticatedLayout>
</template>

