@extends('layouts.master')

@section('content')
<!-- Page-content -->
<div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">
                    Edit Produk
                </h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="#!" class="text-slate-400 dark:text-zink-200">Produk</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Edit Produk
                </li>
            </ul>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-12 gap-x-5 px-0">
        <div class="xl:col-span-9">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-15 mb-4">Edit Produk</h6>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-5 lg:grid-cols-2 xl:grid-cols-12">
                        @csrf
                        @method('PUT')

                        <!-- Product Name -->
                        <div class="xl:col-span-6">
                            <label for="productName" class="inline-block mb-2 text-base font-medium">Nama Produk</label>
                            <input type="text" id="productName" name="name" class="form-input placeholder:text-slate-400 dark:placeholder:text-zink-200 focus:border-custom-500 dark:focus:border-custom-800 dark:bg-zink-700 dark:text-zink-100" value="{{ $product->name }}" required>
                        </div>

                        <!-- Category -->
                        <div class="xl:col-span-6">
                            <label for="productCategory" class="inline-block mb-2 text-base font-medium">Category</label>
                            <select class="form-input placeholder:text-slate-400 dark:placeholder:text-zink-200 focus:border-custom-500 dark:focus:border-custom-800 dark:bg-zink-700 dark:text-zink-100" name="category_id" id="productCategory" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price -->
                        <div class="xl:col-span-6">
                            <label for="productPrice" class="inline-block mb-2 text-base font-medium">Harga (Rp)</label>
                            <input type="text" id="productPrice" name="price" class="form-input placeholder:text-slate-400 dark:placeholder:text-zink-200 focus:border-custom-500 dark:focus:border-custom-800 dark:bg-zink-700 dark:text-zink-100" value="{{ $product->price }}" required>
                        </div>

                        <!-- Image -->
                        <div class="xl:col-span-4">
                            <label for="productImage" class="inline-block mb-2 text-base font-medium">Gambar</label>
                            <input type="file" id="productImage" name="image" class="form-input" accept="image/*">
                        </div>

                        <!-- Description -->
                        <div class="xl:col-span-4">
                            <label for="productDescription" class="inline-block mb-2 text-base font-medium">Description</label>
                            <textarea id="productDescription" name="description" class="form-input placeholder:text-slate-400 dark:placeholder:text-zink-200 focus:border-custom-500 dark:focus:border-custom-800 dark:bg-zink-700 dark:text-zink-100" required>{{ $product->description }}</textarea>
                        </div>

                        <!-- Status -->
                        <div class="xl:col-span-4">
                            <label for="productStatus" class="inline-block mb-2 text-base font-medium">Status</label>
                            <select class="form-input placeholder:text-slate-400 dark:placeholder:text-zink-200 focus:border-custom-500 dark:focus:border-custom-800 dark:bg-zink-700 dark:text-zink-100" name="status" id="productStatus" required>
                                <option value="Aktif" {{ $product->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Tidak Aktif" {{ $product->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="xl:col-span-12">
                            <button type="submit" class="text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
