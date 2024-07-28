<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Sale') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Left Column: Product Search -->
                    <div>
                        <h3 class="font-semibold text-lg text-gray-800 mb-4">Search Products</h3>
                        <div id="product-search" class="mb-4">
                            <div class="mb-4">
                                <label for="product_id" class="block text-sm font-medium text-gray-700">Product</label>
                                <select id="product_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="" selected>Select a product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="shoe_size_id" class="block text-sm font-medium text-gray-700">Shoe Size</label>
                                <select id="shoe_size_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="" disabled selected>Select a size</option>
                                    <!-- Options will be dynamically populated -->
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                                <input type="number" id="quantity" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            </div>
                            <div class="mb-4">
                                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                <input type="number" id="price" step="0.01" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" readonly>
                            </div>
                            <div>
                                <button type="button" id="add-item" class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 text-white font-bold rounded-lg">Add Item</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column: Transaction Completion -->
                    <div>
                        <h3 class="font-semibold text-lg text-gray-800 mb-4">Complete Transaction</h3>
                        <form action="{{ route('sales.store') }}" method="POST">
                            @csrf
                            <div id="sale-items">
                                <!-- Items will be added here dynamically -->
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="px-4 py-2 bg-green-500 hover:bg-green-700 text-white font-bold rounded-lg">Complete Sale</button>
                            </div>
                        </form>
                    </div>
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
        <div class="mb-4 border-b border-gray-200 pb-4">
            <h4 class="font-medium text-lg text-gray-800">${productName} - Size: ${shoeSize}</h4>
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
