@extends('layouts.dashboard')

{{-- Title --}}
@section('title')
    {{ config('app.name') }}
@endsection

{{-- Css --}}
@push('css')
@endpush

@push('page-js')
    <script src="{{ asset('dashboard_assets/app-assets/js/scripts/pages/custom-datatable.js') }}"></script>
    <script src="{{ asset('dashboard_assets/app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
@endpush

{{-- Menu Active --}}
@section('dashboard')
    active
@endsection

{{-- Breadcrumb --}}
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">Admin Dashboard</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Home</a>
            </li>
        </ol>
    </div>
@endsection


{{-- Content --}}
@section('content')
<style>
    .apexcharts-menu-icon{
        display:none !important;
    }
    .apexcharts-title-text{
        display:none !important;
    }
    .apexcharts-yaxis-inversed{
        display:none !important;
    }
</style>
    <section id="dashboard-analytics">
        <div class="row match-height"> 
            <!-- Subscribers Chart Card starts -->
            <div class="col-sm-4 col-12">
                <div class="card">
                    <div class="card-header flex-column align-items-start pb-0">
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content"> 
                                <i data-feather='message-square'  class="font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="font-weight-bolder mt-1">{{totalOrderCount()}}</h2>
                        <p class="card-text">Total Orders</p>
                    </div>
                    {{-- <div id="gained-chart"></div> --}}
                </div>
            </div>
            <!-- Subscribers Chart Card ends -->

            <!-- Orders Chart Card starts -->
            <div class="col-sm-4 col-12">
                <div class="card">
                    <div class="card-header flex-column align-items-start pb-0">
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather='send' class="font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="font-weight-bolder mt-1">{{totalDeliveredOrderCount()}}</h2>
                        <p class="card-text">Total Delivered Orders</p>
                    </div>
                    {{-- <div id="order-chart2"></div> --}}
                </div>
            </div>

            <div class="col-sm-4 col-12">
                <div class="card">
                    <div class="card-header flex-column align-items-start pb-0">
                        <div class="avatar bg-light-warning p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather="file" class="font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="font-weight-bolder mt-1">{{totalUserCount()}}</h2>
                        <p class="card-text">Total User</p>
                    </div>
                    {{-- <div id="order-chart"></div> --}}
                </div>
            </div> 
            {{-- <div class="col-sm-3 col-12">
                <div class="card">
                    <div class="card-header flex-column align-items-start pb-0">
                        <div class="avatar bg-light-warning p-50 m-0">
                            <div class="avatar-content">
                                <span class="font-medium-5"> € </span>
                            </div>
                        </div>
                        <h2 class="font-weight-bolder mt-1">100,000</h2>
                        <p class="card-text">Total Investment</p>
                    </div>
                    <div id="order-chart"></div>
                </div>
            </div>  --}}

            <!-- Donut Chart Starts-->
            <div class="col-xl-6 col-12">
                <div class="card">
                    <div class="card-header flex-column align-items-start">
                        <h4 class="card-title mb-75">Weekly Orders</h4>
                        {{-- <span class="card-subtitle text-muted">Spending on various categories </span> --}}
                    </div>
                    <div class="card-body">
                        <div id="donut-chart-italian"></div>
                    </div>
                </div>
            </div>
            <!-- Donut Chart Ends-->
            <div class="col-xl-6 col-12 pb-0">
                <div class="card">
                    <div class="card-header flex-column align-items-start">
                        <h4 class="card-title mb-75">Weekly Order Status</h4>
                        <span class="card-subtitle text-muted">Statistic of order status</span>
                    </div>
                    <div class="card-body">
                        <div id="chart-italian"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-12 pb-0">
                <div class="card">
                    <div class="card-header flex-column align-items-start">
                        <h4 class="card-title mb-75">Yearly Payment Status</h4>
                        <span class="card-subtitle text-muted">Statistic of payment status</span>
                    </div>
                    <div class="card-body">
                        <div id="chart-payment"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-12 pb-0">
                <div class="card">
                    <div class="card-header flex-column align-items-start">
                        <h4 class="card-title mb-75">Last 12 Months Order Amount Status</h4>
                        <span class="card-subtitle text-muted">Statistic of order amount status</span>
                    </div>
                    <div class="card-body">
                        <div id="chart-totalPayment"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-12 pb-0">
                <div class="card">
                    <div class="card-header flex-column align-items-start">
                        <h4 class="card-title mb-75">Total User</h4>
                        <span class="card-subtitle text-muted">Statistic of total Users</span>
                    </div>
                    <div class="card-body">
                        <div id="userChart"></div>
                    </div>
                </div>
        </div>
           



         
        </div>  
    </section>
@endsection

@push('js')
<script>
    
    var flatPicker = $('.flat-picker'),
         isRtl = $('html').attr('data-textdirection') === 'rtl',
         chartColors = {
         column: {
             series1: '#826af9',
             series2: '#d2b0ff',
             bg: '#f8d3ff'
         },
         success: {
             shade_100: '#7eefc7',
             shade_200: '#06774f'
         },
         donut: {
             series1: '#ffe700',
             series2: '#00d4bd',
             series3: '#45f542',
             series4: '#2b9bf4',
             series5: '#FFA1A1',
             series6: '#c01cd6',
             series7: '#ba0d35',
         },
         area: {
             series3: '#a4f8cd',
             series2: '#60f2ca',
             series1: '#2bdac7'
         }
         };
 
     // heat chart data generator
     function generateDataHeat(count, yrange) {
         var i = 0;
         var series = [];
         while (i < count) {
         var x = 'w' + (i + 1).toString();
         var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
 
         series.push({
             x: x,
             y: y
         });
         i++;
         }
         return series;
     }
 
     // Init flatpicker
     if (flatPicker.length) {
         var date = new Date();
         flatPicker.each(function () {
         $(this).flatpickr({
             mode: 'range',
             defaultDate: ['2019-05-01', '2019-05-10']
         });
         });
     }
 
     var barChartEl = document.querySelector('#lead-stats-bar-chart'),
         barChartConfig = {
         chart: {
             height: 400,
             type: 'bar',
             parentHeightOffset: 0,
             toolbar: {
             show: false
             }
         },
         plotOptions: {
             bar: {
             horizontal: true,
             barHeight: '30%',
             endingShape: 'rounded'
             }
         },
         grid: {
             xaxis: {
             lines: {
                 show: false
             }
             },
             padding: {
             top: -15,
             bottom: -10
             }
         },
         colors: ["#67cdff", "#fe275e", "#5b5bd7", "#28C76F", "#ff9d1f", "#ff3329"],
         dataLabels: {
             enabled: true
         },
         series: [
             {
             name:"Total",
             data: @json($last_week_send_messge),
             }
         ],
         xaxis: {
             categories: @json($days),
         },
         yaxis: {
             opposite: isRtl
         }
         };
     if (typeof barChartEl !== undefined && barChartEl !== null) {
         var barChart = new ApexCharts(barChartEl, barChartConfig);
         barChart.render();
     }
 
 </script>

<script>
    var $textMutedColor = '#b9b9c3';
    var $labelColor = '#313c50';
</script>
<script>
    var $compatabilityRevenueChart = document.querySelector('#compatability-project-stats-chart');
    var compatabilityRevenueChartOptions;
    var compatabilityRevenueChart;

    compatabilityRevenueChartOptions = {
        chart: {
            height: 240,
            toolbar: { show: false },
            zoom: { enabled: false },
            type: 'line',
            offsetX: -10,
        },
        stroke: {
            curve: 'smooth',
            dashArray: [0, 8],
            width: [4, 3],
        },
        grid: {
            borderColor: $labelColor
        },
        legend: {
            show: false
        },
        colors: ["#35cbe2", "#d172f2"],
        markers: {
            size: 0,
            hover: {
                size: 5,
            },
        },
        xaxis: {
            labels: {
                style: {
                    colors: $textMutedColor,
                    fontSize: '1rem',
                },
            },
            axisTicks: {
                show: false,
            },
            categories: ["{{ _('Jan') }}", "{{ _('Feb') }}", "{{ _('Mar') }}", "{{ _('Apr') }}", "{{ _('May') }}", "{{ _('Jun') }}", "{{ _('Jul') }}", "{{ _('Aug') }}", "{{ _('Sep') }}", "{{ _('Oct') }}", "{{ _('Nov') }}", "{{ _('Dec') }}"],
            axisBorder: {
                show: false,
            },
            tickPlacement: 'on',
        },
        yaxis: {
            tickAmount: 5,
            labels: {
                style: {
                    colors: $textMutedColor,
                    fontSize: '1rem',
                },
                formatter: function (val) {
                    return val > 999 ? (val / 1000).toFixed(0) + 'k' : val;
                }
            }
        },
        grid: {
            padding: {
                top: -20,
                bottom: -10,
                left: 20
            }
        },
        tooltip: {
            x: { show: false }
        },
        series: [
            {
                name: "{{ __('This Year') }}",
                data: @json($this_year)
            },
            {
                name: "{{ __('Last Year') }}",
                data: @json($last_year)
            }
        ],
    };

    compatabilityRevenueChart = new ApexCharts($compatabilityRevenueChart, compatabilityRevenueChartOptions);
    compatabilityRevenueChart.render();
</script>
<script>
    var donutChartEl = document.querySelector('#donut-chart-italian'),
    donutChartConfig = {
      chart: {
        height: 350,
        type: 'donut'
      },
      legend: {
        show: true,
        position: 'bottom'
      },
      labels: ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
      series: @json($orders),

      colors: [
        chartColors.donut.series1,
        chartColors.donut.series5,
        chartColors.donut.series3,
        chartColors.donut.series4,
        chartColors.donut.series2,
        chartColors.donut.series6,
        chartColors.donut.series7,
      ],
      dataLabels: {
        enabled: true,
        formatter: function (val, opt) {
          return parseInt(val) + '%';
        }
      },
      plotOptions: {
        pie: {
          donut: {
            labels: {
              show: true,
              name: {
                fontSize: '2rem',
                fontFamily: 'Montserrat'
              },
              value: {
                fontSize: '1rem',
                fontFamily: 'Montserrat',
                formatter: function (val) {
                  return parseInt(val) + '%';
                }
              },
              total: {
                show: true,
                fontSize: '1.5rem',
                label: 'Last 7 days',
                formatter: function (w) {
                  return {{ \App\Models\MyOrder::where('created_at', '>=', \Carbon\Carbon::today()->subDays(7))->count() }};
                }
              }
            }
          }
        }
      },
      responsive: [
        {
          breakpoint: 992,
          options: {
            chart: {
              height: 380
            }
          }
        },
        {
          breakpoint: 576,
          options: {
            chart: {
              height: 320
            },
            plotOptions: {
              pie: {
                donut: {
                  labels: {
                    show: true,
                    name: {
                      fontSize: '1.5rem'
                    },
                    value: {
                      fontSize: '1rem'
                    },
                    total: {
                      fontSize: '1.5rem'
                    }
                  }
                }
              }
            }
          }
        }
      ]
    };
  if (typeof donutChartEl !== undefined && donutChartEl !== null) {
    var donutChart = new ApexCharts(donutChartEl, donutChartConfig);
    donutChart.render();
  }
</script>
<script>
    var options = {
          series:[{
                    name: 'Total User',
                    data: @json($monthlyUsers)                   
                }
                ],
          chart: {
          type: 'bar',
          height: 350
        },
        annotations: {
          xaxis: [{
            x: 500,
            borderColor: '#00E396',
            label: {
              borderColor: '#00E396',
              style: {
                color: '#fff',
                background: '#00E396',
              },
            }
          }]
        },
        plotOptions: {
          bar: {
            horizontal: true,
          }
        },
        dataLabels: {
          enabled: true
        },
        xaxis: {
          categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        },
        grid: {
          xaxis: {
            lines: {
              show: true
            }
          }
        },
        yaxis: {
          reversed: true,
          axisTicks: {
            show: true
          }
        }
        };
        var chart = new ApexCharts(document.querySelector("#userChart"), options);
        chart.render();
</script>
<script>
     var options = {
          series: @json($orderStatus),
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: ['New', 'In-process', 'Ready to pickup', 'Delivered'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chart-italian"), options);
        chart.render();
      
      
    
</script>
<script>
    var options = {
          series: [{
          name: 'Cash',
          data: @json($cashPayment)
        }, {
          name: 'Card',
          data: @json($cardPayment)
        }, {
          name: 'Ticket',
          data: @json($ticketPayment)
        }],
          chart: {
          type: 'bar',
          height: 350,
          stacked: true,
        },
        plotOptions: {
          bar: {
            horizontal: true,
            dataLabels: {
              total: {
                enabled: true,
                offsetX: 0,
                style: {
                  fontSize: '13px',
                  fontWeight: 900
                }
              }
            }
          },
        },
        stroke: {
          width: 1,
          colors: ['#fff']
        },
        title: {
          text: 'Fiction Books Sales'
        },
        xaxis: {
          categories: @json($totalYears),
          labels: {
            formatter: function (val) {
              return val 
            }
          }
        },
        yaxis: {
          title: {
            text: undefined
          },
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val 
            }
          }
        },
        fill: {
          opacity: 1
        },
        legend: {
          position: 'top',
          horizontalAlign: 'left',
          offsetX: 40
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart-payment"), options);
        chart.render();
      
      
</script>
<script>
      var options = {
          series: [{
          name: 'Cash',
          data: @json($cashperMonth)
        }, {
          name: 'Card',
          data: @json($cardperMonth)
        }, {
          name: 'Ticket',
          data: @json($ticketperMonth)
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: @json($months),
        },
        yaxis: {
          title: {
            text: '$ (thousands)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart-totalPayment"), options);
        chart.render();
</script>
@endpush
