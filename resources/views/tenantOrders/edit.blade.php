@extends('layouts.master')

@section('content')
<!-- Page-content -->
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Edit Pesanan</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:before:text-zink-200">
                    <a href="{{ route('tenantOrders.index') }}" class="text-slate-400 dark:text-zink-200">Pesanan</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">Edit Pesanan</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('tenantOrders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="order-name" class="block text-sm font-medium text-slate-700 dark:text-zink-200">Nama Pemesan</label>
                        <input type="text" name="order-name" id="order-name" value="{{ $order->orderName }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:border-zink-600 dark:bg-zink-800 dark:text-zink-200" required>
                    </div>
                    <div class="mb-4">
                        <label for="order-phone" class="block text-sm font-medium text-slate-700 dark:text-zink-200">No. Telepon</label>
                        <input type="text" name="order-phone" id="order-phone" value="{{ $order->orderPhone }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:border-zink-600 dark:bg-zink-800 dark:text-zink-200" required>
                    </div>
                    <div class="mb-4">
                        <label for="order-payment" class="block text-sm font-medium text-slate-700 dark:text-zink-200">Pembayaran</label>
                        <select name="order-payment" id="order-payment" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:border-zink-600 dark:bg-zink-800 dark:text-zink-200" required>
                            <option value="tunai" {{ $order->orderPayment == 'tunai' ? 'selected' : '' }}>Tunai</option>
                            <option value="non-tunai" {{ $order->orderPayment == 'non-tunai' ? 'selected' : '' }}>Non-Tunai</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="orderTotalAmounts" class="block text-sm font-medium text-slate-700 dark:text-zink-200">Total Jumlah</label>
                        <input type="number" name="orderTotalAmounts" id="orderTotalAmounts" value="{{ $order->orderTotalAmounts }}" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:border-zink-600 dark:bg-zink-800 dark:text-zink-200" required>
                    </div>
                    <div class="mb-4">
                        <label for="orderStatus" class="block text-sm font-medium text-slate-700 dark:text-zink-200">Status</label>
                        <select name="orderStatus" id="orderStatus" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:border-zink-600 dark:bg-zink-800 dark:text-zink-200" required>
                            <option value="Pending" {{ $order->orderStatus == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Completed" {{ $order->orderStatus == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Canceled" {{ $order->orderStatus == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="additional" class="block text-sm font-medium text-slate-700 dark:text-zink-200">Catatan Tambahan</label>
                        <textarea name="additional" id="additional" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:border-zink-600 dark:bg-zink-800 dark:text-zink-200">{{ $order->orderNotes }}</textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit" class="btn bg-custom-500 text-white hover:bg-custom-600">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="flex justify-end mt-4">
            <a href="{{ route('tenantOrders.index') }}" class="btn bg-custom-500 text-white hover:bg-custom-600">Kembali ke Daftar Pesanan</a>
        </div>

    </div>
</div>
@endsection
