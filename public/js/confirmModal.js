document.addEventListener('DOMContentLoaded', () => {
    // Elements for confirmation modal
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

    // Elements for order form
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

    const orderProducts = document.getElementById('order-items');

    // Elements for alert modal
    const alertModalOverlay = document.querySelector('.alert-modal-overlay');
    const alertModal = document.querySelector('.alertModal');
    const alertMessage = document.querySelector('.alertMessage');
    const successMessage = document.querySelector('.successMessage');
    const iconSuccess = document.querySelector('.icon-success');
    const failedMessage = document.querySelector('.failedMessage');
    const iconFailed = document.querySelector('.icon-failed');
    const iconError = document.querySelector('.icon-error');
    const closeAlertModal = document.querySelector('.closeModal');

    // Generate and set UID
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

    // Event to submit data on Ok button click
    confirmOrderFinalButton.addEventListener('click', () => {
        orderProducts.value = JSON.stringify(cart);
        const uid = getUID();
        localStorage.setItem('uid', uid);  // Save UID in LocalStorage

        const formData = new FormData(orderForm);
        formData.append('uid', uid);

        const apiEndpoint = '/submit-order'; // Update the API endpoint to match web.php

        fetch(apiEndpoint, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Response from server:', data);
            if (data.success) {
                if (orderPayment.value === 'non-tunai') {
                    console.log('Snap Token:', data.snap_token);
                    if (data.snap_token) {
                        initiateMidtransPayment(data.snap_token);
                    } else {
                        console.error('Snap token not received');
                        showErrorModal('Snap token tidak diterima.');
                    }
                } else {
                    showSuccessModal(data.message);
                }
            } else {
                showFailedModal(data.message || 'Pesanan gagal, silahkan coba lagi.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showErrorModal('Terjadi kesalahan, silahkan coba lagi.');
        });
    });

    // Function to initiate Midtrans payment
    function initiateMidtransPayment(snapToken) {
        snap.pay(snapToken, {
            onSuccess: function (result) {
                console.log(result);
                alert('Pembayaran berhasil!');
                showSuccessModal('Pembayaran berhasil!');
            },
            onPending: function (result) {
                console.log(result);
                alert('Pembayaran pending.');
                showFailedModal('Pembayaran pending.');
            },
            onError: function (result) {
                console.error(result);
                alert('Pembayaran gagal.');
                showErrorModal('Pembayaran gagal.');
            },
            onClose: function () {
                alert('Anda menutup pop-up tanpa menyelesaikan pembayaran.');
                showFailedModal('Anda menutup pop-up tanpa menyelesaikan pembayaran.');
            }
        });
    }
    // ====== Alert Modal Functions ======
    closeAlertModal.addEventListener('click', closeModal);

    // Close the alert modal and redirect
    function closeModal() {
        alertModal.style.display = 'none';
        alertModalOverlay.style.display = 'none';

        // Redirect to a new page
        const uid = localStorage.getItem('uid');
        window.location.href = `/cekPesanan/${uid}`;
    }

    // Show Success Modal
    function showSuccessModal(message) {
        alertMessage.textContent = message;
        alertModal.style.display = 'block';
        alertModalOverlay.style.display = 'block';
        iconSuccess.style.display = 'block';
        successMessage.style.display = 'block';
        iconFailed.style.display = 'none';
        iconError.style.display = 'none';
    }

    // Show Failed Modal
    function showFailedModal(message) {
        alertMessage.textContent = message;
        alertModal.style.display = 'block';
        alertModalOverlay.style.display = 'block';
        iconFailed.style.display = 'block';
        failedMessage.style.display = 'block';
        iconSuccess.style.display = 'none';
        iconError.style.display = 'none';
    }

    // Show Error Modal
    function showErrorModal(message) {
        alertMessage.textContent = message;
        alertModal.style.display = 'block';
        alertModalOverlay.style.display = 'block';
        iconError.style.display = 'block';
        iconSuccess.style.display = 'none';
        iconFailed.style.display = 'none';
    }

});
