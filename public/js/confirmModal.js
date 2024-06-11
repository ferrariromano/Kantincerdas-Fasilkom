// confirmModal.js
document.addEventListener('DOMContentLoaded', () => {
    const confirmModalOverlay = document.getElementById('confirmModalOverlay');
    const confirmModal = document.getElementById('confirmModal');
    const confirmModalInfo = document.querySelector('.confirmModalInfo');
    const confirmName = document.getElementById('confirm-name');
    const confirmPhone = document.getElementById('confirm-phone');
    const confirmPayment = document.getElementById('confirm-payment');
    const confirmItem = document.querySelector('.listConfirmationItem');
    const notesTitle = document.querySelector('.notesTitle');
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

    const orderItems = document.getElementById('order-items');
    const uid = document.getElementById('uid');

    // Tampilkan modal dan isi dengan value yang diambil dari form
    confirmOrderButton.addEventListener('click', () => {
        confirmName.textContent = orderName.value;
        confirmPhone.textContent = orderPhone.value;
        confirmPayment.textContent = orderPayment.options[orderPayment.selectedIndex].text;
        additionalNotesSection.textContent = additional.value;
        confirmTotalItems.textContent = totalItemElement.textContent.split(': ')[1];
        confirmTotalPrice.textContent = totalPriceElement.textContent.split(': ')[1];

        updateConfirmationItems();

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
        confirmModalInfo.classList.toggle('open');
        confirmItem.classList.toggle('open');
        notesTitle.classList.toggle('open');
    });

    // Event untuk Submit data jika klik Ok
    confirmOrderFinalButton.addEventListener('click', () => {
        // Set the hidden fields
        orderItems.value = JSON.stringify(cart);
        uid.value = getUID();

        // Create a FormData object
        const formData = new FormData(orderForm);

        // Send AJAX request
        fetch(orderForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            } 
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Clear the cart
                localStorage.removeItem('cart');
                cart = [];
                addCartToHTML(cart);
                updateCheckOutButton();

                alert(data.message);
                // Redirect to Page Cek Pesanan
                window.location.href = "/cekPesanan";
            }
        })
        .catch(error => console.error('Error:', error));
    });



});
