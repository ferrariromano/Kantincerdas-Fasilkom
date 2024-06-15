<nav>
    <img class="logo" src="{{ asset('images/img/logo.png') }}" alt="Logo">
    <ul class="navbar-links">
        <li>
            <a class="{{ ($active === "beranda") ? 'active' : '' }}" href="/">Beranda</a>
        </li>
        <li>
            <a class="{{ ($active === "menu") ? 'active' : '' }}" href="/menu">Menu</a>
        </li>
        <li>
            <a class="{{ ($active === "cekPesanan") ? 'active' : '' }}" id="cekPesananLink"  href="{{ route('cekPesanan', ['uid' => $uid ?? 'default-uid']) }}">Cek Pesanan</a>
        </li>
    </ul>
</nav>

