@extends('layouts.master')
@section('content')
<!-- Page-content -->
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Detail Pesanan</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:before:text-zink-200">
                    <a href="{{ route('tenantOrders.index') }}" class="text-slate-400 dark:text-zink-200">Pesanan</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">Detail Pesanan</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <h6 class="mb-2 text-lg font-bold">Nama Pemesan:</h6>
                    <p class="text-slate-500 dark:text-zink-200">{{ $order->orderName }}</p>
                </div>
                <div class="mb-4">
                    <h6 class="mb-2 text-lg font-bold">No. Telepon:</h6>
                    <p class="text-slate-500 dark:text-zink-200">{{ $order->orderPhone }}</p>
                </div>
                <div class="mb-4">
                    <h6 class="mb-2 text-lg font-bold">Total Jumlah:</h6>
                    <p class="text-slate-500 dark:text-zink-200">{{ 'Rp ' . number_format($order->orderTotalAmounts, 2, ',', '.') }}</p>
                </div>
                <div class="mb-4">
                    <h6 class="mb-2 text-lg font-bold">Status:</h6>
                    <p class="text-slate-500 dark:text-zink-200">
                        <span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border
                            {{ $order->orderStatus == 'Pending' ? 'bg-yellow-100 border-yellow-200 text-yellow-500 dark:bg-yellow-500/20 dark:border-yellow-500/20' : ($order->orderStatus == 'Completed' ? 'bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20' : ($order->orderStatus == 'Canceled' ? 'bg-red-100 border-red-200 text-red-500 dark:bg-red-500/20 dark:border-red-500/20' : 'bg-blue-100 border-blue-200 text-blue-500 dark:bg-blue-500/20 dark:border-blue-500/20')) }}">
                            {{ $order->orderStatus }}
                        </span>
                    </p>
                </div>
                <div class="mb-4">
                    <h6 class="mb-2 text-lg font-bold">Catatan Tambahan:</h6>
                    <p class="text-slate-500 dark:text-zink-200">{{ $order->orderNotes }}</p>
                </div>
                <div class="mb-4">
                    <h6 class="mb-2 text-lg font-bold">Item Pesanan:</h6>
                    <ul>
                        @foreach ($order->orderProducts as $item)
                        <li class="text-slate-500 dark:text-zink-200">
                            {{ $item->product_id }} - {{ $item->quantity }} x {{ $item->price }}
                            <span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border
                            {{ $item->orderProductStatus == 'Pending' ? 'bg-yellow-100 border-yellow-200 text-yellow-500 dark:bg-yellow-500/20 dark:border-yellow-500/20' : ($item->orderProductStatus == 'Completed' ? 'bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20' : ($item->orderProductStatus == 'Cancelled' ? 'bg-red-100 border-red-200 text-red-500 dark:bg-red-500/20 dark:border-red-500/20' : 'bg-blue-100 border-blue-200 text-blue-500 dark:bg-blue-500/20 dark:border-blue-500/20')) }}">
                            {{ $item->orderProductStatus }}
                        </span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="flex justify-end">
                    <form action="{{ route('tenantOrders.inProgress', $order->id) }}" method="POST" class="mr-2">
                        @csrf
                        <button type="submit" class="btn bg-blue-500 text-white hover:bg-blue-600">In Progress</button>
                    </form>
                    <a href="{{ route('tenantOrders.edit', $order->id) }}" class="btn bg-custom-500 text-white hover:bg-custom-600 mr-2">Edit</a>
                    <form action="{{ route('tenantOrders.destroy', $order->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn bg-red-500 text-white hover:bg-red-600">Hapus</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-4">
            <a href="{{ route('tenantOrders.index') }}" class="btn bg-custom-500 text-white hover:bg-custom-600">Kembali ke Daftar Pesanan</a>
        </div>
    </div>
</div>
@endsection
