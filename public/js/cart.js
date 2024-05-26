const iconCart = document.querySelector('.icon-cart');
const iconClose = document.querySelector('.icon-close');
const cartTab = document.querySelector('.cartTab');
const contentTab = document.querySelector('.contentTab');
const wrapper = document.querySelector('.wrapper');
const header = document.querySelector('header');
let iconCartSpan = iconCart.querySelector('span');
let listCartHTML = document.querySelector('.listCart');
let totalPriceElement = document.getElementById('total-price');
let cart = [];

// Open & Close cart tab
iconCart.addEventListener('click', function () {
    cartTab.classList.toggle('activeTabCart');
    contentTab.classList.toggle('activeTabCart');
    wrapper.classList.toggle('activeTabCart');
    header.classList.toggle('activeTabCart');
});

iconClose.addEventListener('click', function () {
    cartTab.classList.toggle('activeTabCart');
    contentTab.classList.toggle('activeTabCart');
    wrapper.classList.toggle('activeTabCart');
    header.classList.toggle('activeTabCart');
});

// Mengambil semua tombol addCart
const addCartButtons = document.querySelectorAll('.addCart');

// Menambahkan event listener untuk setiap tombol addCart
addCartButtons.forEach(button => {
    button.addEventListener('click', function () {
        const productId = this.getAttribute('data-id');
        const productName = this.closest('.item').querySelector('#product-name').innerText;
        const productPrice = parseInt(this.closest('.item').querySelector('#product-price').innerText.replace('Rp', '').replace(/\./g, ''));
        const product = {
            id: productId,
            name: productName,
            price: productPrice
        };
        addProductToCart(product);
    });
});

// Fungsi untuk menambahkan produk ke cart
const addProductToCart = (product) => {
    let positionThisProductInCart = cart.findIndex((item) => item.product_id == product.id);
    if (positionThisProductInCart < 0) {
        cart.push({
            product_id: product.id,
            name: product.name,
            price: product.price,
            quantity: 1
        });
    } else {
        cart[positionThisProductInCart].quantity += 1;
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    addCartToHTML(cart);
}

// Load cart dari local storage
const loadCartFromLocalStorage = () => {
    cart = JSON.parse(localStorage.getItem('cart')) || [];
    addCartToHTML(cart);
}

// Update view cart
const addCartToHTML = (cart) => {
    listCartHTML.innerHTML = '';
    let totalQuantity = 0;
    let totalPrice = 0;
    cart.forEach(item => {
        totalQuantity += item.quantity;
        totalPrice += item.price * item.quantity;
        let newItem = document.createElement('div');
        newItem.classList.add('item');
        newItem.dataset.id = item.product_id;

        newItem.innerHTML = `
            <div class="name">${item.name}</div>
            <div class="totalPrice">Rp ${(item.price * item.quantity).toLocaleString('id-ID')}</div>
            <div class="quantity">
                <span class="minus" data-id="${item.product_id}"><</span>
                <span>${item.quantity}</span>
                <span class="plus" data-id="${item.product_id}">></span>
            </div>
            <div class="icon-delete" data-id="${item.product_id}">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                </svg>
            </div>
        `;
        listCartHTML.appendChild(newItem);
    });
    iconCartSpan.innerText = totalQuantity;
    totalPriceElement.innerText = totalPrice.toLocaleString('id-ID');

    // Mengaktifkan event listener untuk tombol plus, minus, dan delete
    activateCartButtons();
}

// Menambahkan event listener untuk tombol plus, minus, dan delete pada setiap item cart
const activateCartButtons = () => {
    document.querySelectorAll('.plus').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            let product = cart.find(item => item.product_id == productId);
            setProductInCart(product, product.quantity + 1);
        });
    });

    document.querySelectorAll('.minus').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            let product = cart.find(item => item.product_id == productId);
            setProductInCart(product, product.quantity - 1);
        });
    });

    document.querySelectorAll('.icon-delete').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id');
            let product = cart.find(item => item.product_id == productId);
            setProductInCart(product, 0);
        });
    });
}

// Logic update isi cart
const setProductInCart = (product, value) => {
    let positionThisProductInCart = cart.findIndex((item) => item.product_id == product.product_id);
    if (value <= 0) {
        cart.splice(positionThisProductInCart, 1);
    } else if (positionThisProductInCart < 0) {
        cart.push({
            product_id: product.product_id,
            name: product.name,
            price: product.price,
            quantity: value
        });
    } else {
        cart[positionThisProductInCart].quantity = value;
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    addCartToHTML(cart);
}

// Mengambil data dari localStorage saat halaman dimuat
window.onload = loadCartFromLocalStorage;
