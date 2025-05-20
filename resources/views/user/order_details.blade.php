@extends('layouts.app')
@section('content')
    <main class="py-4">
        <section class="container my-5">
            <h2 class="text-center mb-5 fw-bold">Order Details</h2>
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-2 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @include('user.account-nav')
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="col-lg-10">
                    <!-- Ordered Items -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                                <h5 class="card-title mb-0">Ordered Items</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover text-center">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" class="text-start">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">SKU</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Brand</th>
                                            <th scope="col">Options</th>
                                            <th scope="col">Return Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderitems as $item)
                                            <tr>
                                                <td class="pname text-start">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <img src="{{ asset('Uploads/products/thumbnail') }}/{{ $item->product->image }}"
                                                            alt="{{ $item->product->name }}" class="img-fluid rounded"
                                                            style="width: 50px; height: 50px;">
                                                        <div>
                                                            <a href="{{ route('shop.product.details', ['product_slug' => $item->product->slug]) }}"
                                                               target="_blank" class="text-primary fw-medium">{{ $item->product->name }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>${{ $item->price }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->product->SKU }}</td>
                                                <td>{{ $item->product->category->name }}</td>
                                                <td>{{ $item->product->brand->name }}</td>
                                                <td>{{ $item->options }}</td>
                                                <td>{{ $item->rstatus == 0 ? 'No' : 'Yes' }}</td>
                                                <td>
                                                    <div class="list-icon-function view-icon">
                                                        <a href="#" class="text-muted" title="View Details">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr class="my-4">
                            <div class="d-flex justify-content-end">
                                {{ $orderItems->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>

                    <!-- Order Details -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                                <h5 class="card-title mb-0">Order Details</h5>
                                <a class="btn btn-sm btn-danger" href="{{ route('admin.orders') }}">Back</a>
                            </div>
                            <div class="table-responsive">
                                @if(Session::has('status'))
                                    <p class="alert alert-success">{{Session::get('status')}}</p>
                                @endif
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Order No</th>
                                            <td>{{ $order->id }}</td>
                                            <th scope="row">Mobile</th>
                                            <td>{{ $order->phone }}</td>
                                            <th scope="row">Zip Code</th>
                                            <td>{{ $order->zip }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Order Date</th>
                                            <td>{{ $order->created_at }}</td>
                                            <th scope="row">Delivered Date</th>
                                            <td>{{ $order->delivered_date }}</td>
                                            <th scope="row">Cancelled Date</th>
                                            <td>{{ $order->cancelled_date }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Order Status</th>
                                            <td colspan="5">
                                                @if ($order->status == 'delivered')
                                                    <span class="badge bg-success">Delivered</span>
                                                @elseif($order->status == 'cancelled')
                                                    <span class="badge bg-danger">Cancelled</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Ordered</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Shipping Address</h5>
                            <div class="bg-light p-3 rounded">
                                <p class="fw-bold mb-1">{{ $order->name }}</p>
                                <p class="mb-1">{{ $order->address }}</p>
                                <p class="mb-1">{{ $order->locality }}</p>
                                <p class="mb-1">{{ $order->city }}, {{ $order->country }}</p>
                                <p class="mb-1">{{ $order->landmark }}</p>
                                <p class="mb-1">{{ $order->zip }}</p>
                                <p class="mb-0"><strong>Mobile:</strong> {{ $order->phone }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Transactions -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Transactions</h5>
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <th scope="row">Subtotal</th>
                                        <td>{{ $order->subtotal }}</td>
                                        <th scope="row">Tax</th>
                                        <td>{{ $order->tax }}</td>
                                        <th scope="row">Discount</th>
                                        <td>{{ $order->discount }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Total</th>
                                        <td>{{ $order->total }}</td>
                                        <th scope="row">Payment Mode</th>
                                        <td>{{ $transaction ? $transaction->mode : 'N/A' }}</td>
                                        <th scope="row">Status</th>
                                        <td>
                                            @if ($transaction)
                                                @if ($transaction->status == 'approved')
                                                    <span class="badge bg-success">Success</span>
                                                @elseif($transaction->status == 'declined')
                                                    <span class="badge bg-danger">Failed</span>
                                                @elseif($transaction->status == 'refunded')
                                                    <span class="badge bg-warning text-dark">Refunded</span>
                                                @else
                                                    <span class="badge bg-info">Pending</span>
                                                @endif
                                            @else
                                                <span class="badge bg-secondary">N/A</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if ($order->status != 'delivered')
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <form action="{{ route('user.order.cancel') }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="text" name="order_id" value="{{ $order->id }}" hidden>
                                    <button type="submit" class="btn btn-danger cancel-order w-100">Cancel Order</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </main>

@push('scripts')
    <script>
        $(function () {
            $('.cancel-order').on('click', function (e) {
                e.preventDefault();
                var form = $(this).closest('form');

                // SweetAlert2
                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to cancel this order?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: 'Yes, cancel it!',
                    cancelButtonText: 'No, keep it'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
@endsection
