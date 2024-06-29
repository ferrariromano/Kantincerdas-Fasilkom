@extends('layouts.master')

@section('content')
<!-- Page-content -->
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Laporan Keuangan</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="#!" class="text-slate-400 dark:text-zink-200">Laporan</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Laporan Keuangan
                </li>
            </ul>
        </div>
        <div class="grid grid-cols-1 gap-x-5 md:grid-cols-2 2xl:grid-cols-12">
            <div class="2xl:col-span-2 2xl:row-span-1">
                {{-- <div class="card">
                    <div class="flex items-center gap-3 card-body">
                        <div class="flex items-center justify-center rounded-md size-12 text-15 bg-custom-50 text-custom-500 dark:bg-custom-500/20 shrink-0"><i data-lucide="boxes"></i></div>
                        <div class="grow">
                            <h5 class="mb-1 text-16 counter-value" data-target="{{ $financialReportData['totalOrdersCount'] }}">0</h5>
                            <p class="text-slate-500 dark:text-zink-200">Total Orders</p>
                        </div>
                    </div>
                </div> --}}
            </div><!--end col-->
            <div class="2xl:col-span-2 2xl:row-span-1">
                <div class="card">
                    <div class="flex items-center gap-3 card-body">
                        <div class="flex items-center justify-center rounded-md size-12 text-15 bg-sky-50 text-sky-500 dark:bg-sky-500/20 shrink-0"><i data-lucide="package-plus"></i></div>
                        <div class="grow">
                            <h5 class="mb-1 text-16 counter-value" data-target="{{ $financialReportData['totalRevenue'] }}"></h5>
                            <p class="text-slate-500 dark:text-zink-200">Total Pendapatan</p>
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
                <div class="overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead class="ltr:text-left rtl:text-right bg-slate-100 text-slate-500 dark:text-zink-200 dark:bg-zink-600">
                            <tr>
                                <th>#</th>
                                <th>Order ID</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Nama Pelanggan</th>
                                <th>Metode Pembayaran</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $loop->iteration }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500"><a href="#!" class="transition-all duration-150 ease-linear order_id text-custom-500 hover:text-custom-600">#{{ $order->id }}</a></td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $order->created_at->format('d M, Y') }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $order->orderName }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ $order->orderPayment }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">{{ 'Rp ' . number_format($subtotals[$order->id], 2, ',', '.') }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                        <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border {{ $order->orderStatus == 'Completed' ? 'bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20' : 'bg-yellow-100 border-yellow-200 text-yellow-500 dark:bg-yellow-500/20 dark:border-yellow-500/20' }}">{{ $order->orderStatus }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div><!--end col-->
            <div class="2xl:col-span-2 2xl:row-span-1">
                <div class="card">
                    <div class="flex items-center gap-3 card-body">
                        <div class="flex items-center justify-center text-green-500 rounded-md size-12 text-15 bg-green-50 dark:bg-green-500/20 shrink-0"><i data-lucide="check-circle"></i></div>
                        <div class="grow">
                            <h5 class="mb-1 text-16 counter-value" data-target="{{ $financialReportData['completedOrdersCount'] }}">0</h5>
                            <p class="text-slate-500 dark:text-zink-200">Completed Orders</p>
                        </div>
                    </div>
                </div>
            </div><!--end col-->
        </div><!--end grid-->

        <!-- Date Picker Form -->
        <form method="GET" action="{{ route('tenantFinancialReport.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Date Range Picker -->
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-1 text-15">Date Range</h6>
                        <p class="mb-4">Select a range of dates using the date picker below.</p>
                        <input type="text" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" data-provider="flatpickr" data-date-format="d M, Y" data-mode="range" readonly="readonly" placeholder="Select Date Range" name="date_range" value="{{ request('date_range') }}">
                    </div>
                </div><!--end card-->
            </div>
            <button type="submit" class="btn bg-custom-500 border-custom-500 text-white mt-3">Apply</button>
        </form>

        <!-- Orders Table -->
        <div class="card" id="ordersTable">
            <div class="card-body">
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
                    <div class="lg:col-span-3">
                        <div class="relative">
                            <input type="text" class="ltr:pl-8 rtl:pr-8 search form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Search for ..." autocomplete="off">
                            <i data-lucide="search" class="inline-block size-4 absolute ltr:left-2.5 rtl:right-2.5 top-2.5 text-slate-500 dark:text-zink-200 fill-slate-100 dark:fill-zink-600"></i>
                        </div>
                    </div><!--end col-->
                    <div class="lg:col-span-2 lg:col-start-11">
                        <div class="ltr:lg:text-right rtl:lg:text-left">
                            <a href="#!" data-modal-target="addOrderModal" type="button" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20"><i data-lucide="plus" class="inline-block size-4"></i> <span class="align-middle">Add Order</span></a>
                        </div>
                    </div>
                </div><!--col grid-->

                <ul class="flex flex-wrap w-full mt-5 text-sm font-medium text-center text-gray-500 nav-tabs">
                    <li class="group active">
                        <a href="javascript:void(0);" data-tab-toggle="" data-target="allOrders" class="inline-block px-4 py-1.5 text-base transition-all duration-300 ease-linear rounded-md text-slate-500 dark:text-zink-200 border border-transparent group-[.active]:bg-custom-500 group-[.active]:text-white dark:group-[.active]:text-white hover:text-custom-500 dark:hover:text-custom-500 active:text-custom-500 dark:active:text-custom-500 -mb-[1px]"><i data-lucide="boxes" class="inline-block size-4 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">All Orders</span></a>
                    </li>
                </ul>

                <div class="mt-5 overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead class="ltr:text-left rtl:text-right bg-slate-100 dark:bg-zink-600">
                            <tr>
                                <th class="px-3.5 py-2.5 font-semibold text-slate-500 border-b border-slate-200 dark:border-zink-500 dark:text-zink-200 sort" data-sort="order_id">Order ID</th>
                                <th class="px-3.5 py-2.5 font-semibold text-slate-500 border-b border-slate-200 dark:border-zink-500 dark:text-zink-200 sort" data-sort="order_date">Order Date</th>
                                <th class="px-3.5 py-2.5 font-semibold text-slate-500 border-b border-slate-200 dark:border-zink-500 dark:text-zink-200 sort" data-sort="customer_name">Customer Name</th>
                                <th class="px-3.5 py-2.5 font-semibold text-slate-500 border-b border-slate-200 dark:border-zink-500 dark:text-zink-200 sort" data-sort="payment_method">Payment Method</th>
                                <th class="px-3.5 py-2.5 font-semibold text-slate-500 border-b border-slate-200 dark:border-zink-500 dark:text-zink-200 sort" data-sort="amount">Amount</th>

                                <th class="px-3.5 py-2.5 font-semibold text-slate-500 border-b border-slate-200 dark:border-zink-500 dark:text-zink-200 sort" data-sort="delivery_status">Delivery Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>

                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500"><a href="#!" class="transition-all duration-150 ease-linear order_id text-custom-500 hover:text-custom-600">#{{ $order->id }}</a></td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 order_date">{{ $order->created_at->format('d M, Y') }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 customer_name">{{ $order->orderName }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 payment_method">{{ $order->orderPayment }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500 amount">{{ 'Rp ' . number_format($subtotals[$order->id], 2, ',', '.') }}</td>
                                    <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                        <span class="delivery_status px-2.5 py-0.5 text-xs inline-block font-medium rounded border {{ $order->orderStatus == 'Completed' ? 'bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20' : 'bg-yellow-100 border-yellow-200 text-yellow-500 dark:bg-yellow-500/20 dark:border-yellow-500/20' }}">{{ $order->orderStatus }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end card-->
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

        flatpickr("input[data-provider='flatpickr'][data-mode='single']", {
            dateFormat: "d M, Y",
            onChange: function(selectedDates, dateStr, instance) {
                // Do nothing for single date picker
            }
        });

        flatpickr("input[data-provider='flatpickr'][data-mode='range']", {
            mode: "range",
            dateFormat: "d M, Y",
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    // Submit the form when the date range is selected
                    instance.element.closest('form').submit();
                }
            }
        });
    });
</script>
@endsection
