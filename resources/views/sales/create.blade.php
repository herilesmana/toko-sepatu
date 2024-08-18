<x-app-layout>
    <x-slot name="header">Create Sale</x-slot>
    <x-slot name="activeMenu">sales</x-slot>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- Left Column: Product Search -->
                <div class="col-md-6">
                    <h3 class="font-weight-bold mb-4">Search Products</h3>
                    <div id="product-search">
                        <div class="mb-4">
                            <label for="product_id" class="form-label">Product</label>
                            <select id="product_id" class="form-select" required>
                                <option value="" selected>Select a product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="shoe_size_id" class="form-label">Shoe Size</label>
                            <select id="shoe_size_id" class="form-select" required>
                                <option value="" disabled selected>Select a size</option>
                                <!-- Options will be dynamically populated -->
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" id="quantity" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" id="price" step="0.01" class="form-control" readonly>
                        </div>
                        <div>
                            <button type="button" id="add-item" class="btn btn-primary">Add Item</button>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column: Transaction Completion -->
                <div class="col-md-6">
                    <h3 class="font-weight-bold mb-4">Complete Transaction</h3>
                    <form action="{{ route('sales.store') }}" method="POST">
                        @csrf
                        <div id="sale-items">
                            <!-- Items will be added here dynamically -->
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">Complete Sale</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
document.getElementById('product_id').addEventListener('change', function () {
    var productId = this.value;
    var price = this.options[this.selectedIndex].getAttribute('data-price');
    document.getElementById('price').value = price;

    // Fetch shoe sizes for the selected product
    fetch(`/api/product/${productId}/sizes`)
        .then(response => response.json())
        .then(data => {
            var shoeSizeSelect = document.getElementById('shoe_size_id');
            shoeSizeSelect.innerHTML = '<option value="" disabled selected>Select a size</option>'; // Reset options
            data.forEach(size => {
                shoeSizeSelect.innerHTML += `<option value="${size.id}" data-quantity="${size.quantity}">${size.size}</option>`;
            });
        });
});

document.getElementById('add-item').addEventListener('click', function () {
    var saleItems = document.getElementById('sale-items');
    var saleItemCount = saleItems.getElementsByClassName('sale-item').length;

    var productSelect = document.getElementById('product_id');
    var productName = productSelect.options[productSelect.selectedIndex].text;
    var productId = productSelect.value;

    var sizeSelect = document.getElementById('shoe_size_id');
    var shoeSize = sizeSelect.options[sizeSelect.selectedIndex].text;
    var shoeSizeId = sizeSelect.value;
    var availableQuantity = sizeSelect.options[sizeSelect.selectedIndex].getAttribute('data-quantity');

    var quantity = document.getElementById('quantity').value;
    var price = document.getElementById('price').value;

    if (quantity > availableQuantity) {
        alert('Quantity exceeds available stock!');
        return;
    }

    var newSaleItem = document.createElement('div');
    newSaleItem.classList.add('sale-item', 'mb-4');

    newSaleItem.innerHTML = `
        <div class="mb-4 border-bottom pb-4">
            <h5 class="font-weight-bold">${productName} - Size: ${shoeSize}</h5>
            <input type="hidden" name="items[${saleItemCount}][product_id]" value="${productId}">
            <input type="hidden" name="items[${saleItemCount}][shoe_size_id]" value="${shoeSizeId}">
            <input type="hidden" name="items[${saleItemCount}][quantity]" value="${quantity}">
            <input type="hidden" name="items[${saleItemCount}][price]" value="${price}">
            <p>Quantity: ${quantity}</p>
            <p>Price: ${price}</p>
        </div>
    `;

    saleItems.appendChild(newSaleItem);

    // Clear the form
    document.getElementById('quantity').value = '';
    document.getElementById('price').value = '';
});
</script>
