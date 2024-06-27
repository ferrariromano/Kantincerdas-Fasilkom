@extends('layouts.master')

@section('content')
<!-- Page-content -->
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Daftar Pemesan</h5>
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
                    <div class="mb-4 flex justify-end">
                        <div class="w-64">
                            <form method="GET" action="{{ route('tenantOrders.index') }}">
                                <select id="statusFilter" name="statusFilter" class="form-select border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500" onchange="this.form.submit()">
                                    <option value="all" {{ $selectedStatus == 'all' ? 'selected' : '' }}>Semua Status</option>
                                    <option value="Completed" {{ $selectedStatus == 'Completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="Uncompleted" {{ $selectedStatus == 'Uncompleted' ? 'selected' : '' }}>Uncompleted</option>
                                    <option value="In Progress" {{ $selectedStatus == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                </select>
                            </form>
                        </div>
                    </div>

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
                            @foreach($orders as $items)
                                @if ($statuses[$items->id] == 'Completed' && ($selectedStatus == 'Completed' || $selectedStatus == 'all'))
                                    <tr>
                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                            <a href="{{ route('tenantOrders.show', $items->id) }}" class="flex items-center gap-2">
                                                <h6>{{ $items->orderName }}</h6>
                                            </a>
                                        </td>
                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                            {{ $items->orderPhone }}
                                        </td>
                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                            {{ 'Rp ' . number_format($subtotals[$items->id], 2, ',', '.') }}
                                        </td>
                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zinc-500">
                                            <span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border
                                                {{ $statuses[$items->id] == 'Uncompleted' ? 'bg-yellow-100 border-yellow-200 text-yellow-500 dark:bg-yellow-500/20 dark:border-yellow-500/20' : 'bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20' }}">
                                                {{ $statuses[$items->id] }}
                                            </span>
                                        </td>
                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                            <div class="dropdown">
                                                <button class="flex items-center justify-center w-8 h-8 p-0 text-slate-500 bg-slate-100 rounded-full dropdown-toggle hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20" id="orderAction{{ $items->id }}" data-bs-toggle="dropdown">
                                                    <i data-lucide="more-horizontal" class="w-6 h-6"></i>
                                                </button>
                                                <ul class="absolute z-50 hidden py-2 mt-1 list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="orderAction{{ $items->id }}">
                                                    <li>
                                                        <a class="flex items-center px-4 py-1.5 text-base text-slate-600 transition-all duration-200 ease-linear dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="{{ route('tenantOrders.edit', $items->id) }}">
                                                            <i data-lucide="file-edit" class="w-4 h-4 mr-2"></i>
                                                            <span class="align-middle">Lihat Detail</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('tenantOrders.destroy', $items->id) }}" method="POST" class="flex items-center px-4 py-1.5 text-base text-slate-600 transition-all duration-200 ease-linear cursor-pointer dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200">
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
                                @endif
                                @if ($statuses[$items->id] == 'Uncompleted' && ($selectedStatus == 'Uncompleted' || $selectedStatus == 'all'))
                                    <tr>
                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                            <a href="{{ route('tenantOrders.show', $items->id) }}" class="flex items-center gap-2">
                                                <h6>{{ $items->orderName }}</h6>
                                            </a>
                                        </td>
                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                            {{ $items->orderPhone }}
                                        </td>
                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                            {{ 'Rp ' . number_format($subtotals[$items->id], 2, ',', '.') }}
                                        </td>
                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zinc-500">
                                            <span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border
                                                {{ $statuses[$items->id] == 'Uncompleted' ? 'bg-yellow-100 border-yellow-200 text-yellow-500 dark:bg-yellow-500/20 dark:border-yellow-500/20' : 'bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20' }}">
                                                {{ $statuses[$items->id] }}
                                            </span>
                                        </td>
                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                            <div class="dropdown">
                                                <button class="flex items-center justify-center w-8 h-8 p-0 text-slate-500 bg-slate-100 rounded-full dropdown-toggle hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20" id="orderAction{{ $items->id }}" data-bs-toggle="dropdown">
                                                    <i data-lucide="more-horizontal" class="w-6 h-6"></i>
                                                </button>
                                                <ul class="absolute z-50 hidden py-2 mt-1 list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="orderAction{{ $items->id }}">
                                                    <li>
                                                        <a class="flex items-center px-4 py-1.5 text-base text-slate-600 transition-all duration-200 ease-linear dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="{{ route('tenantOrders.edit', $items->id) }}">
                                                            <i data-lucide="file-edit" class="w-4 h-4 mr-2"></i>
                                                            <span class="align-middle">Lihat Detail</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('tenantOrders.destroy', $items->id) }}" method="POST" class="flex items-center px-4 py-1.5 text-base text-slate-600 transition-all duration-200 ease-linear cursor-pointer dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200">
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
                                @endif
                                @if ($statuses[$items->id] == 'In Progress' && ($selectedStatus == 'In Progress' || $selectedStatus == 'all'))
                                    <tr>
                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                            <a href="{{ route('tenantOrders.show', $items->id) }}" class="flex items-center gap-2">
                                                <h6>{{ $items->orderName }}</h6>
                                            </a>
                                        </td>
                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                            {{ $items->orderPhone }}
                                        </td>
                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                            {{ 'Rp ' . number_format($subtotals[$items->id], 2, ',', '.') }}
                                        </td>
                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zinc-500">
                                            <span class="px-2.5 py-0.5 inline-block text-xs font-medium rounded border
                                                {{ $statuses[$items->id] == 'Uncompleted' ? 'bg-yellow-100 border-yellow-200 text-yellow-500 dark:bg-yellow-500/20 dark:border-yellow-500/20' : 'bg-green-100 border-green-200 text-green-500 dark:bg-green-500/20 dark:border-green-500/20' }}">
                                                {{ $statuses[$items->id] }}
                                            </span>
                                        </td>
                                        <td class="px-3.5 py-2.5 border-y border-slate-200 dark:border-zink-500">
                                            <div class="dropdown">
                                                <button class="flex items-center justify-center w-8 h-8 p-0 text-slate-500 bg-slate-100 rounded-full dropdown-toggle hover:text-white hover:bg-slate-600 focus:text-white focus:bg-slate-600 focus:ring focus:ring-slate-100 active:text-white active:bg-slate-600 active:ring active:ring-slate-100 dark:bg-slate-500/20 dark:text-slate-400 dark:hover:bg-slate-500 dark:hover:text-white dark:focus:bg-slate-500 dark:focus:text-white dark:active:bg-slate-500 dark:active:text-white dark:ring-slate-400/20" id="orderAction{{ $items->id }}" data-bs-toggle="dropdown">
                                                    <i data-lucide="more-horizontal" class="w-6 h-6"></i>
                                                </button>
                                                <ul class="absolute z-50 hidden py-2 mt-1 list-none bg-white rounded-md shadow-md dropdown-menu min-w-[10rem] dark:bg-zink-600" aria-labelledby="orderAction{{ $items->id }}">
                                                    <li>
                                                        <a class="flex items-center px-4 py-1.5 text-base text-slate-600 transition-all duration-200 ease-linear dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200" href="{{ route('tenantOrders.edit', $items->id) }}">
                                                            <i data-lucide="file-edit" class="w-4 h-4 mr-2"></i>
                                                            <span class="align-middle">Lihat Detail</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('tenantOrders.destroy', $items->id) }}" method="POST" class="flex items-center px-4 py-1.5 text-base text-slate-600 transition-all duration-200 ease-linear cursor-pointer dropdown-item hover:bg-slate-100 hover:text-slate-500 focus:bg-slate-100 focus:text-slate-500 dark:text-zink-100 dark:hover:bg-zink-500 dark:hover:text-zink-200 dark:focus:bg-zink-500 dark:focus:text-zink-200">
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
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
