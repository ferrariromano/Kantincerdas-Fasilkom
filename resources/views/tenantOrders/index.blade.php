@extends('layouts.master')

@section('content')
<!-- Page-content -->
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Daftar Pesanan</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:before:text-zink-200">
                    <a href="#!" class="text-slate-400 dark:text-zink-200">Pesanan</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">Daftar Pesanan</li>
            </ul>
        </div>

        <div class="card" id="orderListTable">
            <div class="!pt-1 card-body">
                <div class="overflow-x-auto">
                    <table class="w-full whitespace-nowrap" id="orderTable">
                        <thead class="ltr:text-left rtl:text-right bg-slate-100 dark:bg-zink-600">
                            <tr>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Nama Pemesan</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">No. Telepon</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Total Jumlah</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Status</th>
                                <th class="px-3.5 py-2.5 font-semibold border-b border-slate-200 dark:border-zink-500">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    <a href="{{ route('tenantOrders.show', $order->id) }}" class="flex items-center gap-2">
                                        <h6>{{ $order->orderName }}</h6>
                                    </a>
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    {{ $order->orderPhone }}
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    {{ 'Rp ' . number_format($order->orderTotalAmounts, 2, ',', '.') }}
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    <span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border
                                        {{ $order->orderStatus == 'Pending' ? 'bg-yellow-100 border-yellow-200 text-yellow-500 dark:bg-yellow-500/20 dark:border-yellow-500/20' : ($order->orderStatus == 'Completed' ? 'bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20' : ($order->orderStatus == 'Canceled' ? 'bg-red-100 border-red-200 text-red-500 dark:bg-red-500/20 dark:border-red-500/20' : 'bg-blue-100 border-blue-200 text-blue-500 dark:bg-blue-500/20 dark:border-blue-500/20')) }}">
                                        {{ $order->orderStatus }}
                                    </span>
                                </td>
                                <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                    <div class="relative dropdown">
                                        <button class="flex items-center justify-center w-8 h-8 p-0 text-slate-500 bg-slate-100 rounded-full dropdown-toggle hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20" id="orderAction{{ $order->id }}" data-bs-toggle="dropdown">
                                            <i data-lucide="more-horizontal" class="w-6 h-6"></i>
                                        </button>
                                        <ul class="absolute z-50 hidden py-2 mt-1 list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="orderAction{{ $order->id }}">
                                            <li>
                                                <a class="flex items-center px-4 py-1.5 text-base text-slate-600 transition-all duration-200 ease-linear dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="{{ route('tenantOrders.show', $order->id) }}">
                                                    <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                                                    <span class="align-middle">Overview</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="flex items-center px-4 py-1.5 text-base text-slate-600 transition-all duration-200 ease-linear dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="{{ route('tenantOrders.edit', $order->id) }}">
                                                    <i data-lucide="file-edit" class="w-4 h-4 mr-2"></i>
                                                    <span class="align-middle">Edit</span>
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('tenantOrders.destroy', $order->id) }}" method="POST" class="flex items-center px-4 py-1.5 text-base text-slate-600 transition-all duration-200 ease-linear cursor-pointer dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="flex items-center w-full text-left">
                                                        <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                                                        <span class="align-middle">Delete</span>
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="noresult" style="display: none">
                        <div class="py-6 text-center">
                            <i data-lucide="search" class="w-6 h-6 mx-auto mb-3 text-sky-500 fill-sky-100 dark:fill-sky-500/20"></i>
                            <h5 class="mt-2 mb-1">Sorry! No Result Found</h5>
                            <p class="mb-0 text-slate-500 dark:text-zink-200">We've searched more than 199+ orders. We did not find any orders for your search.</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col items-center gap-4 px-4 mt-4 md:flex-row" id="pagination-element">
                    <div class="grow">
                        <p class="text-slate-500 dark:text-zink-200">Showing <b>{{ $orders->firstItem() }}</b> to <b>{{ $orders->lastItem() }}</b> of <b>{{ $orders->total() }}</b> Results</p>
                    </div>

                    <div class="col-sm-auto mt-sm-0">
                        <div class="flex gap-2 pagination-wrap justify-content-center">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div><!--end card-->

        <!-- Create Order -->
        <div class="flex justify-end mt-4">
            <a href="{{ route('tenantOrders.create') }}" class="btn bg-custom-500 text-white hover:bg-custom-600">Tambah Pesanan</a>
        </div>

    </div>
</div>
@endsection
