@extends('layouts.app')

@section('content')
<div class="mb-0 w-screen lg:mx-auto lg:w-[500px] card shadow-lg border-none shadow-slate-100 relative">
    <div class="!px-10 !py-12 card-body">
        <a href="#!">
            <img src="assets/images/logo-light.png" alt="" class="hidden h-6 mx-auto dark:block logoLogin">
            <img src="assets/images/logo-dark.png" alt="" class="block h-6 mx-auto dark:hidden logoLogin">
        </a>

        <div class="mt-8 text-center">
            <h4 class="mb-1 text-custom-500 dark:text-custom-500">Selamat Datang Tenant!</h4>
            <p class="text-slate-500 dark:text-zink-200">Masuk untuk melanjutkan ke Tenant Dashboard.</p>
        </div>

        <form action="{{ route('tenant.login') }}" class="mt-10" id="" method="POST">
            @csrf
            <div class="hidden px-4 py-3 mb-3 text-sm text-green-500 border border-green-200 rounded-md bg-green-50 dark:bg-green-400/20 dark:border-green-500/50" id="successAlert">
                Kamu punya <b>berhasil</b> masuk.
            </div>
            <div class="mb-3">
                <label for="nama_tenant" class="inline-block mb-2 text-base font-medium">Nama Tenant</label>
                <input type="text" id="nama_tenant" name="nama_tenant" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Enter tenant name">
                <div id="nama_tenant-error" class="hidden mt-1 text-sm text-red-500">Silakan masukkan nama tenant name valid.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="inline-block mb-2 text-base font-medium">Password</label>
                <input type="password" id="password" name="password" class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Enter password">
                <div id="password-error" class="hidden mt-1 text-sm text-red-500">Kata sandi harus terdiri dari minimal 8 karakter dan mengandung huruf dan angka                    .</div>
            </div>
            <div class="mt-10">
                <button type="submit" class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Login</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
@endsection
