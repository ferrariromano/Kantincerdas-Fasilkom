<nav>
    <img class="logo" src="images/img/logo.png" alt="Logo">
    <ul class="navbar-links">
        <li>
            <a class="{{ ($active === "beranda") ? 'active' : '' }}" href="/">Beranda</a>
        </li>
        <li>
            <a class="{{ ($active === "menu") ? 'active' : '' }}" href="/menu">Menu</a>
        </li>
        <li>
            <a href="#">Cek Pesanan</a>
        </li>
    </ul>
</nav>
