@extends('layouts.master')

@section('content')
<!-- Page-content -->

<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Financial Report</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="#!" class="text-slate-400 dark:text-zink-200">Report</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Financial Report
                </li>
            </ul>
        </div>
        <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 2xl:grid-cols-12">
            <div class="2xl:col-span-2 2xl:row-span-1">
                <div class="card">
                    <div class="flex items-center gap-3 card-body">
                        <div class="flex items-center justify-center rounded-md size-12 text-15 bg-custom-50 text-custom-500 dark:bg-custom-500/20 shrink-0"><i data-lucide="boxes"></i></div>
                        <div class="grow">
                            <h5 class="mb-1 text-16 counter-value" data-target="{{ $financialReportData['totalOrdersCount'] }}">0</h5>
                            <p class="text-slate-500 dark:text-zink-200">Total Orders</p>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
            <div class="2xl:col-span-2 2xl:row-span-1">
                <div class="card">
                    <div class="flex items-center gap-3 card-body">
                        <div class="flex items-center justify-center rounded-md size-12 text-15 bg-sky-50 text-sky-500 dark:bg-sky-500/20 shrink-0"><i data-lucide="package-plus"></i></div>
                        <div class="grow">
                            <h5 class="mb-1 text-16 counter-value" data-target="{{ $financialReportData['totalRevenue'] }}"></h5>
                            <p class="text-slate-500 dark:text-zink-200">Total Pendapatan
                            </p>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
            <div class="order-last md:col-span-2 2xl:col-span-8 2xl:row-span-3 card 2xl:order-none">
                <div class="card-body">
                    <h6 class="mb-4 text-gray-800 text-15 dark:text-zink-50">Orders Overview</h6>
                    <div id="ordersOverview" class="apex-charts" data-chart-colors='["bg-custom-500"]' dir="ltr"></div>
                </div>
            </div><!--end col-->
            <div class="2xl:col-span-2 2xl:row-span-1">
                <div class="card">
                    <div class="flex items-center gap-3 card-body">
                        <div class="flex items-center justify-center text-yellow-500 rounded-md size-12 text-15 bg-yellow-50 dark:bg-yellow-500/20 shrink-0"><i data-lucide="loader"></i></div>
                        <div class="grow">
                            {{-- <h5 class="mb-1 text-16 counter-value" data-target="{{ $financialReportData['pendingOrdersCount'] }}">0</h5> --}}
                            <p class="text-slate-500 dark:text-zink-200">Pending Orders</p>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
            <div class="2xl:col-span-2 2xl:row-span-1">
                <div class="card">
                    <div class="flex items-center gap-3 card-body">
                        <div class="flex items-center justify-center text-purple-500 rounded-md size-12 text-15 bg-purple-50 dark:bg-purple-500/20 shrink-0"><i data-lucide="truck"></i></div>
                        <div class="grow">
                            {{-- <h5 class="mb-1 text-16 counter-value" data-target="{{ $financialReportData['shippingOrdersCount'] }}">0</h5> --}}
                            <p class="text-slate-500 dark:text-zink-200">Shipping Orders</p>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
            <div class="2xl:col-span-2 2xl:row-span-1">
                <div class="card">
                    <div class="flex items-center gap-3 card-body">
                        <div class="flex items-center justify-center text-green-500 rounded-md size-12 text-15 bg-green-50 dark:bg-green-500/20 shrink-0"><i data-lucide="package-check"></i></div>
                        <div class="grow">
                            {{-- <h5 class="mb-1 text-16 counter-value" data-target="{{ $financialReportData['deliveredOrdersCount'] }}">0</h5> --}}
                            <p class="text-slate-500 dark:text-zink-200">Delivered Orders</p>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
            <div class="2xl:col-span-2 2xl:row-span-1">
                <div class="card">
                    <div class="flex items-center gap-3 card-body">
                        <div class="flex items-center justify-center text-red-500 rounded-md size-12 text-15 bg-red-50 dark:bg-red-500/20 shrink-0"><i data-lucide="package-x"></i></div>
                        <div class="grow">
                            {{-- <h5 class="mb-1 text-16 counter-value" data-target="{{ $financialReportData['cancelledOrdersCount'] }}">0</h5> --}}
                            <p class="text-slate-500 dark:text-zink-200">Cancelled Orders</p>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end grid-->
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var options = {
            chart: {
                type: 'bar',
                height: 350
            },
            series: [{
                name: 'Revenue',
                data: [{{ implode(', ', $financialReportData['monthlyOrders']) }}]
            }],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            colors: ['#4f46e5'],
            dataLabels: {
                enabled: true
            }
        };

        var chart = new ApexCharts(document.querySelector("#ordersOverview"), options);
        chart.render();
    });
</script>
@endsection
