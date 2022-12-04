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
    GridComponent
  } from 'echarts/components';
  import VChart, { THEME_KEY } from 'vue-echarts';
  import { ref, defineComponent } from 'vue';

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

  use([
    CanvasRenderer,
    LineChart,
    TitleComponent,
    TooltipComponent,
    LegendComponent,
    GridComponent,
  ]);

  export default defineComponent({
    name: 'HelloWorld',
    components: {
      VChart,
    },
    provide: {
      [THEME_KEY]: 'light',
    },
    setup() {
      const option = ref({
          // Make gradient line here
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
      max: dateList.length - 1
    }
  ],

  tooltip: {
    trigger: 'axis'
  },
  xAxis: [
    {
      data: dateList
    }
  ],
  yAxis: [
    {}
  ],
  grid: [
    {
      bottom: '15%'
    }
  ],
  series: [
    {
      type: 'line',
      showSymbol: false,
      data: valueList
    }
  ]
      });

      return { option };
    },
  });
  </script>

  <style scoped>
  .chart {
    height: 35vh;
  }
  </style>
