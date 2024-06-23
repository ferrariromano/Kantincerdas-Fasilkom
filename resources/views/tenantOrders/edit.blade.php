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
                <li class="text-slate-700 dark:text-zink-100">Edit Pesanan</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <h6 class="mb-2 text-lg font-bold">Nama Pemesan:</h6>
                    <p class="text-slate-500 dark:text-zinc-200">{{ $order->orderName }}</p>
                </div>
                <div class="mb-4">
                    <h6 class="mb-2 text-lg font-bold">No. Telepon:</h6>
                    <p class="text-slate-500 dark:text-zinc-200">{{ $order->orderPhone }}</p>
                </div>
                <div class="mb-4">
                    <h6 class="mb-2 text-lg font-bold">Total Jumlah:</h6>
                    <p class="text-slate-500 dark:text-zinc-200">{{ 'Rp ' . number_format($subtotals[$order->id], 2, ',', '.') }}</p>
                </div>
                <div class="mb-4">
                    <h6 class="mb-2 text-lg font-bold">Status:</h6>
                    <p class="text-slate-500 dark:text-zinc-200">
                        <span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border
                            {{ $order->orderStatus == 'Pending' ? 'bg-yellow-100 border-yellow-200 text-yellow-500 dark:bg-yellow-500/20 dark:border-yellow-500/20' : ($order->orderStatus == 'Completed' ? 'bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20' : ($order->orderStatus == 'Canceled' ? 'bg-red-100 border-red-200 text-red-500 dark:bg-red-500/20 dark:border-red-500/20' : 'bg-blue-100 border-blue-200 text-blue-500 dark:bg-blue-500/20 dark:border-blue-500/20')) }}">
                            {{ $order->orderStatus }}
                        </span>
                    </p>
                </div>
                <div class="mb-4">
                    <h6 class="mb-2 text-lg font-bold">Item Pesanan:</h6>
                </div>
                <form action="{{ route('tenantOrders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    @foreach ($orderProducts as $items)
                    <div class="flex items-center mb-4">
                        <div class="mr-3">{{ $items->quantity }}x</div>
                        <div class="mr-3">{{ $items->product->name }}</div>
                        <div class="mr-3">{{ $items->product->price }}</div>
                        <div>
                            <select name="orderItemStatus[{{ $items->id }}]" id="orderItemStatus" class="block w-full border-slate-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-200" required>
                                <option value="Pending" {{ $items->orderItemStatus == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Completed" {{ $items->orderItemStatus == 'Completed' ? 'selected' : '' }}>Completed</option>
                                <option value="Canceled" {{ $items->orderItemStatus == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                        </div>
                    </div>
                    @endforeach
                    <div class="mb-4">
                        <label for="additional" class="mb-2 text-lg font-bold">Catatan Tambahan</label>
                        <textarea name="additional" id="additional" class="block w-full mt-1 border-slate-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:border-zinc-600 dark:bg-zinc-800 dark:text-zinc-200" disabled>{{ $order->orderNotes }}</textarea>
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
