<script setup>
import { onMounted, reactive, ref } from 'vue';

const props = defineProps(['modelValue']);

const emits = defineEmits(['update:modelValue']);

const input = ref(null);
const _modelValue = ref("");

onMounted(() => {
    _modelValue.value = props.modelValue;
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

</script>



<template>

    <select v-model.lazy="_modelValue" @change="$emit('update:modelValue', $event.target.value)" ref="input">
        <option disabled value="">Please select one</option>
        <option value="doctor">Doctor</option>
        <option value="admin">Admin</option>
    </select>


</template>



<style>

</style>
