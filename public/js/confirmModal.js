// confirmModal.js
document.addEventListener('DOMContentLoaded', () => {
    const confirmModalOverlay = document.getElementById('confirmModalOverlay');
    const confirmModal = document.getElementById('confirmModal');
    const confirmModalTitle = document.querySelector('.confirm-modal-title');
    const confirmModalInfo = document.querySelector('.confirmModalInfo');
    const confirmModalHighlight = document.querySelector('.confirmModalHighlight');
    const highlightPrice = document.querySelector('.highlightPrice');
    const confirmName = document.getElementById('confirm-name');
    const confirmPhone = document.getElementById('confirm-phone');
    const confirmPayment = document.getElementById('confirm-payment');
    const confirmItem = document.querySelector('.listConfirmationItem');
    const notesTitle = document.querySelector('.notesTitle');
    const confirmTotalItems = document.getElementById('confirm-total-items');
    const confirmTotalPrice = document.getElementById('confirm-total-price');
    const hlItem = document.querySelectorAll('.hlItem');

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

    // Show modal and fill in the values from the form
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

    // Event to close the modal on Cancel button click
    document.querySelector('.cancelOrder').addEventListener('click', () => {
        confirmModal.style.display = 'none';
        confirmModalOverlay.style.display = 'none';
    });

    // Toggle additional notes
    additionalNotesToggle.addEventListener('click', () => {
        additionalNotesSection.classList.toggle('open');
        toggleIcon.classList.toggle('open');
        confirmModalInfo.classList.toggle('open');
        confirmItem.classList.toggle('open');
        notesTitle.classList.toggle('open');
        confirmModalTitle.classList.toggle('open');
        confirmModalHighlight.classList.toggle('open');
        highlightPrice.classList.toggle('open');

        hlItem.forEach(item => {
            item.classList.toggle('open')
        })

    });

    // Event to submit data on Ok button click
    confirmOrderFinalButton.addEventListener('click', () => {
        // Set hidden fields
        orderItems.value = JSON.stringify(cart);
        uid.value = getUID();

        // Create FormData object
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
