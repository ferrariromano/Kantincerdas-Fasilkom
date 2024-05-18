@extends('layouts.main')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
@endpush

@section('container')
    <div class="boundary">
        <main>
            <header class="headline flex-group">
                <picture class="headline__img">
                    <img src="{{ asset('images/img/fasilkom.png') }}" alt="fasilkom">
                </picture> 
                <div class="headline__text">
                    <h1>
                        <span class="headline__title txt_orange">Smart Canteen</span>
                        <span class="headline__subtitle">Fasilkom Universitas Jember</span>
                    </h1>
                    <p class="headline__attachment"><span class="txt_orange">Pesan</span> & <span class="txt_orange">Bayar</span> Makanan dengan Mudah</p>
                    <button class="button btn_order">Pesan Sekarang <img class="arrow" src="images/icon/arrow_icon.png" alt="arrow_icon"></button>
                </div>
            </header>
            <p class="caption">Selamat datang di <span class="txt_orange">Smart Canteen Fasilkom UNEJ.</span> Temukan pilihan makanan dan minuman terbaik dengan sistem pembayaran pintar di Fakultas Ilmu Komputer Universitas Jember. Nikmati kuliner praktis tanpa antrian!</p>
            <div class="offer flex-group">
                <div class="offer__icon flex-group">
                    <img class="icon" src="{{ asset('images/icon/check_icon.png') }}" alt="order_icon">
                    <div class="icon_text">
                        <h3>Pesan Online</h3>
                        <p>Lihat menu & pesan makanan secara online</p>
                    </div>
                </div>
                <div class="offer__icon flex-group">
                    <img class="icon" src="{{ asset('images/icon/payment_icon.png') }}" alt="payment_icon">
                    <div class="icon_text"> 
                        <h3>Bayar Mudah</h3>
                        <p>Bayar pesanan tunai atau non-tunai dengan mudah</p>
                    </div>
                </div>
                <div class="offer__icon flex-group">
                    <img class="icon" src="{{ asset('images/icon/food_icon.png') }}" alt="food_icon">
                    <div class="icon_text">
                        <h3>Kualitas Terbaik</h3>
                        <p>Nikmati makanan dan minuman kualitas terbaik</p>
                    </div>
                </div>
            </div>
            <section class="bestseller">
                <p>Kategori <span class="txt_orange">Menu Terbaik</span></p>
                <p>Smart Canteen Fasilkom</p>
                <div class="bestseller__menu flex-group">
                    <div class="bestseller__item">
                        <img src="{{ asset('images/img/food1.png') }}" alt="food1">
                        <span class="bestseller__text">Soto Sate</span>
                        <a href="#">Pesan ></a>
                    </div>
                    <div class="bestseller__item">
                        <img src="{{ asset('images/img/food2.png') }}" alt="food2">
                        <span class="bestseller__text">Ayam Geprek</span>
                        <a href="#">Pesan ></a>
                    </div>
                    <div class="bestseller__item">
                        <img src="{{ asset('images/img/food3.png') }}" alt="food3">
                        <span class="bestseller__text">Tahu Tek</span>
                        <a href="#">Pesan ></a>
                    </div>
                </div>
            </section>
            <div class="attachment">
                <p class="attachment__text">Nikmati <span class="atctex_black">20+ variasi makanan</span> dari</p> 
                <p class="attachment__text"><span class="atctex_yellow">Outlet</span> Smart Canteen Fasilkom</p>
                <button class="button attachment__btn">Pesan Sekarang <img class="arrow" src="{{ asset('images/icon/arrow_icon.png') }}" alt="arrow_icon"></button>
            </div>
        </main>    
    </div>
@endsection