<script setup>
import { onMounted, ref } from 'vue';

defineProps(['modelValue']);

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

</script>



<template>

    <select v-model.lazy="modelValue" @change="$emit('update:modelValue', $event.target.value)" ref="input">
        <option disabled value="">Please select one</option>
        <option value="doctor">Doctor</option>
        <option value="admin">Admin</option>
    </select>


</template>



<style>

</style>
