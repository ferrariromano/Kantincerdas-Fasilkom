@foreach ($products as $product)
    <div class="item">
        <a href="#" class="imagesProduct" data-toggle="modal" data-target="productDetailModal-{{ $product->id }}">
            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
        </a>
        <h2 id="product-name">{{ $product->name }}</h2>
        <div class="price txt_orange" id="product-price">Rp{{ number_format($product->price, 0, ',', '.') }}</div>
        <span id="product-tenant" style="display: none;">{{ $product->tenant_id }}</span>
        <button class="addCart" data-id="{{ $product->id }}">+Keranjang</button>
    </div>
    @include('menu.productModal', ['product' => $product])
@endforeach

