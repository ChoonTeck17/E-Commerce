@extends('layouts.app')
@section('content')
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<style>
    .text-success {
        color: green !important;
    }
    .text-danger{
        color:red !important;
    }
</style>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
      <h2 class="page-title">Cart</h2>
      <div class="checkout-steps">
        <a href="javascript:void(0)" class="checkout-steps__item active">
          <span class="checkout-steps__item-number">01</span>
          <span class="checkout-steps__item-title">
            <span>Shopping Bag</span>
            <em>Manage Your Items List</em>
          </span>
        </a>
        <a href="javascript:void(0)" class="checkout-steps__item">
          <span class="checkout-steps__item-number">02</span>
          <span class="checkout-steps__item-title">
            <span>Shipping and Checkout</span>
            <em>Checkout Your Items List</em>
          </span>
        </a>
        <a href="javascript:void(0)" class="checkout-steps__item">
          <span class="checkout-steps__item-number">03</span>
          <span class="checkout-steps__item-title">
            <span>Confirmation</span>
            <em>Review And Submit Your Order</em>
          </span>
        </a>
      </div>
      <div class="shopping-cart">
        @if ($items->count()>0)
            <div class="cart-table__wrapper">
            <table class="cart-table">
                <thead>
                <tr>
                    <th>Product</th>
                    <th></th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td>
                            <div class="shopping-cart__product-item">
                                <img loading="lazy" src="{{ $item->model && $item->model->image ? asset('uploads/products/' . $item->model->image) : asset('images/placeholder.jpg') }}" alt="{{$item->name}}" style="width: 160px; height: 250px; object-fit: cover; object-position: center;" />                            </div>
                        </td>
                        <td>
                            <div class="shopping-cart__product-item__detail" style="margin-left: 20px;">
                                <h4>{{$item->name}}</h4>
                                <ul class="shopping-cart__product-item__options">
                                    <li>Color: Yellow</li>
                                    <li>Size: L</li>
                                </ul>
                            </div>
                        </td>
                        <td>
                            <span class="shopping-cart__product-price">${{$item->price}}</span>
                        </td>
                        <td>
                            <div class="qty-control position-relative">
                                <input type="number" name="quantity" value="{{$item->qty}}" min="1" class="qty-control__number text-center">
                                <form method="POST" action="{{route('cart.decrease-quantity', ['rowId'=>$item->rowId])}}">
                                    @csrf
                                    @method('PUT')  
                                <div class="qty-control__reduce">-</div>
                                </form>

                                <form method="POST" action="{{route('cart.increase-quantity', ['rowId'=>$item->rowId])}}">
                                @csrf
                                @method('PUT')  
                                <div class="qty-control__increase">+</div>
                                </form>
                            </div>
                        </td>
                        <td>
                            <span class="shopping-cart__subtotal">${{$item->subtotal()}}</span>
                        </td>
                        <td>
                            <form method="POST" action="{{route('cart.remove', ['rowId'=>$item->rowId])}}">
                                @csrf
                                @method('DELETE')
                            <a href="javascript:void(0)" class="remove-cart">
                                <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676" xmlns="http://www.w3.org/2000/svg">
                                    <i class="fa-solid fa-xmark"></i>
                                </svg>
                            </a>
                          </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="cart-table-footer">
                <form action="{{route('cart.apply_coupon')}}" METHOD="POST" class="position-relative bg-body">
                    @csrf
                <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code" value="@if(Session::has('coupon')) {{Session::get('coupon')['code']}} applied! @endif">
                <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit"
                    value="APPLY COUPON">
                </form>
                <form action="{{route('cart.empty')}}" method="POST">
                    @csrf
                    @method('DELETE')
                <button class="btn btn-light" type="submit">Clear cart</button>
                </form>
            </div>
            <div>
                @if (Session::has('success'))
                <p class="text-success">{{Session::get('success')}}</p>
                @elseif(Session::has('error'))
                <p class="text-danger">{{Session::get('error')}}</p>
                @endif
            </div>
            </div>
            <div class="shopping-cart__totals-wrapper">
            <div class="sticky-content">
                <div class="shopping-cart__totals">
                <h3>Cart Totals</h3>
                @if(Session::has('discounts'))
                  
                <table class="cart-totals">
                    <tbody>
                    <tr>
                        <th>Subtotal</th>
                        <td>${{Cart::instance('cart')->subtotal()}}</td>
                    </tr>
                    <tr>
                        <th>Discount {{Session::get('coupon')['code']}}</th>
                        <td>{{Session::get('discounts')['discount']}}</td>
                    </tr>
                    <tr>
                        <th>Subtotal after discount </th>
                        <td>${{Session::get('discounts')['subtotal']}}</td>
                    </tr>
                    <tr>
                        <th>Shipping</th>
                        <td>
                            Free
                        </td>
                    </tr>
                    <tr>
                        <th>VAT</th>
                        <td>${{Session::get('discounts')['tax']}}</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>${{Session::get('discounts')['total']}}</td>
                    </tr>
                    </tbody>
                </table>  

                @else

                <table class="cart-totals">
                    <tbody>
                    <tr>
                        <th>Subtotal</th>
                        <td>${{Cart::instance('cart')->subtotal()}}</td>
                    </tr>
                    <tr>
                        <th>Shipping</th>
                        <td>
                            Free
                        </td>
                    </tr>
                    <tr>
                        <th>VAT</th>
                        <td>${{Cart::instance('cart')->tax()}}</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>${{Cart::instance('cart')->total()}}</td>
                    </tr>
                    </tbody>
                </table>
                @endif
                </div>
                <div class="mobile_fixed-btn_wrapper">
                <div class="button-wrapper container">
                    <a href="checkout.html" class="btn btn-primary btn-checkout">PROCEED TO CHECKOUT</a>
                </div>
                </div>
            </div>
            </div>
        @else
            <div class="row">
                <div class="col-md text-center pt-5 bp-5">
                    <p>
                        No items found in your cart
                    </p>
                    <a href="{{route('shop.index')}}" class="btn btn-primary">Shop now </a>
                </div>
            </div>
        @endif
      </div>
    </section>
    <div class="d-flex justify-content-center">
        <form action="{{ route('cart.clear-session') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-warning">CLEAR SESSION</button>
        </form>
    </div> 
    
  </main>
@endsection

@push('scripts')

<script>
    $(function(){
        $(".qty-control__reduce").click(function(){
           $(this).closest('form').submit();
        });

        $(".qty-control__increase").click(function(){
           $(this).closest('form').submit();
        });

        $(".remove-cart").click(function(){
           $(this).closest('form').submit();
        });
    })
</script>
    
@endpush