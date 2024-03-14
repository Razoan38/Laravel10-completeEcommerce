<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <div class="header-dropdown">
                    <a href="#">Usd</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">Eur</a></li>
                            <li><a href="#">Usd</a></li>
                        </ul>
                    </div>
                </div>

                <div class="header-dropdown">
                    <a href="#">Eng</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">English</a></li>
                            <li><a href="#">French</a></li>
                            <li><a href="#">Spanish</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="header-right">
                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li><a href="tel:#"><i class="icon-phone"></i>Call: +0123 456 789</a></li>
                            <li><a href=""><i class="icon-heart-o"></i>My Wishlist <span>(3)</span></a></li>
                            <li><a href="">About Us</a></li>
                            <li><a href="">Contact Us</a></li>
                            {{-- <li><a href="{{ route('wishlist') }}"><i class="icon-heart-o"></i>My Wishlist <span>(3)</span></a></li>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li> --}}
                            <li><a href="#signin-modal" data-toggle="modal"><i class="icon-user"></i>Login</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="header-middle sticky-header">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="{{ url('') }}" class="logo">
                    <img src="{{asset('/')}}website/assets/images/logo.png" alt="Molla Logo" width="105" height="25">
                </a>

                <nav class="main-nav">
                    <ul class="menu sf-arrows">
                        <li class=" active">
                            <a href="{{ url('') }}" class="">Home</a>  
                        </li>
                        <li>
                            <a href="javascript:;" class="sf-with-ul">Shop</a>

                            <div class="megamenu megamenu-md">
                                <div class="row no-gutters">
                                    <div class="col-md-10">
                                        <div class="menu-col">
                                            <div class="row">

                                                @php
                                                    $getCategoryHeader = App\Models\Categories::getRecordMenu();
                                                @endphp
                                                {{-- @for($i=1;$i<=5;$i++) --}}
                                                @foreach ($getCategoryHeader as $value_category_header)
                                                @if (!empty($value_category_header->getSubCategory->count()))
                                                
                                                <div class="col-md-4" style="margin-bttom: 25px;">
                                                    <a href="{{ url($value_category_header->category_slug ) }}" class="menu-title">{{ $value_category_header->category_name }}</a>
                                                    <ul>
                                                        @foreach ($value_category_header->getSubCategory as $value_Subcategory_header )
                                                        <li><a href="{{ url($value_category_header->category_slug.'/'.$value_Subcategory_header->subcategory_slug) }}">{{  $value_Subcategory_header->subcategory_name }}</a></li>
                                                        @endforeach
                                                       
                                                    </ul>

                                                    {{-- <div class="menu-title">Shop no sidebar</div>
                                                    <ul>
                                                        <li><a href="category-boxed.html"><span>Shop Boxed No Sidebar<span class="tip tip-hot">Hot</span></span></a></li>
                                                        <li><a href="category-fullwidth.html">Shop Fullwidth No Sidebar</a></li>
                                                    </ul> --}}
                                                </div>
                                                      
                                                  @endif
                                                @endforeach
                                                {{-- @endfor --}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="banner banner-overlay">
                                            <a href="category.html" class="banner banner-menu">
                                                <img src="{{asset('/')}}website/assets/images/menu/banner-1.jpg" alt="Banner">

                                                <div class="banner-content banner-content-top">
                                                    <div class="banner-title text-white">Last <br>Chance<br><span><strong>Sale</strong></span></div><!-- End .banner-title -->
                                                </div><!-- End .banner-content -->
                                            </a>
                                        </div><!-- End .banner banner-overlay -->
                                    </div><!-- End .col-md-4 -->
                                </div><!-- End .row -->
                            </div><!-- End .megamenu megamenu-md -->
                        </li>

                 <li>
                            <a href="product.html" class="sf-with-ul">Product</a>

                            <div class="megamenu megamenu-sm">
                                <div class="row no-gutters">
                                    <div class="col-md-6">
                                        <div class="menu-col">
                                            <div class="menu-title">Product Details</div><!-- End .menu-title -->
                                            <ul>
                                                <li><a href="product.html">Default</a></li>
                                                <li><a href="product-centered.html">Centered</a></li>
                                                <li><a href="product-extended.html"><span>Extended Info<span class="tip tip-new">New</span></span></a></li>
                                                <li><a href="product-gallery.html">Gallery</a></li>
                                                <li><a href="product-sticky.html">Sticky Info</a></li>
                                                <li><a href="product-sidebar.html">Boxed With Sidebar</a></li>
                                                <li><a href="product-fullwidth.html">Full Width</a></li>
                                                <li><a href="product-masonry.html">Masonry Sticky Info</a></li>
                                            </ul>
                                        </div><!-- End .menu-col -->
                                    </div>

                                    <div class="col-md-6">
                                        <div class="banner banner-overlay">
                                            <a href="category.html">
                                                <img src="{{asset('/')}}website/assets/images/menu/banner-2.jpg" alt="Banner">

                                                <div class="banner-content banner-content-bottom">
                                                    <div class="banner-title text-white">New Trends<br><span><strong>spring 2019</strong></span></div><!-- End .banner-title -->
                                                </div><!-- End .banner-content -->
                                            </a>
                                        </div><!-- End .banner -->
                                    </div>
                                </div><!-- End .row -->
                            </div><!-- End .megamenu megamenu-sm -->
                </li>

                    </ul>
                </nav>
            </div>
            <!-- End .header-left -->

            <div class="header-right">
                <div class="header-search">
                    <a href="#" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
                    <form action="{{ url('search') }}" method="GET">
                        <div class="header-search-wrapper">
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search in..."
                            value="{{ !empty(Request::get('q')) ? Request::get('q') : '' }}"  required>
                        </div>
                    </form>
                </div>
                <!-- End .header-search -->

                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-shopping-cart"></i>
                        <span class="cart-count">{{ Cart::getContent()->count() }}</span>
                    </a>
                 @if(!empty( Cart::getContent()->count()))
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-cart-products">
                           @foreach (Cart::getContent() as $header_cart )
                           @php
                               $getCartProduct = App\Models\Product::getSingle($header_cart->id);
                            
                           @endphp

                           @if (!empty( $getProductimage ))
                           @php
                             
                               $getProductimage = $getCartProduct->getSingleimage($getCartProduct->id);
                           @endphp

                            <div class="product">
                                <div class="product-cart-details">
                                    <h4 class="product-title">
                                        <a href="{{ url($getCartProduct->slug) }}">
                                            {{ $getCartProduct->title }}</a>
                                    </h4>

                                    <span class="cart-product-info">
                                        <span class="cart-product-qty">{{ $header_cart->quantity }}</span>
                                        x ${{ number_format($header_cart->price , 2) }}
                                    </span>
                                </div><!-- End .product-cart-details -->

                                <figure class="product-image-container">
                                    <a href="product.html" class="product-image">
                                        <img src="{{ $getProductimage->getimageshow() }}" alt="product">
                                    </a>
                                </figure>
                                <a href="{{ url('payment/carts/delete/'.$header_cart->id) }}" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                            </div><!-- End .product -->

                            @endif
                            @endforeach 
                    
                        </div><!-- End .cart-product -->

                        <div class="dropdown-cart-total">
                            <span>Total</span>

                            <span class="cart-total-price">{{ number_format(Cart::getSubTotal(), 2) }}</span>
                        </div><!-- End .dropdown-cart-total -->

                        <div class="dropdown-cart-action">
                            <a href="{{ url('payment/carts') }}" class="btn btn-primary">View Cart</a>
                            <a href="{{ url('checkout') }}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                 @endif
                </div>
            </div>
        </div>
    </div>
</header>
