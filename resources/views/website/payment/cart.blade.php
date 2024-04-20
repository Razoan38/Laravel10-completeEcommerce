  @extends('website.layouts.app')

  @section('title')
      Cart Page
  @endsection

  @section('style')
  @endsection
  @section('content')
      <main class="main">
          <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
              <div class="container">
                  <h1 class="page-title">Shopping Cart<span>Shop</span></h1>
              </div>
          </div>
          <nav aria-label="breadcrumb" class="breadcrumb-nav">
              <div class="container">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                      <li class="breadcrumb-item"><a href="#">Shop</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                  </ol>
              </div>
          </nav>

          <div class="page-content">
              <div class="cart">
                  <div class="container">

                    @include('website.layouts._message')
                      @if (!empty(Cart::getContent()->count()))
                          <div class="row">
                              <div class="col-lg-9">
                                <form action="{{ url('update_cart') }}" method="POST">
                                  {{ csrf_field() }}
                                  <table class="table table-cart table-mobile">
                                      <thead>
                                          <tr>
                                              <th>Product</th>
                                              <th>Price</th>
                                              <th>Quantity</th>
                                              <th>Total</th>
                                              <th></th>
                                          </tr>
                                      </thead>

                                      <tbody>
                                          @foreach (Cart::getContent() as $key => $carts)
                                              @php
                                                  $getCartProduct = App\Models\Product::getSingle($carts->id);
                                              @endphp

                                              {{-- @if (!empty($getProductimage)) --}}

                                              @php

                                                  $getProductimage = $getCartProduct->getSingleimage(
                                                      $getCartProduct->id,
                                                  );
                                              @endphp
                                              <tr>
                                                  <td class="product-col">
                                                      <div class="product">
                                                          <figure class="product-media">
                                                              <a href="{{ url($getCartProduct->slug) }}">
                                                                  <img src="{{ $getProductimage->getimageshow() }}"
                                                                      alt="Product image">
                                                              </a>
                                                          </figure>

                                                          <h3 class="product-title">
                                                              <a
                                                                  href="{{ url($getCartProduct->slug) }}">{{ $getCartProduct->title }}</a>
                                                          </h3>
                                                      </div>
                                                  </td>
                                                  <td class="price-col">${{ number_format($carts->price, 2) }}</td>
                                                  <td class="quantity-col">
                                                      <div class="cart-product-quantity">
                                                          <input type="number" class="form-control"
                                                              value="{{ $carts->quantity }}" min="1" name="cart[{{ $key }}][qty]"  max="100"
                                                              step="1"  data-decimals="0" required>
                                                      </div>

                                                      <input type="hidden" class="form-control"
                                                              value="{{ $carts->id }}" min="1" name="cart[{{ $key }}][id]">
                                                  </td>
                                                  <td class="total-col">
                                                      {{ number_format($carts->price * $carts->quantity, 2) }}</td>
                                                  <td class="remove-col"><a
                                                          href="{{ url('payment/carts/delete/' . $carts->id) }}"
                                                          class="btn-remove"><i class="icon-close"></i></a></td>
                                              </tr>
                                              {{-- @endif --}}
                                          @endforeach

                                      </tbody>
                                  </table>

                                  <div class="cart-bottom">
                                      

                                      <button type="submit" class="btn btn-outline-dark-2"><span>UPDATE
                                              CART</span><i class="icon-refresh"></i></button>
                                  </div>

                                </form>
                              </div>
                              <aside class="col-lg-3">
                                  <div class="summary summary-cart">
                                      <h3 class="summary-title">Cart Total</h3>

                                      <table class="table table-summary">
                                          <tbody>
                                              <tr class="summary-subtotal">
                                                  <td>Subtotal:</td>
                                                  <td>${{ number_format(Cart::getSubTotal(), 2) }}</td>
                                              </tr>
                                              <tr class="summary-shipping">
                                                  <td>Shipping:</td>
                                                  <td>&nbsp;</td>
                                              </tr>


                                              {{-- <tr class="summary-shipping-estimate">
                        <td>Estimate for Your Country<br> <a href="dashboard.html">Change address</a></td>
                        <td>&nbsp;</td>
                      </tr> --}}

                                              <tr class="summary-total">
                                                  <td>Total:</td>
                                                  <td>${{ number_format(Cart::getSubTotal(), 2) }}</td>
                                              </tr>
                                          </tbody>
                                      </table>

                                      <a href="{{ url('checkout') }}" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED
                                          TO CHECKOUT</a>
                                  </div>

                                  <a href="{{ route('home') }}"
                                      class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i
                                          class="icon-refresh"></i></a>
                              </aside>
                          </div>
                      @else
                          <p>Cart is Empty</p>
                      @endif
                  </div>
              </div>
          </div>
      </main>
  @endsection

  @section('script')
  @endsection
