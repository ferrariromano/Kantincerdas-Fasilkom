@extends('layouts.main')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/cekPesanan.css') }}">
@endpush

@section('container')
<div class="defaultContainer">
    <h1>Cek Pesanan</h1>
    <div class="outletGroup">
        <div class="outlet">
            <h2 class="outletTitle">Left Canteen</h2>
            <img src="{{ asset('images/img/canteen.jpeg') }}" alt="fasilkom">
            <div class="waitingList__group">
                <p class="waitingList__title">Waiting List :</p>
                <span class="waitingList__value">{{ $waitingLists[1] ?? 0 }}</span>
            </div>
        </div>
        <div class="outlet">
            <h2 class="outletTitle">Right Canteen</h2>
            <img src="{{ asset('images/img/canteen2.jpeg') }}" alt="fasilkom">
            <div class="waitingList__group">
                <p class="waitingList__title">Waiting List :</p>
                <span class="waitingList__value">{{ $waitingLists[2] ?? 0 }}</span>
            </div>
        </div>
    </div>
    <div class="linkToMenu">
        <p>Anda belum melakukan pesanan</p>
        <a href="{{ route('menu.index') }}" class="btn">Pesan Sekarang</a>
    </div>
</div>
@endsection

@push('js')
    <script src="{{ asset('js/cekPesanan.js') }}"></script>
@endpush
