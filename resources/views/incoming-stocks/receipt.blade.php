<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Incoming Receipt | Velzon Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Receipt page based on Velzon template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/template/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons CSS -->
    <link href="{{ asset('assets/template/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App CSS -->
    <link href="{{ asset('assets/template/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <h4 class="float-end font-size-16 d-flex flex-column align-items-end">
                                Invoice Pembelian #{{ $transaction->id }}
                                <small>Supplier : {{ $transaction->supplier_name }}</small>
                            </h4>
                            <div class="d-flex gap-2 align-items-center">
                                <img src="{{ asset('assets/logo.png') }}" alt="logo" height="50" />
                                <h3>Glory Shoes</h3>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6 mt-3">
                                <address>
                                    <strong>User:</strong><br>
                                    {{ $transaction->user->name }}
                                </address>
                            </div>
                            <div class="col-sm-6 mt-3 text-sm-end">
                                <address>
                                    <strong>Transaction Time:</strong><br>
                                    {{ date('d M Y H:i:s', strtotime($transaction->created_at)) }}<br><br>
                                </address>
                            </div>
                        </div>
                        <div class="mt-2">
                            <h3 class="font-size-15 fw-bold">Invoice Summary</h3>
                        </div>
                        <div class="table-responsive mt-3">
                            <table class="table table-nowrap">
                                <thead>
                                    <tr>
                                        <th class="px-0">Product</th>
                                        <th>Size</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction->items as $item)
                                    <tr>
                                        <td class="px-0">{{ $item->product->name }}</td>
                                        <td>{{ $item->shoeSize->size }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Rp{{ number_format($item->price, 0, ',', '.') }},-</td>
                                        <td class="text-end">Rp{{ number_format($item->price*$item->quantity, 0, ',', '.') }},-</td>
                                    </tr>
                                    @endforeach
                                    <!-- Add more products as needed -->
                                    <tr>
                                        <td colspan="4" class="text-end"><strong>Total</strong></td>
                                        <td class="text-end"><strong>
                                            Rp{{ number_format($transaction->total, 0, ',', '.') }},-</strong></td>
                                        </strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-print-none">
                            <div class="float-end no-print">
                                <a href="javascript:window.print()" class="btn btn-success"><i class="ri-printer-line align-bottom"></i> Print</a>
                                <a onClick="window.close()" class="btn btn-primary">Close</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/template/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        window.onload = function () {
            // window.print();
        };
    </script>
</body>

</html>
