<!-- Modal Overlay -->
<div class="confirm-modal-overlay" id="confirmModalOverlay" style="display: none;"></div>
<!-- Confirmation Modal -->
<div class="confirm-modal" id="confirmModal" style="display: none;">
    <div class="confirm-modal-content">
        <h2 class="confirm-modal-title">Konfirmasi Pesanan</h2>
        <div class="confirmModalInfo">
            <div class="infoGroup">
                <p class="pInfoGroup">Nama Pemesan</p>
                <span class="txt-bld-orange" id="confirm-name"></span>
            </div>
            <div class="infoGroup">
                <p class="pInfoGroup">Nomor Handphone</p>
                <span class="txt-bld-orange" id="confirm-phone"></span>
            </div>
            <div class="infoGroup">
                <p class="pInfoGroup">Metode Pembayaran</p>
                <span class="txt-bld-orange" id="confirm-payment"></span>
            </div>
        </div>
        <p class="additional-notes-toggle">
            Detail Pesanan:
            <span class="toggle-icon">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#ee4111   " viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M3 4a1 1 0 0 0-.822 1.57L6.632 12l-4.454 6.43A1 1 0 0 0 3 20h13.153a1 1 0 0 0 .822-.43l4.847-7a1 1 0 0 0 0-1.14l-4.847-7a1 1 0 0 0-.822-.43H3Z" clip-rule="evenodd"/>
                </svg>
            </span>
        </p>
        <div class="contentItem">
            <div class="listConfirmationItem"></div>
            <p class="notesTitle">Catatan Tambahan :</p>
            <div class="additional-notes" id="confirm-additional"></div>
        </div>
        <div class="confirmModalHighlight">
            <p class="hlItem"><span class="txt-bld-orange hlItem" id="confirm-total-items"></span> Item</p>
            <div class="highlightPrice">
                <p class="hlItem">Total Harga </p>
                <span class="txt-bld-orange hlItem" id="confirm-total-price"></span>
            </div>
        </div>
        <p class="question">Apakah yakin dengan semua pilihan pemesanan tersebut?</p>
        <div class="btnGroup">
            <button class="cancelOrder">Batal</button>
            <button class="confirmOrderFinal">Ok</button>
        </div>
    </div>
</div>
