<x-app-layout>
    <x-slot name="header">Barang Masuk</x-slot>
    <x-slot name="activeMenu">barang-masuk</x-slot>

    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <label for="product_id" class="form-label">Nama Sepatu</label>
                        <select name="product_id" id="draft-product_id" class="form-select" required>
                            <option value="">Pilih</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="shoe_size_id" class="form-label">Ukuran Sepatu</label>
                        <select name="shoe_size_id" id="draft-shoe_size_id" class="form-select" required>
                            <option value="">Pilih</option>
                            @foreach($shoeSizes as $shoeSize)
                                <option value="{{ $shoeSize->id }}">{{ $shoeSize->size }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="quantity" class="form-label">Jumlah</label>
                        <input type="number" name="quantity" id="draft-quantity" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" id="add-button" class="btn btn-primary">
                            <i class="mdi mdi-plus"></i>
                            Add
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <table id="incoming-stocks" class="table table-bordered table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Shoe Size</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <form action="{{ route('incoming-stocks.store') }}" method="POST">
                        @csrf
                        <div class="mb-4" style="display: none">
                            <label for="product_id" class="form-label">Nama Sepatu</label>
                            <input type="text" class="form-control" name="product_id" id="product_id">
                        </div>
                        <div class="mb-4" style="display: none">
                            <label for="shoe_size_id" class="form-label">Ukuran Sepatu</label>
                            <input type="text" class="form-control" name="shoe_size_id" id="shoe_size_id">
                        </div>
                        <div class="mb-4" style="display: none">
                            <label for="quantity" class="form-label">Jumlah</label>
                            <input type="text" name="quantity" id="quantity" class="form-control" required>
                        </div>
                        <div class="mb-4" id="supplier-container" style="display: none">
                            <label for="supplier" class="form-label">Supplier Name</label>
                            <input type="text" name="supplier_name" id="supplier" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="submit" id="submit-button" class="btn btn-success" style="display: none">
                                <i class="mdi mdi-content-save"></i>
                                Simpan
                            </button>
                            <a href="{{ route('incoming-stocks.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>

<script>
    // Clear the local storage
    localStorage.removeItem('incomingStocks');

    $('#add-button').on('click', function () {
        const product_id = $('#draft-product_id').val();
        const shoe_size_id = $('#draft-shoe_size_id').val();
        const quantity = $('#draft-quantity').val();

        if (product_id === '' || shoe_size_id === '' || quantity === '') {
            alert('Semua field harus diisi');
            return;
        }

        // size text and product name
        const shoeSizeText = $('#draft-shoe_size_id option:selected').text();
        const productName = $('#draft-product_id option:selected').text();
        
        // add to local storage
        let incomingStocks = JSON.parse(localStorage.getItem('incomingStocks')) || [];

        // If there is already a product with the same size, then add the quantity
        const existingIndex = incomingStocks.findIndex(incomingStock => {
            return incomingStock.product_id == product_id && incomingStock.shoe_size_id == shoe_size_id;
        });

        if (existingIndex !== -1) {
            incomingStocks[existingIndex].quantity = parseInt(incomingStocks[existingIndex].quantity) + parseInt(quantity);
        }else{
            incomingStocks.push({
                product_id: product_id,
                shoe_size_id: shoe_size_id,
                quantity: quantity,
                shoeSizeText: shoeSizeText,
                productName: productName
            });
        }


        localStorage.setItem('incomingStocks', JSON.stringify(incomingStocks));

        // reset form
        $('#draft-product_id').val('');
        $('#draft-shoe_size_id').val('');
        $('#draft-quantity').val('');

        loadIncomingStocks();
    })

    loadIncomingStocks();

    function loadIncomingStocks() {
        const incomingStocks = JSON.parse(localStorage.getItem('incomingStocks')) || [];
        let html = '';

        let productIds = [];
        let shoeSizeIds = [];
        let quantities = [];

        if (incomingStocks.length === 0) {
            $('#submit-button').hide();
            $('#supplier-container').hide();
        } else {
            $('#submit-button').show();
            $('#supplier-container').show();
        }

        incomingStocks.forEach((incomingStock, index) => {
            console.log(incomingStock)
            html += `
                <tr>
                    <td>${incomingStock.productName}</td>
                    <td>${incomingStock.shoeSizeText}</td>
                    <td>${incomingStock.quantity}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm btn-icon" onclick="removeIncomingStock(${index})">
                            <i class="mdi mdi-trash-can"></i>
                        </button>
                    </td>
                </tr>
            `;

            productIds.push(incomingStock.product_id);
            shoeSizeIds.push(incomingStock.shoe_size_id);
            quantities.push(incomingStock.quantity);
        });

        $('#product_id').val(productIds.join(','));
        $('#shoe_size_id').val(shoeSizeIds.join(','));
        $('#quantity').val(quantities.join(','));

        $('#incoming-stocks tbody').html(html);
    }

    function removeIncomingStock(index) {
        let incomingStocks = JSON.parse(localStorage.getItem('incomingStocks')) || [];
        incomingStocks.splice(index, 1);
        localStorage.setItem('incomingStocks', JSON.stringify(incomingStocks));
        loadIncomingStocks();
    }
</script>
