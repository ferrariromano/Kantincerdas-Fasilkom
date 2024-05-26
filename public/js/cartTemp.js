const iconCart = document.querySelector('.icon-cart');
const iconClose = document.querySelector('.icon-close');
const cartTab = document.querySelector('.cartTab');
const contentTab = document.querySelector('.contentTab');
const wrapper = document.querySelector('.wrapper');
const header = document.querySelector('header');
let iconCartSpan = iconCart.querySelector('span');
let listCartHTML = document.querySelector('.listCart');
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

// Event click -> SetProductInCart ->addCartToHTML

// Logic update isi cart
const setProductInCart = (idProduct, value) => {
    // Cari indeks dalam array 'cart' yg memiliki product_id sama dgn idProduct
    let positionThisProductInCart = cart.findIndex((value) => value.product_id == idProduct);
    // Hapus item cart jika qty <= 0
    if(value <= 0){
        cart.splice(positionThisProductInCart, 1);
    // add item ke cart jika belum ada
    }else if(positionThisProductInCart < 0){
        cart.push({
            product_id: idProduct,
            quantity: 1
        });
    // update qty jika produk sudah ada
    }else{
        cart[positionThisProductInCart].quantity = value;
    }
    // save cart in localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
    addCartToHTML(cart);
}

// Load cart dari local storage
const loadCartFromLocalStorage = () => {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    addCartToHTML(cart);
}

// Update view cart
const addCartToHTML = (cart) => {
    listCartHTML.innerHTML = '';
    let totalQuantity = 0;
    cart.forEach(item => {
        totalQuantity += item.quantity;
        let newItem = document.createElement('div');
        newItem.classList.add('item');
        newItem.dataset.id = item.product_id;

        newItem.innerHTML = `
            <div class="name">${item.name}</div>
            <div class="totalPrice">Rp ${item.price * item.quantity}</div>
            <div class="quantity">
                <span class="minus" data-id="${item.product_id}"><</span>
                <span>${item.quantity}</span>
                <span class="plus" data-id="${item.product_id}">></span>
            </div>
            <div class="icon-delete">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
                </svg>
            </div>
        `;
        listCartHTML.appendChild(newItem);
    });
    iconCartSpan.innerText = totalQuantity;
}

// Event click
// document.addEventListener('click', function(event) {
//     event.preventDefault();
//     let buttonClick = event.target;
//     let idProduct = buttonClick.dataset.id;
//     let quantity = null;
//     let positionProductInCart = cart.findIndex((value) => value.product_id == idProduct);
//     switch (true) {
//         // Logic Cek & add item pada cart. Jika belum ada maka qty 1. Jika sudah ada maka qty +1
//         case (buttonClick.classList.contains('addCart')):
//             quantity = (positionProductInCart < 0) ? 1 : cart[positionProductInCart].quantity+1;
//             console.log("addcart")
//             console.log(cart)
//             setProductInCart(idProduct, quantity);
//             break;
//         // Logic decrease qty
//         case (buttonClick.classList.contains('minus')):
//             quantity = cart[positionProductInCart].quantity-1;
//             console.log("minus")
//             setProductInCart(idProduct, quantity);
//             break;
//         // Logic increase qty
//         case (buttonClick.classList.contains('plus')):
//             quantity = cart[positionProductInCart].quantity+1;
//             console.log("minus")
//             setProductInCart(idProduct, quantity);
//             break;
//         default:
//             break;
//     }
// })
