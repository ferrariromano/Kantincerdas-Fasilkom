@extends('layouts.app')

@section('content')
<div class="mb-0 mx-5 border-none shadow-none xl:w-3/4 card bg-white/70 dark:bg-zink-500/70">
    <div class="grid grid-cols-1 gap-0 md:grid-cols-12 lg:grid-cols-12 relative">
        <div class="mx-2 mt-2 mb-2 pl-5 border-none shadow-none md:col-span-7 card bg-white/60 dark:bg-zink-500/60 relative">
            <div class="h-full !pb-0 flex flex-col">
                <div class="flex items-center justify-between">
                    <div class="mt-auto w-full">
                        <img src="{{ asset('images/img/posterLogin.png') }}" alt="" class="w-full max-w-full md:max-w-[32rem] mx-auto">
                    </div>
                </div>
            </div>
        </div>
        <div class="md:col-span-5 pr-4 absolute w-full h-full md:relative bg-white/80 dark:bg-zink-500/70 md:bg-transparent md:dark:bg-transparent">
            <div class="!py-12 !px-2 bg-transparent dark:bg-transparent">
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
                        Anda <b>berhasil</b> masuk.
                    </div>
                    <div class="mb-3">
                        <label for="nama_tenant" class="inline-block mb-2 text-base font-medium">Nama Tenant</label>
                        <input type="text" id="nama_tenant" name="nama_tenant" class="form-input border-3 border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Masukkan nama tenant">
                        <div id="nama_tenant-error" class="hidden mt-1 text-sm text-red-500">Silakan masukkan nama tenant yang valid.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="inline-block mb-2 text-base font-medium">Password</label>
                        <input type="password" id="password" name="password" class="form-input border-3 border-slate-200 dark:border-zink-500 dark:bg-transparent focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200" placeholder="Masukkan password">
                        <div id="password-error" class="hidden mt-1 text-sm text-red-500">Password harus terdiri dari minimal 8 karakter dan mengandung huruf dan angka.</div>
                    </div>
                    <div class="mt-10">
                        <button type="submit" class="w-full text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
