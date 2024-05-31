@extends('layouts.master')

@section('content')
<!-- Page-content -->
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Ringkasan</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="{{ route('products.index') }}" class="text-slate-400 dark:text-zink-200">Produk</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">Ringkasan</li>
            </ul>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5 px-0">
            <div class="xl:col-span-4">
                <div class="sticky top-[calc(theme('spacing.header')_*_1.3)] mb-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="grid grid-cols-1 gap-5 md:grid-cols-12">
                                <div class="rounded-md md:col-span-12 bg-slate-100 dark:bg-zink-600">
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full rounded-md">
                                </div>
                            </div>
                            <div class="flex gap-2 mt-4 shrink-0">
                                <a href="{{ route('products.edit', $product->id) }}" class="w-full bg-white border-dashed text-custom-500 btn border-custom-500 hover:text-custom-500 hover:bg-custom-50 hover:border-custom-600 focus:text-custom-600 focus:bg-custom-50 focus:border-custom-600 active:text-custom-600 active:bg-custom-50 active:border-custom-600 dark:bg-zink-700 dark:ring-custom-400/20 dark:hover:bg-custom-800/20 dark:focus:bg-custom-800/20 dark:active:bg-custom-800/20"><i data-lucide="file-edit" class="inline-block align-middle size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Edit</span></a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full text-white bg-red-500 border-red-500 btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-red-400/20"><i data-lucide="trash-2" class="inline-block align-middle size-3 ltr:mr-1 rtl:ml-1"></i> <span class="align-middle">Delete</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="xl:col-span-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mt-3 mb-1">{{ $product->name }}</h5>
                        <ul class="flex flex-wrap items-center gap-4 mb-5 text-slate-500 dark:text-zink-200">
                            <li>Kategori: <span class="font-medium">{{ $product->category->name }}</span></li>
                            <li>Tenant: <span class="font-medium">{{ session('tenant_name') }}</span></li>
                            <li>Diterbitkan: <span class="font-medium">{{ $product->created_at->format('d M, Y') }}</span></li>
                        </ul>
                        <div class="mb-4">
                            <h4>{{ 'Rp ' . number_format($product->price, 2, ',', '.') }}</h4>
                        </div>
                        <div class="mt-5">
                            <h6 class="mb-3 text-15">Deskripsi Produk:</h6>
                            <p class="mb-2 text-slate-500 dark:text-zink-200">{{ $product->description }}</p>
                        </div>
                        <div class="mt-5">
                            <h6 class="mb-3 text-15">Nutrisi Produk:</h6>
                            <table class="w-full table-auto">
                                <thead>
                                    <tr class="bg-red-500 text-white">
                                        @if ($category == 'Makanan')
                                            <th class="px-4 py-2">Kalori</th>
                                            <th class="px-4 py-2">Karbohidrat</th>
                                            <th class="px-4 py-2">Protein</th>
                                        @elseif ($category == 'Minuman')
                                            <th class="px-4 py-2">Kalori</th>
                                            <th class="px-4 py-2">Lemak</th>
                                            <th class="px-4 py-2">Gula</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @if ($category == 'Makanan')
                                            <td class="border px-4 py-2">{{ $product->nutrition->kalori }} kkal</td>
                                            <td class="border px-4 py-2">{{ $product->nutrition->karbohidrat }} g</td>
                                            <td class="border px-4 py-2">{{ $product->nutrition->protein }} g</td>
                                        @elseif ($category == 'Minuman')
                                            <td class="border px-4 py-2">{{ $product->nutrition->kalori }} kkal</td>
                                            <td class="border px-4 py-2">{{ $product->nutrition->lemak }} g</td>
                                            <td class="border px-4 py-2">{{ $product->nutrition->gula }} g</td>
                                        @endif
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
