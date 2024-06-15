@extends ('layouts.main')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/cekPesanan.css') }}">
@endpush

@section('container')
<div class="indexContainer">
    <h1>Cek Pesanan Index</h1>
    @foreach ($orderItemsGrouped as $tenantId => $items)
    <div class="row">
        <div class="col-md-6">
            <h2>Outlet : {{ $tenantNames[$tenantId] }}</h2>
            <p>Waiting List: {{ $waitingLists[$tenantId] }}</p>
            <div class="orderItem">
                @foreach ($items as $item)
                <li>{{ $item->quantity }}x {{ $item->product->name }} - Rp {{ number_format($item->price, 0, ',', '.') }}</li>
                @endforeach
            </div>
            <p>{{$quantities[$tenantId]}} item</p>
            <p>Sub Total: Rp {{ number_format($subtotals[$tenantId], 0, ',', '.') }}</p>
        </div>
    </div>
    @endforeach
    <div class="row">
        <div class="col-md-12">
            <h3>Total Item: {{ $order->orderItems->sum('quantity') }}</h3>
            <h3>Total Harga: Rp {{ number_format($order->orderTotalAmounts, 0, ',', '.') }}</h3>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script src="{{ asset('js/cekPesanan.js') }}"></script>
@endpush
