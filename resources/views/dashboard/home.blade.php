@extends('layouts.master')

@section('content')
<!-- Page-content -->
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

            <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
                <div class="grow">
                    <h5 class="text-16">
                        Dashboards</h5>
                </div>
                <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                    <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                        <a href="#!" class="text-slate-400 dark:text-zink-200">Dashboards</a>
                    </li>
                    <li class="text-slate-700 dark:text-zink-100">
                        Dashboards
                    </li>
                </ul>
            </div>
            <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
                <div class="relative col-span-12 overflow-hidden card 2xl:col-span-8 bg-slate-900">
                    <div class="absolute inset-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-100" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" width="1440" height="560" preserveaspectratio="none" viewbox="0 0 1440 560">
                            <g mask="url(&quot;#SvgjsMask1000&quot;)" fill="none">
                                <use xlink:href="#SvgjsSymbol1007" x="0" y="0"></use>
                                <use xlink:href="#SvgjsSymbol1007" x="720" y="0"></use>
                            </g>
                            <defs>
                                <mask id="SvgjsMask1000">
                                    <rect width="1440" height="560" fill="#ffffff"></rect>
                                </mask>
                                <path d="M-1 0 a1 1 0 1 0 2 0 a1 1 0 1 0 -2 0z" id="SvgjsPath1003"></path>
                                <path d="M-3 0 a3 3 0 1 0 6 0 a3 3 0 1 0 -6 0z" id="SvgjsPath1004"></path>
                                <path d="M-5 0 a5 5 0 1 0 10 0 a5 5 0 1 0 -10 0z" id="SvgjsPath1001"></path>
                                <path d="M2 -2 L-2 2z" id="SvgjsPath1005"></path>
                                <path d="M6 -6 L-6 6z" id="SvgjsPath1002"></path>
                                <path d="M30 -30 L-30 30z" id="SvgjsPath1006"></path>
                            </defs>
                            <symbol id="SvgjsSymbol1007">
                                <use xlink:href="#SvgjsPath1001" x="30" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="30" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="30" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1003" x="30" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="30" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="30" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="30" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1003" x="30" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="30" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="30" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="90" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1003" x="90" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="90" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="90" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1004" x="90" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1003" x="90" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="90" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="90" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="90" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="90" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="150" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1005" x="150" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="150" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1005" x="150" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1005" x="150" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1006" x="150" y="330" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                                <use xlink:href="#SvgjsPath1004" x="150" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="150" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="150" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="150" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="210" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="210" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1006" x="210" y="150" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                                <use xlink:href="#SvgjsPath1002" x="210" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="210" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1005" x="210" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="210" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="210" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1006" x="210" y="510" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                                <use xlink:href="#SvgjsPath1003" x="210" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="270" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1005" x="270" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="270" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="270" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1005" x="270" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="270" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1006" x="270" y="390" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                                <use xlink:href="#SvgjsPath1002" x="270" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1005" x="270" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1005" x="270" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="330" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1006" x="330" y="90" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                                <use xlink:href="#SvgjsPath1002" x="330" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="330" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1006" x="330" y="270" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                                <use xlink:href="#SvgjsPath1001" x="330" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="330" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="330" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1003" x="330" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="330" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1004" x="390" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1005" x="390" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="390" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1005" x="390" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="390" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="390" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="390" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1003" x="390" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="390" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="390" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="450" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1004" x="450" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="450" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="450" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="450" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="450" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="450" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="450" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="450" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="450" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="510" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1003" x="510" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1005" x="510" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1005" x="510" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="510" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1004" x="510" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1006" x="510" y="390" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                                <use xlink:href="#SvgjsPath1001" x="510" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="510" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="510" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1005" x="570" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="570" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="570" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="570" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="570" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="570" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1006" x="570" y="390" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                                <use xlink:href="#SvgjsPath1005" x="570" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="570" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="570" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="630" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1005" x="630" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1005" x="630" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="630" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="630" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1006" x="630" y="330" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                                <use xlink:href="#SvgjsPath1002" x="630" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1006" x="630" y="450" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                                <use xlink:href="#SvgjsPath1001" x="630" y="510" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1005" x="630" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="690" y="30" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1005" x="690" y="90" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="690" y="150" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1002" x="690" y="210" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1005" x="690" y="270" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1001" x="690" y="330" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1003" x="690" y="390" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1003" x="690" y="450" stroke="rgba(32, 43, 61, 1)"></use>
                                <use xlink:href="#SvgjsPath1006" x="690" y="510" stroke="rgba(32, 43, 61, 1)" stroke-width="3"></use>
                                <use xlink:href="#SvgjsPath1003" x="690" y="570" stroke="rgba(32, 43, 61, 1)"></use>
                            </symbol>
                        </svg>
                    </div>
                    <div class="relative card-body">
                        <div class="grid items-center grid-cols-12">
                            <div class="col-span-12 lg:col-span-8 2xl:col-span-7">
                                <h5 class="mb-3 font-normal tracking-wide text-slate-200">Selamat Datang di Kantin Cerdas Fasilkom 🎉</h5>
                                <p class="mb-5 text-slate-400">Sebuah dasbor kantin cerdas memiliki tujuan tersebut. Dasbor ini memberikan tim kantin Anda gambaran yang jelas tentang indikator kinerja keuangan dan situs web utama kapan saja.</p>
                            </div>
                            <div class="hidden col-span-12 2xl:col-span-3 lg:col-span-2 lg:col-start-11 2xl:col-start-10 lg:block">
                                <img src="{{asset('assets/images/dashboard.png')}}" alt="" class="h-40 ltr:2xl:ml-auto rtl:2xl:mr-auto">
                            </div>
                        </div>
                    </div>`
                </div><!--end col-->
                <div class="col-span-12 card 2xl:col-span-4 2xl:row-span-2">
           <!-- resources/views/dashboard/home.blade.php -->
                {{-- <div class="card-body">
                    <div class="flex items-center mb-3">
                        <h6 class="grow text-15">Statistik Pesanan</h6>
                        <div class="relative">
                            <a href="#!" class="underline transition-all duration-200 ease-linear text-custom-500 hover:text-custom-600">Lihat Semua <i data-lucide="move-right" class="inline-block align-middle size-4 ltr:ml-1 rtl:mr-1"></i></a>
                        </div>
                    </div>
                    <div id="orderStatisticsChart" class="apex-charts" data-chart-colors='["bg-purple-500", "bg-sky-500"]' dir="ltr">
                        <script>
                            var options = {
                                series: [{
                                    name: 'Completed Orders',
                                    data: [{{ $completedOrders }}]
                                }, {
                                    name: 'Uncompleted Orders',
                                    data: [{{ $uncompletedOrders }}]
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
                                    categories: ['Orders'],
                                },
                                yaxis: {
                                    title: {
                                        text: 'Count'
                                    }
                                },
                                fill: {
                                    opacity: 1
                                },
                                tooltip: {
                                    y: {
                                        formatter: function (val) {
                                            return val;
                                        }
                                    }
                                }
                            };

                            var chart = new ApexCharts(document.querySelector("#orderStatisticsChart"), options);
                            chart.render();
                        </script>
                    </div>
                </div> --}}

                </div><!--end col-->
                <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
                    <div class="text-center card-body">
                        <div class="flex items-center justify-center mx-auto rounded-full size-14 bg-custom-100 text-custom-500 dark:bg-custom-500/20">
                            <i data-lucide="wallet-2"></i>
                        </div>
                        <h5 class="mt-4 mb-2">Rp <span class="counter-value" data-target="{{ $financialReportData['totalRevenue'] }}"></span></h5>
                        <p class="text-slate-500 dark:text-zink-200">Total Pendapatan</p>
                    </div>
                </div><!--end col-->
                <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
                    <div class="text-center card-body">
                        <div class="flex items-center justify-center mx-auto text-purple-500 bg-purple-100 rounded-full size-14 dark:bg-purple-500/20">
                            <i data-lucide="package"></i>
                        </div>
                        <h5 class="mt-4 mb-2"><span class="counter-value" data-target="{{ $financialReportData['totalOrdersCount'] }}"></span></h5>
                        <p class="text-slate-500 dark:text-zink-200">Jumlah Pesanan  </p>
                    </div>
                </div><!--end col-->
                <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
                    <div class="text-center card-body">
                        <div class="flex items-center justify-center mx-auto text-green-500 bg-green-100 rounded-full size-14 dark:bg-green-500/20">
                            <i data-lucide="truck"></i>
                        </div>
                        <h5 class="mt-4 mb-2"><span class="counter-value" data-target="17150">0</span></h5>
                        <p class="text-slate-500 dark:text-zink-200">Terkirim                        </p>
                    </div>
                </div><!--end col-->
                <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
                    <div class="text-center card-body">
                        <div class="flex items-center justify-center mx-auto text-red-500 bg-red-100 rounded-full size-14 dark:bg-red-500/20">
                            <i data-lucide="package-x"></i>
                        </div>
                        <h5 class="mt-4 mb-2"><span class="counter-value" data-target="3519">0</span></h5>
                        <p class="text-slate-500 dark:text-zink-200">Dibatalkan</p>
                    </div>
                </div><!--end col-->
                <div class="col-span-12 card 2xl:col-span-8">
                    <div class="card-body">
                        <div class="flex flex-col gap-4 mb-4 md:mb-3 md:items-center md:flex-row">
                            <h6 class="grow text-15"> Pendapatan Penjualan</h6>

                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-3">
                            <div class="col-span-12 md:col-span-6 lg:col-span-3">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center rounded-md size-12 text-sky-500 bg-sky-50 shrink-0 dark:bg-sky-500/10">
                                        <i data-lucide="bar-chart"></i>
                                    </div>
                                    <div class="grow">
                                        <p class="mb-1 text-slate-500 dark:text-zink-200">Jumlah Penjualan
                                        </p>
                                        <h5 class="text-15">Rp<span class="counter-value" data-target="1517.36">0</span>k</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-6 lg:col-span-3">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center text-green-500 rounded-md size-12 bg-green-50 shrink-0 dark:bg-green-500/10">
                                        <i data-lucide="trending-up"></i>
                                    </div>
                                    <div class="grow">
                                        <p class="mb-1 text-slate-500 dark:text-zink-200">Total keuntungan</p>
                                        <h5 class="text-15">Rp <span class="counter-value" data-target="746840">0</span></h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!--end col-->
                <div class="col-span-12 2xl:col-span-4">
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12 card lg:col-span-6 2xl:col-span-12">

                        </div><!--end col-->
                        {{-- <div class="col-span-12 card lg:col-span-6 2xl:col-span-12">
                            <div class="card-body">
                                <div class="flex items-center mb-2">
                                    <h5 class="grow"><span class="counter-value" data-target="1596">0</span></h5>
                                    <span class="px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-white border-red-100 text-red-500 dark:bg-zink-700 dark:border-red-900"><i data-lucide="trending-down" class="inline-block size-3 ltr:mr-1 rtl:ml-1"></i> 6.8%</span>
                                </div>
                                <h6 class="mb-0">Sasaran Pesanan Bulanan (20000+)
                                </h6>
                                <div>
                                    <div class="flex items-center justify-between mt-5 mb-2">
                                        <p class="text-slate-500 dark:text-zink-200">Jumlah Pesanan
                                        </p>
                                        <h6 class="mb-0 text-custom-500">85%</h6>
                                    </div>
                                    <div class="w-full bg-slate-200 rounded-full h-2.54 dark:bg-zink-600">
                                        <div class="bg-custom-500 h-2.5 rounded-full" style="width: 85%"></div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end col--> --}}
                    </div><!--end grid-->
                </div><!--end col-->
                {{-- <div class="col-span-12 card lg:col-span-6 2xl:col-span-3">
                    <div class="card-body">
                        <div class="flex items-center mb-3">
                            <h6 class="grow text-15">Pelayanan pelanggan  </h6>
                            <div class="relative dropdown shrink-0">
                                <button type="button" class="flex items-center justify-center size-[30px] p-0 bg-white text-slate-500 btn hover:text-slate-500 hover:bg-slate-100 focus:text-slate-500 focus:bg-slate-100 active:text-slate-500 active:bg-slate-100 dark:bg-zink-700 dark:hover:bg-slate-500/10 dark:focus:bg-slate-500/10 dark:active:bg-slate-500/10 dropdown-toggle" id="customServiceDropdown" data-bs-toggle="dropdown">
                                    <i data-lucide="more-vertical" class="inline-block size-4"></i>
                                </button>

                                <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="customServiceDropdown">
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!">1 Weekly</a>
                                    </li>
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!">1 Monthly</a>
                                    </li>
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!">3 Monthly</a>
                                    </li>
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!">6 Monthly</a>
                                    </li>
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!">This Yearly</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mt-5 mb-2">
                                <p class="text-slate-500 dark:text-zink-200">8% dari Sasaran Tercapai ($25k)
                                </p>
                            </div>
                            <div class="w-full h-2 rounded-full bg-slate-200 dark:bg-zink-600">
                                <div class="h-2 bg-green-500 rounded-full" style="width: 28%"></div>
                            </div>
                            <div class="grid mt-3 xl:grid-cols-2">
                                <div class="flex items-center gap-2">
                                    <div class="shrink-0">
                                        <i data-lucide="calendar-days" class="inline-block mb-1 align-middle size-4"></i>
                                    </div>
                                    <p class="mb-0 text-slate-500 dark:text-zink-200">Bulan ini: <span class="font-medium text-slate-800 dark:text-zink-50">$13,741</span></p>
                                </div>
                            </div>
                        </div>
                        <h6 class="mt-4 mb-3">Pelanggan Teratas </h6>
                        <ul class="divide-y divide-slate-200 dark:divide-zink-500">
                            <li class="flex items-center gap-3 py-2 first:pt-0 last:pb-0">
                                <div class="w-8 h-8 rounded-full shrink-0 bg-slate-100 dark:bg-zink-600">
                                    <img src="assets/images/avatar-2.png" alt="" class="w-8 h-8 rounded-full">
                                </div>
                                <div class="grow">
                                    <h6 class="font-medium">Urrie Arthur</h6>
                                    <p class="text-slate-500 dark:text-zink-200">arthur@starcode.com</p>
                                </div>
                                <div class="shrink-0">
                                    <h6>$2,452</h6>
                                </div>
                            </li>
                            <li class="flex items-center gap-3 py-2 first:pt-0 last:pb-0">
                                <div class="w-8 h-8 rounded-full shrink-0 bg-slate-100 dark:bg-zink-600">
                                    <img src="assets/images/avatar-3.png" alt="" class="w-8 h-8 rounded-full">
                                </div>
                                <div class="grow">
                                    <h6 class="font-medium">Natalie Christy</h6>
                                    <p class="text-slate-500 dark:text-zink-200">natalie@starcode.com</p>
                                </div>
                                <div class="shrink-0">
                                    <h6>$1,893</h6>
                                </div>
                            </li>
                            <li class="flex items-center gap-3 py-2 first:pt-0 last:pb-0">
                                <div class="w-8 h-8 rounded-full shrink-0 bg-slate-100 dark:bg-zink-600">
                                    <img src="assets/images/avatar-4.png" alt="" class="w-8 h-8 rounded-full">
                                </div>
                                <div class="grow">
                                    <h6 class="font-medium">Laurie Jackson</h6>
                                    <p class="text-slate-500 dark:text-zink-200">jackson@starcode.com</p>
                                </div>
                                <div class="shrink-0">
                                    <h6>$1,196</h6>
                                </div>
                            </li>
                            <li class="flex items-center gap-3 py-2 first:pt-0 last:pb-0">
                                <div class="w-8 h-8 rounded-full shrink-0 bg-slate-100 dark:bg-zink-600">
                                    <img src="assets/images/avatar-5.png" alt="" class="w-8 h-8 rounded-full">
                                </div>
                                <div class="grow">
                                    <h6 class="font-medium">Michael Torres</h6>
                                    <p class="text-slate-500 dark:text-zink-200">torres@starcode.com</p>
                                </div>
                                <div class="shrink-0">
                                    <h6>$976</h6>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div><!--end col--> --}}
                <div class="col-span-12 card lg:col-span-6 2xl:col-span-3">
                    <div class="card-body">
                        <div class="flex items-center mb-3">
                            <h6 class="grow text-15">Penjualan Bulan Ini </h6>
                            <div class="relative dropdown shrink-0">
                                <button type="button" class="flex items-center justify-center size-[30px] p-0 bg-white text-slate-500 btn hover:text-slate-500 hover:bg-slate-100 focus:text-slate-500 focus:bg-slate-100 active:text-slate-500 active:bg-slate-100 dark:bg-zink-700 dark:hover:bg-slate-500/10 dark:focus:bg-slate-500/10 dark:active:bg-slate-500/10 dropdown-toggle" id="sellingProductDropdown" data-bs-toggle="dropdown">
                                    <i data-lucide="more-vertical" class="inline-block size-4"></i>
                                </button>

                                <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="sellingProductDropdown">
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!">1 Weekly</a>
                                    </li>
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!">1 Monthly</a>
                                    </li>
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!">3 Monthly</a>
                                    </li>
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!">6 Monthly</a>
                                    </li>
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!">This Yearly</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 my-3">
                            <div class="flex items-center justify-center text-green-500 rounded-md size-12 bg-green-50 shrink-0 dark:bg-green-500/10">
                                <i data-lucide="trending-up"></i>
                            </div>
                            <div class="grow">
                                <p class="mb-1 text-slate-500 dark:text-zink-200">Total keuntungan</p>
                                <h5 class="text-15">Rp <span class="counter-value" data-target="746840">0</span></h5>
                            </div>

                        </div>
                        <div id="salesThisMonthChart" class="apex-charts" data-chart-colors='["bg-sky-100", "bg-orange-100", "bg-sky-500", "bg-orange-500"]' dir="ltr"></div>
                    </div>
                </div><!--end col-->
                <div class="col-span-12 card lg:col-span-6 2xl:col-span-3">
                    <div class="card-body">
                        <div class="flex items-center mb-3">
                            <h6 class="grow text-15">Produk Terlaris</h6>
                            <div class="relative dropdown shrink-0">
                                <button type="button" class="flex items-center justify-center size-[30px] p-0 bg-white text-slate-500 btn hover:text-slate-500 hover:bg-slate-100 focus:text-slate-500 focus:bg-slate-100 active:text-slate-500 active:bg-slate-100 dark:bg-zink-700 dark:hover:bg-slate-500/10 dark:focus:bg-slate-500/10 dark:active:bg-slate-500/10 dropdown-toggle" id="sellingProductDropdown" data-bs-toggle="dropdown">
                                    <i data-lucide="more-vertical" class="inline-block size-4"></i>
                                </button>

                                <ul class="absolute z-50 hidden py-2 mt-1 ltr:text-left rtl:text-right list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="sellingProductDropdown">
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!">1 Weekly</a>
                                    </li>
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!">1 Monthly</a>
                                    </li>
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!">3 Monthly</a>
                                    </li>
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!">6 Monthly</a>
                                    </li>
                                    <li>
                                        <a class="block px-4 py-1.5 text-base transition-all duration-200 ease-linear text-slate-600 dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="#!">This Yearly</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <ul class="flex flex-col gap-5">
                            <li class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-10 h-10 rounded-md bg-slate-100 dark:bg-zink-600">
                                    <img src="assets/images/img-02.png" alt="" class="h-6">
                                </div>
                                <div class="overflow-hidden grow">
                                    <h6 class="truncate">Mesh Ergonomic Black Chair</h6>
                                    <div class="text-yellow-500">
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-half-fill"></i>
                                    </div>
                                </div>
                                <h6 class="shrink-0"><i data-lucide="shopping-cart" class="inline-block align-middle size-4 text-slate-500 dark:text-zink-200 ltr:mr-1 rtl:ml-1"></i> 798</h6>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-10 h-10 rounded-md bg-slate-100 dark:bg-zink-600">
                                    <img src="assets/images/img-03.png" alt="" class="h-6">
                                </div>
                                <div class="overflow-hidden grow">
                                    <h6 class="truncate">Fastcolors Typography Men</h6>
                                    <div class="text-yellow-500">
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-half-fill"></i>
                                    </div>
                                </div>
                                <h6 class="shrink-0"><i data-lucide="shopping-cart" class="inline-block align-middle size-4 text-slate-500 dark:text-zink-200 ltr:mr-1 rtl:ml-1"></i> 695</h6>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-10 h-10 rounded-md bg-slate-100 dark:bg-zink-600">
                                    <img src="assets/images/img-04.png" alt="" class="h-6">
                                </div>
                                <div class="overflow-hidden grow">
                                    <h6 class="truncate">Mesh Ergonomic Green Chair</h6>
                                    <div class="text-yellow-500">
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-half-fill"></i>
                                    </div>
                                </div>
                                <h6 class="shrink-0"><i data-lucide="shopping-cart" class="inline-block align-middle size-4 text-slate-500 dark:text-zink-200 ltr:mr-1 rtl:ml-1"></i> 985</h6>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-10 h-10 rounded-md bg-slate-100 dark:bg-zink-600">
                                    <img src="assets/images/img-05.png" alt="" class="h-6">
                                </div>
                                <div class="overflow-hidden grow">
                                    <h6 class="truncate">Techel Black Bluetooth Soundbar</h6>
                                    <div class="text-yellow-500">
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-half-fill"></i>
                                    </div>
                                </div>
                                <h6 class="shrink-0"><i data-lucide="shopping-cart" class="inline-block align-middle size-4 text-slate-500 dark:text-zink-200 ltr:mr-1 rtl:ml-1"></i> 813</h6>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-10 h-10 rounded-md bg-slate-100 dark:bg-zink-600">
                                    <img src="assets/images/img-06.png" alt="" class="h-6">
                                </div>
                                <div class="overflow-hidden grow">
                                    <h6 class="truncate">Bovet Fleurier AIFSQ029</h6>
                                    <div class="text-yellow-500">
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-half-fill"></i>
                                    </div>
                                </div>
                                <h6 class="shrink-0"><i data-lucide="shopping-cart" class="inline-block align-middle size-4 text-slate-500 dark:text-zink-200 ltr:mr-1 rtl:ml-1"></i> 915</h6>
                            </li>
                            <li class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-10 h-10 rounded-md bg-slate-100 dark:bg-zink-600">
                                    <img src="assets/images/img-03.png" alt="" class="h-6">
                                </div>
                                <div class="overflow-hidden grow">
                                    <h6 class="truncate">Fastcolors Typography Men</h6>
                                    <div class="text-yellow-500">
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-fill"></i>
                                        <i class="ri-star-half-fill"></i>
                                    </div>
                                </div>
                                <h6 class="shrink-0"><i data-lucide="shopping-cart" class="inline-block align-middle size-4 text-slate-500 dark:text-zink-200 ltr:mr-1 rtl:ml-1"></i> 785</h6>
                            </li>
                        </ul>
                    </div>
                </div><!--end col-->
            </div><!--end grid-->
        </div>
        <!-- container-fluid -->
    </div>
<!-- End Page-content -->
@endsection
