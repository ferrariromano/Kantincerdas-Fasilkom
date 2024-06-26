@extends ('layouts.main')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/productModal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/confirmModal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alertModal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
@endpush

@section('container')
    <div class="wrapper">
        <header>
            <div class="topHeader">
                <div class="icon-filter">
                    <svg class="w-6 h-6 filterIcon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="#353432" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M20 6H10m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4m16 6h-2m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4m16 6H10m0 0a2 2 0 1 0-4 0m4 0a2 2 0 1 1-4 0m0 0H4"/>
                    </svg>
                </div>
                <div class="title">
                    <a href="/menu">MENU</a>
                </div>
                <div class="icon-cart">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1"/>
                    </svg>
                    <span>0</span>
                </div>
            </div>
            <div class="filterGroup">
                <div class="searchGroup">
                    <div class="icon-search">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="#353432" viewBox="0 0 24 24">
                            <path stroke="#ffeba7" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                    <form id="search-form">
                        <input type="text" id="search-input" class="search-input" placeholder="Cari produk..." />
                    </form>
                </div>
                <div class="subFilterGroup">
                    <div class="filter">
                        <form class="filterForm" action="{{ route('menu.index') }}" method="GET">
                            <!-- Dropdown untuk kategori -->
                            <input class="dropdown" type="checkbox" id="dropdown-category" name="dropdown-category"/>
                            <label class="for-dropdown" for="dropdown-category" id="label-category">Pilih Kategori</label>
                            <div class="section-dropdown" id="dropdown-category-menu">
                                <a class="dropDownLink" href="{{ route('menu.index', ['category_id' => '', 'tenant_id' => request()->input('tenant_id')]) }}" data-category="Semua Kategori">Semua Kategori</a>
                                @foreach ($categories as $category)
                                    <a class="dropDownLink" href="{{ route('menu.index', ['category_id' => $category->id, 'tenant_id' => request()->input('tenant_id')]) }}" data-category="{{ $category->name }}">
                                        {{ $category->name }}
                                    </a>
                                @endforeach
                            </div>
                        </form>
                    </div>
                    <div class="filter">
                        <form class="filterForm" action="{{ route('menu.index') }}" method="GET">
                            <!-- Dropdown untuk tenant -->
                            <input class="dropdown" type="checkbox" id="dropdown-tenant" name="dropdown-tenant"/>
                            <label class="for-dropdown" for="dropdown-tenant" id="label-tenant">Pilih Outlet</label>
                            <div class="section-dropdown" id="dropdown-tenant-menu">
                                <a class="dropDownLink" href="{{ route('menu.index', ['tenant_id' => '', 'category_id' => request()->input('category_id')]) }}" data-tenant="Semua Outlet">Semua Outlet</a>
                                @foreach ($nama_tenant as $id => $name)
                                    <a class="dropDownLink" href="{{ route('menu.index', ['tenant_id' => $id, 'category_id' => request()->input('category_id')]) }}" data-tenant="{{ $name }}">
                                        {{ $name }}
                                    </a>
                                @endforeach
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <div class="contentTab">
        <div id="product-list" class="listProduct">
            @foreach ($products as $product)
                <div class="item">
                    <a href="#" class="imagesProduct" data-toggle="modal" data-target="productDetailModal-{{ $product->id }}">
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                    </a>
                    <h2 id="product-name">{{ $product->name }}</h2>
                    <div class="price txt_orange" id="product-price">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                    <span id="product-tenant" style="display: none;">{{ $product->tenant_id }}</span>
                    <button class="addCart" data-id="{{ $product->id }}">+Keranjang</button>
                </div>
                @include('menu.productModal', ['product' => $product])
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
        <button class="checkOut disabled">Lanjut Pesan</button>

        <form class="orderForm" action="{{ route('submitOrder') }}" method="POST" style="display: none;">
            @csrf
            <div class="inputUser">
                <div class="input-group">
                    <input type="text" name="order-name" id="order-name" placeholder=" " maxlength="25" required />
                    <span for="order-name">Nama Pemesan</span>
                </div>
                <div class="input-group">
                    <input type="text" name="order-phone" id="order-phone" placeholder=" " maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />
                    <span for="order-phone">Nomor Handphone</span>
                </div>
            </div>
            <div class="select-group">
                <label for="order-payment">Metode Pembayaran</label>
                <select class="form-select" name="order-payment" id="order-payment">
                    <option value="tunai">Tunai</option>
                    <option value="non-tunai">Non Tunai</option>
                </select>
            </div>
            <div class="additional-group">
                <label for="additional">Tambahan</label>
                <textarea class="form-control" id="additional" name="additional" placeholder="catatan tambahan untuk pesanan"></textarea>
            </div>
            <input type="hidden" name="uid" id="uid">
            <input type="hidden" name="order-items" id="order-items">
            <input type="hidden" name="orderTotalAmounts" id="orderTotalAmounts">
            <div class="button-group">
                <button type="button" class="backToCart">Kembali</button>
                <button type="button" class="confirmOrder disabled" disabled>Check Out</button>
            </div>
        </form>
    </div>

    @include('menu/confirmModal')

    @include('partials/alertModal')

@endsection

@push('js')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script src="{{ asset('js/dropDown.js') }}"></script>
    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('js/productModal.js') }}"></script>
    <script src="{{ asset('js/confirmModal.js') }}"></script>
@endpush
