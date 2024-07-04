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

    // AlertModal Attribute
    const alertModalOverlay = document.querySelector('.alert-modal-overlay');
    const alertModal = document.querySelector('.alertModal');
    const alertMessage = document.querySelector('.alertMessage');
    const successMessage = document.querySelector('.successMessage');
    const iconSuccess = document.querySelector('.icon-success');
    const failedMessage = document.querySelector('.failedMessage');
    const iconFailed = document.querySelector('.icon-failed');
    const iconError = document.querySelector('.icon-error');
    const closeAlertModal = document.querySelector('.closeModal');

    const uid = getUID();
    document.getElementById('uid').value = uid;

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
            item.classList.toggle('open');
        });
    });

    confirmOrderFinalButton.addEventListener('click', () => {
        // Set hidden fields
        const orderItemsValue = JSON.stringify(cart);
        const uid = getUID();
        localStorage.setItem('uid', uid);  // Save UID in LocalStorage

        // Create FormData object
        const formData = new FormData(orderForm);
        formData.append('uid', uid);
        formData.append('order-items', orderItemsValue); // Ensure order-items is appended correctly

        // Send AJAX request
        fetch(orderForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(jsonData => {
            console.log('JSON Data:', jsonData);

            if (jsonData.success) {
                // Clear the cart
                localStorage.removeItem('cart');
                cart = [];
                addCartToHTML(cart);
                updateCheckOutButton();
                confirmModal.style.display = 'none';
                confirmModalOverlay.style.display = 'none';

                if (jsonData.snap_token) {
                    window.snap.pay(jsonData.snap_token, {
                        onSuccess: function(result) {
                            showSuccessModal('Pembayaran berhasil!'); // Update as necessary
                            console.log('Payment success:', result);
                        },
                        onPending: function(result) {
                            showFailedModal('Pembayaran tertunda!'); // Update as necessary
                            console.log('Payment pending:', result);
                        },
                        onError: function(result) {
                            showErrorModal('Pembayaran gagal!'); // Update as necessary
                            console.log('Payment error:', result);
                        },
                        onClose: function() {
                            showErrorModal('Anda menutup popup tanpa menyelesaikan pembayaran.');
                            console.log('Payment popup closed without finishing payment');
                        }
                    });
                } else {
                    showSuccessModal(jsonData.message);
                }
            } else {
                showFailedModal(jsonData.message || 'Pesanan gagal, silahkan coba lagi.');
                confirmModal.style.display = 'none';
                confirmModalOverlay.style.display = 'none';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showErrorModal('Terjadi kesalahan, silahkan coba lagi.');
            confirmModal.style.display = 'none';
            confirmModalOverlay.style.display = 'none';
        });
    });

    // ====== Alert Modal ======
    closeAlertModal.addEventListener('click', closeModal);

    // Close the alert modal and redirect
    function closeModal() {
        alertModal.style.display = 'none';
        alertModalOverlay.style.display = 'none';

        // Redirect to a new page
        const uid = localStorage.getItem('uid');
        window.location.href = `/cekPesanan/${uid}`;
    }

    // Show Alert Modal
    function showSuccessModal(message) {
        alertMessage.textContent = message;
        alertModal.style.display = 'block';
        alertModalOverlay.style.display = 'block';
        iconSuccess.style.display = 'block';
        successMessage.style.display = 'block';
        iconFailed.style.display = 'none';
        iconError.style.display = 'none';
    }
    function showFailedModal(message) {
        alertMessage.textContent = message;
        alertModal.style.display = 'block';
        alertModalOverlay.style.display = 'block';
        iconFailed.style.display = 'block';
        failedMessage.style.display = 'block';
        iconSuccess.style.display = 'none';
        iconError.style.display = 'none';
    }
    function showErrorModal(message) {
        alertMessage.textContent = message;
        alertModal.style.display = 'block';
        alertModalOverlay.style.display = 'block';
        iconError.style.display = 'block';
        iconSuccess.style.display = 'none';
        iconFailed.style.display = 'none';
    }
});
