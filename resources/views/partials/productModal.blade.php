<div id="productDetailModal-{{ $product->id }}" class="modal">
    <div class="modal-content">
        <div class="modal-body view-1">
            <span class="close">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd"/>
                </svg>
            </span>
            <div class="modal-left">
                <img src="/images/products/{{ $product->image }}" alt="Product Image">
            </div>
            <div class="modal-right">
                <h2 id="product-name">{{ $product->name }}</h2>
                <div class="price" id="product-price">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                <p><span class="txt_orange">Outlet : </span>{{ $outletNames[$product->tenant_id] ?? 'Unknown Outlet' }}</p>
                <div class="modalButton">
                    <button class="switchView" data-target="view-2">More Info</button>
                    <button class="addCart" data-id="{{ $product->id }}">Add To Cart</button>
                </div>
            </div>
        </div>
        <div class="modal-body view-2" style="display: none;">
            <span class="close">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z" clip-rule="evenodd"/>
                </svg>
            </span>
            <div class="modal-right">
                <h2 id="product-name">{{ $product->name }}</h2>
                <div class="price" id="product-price" style="display: none;">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
                <p><span class="txt_orange">Outlet : </span>{{ $outletNames[$product->tenant_id] ?? 'Unknown Outlet' }}</p>
                <div class="desc">
                    <p>{{ $product->description }}</p>
                </div>
                <div class="grid">
                    <div class="header">Kalori</div>
                    <div class="header">Karbohidrat</div>
                    <div class="header">Protein</div>
                    <div class="cell">312 kkal</div>
                    <div class="cell">19,55 g</div>
                    <div class="cell">6,58 g</div>
                </div>
                <div class="modalButton">
                    <button class="switchView" data-target="view-1">Back</button>
                    <button class="addCart" data-id="{{ $product->id }}">Add To Cart</button>
                </div>
            </div>
        </div>
    </div>
</div>
