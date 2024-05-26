@extends('layouts.master')

@section('content')
<!-- Page-content -->
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">
                    Tambah Baru</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="#!" class="text-slate-400 dark:text-zink-200">Produk</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Tambah Baru
                </li>
            </ul>
        </div>
</div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5 px-0">
        <div class="xl:col-span-9">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-15 mb-4">Buat Produk</h6>
                    <form action="#!" class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">
                        <div class="xl:col-span-6">
                            <label for="name" class="inline-block mb-2 text-base font-medium">Judul Produk</label>
                            <input type="text" id="name" name="name" class="form-input placeholder:text-slate-400 dark:placeholder:text-zink-200 focus:border-custom-500 dark:focus:border-custom-800 dark:bg-zink-700 dark:text-zink-100" placeholder="Judul Produk" required>
                            <p class="mt-1 text-sm text-slate-400 dark:text-zink-200">Harap tidak melebihi 20 karakter saat memasukkan nama produk.</p>
                        </div>
                        <div class="xl:col-span-6">
                            <label for="category_id" class="inline-block mb-2 text-base font-medium">Kategori</label>
                            <select class="form-input placeholder:text-slate-400 dark:placeholder:text-zink-200 focus:border-custom-500 dark:focus:border-custom-800 dark:bg-zink-700 dark:text-zink-100" name="category_id" id="category_id" required>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="xl:col-span-6">
                            <label for="price" class="inline-block mb-2 text-base font-medium">Harga (Rp)</label>
                            <input type="text" id="price" name="price" class="form-input placeholder:text-slate-400 dark:placeholder:text-zink-200 focus:border-custom-500 dark:focus:border-custom-800 dark:bg-zink-700 dark:text-zink-100" placeholder="Harga" required>
                        </div>
                        <div class="xl:col-span-4">
                            <label for="image" class="inline-block mb-2 text-base font-medium">Gambar</label>
                            <input type="file" id="image" name="image" class="form-input" accept="image/*" required>
                        </div>
                        <div class="xl:col-span-4">
                            <label for="description" class="inline-block mb-2 text-base font-medium">Deskripsi</label>
                            <textarea id="description" name="description" class="form-input placeholder:text-slate-400 dark:placeholder:text-zink-200 focus:border-custom-500 dark:focus:border-custom-800 dark:bg-zink-700 dark:text-zink-100" placeholder="Deskripsi" required></textarea>
                        </div>
                        <div class="xl:col-span-4">
                            <label for="status" class="inline-block mb-2 text-base font-medium">Status</label>
                            <select class="form-input placeholder:text-slate-400 dark:placeholder:text-zink-200 focus:border-custom-500 dark:focus:border-custom-800 dark:bg-zink-700 dark:text-zink-100" name="status" id="status" required>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="xl:col-span-12">
                            <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Buat Produk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
