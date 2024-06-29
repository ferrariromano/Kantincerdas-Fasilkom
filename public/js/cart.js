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

function setUID(newUID) {
    localStorage.setItem('uid', newUID);
}

const checkOutButton = document.querySelector('.checkOut');
const orderForm = document.querySelector('.orderForm');
const backToCartButton = document.querySelector('.backToCart');
const confirmOrderButton = document.querySelector('.confirmOrder');
const orderName = document.getElementById('order-name');
const orderPhone = document.getElementById('order-phone');
const orderPayment = document.getElementById('order-payment');
const additional = document.getElementById('additional');

// Create UID from local storage or cookie
function generateUID() {
    return 'uid-' + Math.random().toString(36).substr(2, 16);
}

function getUID() {
    let uid = localStorage.getItem('uid');
    if (!uid) {
        uid = generateUID();
        localStorage.setItem('uid', uid);
    }
    return uid;
}

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
    updateConfirmationItems();
}

// Load cart from local storage
const loadCartFromLocalStorage = () => {
    cart = JSON.parse(localStorage.getItem('cart')) || [];
    addCartToHTML(cart);
    updateCheckOutButton();
    updateConfirmationItems();
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
        updateConfirmationItems();
    }
}

// Remove item from cart
const removeItemFromCart = (productId) => {
    cart = cart.filter(item => item.product_id != productId);
    localStorage.setItem('cart', JSON.stringify(cart));
    addCartToHTML(cart);
    updateCheckOutButton();
    updateConfirmationItems();
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
        confirmOrderButton.classList.remove('disabled');
        confirmOrderButton.disabled = false;
    } else {
        confirmOrderButton.classList.add('disabled');
        confirmOrderButton.disabled = true;
    }
}

orderName.addEventListener('input', validateForm);
orderPhone.addEventListener('input', validateForm);
orderPayment.addEventListener('change', validateForm);

// Update CheckOut button state
const updateCheckOutButton = () => {
    checkOutButton.disabled = cart.length === 0;
    if (cart.length > 0) {
        checkOutButton.classList.remove('disabled');
    } else {
        checkOutButton.classList.add('disabled');
    }
}

// Fungsi untuk memperbarui daftar item di listConfirmationItem
const updateConfirmationItems = () => {
    const listConfirmationItem = document.querySelector('.listConfirmationItem');
    listConfirmationItem.innerHTML = '';
    let tenants = {};
    const tenantNames = {
        1: "Left Canteen",
        2: "Right Canteen"
    };

    // Group items by tenant
    cart.forEach(item => {
        const tenantName = tenantNames[item.tenant_id] || `Tenant ${item.tenant_id}`;
        if (!tenants[item.tenant_id]) {
            tenants[item.tenant_id] = {
                tenant_name: tenantName,
                items: [],
                subtotal: 0,
                totalQuantity: 0
            };
        }
        tenants[item.tenant_id].items.push(item);
        tenants[item.tenant_id].subtotal += item.price * item.quantity;
        tenants[item.tenant_id].totalQuantity += item.quantity;
    });

    // Recalculate tenant count after grouping items
    const updatedTenantCount = Object.keys(tenants).length;

    // Render items grouped by tenant
    Object.values(tenants).forEach(tenant => {
        let tenantItemsHTML = `
            <div class="tenant">
                <p>Outlet : <span>${tenant.tenant_name}</span></p>
                <div class="items">`;

        tenant.items.forEach(item => {
            tenantItemsHTML += `
                <div class="confirmation-item">
                    <div class="quantity">${item.quantity}x</div>
                    <div class="name">${item.name}</div>
                    <div class="totalPrice">Rp ${(item.price * item.quantity).toLocaleString('id-ID')}</div>
                </div>`;
        });

        if (updatedTenantCount > 1) {
            tenantItemsHTML += `
                    </div>
                    <div class="subtotal">
                        <p>${tenant.totalQuantity} item</p>
                        <p>Subtotal : Rp <span>${tenant.subtotal.toLocaleString('id-ID')}</span></p>
                    </div>
                </div>`;
        } else {
            tenantItemsHTML += `</div>`; // Close tenantSection div without subtotal
        }

        listConfirmationItem.innerHTML += tenantItemsHTML;
    });
};

// show the confirmation modal
confirmOrderButton.addEventListener('click', async () => {
    if (confirmOrderButton.disabled) return;

    const uid = getUID();
    const orderData = {
        'order-name': orderName.value,
        'order-phone': orderPhone.value,
        'order-payment': orderPayment.value,
        'additional': additional.value,
        'order-items': JSON.stringify(cart),
        'orderTotalAmounts': document.getElementById('orderTotalAmounts').value,
        'uid': uid
    };

    try {
        const response = await fetch('/submit-order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(orderData)
        });

        const result = await response.json();
        if (result.success) {
            setUID(result.uid); // Update UID in localStorage
            // Display success message and handle further steps
        } else {
            // Handle error
        }
    } catch (error) {
        console.error('Error submitting order:', error);
    }

    // Menampilkan confirm-modal
    document.getElementById('confirmModal').style.display = 'block';
});

// Load cart from local storage on page load
loadCartFromLocalStorage();
