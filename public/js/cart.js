const iconCart = document.querySelector('.icon-cart');
const iconClose = document.querySelector('.icon-close');
const cartTab = document.querySelector('.cartTab');
const contentTab = document.querySelector('.contentTab');
const wrapper = document.querySelector('.wrapper');
const header = document.querySelector('header');
let iconCartSpan = iconCart.querySelector('span');
let listCartHTML = document.querySelector('.listCart');
let totalItemElement = document.getElementById('total-items');
let totalPriceElement = document.getElementById('total-price');
let cart = [];

const checkOutButton = document.querySelector('.checkOut');
const orderForm = document.querySelector('.orderForm');
const backToCartButton = document.querySelector('.backToCart');
const confirmOrderButton = document.querySelector('.confirmOrder');
const orderName = document.getElementById('order-name');
const orderPhone = document.getElementById('order-phone');
const orderPayment = document.getElementById('order-payment');
const orderItems = document.getElementById('order-items');
const additional = document.getElementById('additional');


// Create UID from local storage or cookie
const createUID = () => {
    return 'uid-' + Math.random().toString(36).substring(2, 18);
}
const getUID = () => {
    let uid = localStorage.getItem('uid');
    if (!uid) {
        uid = createUID();
        localStorage.setItem('uid', uid);
        document.cookie = `uid=${uid}; path=/;`;
    }
    return uid;
}
const uid = getUID();


// Open & Close cart tab
iconCart.addEventListener('click', function () {
    toggleCart();
});
iconClose.addEventListener('click', function () {
    toggleCart();
});

const toggleCart = () => {
    cartTab.classList.toggle('activeTabCart');
    contentTab.classList.toggle('activeTabCart');
    wrapper.classList.toggle('activeTabCart');
    header.classList.toggle('activeTabCart');
}

// Select all addCart button
const addCartButtons = document.querySelectorAll('.addCart');
// Add event listener for each addCart button
addCartButtons.forEach(button => {
    button.addEventListener('click', function () {
        const productId = this.getAttribute('data-id');
        let productClassSelector = this.closest('.item') || this.closest('.modal-right');
        const productName = productClassSelector.querySelector('#product-name').innerText;
        const productPrice = parseInt(productClassSelector.querySelector('#product-price').innerText.replace('Rp', '').replace('.', ''));
        const productTenant = productClassSelector.querySelector('#product-tenant').innerText;
        const product = {
            id: productId,
            name: productName,
            price: productPrice,
            tenant: productTenant
        };
        addProductToCart(product);
    });
});

// Add product to cart array
const addProductToCart = (product) => {
    let positionThisProductInCart = cart.findIndex((item) => item.product_id == product.id);
    if (positionThisProductInCart < 0) {
        cart.push({
            product_id: product.id,
            name: product.name,
            price: product.price,
            tenant_id: product.tenant,
            quantity: 1
        });
    } else {
        cart[positionThisProductInCart].quantity += 1;
    }
    localStorage.setItem('cart', JSON.stringify(cart));
    addCartToHTML(cart);
    updateCheckOutButton();
}

// Load cart from local storage
const loadCartFromLocalStorage = () => {
    cart = JSON.parse(localStorage.getItem('cart')) || [];
    addCartToHTML(cart);
    updateCheckOutButton();
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
    totalItemElement.innerText = `Jumlah Item : ${totalQuantity}`;
    totalPriceElement.innerText = `Total Harga : Rp ${totalPrice.toLocaleString('id-ID')}`;
    document.getElementById('orderTotalAmounts').value = totalPrice;
}

// Event listeners for plus and minus buttons
listCartHTML.addEventListener('click', (event) => {
    if (event.target.classList.contains('plus')) {
        const productId = event.target.getAttribute('data-id');
        updateQuantity(productId, 1);
    } else if (event.target.classList.contains('minus')) {
        const productId = event.target.getAttribute('data-id');
        updateQuantity(productId, -1);
    } else if (event.target.classList.contains('icon-delete') || event.target.closest('.icon-delete')) {
        const productId = event.target.closest('.icon-delete').getAttribute('data-id');
        removeItemFromCart(productId);
    }
});

// Update product quantity in cart
const updateQuantity = (productId, delta) => {
    let positionThisProductInCart = cart.findIndex((item) => item.product_id == productId);
    if (positionThisProductInCart >= 0) {
        cart[positionThisProductInCart].quantity += delta;
        if (cart[positionThisProductInCart].quantity <= 0) {
            cart.splice(positionThisProductInCart, 1);
        }
        localStorage.setItem('cart', JSON.stringify(cart));
        addCartToHTML(cart);
        updateCheckOutButton();
    }
}

// Remove item from cart
const removeItemFromCart = (productId) => {
    cart = cart.filter(item => item.product_id != productId);
    localStorage.setItem('cart', JSON.stringify(cart));
    addCartToHTML(cart);
    updateCheckOutButton();
}

// CheckOut button functionality
checkOutButton.addEventListener('click', () => {
    cartTab.querySelector('.cartInfo').style.display = 'none';
    listCartHTML.style.display = 'none';
    checkOutButton.style.display = 'none';
    orderForm.style.display = 'block';
});

// Back button functionality
backToCartButton.addEventListener('click', () => {
    orderForm.style.display = 'none';
    cartTab.querySelector('.cartInfo').style.display = 'flex';
    listCartHTML.style.display = 'block';
    checkOutButton.style.display = 'block';
});

// Validate form and enable/disable CheckOut button
const validateForm = () => {
    if (orderName.value.trim() !== '' && orderPhone.value.trim() !== '' && orderPayment.value.trim() !== '') {
        confirmOrderButton.disabled = false;
    } else {
        confirmOrderButton.disabled = true;
    }
}

orderName.addEventListener('input', validateForm);
orderPhone.addEventListener('input', validateForm);
orderPayment.addEventListener('change', validateForm);


// Update CheckOut button state
const updateCheckOutButton = () => {
    checkOutButton.disabled = cart.length === 0;
}

// Prepare data and submit the form
confirmOrderButton.addEventListener('click', () => {
    if (confirmOrderButton.disabled) return;
    orderItems.value = JSON.stringify(cart);
    document.getElementById('uid').value = uid;
    orderForm.submit();
});

// Load cart from local storage on page load
loadCartFromLocalStorage();

