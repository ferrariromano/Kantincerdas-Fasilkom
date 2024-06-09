@extends ('layouts.main')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/productModal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/confirmModal.css') }}">
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
                    <div class="price txt_orange" id="product-price">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                    <span class="txt_orange" id="product-tenant" style="display: none;">{{ $product->tenant_id }}</span>
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
        <button class="checkOut disabled">Check Out</button>

        <form class="orderForm" action="{{ route('submitOrder') }}" method="POST" style="display: none;">
            @csrf
            <div class="inputUser">
                <div class="input-group">
                    <input type="text" name="order-name" id="order-name" placeholder=" " />
                    <span for="order-name">Nama Pemesan</span>
                </div>
                <div class="input-group">
                    <input type="text" name="order-phone" id="order-phone" placeholder=" " />
                    <span for="order-name">Nomor Handphone</span>
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
                <button type="button" class="backToCart">Back</button>
                <button type="button" class="confirmOrder disabled" disabled>Check Out</button>
            </div>
        </form>
    </div>

    <!-- Modal Overlay -->
    <div class="confirm-modal-overlay" id="confirmModalOverlay" style="display: none;"></div>
    <!-- Confirmation Modal -->
    <div class="confirm-modal" id="confirmModal" style="display: none;">
        <div class="confirm-modal-content">
            <h2>Konfirmasi Pesanan</h2>
            <div class="confirmModalInfo">
                <div class="infoGroup">
                    <p class="pInfoGroup">Nama Pemesan</p>
                    <span class="txt-bld-orange" id="confirm-name"></span>
                </div>
                <div class="infoGroup">
                    <p class="pInfoGroup">Nomor Handphone</p>
                    <span class="txt-bld-orange" id="confirm-phone"></span>
                </div>
                <div class="infoGroup">
                    <p class="pInfoGroup">Metode Pembayaran</p>
                    <span class="txt-bld-orange" id="confirm-payment"></span>
                </div>
            </div>
            <p class="additional-notes-toggle">
                Catatan tambahan:
                <span class="toggle-icon">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ee4111   " viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 0 0-.822 1.57L6.632 12l-4.454 6.43A1 1 0 0 0 3 20h13.153a1 1 0 0 0 .822-.43l4.847-7a1 1 0 0 0 0-1.14l-4.847-7a1 1 0 0 0-.822-.43H3Z" clip-rule="evenodd"/>
                    </svg>
                </span>
            </p>
            <div class="additional-notes" id="confirm-additional"></div>
            <div class="confirmModalHighlight">
                <p><span class="txt-bld-orange" id="confirm-total-items"></span> Item</p>
                <div class="highlightPrice">
                    <p>Total Harga</p>
                    <span class="txt-bld-orange" id="confirm-total-price"></span>
                </div>
            </div>
            <p class="question">Apakah yakin dengan semua pilihan pemesanan tersebut?</p>
            <div class="btnGroup">
                <button class="cancelOrder">Batal</button>
                <button class="confirmOrderFinal">Ok</button>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('js/productModal.js') }}"></script>
    <script src="{{ asset('js/confirmModal.js') }}"></script>
@endpush
