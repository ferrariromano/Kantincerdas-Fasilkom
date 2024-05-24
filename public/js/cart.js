document.addEventListener('DOMContentLoaded', function () {
    const iconCart = document.querySelector('.icon-cart');
    const iconClose = document.querySelector('.icon-close');
    const cartTab = document.querySelector('.cartTab');
    const contentTab = document.querySelector('.contentTab');
    const wrapper = document.querySelector('.wrapper');
    const header = document.querySelector('header');

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
});
