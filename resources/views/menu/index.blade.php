@extends ('layouts.main')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/productModal.css') }}">
@endpush

@section('container')
    <div class="wrapper">
        <header>
            <div class="title">
                <a href="/menu">MENU</a>
            </div>
            <div class="icon-cart">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1"/>
                </svg>
                <span>0</span>
            </div>
        </header>
    </div>

    <div class="contentTab">
        <div class="listProduct">
            @foreach ($products as $product)
                <div class="item">
                    <a href="#" class="imagesProduct" data-toggle="modal" data-target="productDetailModal-{{ $product->id }}">
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                    </a>
                    <h2 id="product-name">{{ $product->name }}</h2>
                    <div class="price" id="product-price">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                    <button class="addCart" data-id="{{ $product->id }}">Add To Cart</button>
                </div>
                @include('partials.productModal', ['product' => $product])
            @endforeach
        </div>
    </div>

    <div class="cartTab flex-group">
        <div class="flex-group">
            <h1>Keranjang</h1>
            <div class="icon-close">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
        <div class="listCart"></div>
        <div class="cartInfo">
            <p id="total-items">Jumlah item: 0</p>
            <p id="total-price">Total Harga: Rp 0</p>
        </div>
        <button class="checkOut">Check Out</button>
    </div>

@endsection

@push('js')
    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('js/modal.js') }}"></script>
@endpush
