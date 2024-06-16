@extends ('layouts.main')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/cekPesanan.css') }}">
@endpush

@section('container')
<div class="indexContainer">
    <h1>Cek Pesanan</h1>
    <div class="headerGroup">
        <div class="orderInfo">
            <div class="infoGroup">
                <p class="pInfoGroup">Nama Pemesan</p>
                <span class="txt-bld-orange" class="order-name">{{ $orderName }}</span>
            </div>
            <div class="infoGroup">
                <p class="pInfoGroup">Nomor Handphone</p>
                <span class="txt-bld-orange" class="order-phone">{{ $orderPhone }}</span>
            </div>
            <div class="infoGroup">
                <p class="pInfoGroup">Metode Pembayaran</p>
                <span class="txt-bld-orange" class="order-payment">{{ $orderPayment }}</span>
            </div>
        </div>
        <div class="messageInfo">
            <div class="icon-message">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="28" height="30" fill="#ee4111" viewBox="0 0 24 24">
                    <path d="M17.133 12.632v-1.8a5.407 5.407 0 0 0-4.154-5.262.955.955 0 0 0 .021-.106V3.1a1 1 0 0 0-2 0v2.364a.933.933 0 0 0 .021.106 5.406 5.406 0 0 0-4.154 5.262v1.8C6.867 15.018 5 15.614 5 16.807 5 17.4 5 18 5.538 18h12.924C19 18 19 17.4 19 16.807c0-1.193-1.867-1.789-1.867-4.175Zm-13.267-.8a1 1 0 0 1-1-1 9.424 9.424 0 0 1 2.517-6.391A1.001 1.001 0 1 1 6.854 5.8a7.43 7.43 0 0 0-1.988 5.037 1 1 0 0 1-1 .995Zm16.268 0a1 1 0 0 1-1-1A7.431 7.431 0 0 0 17.146 5.8a1 1 0 0 1 1.471-1.354 9.424 9.424 0 0 1 2.517 6.391 1 1 0 0 1-1 .995ZM8.823 19a3.453 3.453 0 0 0 6.354 0H8.823Z"/>
                </svg>
            </div>
            <p id="orderMessage" class="message">
                Segera lakukan pembayaran agar pesananmu bisa segera diproses
            </p>
        </div>
    </div>
    <div class="outletGroup {{ count($orderItemsGrouped) === 1 ? 'single-tenant' : '' }}">
        @foreach ($orderItemsGrouped as $tenantId => $items)
            <div class="outlet">
                <div class="outletHeader">
                    <div class="headerLeft">
                        <div class="tenant">Outlet : <span class="tenantName">{{ $tenantNames[$tenantId] }}</span></div>
                        <p class="outletWaitingList">Waiting List : {{ $waitingLists[$tenantId] }}</p>
                    </div>
                    <div class="headerRight">
                        <div class="orderStatus {{ strtolower($statuses[$tenantId]) }}">
                            {{ $statuses[$tenantId] }}
                        </div>
                    </div>
                </div>
                <div class="outletItem">
                    @foreach ($items as $item)
                    <div>{{ $item->quantity }}x</div>
                    <div>{{ $item->product->name }}</div>
                    <div>Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                    @endforeach
                </div>
                <div class="outletHighlight">
                    <p class="quantity__title"><span class="higlightValue">{{$quantities[$tenantId]}}</span> item</p>
                    <p class="subTotal__title">Sub Total </p>
                    <p class="higlightValue">Rp {{ number_format($subtotals[$tenantId], 0, ',', '.') }}</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="orderHighlight">
        <p><span class="orderHighlight__value">{{ $order->orderItems->sum('quantity') }}</span> Item</p>
        <div class="priceOrder">
            <p>Total Harga</p>
            <span class="orderHighlight__value">Rp {{ number_format($order->orderTotalAmounts, 0, ',', '.') }}</span>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script src="{{ asset('js/cekPesanan.js') }}"></script>
@endpush
