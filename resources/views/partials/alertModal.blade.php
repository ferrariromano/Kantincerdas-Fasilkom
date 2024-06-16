<!-- Modal Overlay -->
<div class="alert-modal-overlay" style="display: none;"></div>
<!-- Alert Modal -->
<div class="alertModal" style="display: none;" >
    <div class="modalContent">
        <img class="logo" src="images/img/logo.png" alt="Logo Fasilkom UNEJ">
        <div class="iconModal icon-success" >
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="#4CAF50" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="iconModal icon-failed" style="display: none;" >
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="#db0f0f" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd"/>
            </svg>
        </div>
        <div class="iconModal icon-error" style="display: none;" >
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="#db0f0f" viewBox="0 0 24 24">
                <path stroke="#fff" stroke-linecap="round" stroke-width="2" d="m6 6 12 12m3-6a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
        </div>
        <p class="alertMessage"></p>
        <p class="successMessage" style="display: none;">Segera lakukan pembayaran agar pesanan bisa diproses</p>
        <p class="failedMessage" style="display: none;">Anda baru bisa melakukan pesanan lagi setelah pesanan sebelumnya selesai.</p>
        <button class="closeModal" onclick="closeModal()">Ok</button>
    </div>
</div>
