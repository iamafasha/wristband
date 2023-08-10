<script setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import 'datatables.net-select';
import 'datatables.net-responsive';
import 'datatables.net-buttons';
import 'datatables.net-buttons/js/buttons.html5.min';

const props = defineProps({
    data:{
        type:Array
    },
})

DataTable.use(DataTablesCore);



</script>

<template>
    <DataTable
        :data="props.data"
        class="display"
        :options="{
            select: true,
            order: [[5, 'desc']],
            dom: 'Bfrtip',
            buttons: [
                'csvHtml5',
            ]
        }">
        <thead>
            <tr>
                <th>Blood Pressure (mmHg)</th>
                <th>Heart Rate (bpm)</th>
                <th>SPo2 (%)</th>
                <th>Temp (°C)</th>
                <th>Device</th>
                <th>Reading Time</th>
            </tr>
        </thead>
    </DataTable>
</template>
