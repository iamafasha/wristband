<template>
    <v-chart class="chart" :option="option" />
</template>

  <script>
  import { use } from 'echarts/core';
  import { CanvasRenderer } from 'echarts/renderers';
  import { LineChart } from 'echarts/charts';
  import {
    TitleComponent,
    TooltipComponent,
    LegendComponent,
    GridComponent,
    VisualMapComponent
  } from 'echarts/components';
  import VChart, { THEME_KEY } from 'vue-echarts';
  import { defineComponent, reactive , onMounted, onBeforeUnmount, computed } from 'vue';

    function getWeekFromStartDay(start) {
        const days = ['monday', 'tuesday', 'wednesday', 'thursday',
              'friday', 'saterday', 'sunday'];
        var goBackDays = 7;

        var today = new Date();
        var daysSorted = [];

        for(var i = 0; i < goBackDays; i++) {
        var newDate = new Date(today.setDate(today.getDate() - 1));
        daysSorted.push(days[newDate.getDay()]);
        }

        return days

    }

    function randomIntFromInterval(min, max) { // min and max included
        return Math.floor(Math.random() * (max - min + 1) + min)
    }



  use([
    CanvasRenderer,
    LineChart,
    TitleComponent,
    TooltipComponent,
    LegendComponent,
    GridComponent,
    VisualMapComponent
  ]);

  export default defineComponent({
    props:{id:Number,},
    components: { VChart,},
    provide: { [THEME_KEY]: 'light',},
    setup(props) {
            const state = reactive({data:[]});

            const updateGraphData = () => {

                fetch(route('patient.data.api', props.id ))
                    .then(async res => {
                        state.data = await res.json();
                    })
             };

            const intervalHandle = setInterval(updateGraphData, 5000);

            onBeforeUnmount(() => { clearInterval(intervalHandle); });

            onMounted(() => {

                fetch(route('patient.data.api', props.id ))
                    .then(async res => {
                        state.data = await res.json();
                    })
            })

            const option = computed(() => {

                return {
             color:['#fb8649', '#ae1029', '#26c238', '#9876aa', '#0065c2','#57904b','#d35b5c'],
                legend: {
                    orient: 'horizontal',
                    right: 10,
                    top: '10'
                },
                visualMap: [
                    {
                    show: false,
                    type: 'continuous',
                    seriesIndex: 0,
                    min: 0,
                    max: 400
                    },
                    {
                    show: false,
                    type: 'continuous',
                    seriesIndex: 1,
                    dimension: 0,
                    min: 0,
                    max: 6
                    }
                ],
                title:    {
                    left: 'center',
                    text: 'Patient Pressure Graph',
                    top:'5%'
                    },
                tooltip: {
                    trigger: 'axis'
                },
                xAxis: {
                    type: 'time',
                    name:"Time",
                    ...(state.data ?  { min:state.data.min, max:state.data.max}: {})
                },
                yAxis: {
                    name:"DBP(mmHg)",
                    type:"value"
                },
                grid: [
                    {
                    bottom: '15%'
                    }
                ],
                series: [
                    {
                        type: 'line',
                        name: 'Systolic',
                        showSymbol: false,
                        smooth:true,
                        data: (state.data.data) ? Object.values(state.data.data).map(x => [(new Date(x.created_at)).getTime(), x.systolic]) :[]
                    },
                    {
                        type: 'line',
                        name: 'Diastolic',
                        showSymbol: false,
                        smooth:true,
                        data: (state.data.data) ?  Object.values(state.data.data).map(x => [(new Date(x.created_at)).getTime(), x.diastolic]):[]
                    }
                ]
            }
            })

            return { option, state };
        },
    });
  </script>

  <style scoped>
  .chart {
    height: 35vh;
  }
  </style>
