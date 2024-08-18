<x-app-layout>
    <x-slot name="header">Point of Sale (POS)</x-slot>
    <x-slot name="activeMenu">sales</x-slot>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- Left Column: Barcode Input & Product Search -->
                <div class="col-md-5">
                    <h3 class="font-weight-bold mb-4">Scan or Search Product</h3>
                    <div id="product-input-section">
                        <!-- Barcode Input -->
                        <div class="mb-4">
                            <label for="barcode" class="form-label">Scan Barcode:</label>
                            <input type="text" id="barcode" class="form-control" placeholder="Scan or enter barcode" autofocus>
                        </div>
                        
                        <!-- Product Search Input -->
                        <div class="mb-4">
                            <label for="search" class="form-label">Search Product:</label>
                            <input type="text" id="search" class="form-control" placeholder="Enter product name">
                        </div>

                        <!-- Product List -->
                        <div id="product-list" class="list-group" style="display: none;">
                            <!-- Results will be displayed here -->
                        </div>

                        <!-- Product Details -->
                        <div id="product-details" class="mb-4 border rounded p-3" style="display: none;">
                            <div class="d-flex gap-2">
                                <h5 class="font-weight-bold" id="product-name"></h5>
                                <div>
                                    <span class="badge bg-primary" id="product-brand"></span>
                                </div>
                            </div>
                            <p id="product-price"></p>
                            <input type="hidden" id="product_id">
                            <input type="hidden" id="price">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="shoe_size_id" class="form-label">Shoe Size</label>
                                        <select id="shoe_size_id" class="form-select" required>
                                            <option value="" disabled selected>Select a size</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" id="quantity" class="form-control" value="1" min="1" required>
                                    </div>
                                </div>
                            </div>
                            <button type="button" id="add-item" class="btn btn-primary">Add Item</button>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column: Sale Items and Checkout -->
                <div class="col-md-7">
                    <h3 class="font-weight-bold mb-4">Sale Summary</h3>
                    <form action="{{ route('sales.store') }}" method="POST">
                        @csrf
                        <div id="sale-items">
                            <!-- Items will be added here dynamically -->
                        </div>
                        <div class="mt-4">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="font-weight-bold">Total : <span id="total-price"></span></h4>
                                </div>
                                <button id="complete-sale-button" type="submit" class="btn btn-success">Complete Sale</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    function currencyIndonesia(value) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(value);
    }
    $(document).ready(function() {
        // Clear localStorage on page load (optional)
        localStorage.removeItem('saleItems');
    
        // Load sale items from localStorage on page load
        loadSaleItems();
    
        // Handle barcode scanning
        $('#barcode').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                let barcode = $(this).val();

                $('#barcode').val('');
    
                $.getJSON(`/api/product/barcode/${barcode}`, function(data) {
                    if (data) {
                        populateProductDetails(data);
                        fetchShoeSizes(data.id);
                    } else {
                        alert('Product not found!');
                    }
                });
            }
        });
    
        // Handle product search
        $('#search').on('input', function() {
            let query = $(this).val();
    
            if (query.length > 2) {
                $.getJSON(`/api/product/search?search=${query}`, function(data) {
                    let productList = $('#product-list');
                    productList.empty();
    
                    if (data.length > 0) {
                        productList.show();
                        $.each(data, function(index, product) {
                            let productItem = $('<a>', {
                                href: '#',
                                class: 'list-group-item list-group-item-action',
                                text: product.name,
                                click: function() {
                                    populateProductDetails(product);
                                    fetchShoeSizes(product.id);
                                    productList.hide();
                                }
                            });

                            productItem.append($('<span>', {
                                class: 'ms-2 badge bg-primary',
                                text: product.brand.name
                            }));

                            productList.append(productItem);
                        });
                    } else {
                        productList.hide();
                    }
                });
            } else {
                $('#product-list').hide();
            }
        });
    
        // Fetch available shoe sizes
        function fetchShoeSizes(productId) {
            $.getJSON(`/api/product/${productId}/sizes`, function(data) {
                let shoeSizeSelect = $('#shoe_size_id');
                shoeSizeSelect.empty().append('<option value="" disabled selected>Select a size</option>');
    
                $.each(data, function(index, size) {
                    shoeSizeSelect.append(
                        `<option value="${size.id}" data-quantity="${size.quantity}">${size.size}</option>`
                    );
                });
            });
        }
    
        // Populate product details for adding to sale
        function populateProductDetails(product) {
            $('#product-name').text(product.name);
            $('#product-brand').text(product.brand.name);
            $('#product-price').text(`Price: ${currencyIndonesia(product.price)}`);
            $('#product_id').val(product.id);
            $('#price').val(product.price);
            $('#product-details').show();
            $('#quantity').focus();
        }
    
        // Handle adding item to sale
        $('#add-item').on('click', function() {
            let productId = $('#product_id').val();
            let productName = $('#product-name').text();
            let productBrand = $('#product-brand').text();
            let shoeSizeSelect = $('#shoe_size_id');
            let shoeSize = shoeSizeSelect.find('option:selected').text();
            let shoeSizeId = shoeSizeSelect.val();
            let availableQuantity = shoeSizeSelect.find('option:selected').data('quantity');
            let quantity = $('#quantity').val();
            let price = $('#price').val();
    
            if (!shoeSizeId) {
                alert('Please select a shoe size!');
                return;
            }
    
            if (quantity > availableQuantity) {
                alert('Quantity exceeds available stock!');
                return;
            }
    
            // Check if the product with the selected size already exists in the sale summary
            let saleItemsData = JSON.parse(localStorage.getItem('saleItems')) || [];
            let existingItem = saleItemsData.find(item => item.productId === productId && item.shoeSizeId === shoeSizeId);
    
            if (existingItem) {
                // Increase the quantity of the existing item
                existingItem.quantity = parseInt(existingItem.quantity) + parseInt(quantity);
            } else {
                // Add a new item to saleItemsData
                saleItemsData.push({
                    productId: productId,
                    productName: productName,
                    brand: productBrand,
                    shoeSize: shoeSize,
                    shoeSizeId: shoeSizeId,
                    quantity: parseInt(quantity),
                    price: price,
                    availableQuantity: availableQuantity // Save available quantity for stock checking
                });
            }
    
            // Save the updated saleItemsData to localStorage
            localStorage.setItem('saleItems', JSON.stringify(saleItemsData));
    
            // Reload sale items to update the UI
            loadSaleItems();
    
            // Clear the form
            $('#barcode').val('');
            $('#search').val('');
            $('#product-list').hide();
            $('#product-details').hide();
            $('#barcode').focus();
        });
    
        // Load sale items from localStorage
        function loadSaleItems() {
            let saleItems = $('#sale-items');
            saleItems.empty();
    
            let saleItemsData = JSON.parse(localStorage.getItem('saleItems')) || [];
    
            $.each(saleItemsData, function(index, item) {
                saleItems.append(`
                    <div class="sale-item mb-4 border rounded p-3">
                        <div class="">
                            <h5 class="font-weight-bold">${item.productName} <span class="badge bg-primary">${item.brand}</span> - Size: ${item.shoeSize}</h5>
                            <input type="hidden" name="items[${index}][product_id]" value="${item.productId}">
                            <input type="hidden" name="items[${index}][shoe_size_id]" value="${item.shoeSizeId}">
                            <input type="hidden" name="items[${index}][quantity]" value="${item.quantity}">
                            <input type="hidden" name="items[${index}][price]" value="${item.price}">
                            <div class="d-flex justify-content-between">
                                <div>
                                    Quantity: <button type="button" class="btn btn-sm btn-icon btn-dark decrease-quantity rounded-circle" data-index="${index}">-</button> 
                                         <span class="item-quantity px-2">${item.quantity}</span> 
                                         <button type="button" class="btn btn-sm btn-icon btn-dark increase-quantity rounded-circle" data-index="${index}">+</button>
                                </div>
                                <div>
                                    <span>Price: ${currencyIndonesia(item.price)}</span>
                                </div>
                            </div>
                            <div class="mt-2">
                                <strong>Subtotal: ${currencyIndonesia(item.price*item.quantity)}</strong>
                            </div>
                        </div>
                    </div>
                `);
            });

            // Calculate total price
            let totalPrice = saleItemsData.reduce((total, item) => total + (item.price * item.quantity), 0);
            $('#total-price').text(currencyIndonesia(totalPrice));
    
            // Attach event listeners for increase/decrease buttons
            $('.increase-quantity').on('click', function() {
                let index = $(this).data('index');
                updateQuantity(index, 1);
            });
    
            $('.decrease-quantity').on('click', function() {
                let index = $(this).data('index');
                updateQuantity(index, -1);
            });
    
            // Enable or disable the complete sale button based on the number of items in the sale
            let completeSaleButton = $('#complete-sale-button');
            if (saleItemsData.length > 0) {
                completeSaleButton.removeAttr('disabled');
            } else {
                completeSaleButton.prop('disabled', true);
            }
        }
    
        // Update quantity function with stock check
        function updateQuantity(index, delta) {
            let saleItemsData = JSON.parse(localStorage.getItem('saleItems')) || [];
            let item = saleItemsData[index];
    
            // Check if the new quantity exceeds available stock
            let newQuantity = item.quantity + delta;
            if (newQuantity > item.availableQuantity) {
                alert('Quantity exceeds available stock!');
                return;
            }
    
            // Update the quantity
            item.quantity = newQuantity;
    
            // Remove item if quantity is zero or less
            if (item.quantity <= 0) {
                saleItemsData.splice(index, 1);
            }
    
            // Save the updated saleItemsData to localStorage
            localStorage.setItem('saleItems', JSON.stringify(saleItemsData));
    
            // Reload sale items to update the UI
            loadSaleItems();
        }
    });
</script>
