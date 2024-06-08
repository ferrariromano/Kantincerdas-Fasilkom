// confirmModal.js
document.addEventListener('DOMContentLoaded', () => {
    const confirmOrderButton = document.querySelector('.confirmOrder');
    const confirmModal = document.getElementById('confirmModal');
    const confirmName = document.getElementById('confirm-name');
    const confirmPhone = document.getElementById('confirm-phone');
    const confirmPayment = document.getElementById('confirm-payment');
    const confirmAdditional = document.getElementById('confirm-additional');
    const confirmTotalItems = document.getElementById('confirm-total-items');
    const confirmTotalPrice = document.getElementById('confirm-total-price');
    const orderForm = document.querySelector('.orderForm');
    const orderName = document.getElementById('order-name');
    const orderPhone = document.getElementById('order-phone');
    const orderPayment = document.getElementById('order-payment');
    const additional = document.getElementById('additional');
    const totalItemElement = document.getElementById('total-items');
    const totalPriceElement = document.getElementById('total-price');

    confirmOrderButton.addEventListener('click', () => {
        confirmName.textContent = orderName.value;
        confirmPhone.textContent = orderPhone.value;
        confirmPayment.textContent = orderPayment.options[orderPayment.selectedIndex].text;
        confirmAdditional.textContent = additional.value;
        confirmTotalItems.textContent = totalItemElement.textContent.split(': ')[1];
        confirmTotalPrice.textContent = totalPriceElement.textContent.split(': ')[1];
        confirmModal.style.display = 'block';
    });

    document.querySelector('.cancelOrder').addEventListener('click', () => {
        confirmModal.style.display = 'none';
    });

    document.querySelector('.confirmOrderFinal').addEventListener('click', () => {
        orderForm.submit();
    });
});
