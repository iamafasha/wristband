<script setup>
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import 'datatables.net-select';
import 'datatables.net-responsive';

DataTable.use(DataTablesCore);

</script>

<template>
    <DataTable :data="data" class="display">
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
