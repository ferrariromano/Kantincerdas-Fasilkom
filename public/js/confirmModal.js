// confirmModal.js
document.addEventListener('DOMContentLoaded', () => {
    const confirmModalOverlay = document.getElementById('confirmModalOverlay');
    const pInfoGroup = document.querySelectorAll('.pInfoGroup');
    const confirmModal = document.getElementById('confirmModal');
    const confirmName = document.getElementById('confirm-name');
    const confirmPhone = document.getElementById('confirm-phone');
    const confirmPayment = document.getElementById('confirm-payment');
    const confirmTotalItems = document.getElementById('confirm-total-items');
    const confirmTotalPrice = document.getElementById('confirm-total-price');

    const orderForm = document.querySelector('.orderForm');
    const orderName = document.getElementById('order-name');
    const orderPhone = document.getElementById('order-phone');
    const orderPayment = document.getElementById('order-payment');
    const additional = document.getElementById('additional');
    const totalItemElement = document.getElementById('total-items');
    const totalPriceElement = document.getElementById('total-price');
    const confirmOrderButton = document.querySelector('.confirmOrder');

    const confirmOrderFinalButton = document.querySelector('.confirmOrderFinal');
    const additionalNotesToggle = document.querySelector('.additional-notes-toggle');
    const additionalNotesSection = document.querySelector('.additional-notes');
    const toggleIcon = document.querySelector('.toggle-icon');

    // Tampilkan modal dan isi dengan value yang diambil dari form
    confirmOrderButton.addEventListener('click', () => {
        confirmName.textContent = orderName.value;
        confirmPhone.textContent = orderPhone.value;
        confirmPayment.textContent = orderPayment.options[orderPayment.selectedIndex].text;
        additionalNotesSection.textContent = additional.value;
        confirmTotalItems.textContent = totalItemElement.textContent.split(': ')[1];
        confirmTotalPrice.textContent = totalPriceElement.textContent.split(': ')[1];
        confirmModal.style.display = 'block';
        confirmModalOverlay.style.display = 'block';
    });

    // Event untuk tutup Modal jika klik btn Batal
    document.querySelector('.cancelOrder').addEventListener('click', () => {
        confirmModal.style.display = 'none';
        confirmModalOverlay.style.display = 'none';
    });

    // Buka tutup Catatan Tambahan
    additionalNotesToggle.addEventListener('click', () => {
        additionalNotesSection.classList.toggle('open');
        toggleIcon.classList.toggle('open');

        pInfoGroup.forEach(pInfoGroup => {
            pInfoGroup.classList.toggle('open');
        });
    });

    // Event untuk Submit data jika klik Ok
    confirmOrderFinalButton.addEventListener('click', () => {
        orderItems.value = JSON.stringify(cart);
        document.getElementById('uid').value = uid;
        orderForm.submit();
    });

    // Clear the cart
    localStorage.removeItem('cart');
       cart = [];
       iconCartSpan.innerText = 0;
       addCartToHTML(cart);
       updateCheckOutButton();
    });
