  
@extends('website.layouts.app')

@section('title')
  Product Detail Page
@endsection

@section('style')

    <link rel="stylesheet" href="{{asset('/')}}website/assets/css/plugins/nouislider/nouislider.css">
    
@endsection
@section('content')

<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url( $getProduct->getCategory->category_slug ) }}">
                    {{ $getProduct->getCategory->category_name }}</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ url( $getProduct->getCategory->category_slug.'/'.$getProduct->getSubCategory->subcategory_slug ) }}">
                    {{ $getProduct->getSubCategory->subcategory_name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $getProduct->title }} </li>
            </ol>

        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            <div class="product-details-top mb-2">
                <div class="row">
                    {{-- <div class="col-md-6">
                        <div class="product-gallery">
                            <figure class="product-main-image" id="product-zoom-gallery">

                                @php
                                   $getProductimage = $getProduct->getSingleimage($getProduct->id)
                                @endphp

                               @if (!empty($getProductimage) && !empty($getProductimage->getimageshow()))
                                <img id="product-zoom" src="{{ $getProductimage->getimageshow() }}"
                                 data-zoom-image="{{ $getProductimage->getimageshow() }}" alt="product image">

                                <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                    <i class="icon-arrows"></i>
                                </a>
                                @endif
                            </figure><!-- End .product-main-image -->

                            <div id="product-zoom-gallery" class="product-image-gallery">
                                @foreach ($getProduct->getimage as $image )
                                    <a class="product-gallery-item" href="#" data-image="{{ $image->getimageshow() }}" 
                                    data-zoom-image="{{ $image->getimageshow() }}">
                                        <img src="{{ $image->getimageshow() }}" alt="product side">
                                    </a>     
                                @endforeach
                              

                            </div>
                        </div>
                    </div> --}}

                    <div class="col-md-6">
                        <div class="product-gallery">
                            <figure class="product-main-image">
                                @php
                                   $getProductimage = $getProduct->getSingleimage($getProduct->id)
                                @endphp
                                @if (!empty($getProductimage) && !empty($getProductimage->getimageshow()))
                                <img id="product-zoom" src="{{ $getProductimage->getimageshow()}}" data-zoom-image="{{ $getProductimage->getimageshow() }}" alt="product image" style="height: 574px ; width: 574px">

                                <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                    <i class="icon-arrows"></i>
                                </a>
                                @endif
                            </figure>

                            <div id="product-zoom-gallery" class="product-image-gallery">
                                @foreach ($getProduct->getimage as $image )
                                <a class="product-gallery-item" href="#" data-image="{{$image->getimageshow()}}" data-zoom-image="{{ $image->getimageshow() }}">
                                    <img src="{{$image->getimageshow()}}" alt="product side" style="height: 150px ; width: 130px">
                                </a>   
                                @endforeach             
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="product-details">
                            <h1 class="product-title">{{ $getProduct->title }}</h1><!-- End .product-title -->

                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                </div>
                                <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                            </div>

                            <div class="product-price">
                              <span id="getTotalPrice">${{number_format($getProduct->price , 2)}}</span>
                            </div>

                            <div class="product-content">
                                <p>{{ $getProduct->short_description }} </p>
                            </div>

                       <form  action="{{ url('product/add-to-cart') }}" method="POST">
                            {{ csrf_field() }}
                            
                            <input type="hidden" name="product_id"  value="{{ $getProduct->id }}">
                           @if (!empty($getProduct->getColor->count()))
                            <div class="details-filter-row details-row-size">
                                <label for="size">Color:</label>
                                <div class="select-custom">
                                    <select name="color_id" id="color" required class="form-control">
                                        <option value="#" selected="selected">Select a Color</option>
                                     @foreach ( $getProduct->getColor as $Color)
                                        <option value="{{$Color->getColor->id}}">
                                            {{$Color->getColor->color_name}}</option>
                                     @endforeach
                                    </select>
                                </div>
                            </div>
                                @endif
                                
                           @if (!empty($getProduct->getSize->count()))
                            <div class="details-filter-row details-row-size">
                                <label for="size">Size:</label>
                                <div class="select-custom">
                                    <select name="size_id" id="size" required class="form-control getSizePrice">
                                        <option  data-price="0" value="#" selected="selected">Select a Color</option>
                                            @foreach ( $getProduct->getSize as $Size)
                                                <option data-price="{{ !empty($Size->price) ? $Size->price : 0}}" value="{{$Size->id}}">{{$Size->name}}  
                                                    @if(!empty($Size->price)) (${{number_format($Size->price)}})@endif
                                                </option>
                                            @endforeach
                                    </select>
                                </div>
                             </div>
                            @endif
                           
                            <div class="details-filter-row details-row-size">
                                <label for="qty">Qty:</label>
                                <div class="product-details-quantity">
                                    <input type="number" id="qty" name="qty" required class="form-control" 
                                    value="1" min="1" max="100" step="1" data-decimals="0" required>
                                </div>
                            </div>

                            <div class="product-details-action">
                                  <button class="btn-product btn-cart" type="submit"
                                  style="background: #fff; color: #c96">add to cart</button>
                                <div class="details-action-wrapper">
                                    <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                    {{-- <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to Compare</span></a> --}}
                                </div>
                            </div>
                        </form>
                            <div class="product-details-footer">
                                <div class="product-cat">
                                    <span>Category:</span>
                                   <a href="{{ url( $getProduct->getCategory->category_slug ) }}">
                                        {{ $getProduct->getCategory->category_name }}</a> ,
                                    
                                        <a href="{{ url( $getProduct->getCategory->category_slug.'/'.$getProduct->getSubCategory->subcategory_slug ) }}">
                                        {{ $getProduct->getSubCategory->subcategory_name }}</a>
                                </div>

                                {{-- <div class="social-icons social-icons-sm">
                                    <span class="social-label">Share:</span>
                                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-details-tab product-details-extended">
            <div class="container">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews (2)</a>
                    </li> --}}
                </ul>
            </div>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                    <div class="container" style="margin-top: 20px">
                      {!! $getProduct->description !!}
                    </div>
                </div>
                <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                    <div class="product-desc-content">
                        <div class="container" style="margin-top: 20px">
                            {!! $getProduct->additional_information	 !!}
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                    <div class="product-desc-content">
                        <div class="container" style="margin-top: 20px">
                            {!! $getProduct->shipping_returns !!}
                        </div>
                    </div>
                </div>
                {{-- <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                    <div class="reviews">
                        <div class="container">
                            <h3>Reviews (2)</h3>
                            <div class="review">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h4><a href="#">Samanta J.</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 80%;"></div><!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                        </div><!-- End .rating-container -->
                                        <span class="review-date">6 days ago</span>
                                    </div><!-- End .col -->
                                    <div class="col">
                                        <h4>Good, perfect size</h4>

                                        <div class="review-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum dolores assumenda asperiores facilis porro reprehenderit animi culpa atque blanditiis commodi perspiciatis doloremque, possimus, explicabo, autem fugit beatae quae voluptas!</p>
                                        </div><!-- End .review-content -->

                                        <div class="review-action">
                                            <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                            <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                        </div><!-- End .review-action -->
                                    </div><!-- End .col-auto -->
                                </div><!-- End .row -->
                            </div><!-- End .review -->

                            <div class="review">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h4><a href="#">John Doe</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 100%;"></div><!-- End .ratings-val -->
                                            </div><!-- End .ratings -->
                                        </div><!-- End .rating-container -->
                                        <span class="review-date">5 days ago</span>
                                    </div><!-- End .col -->
                                    <div class="col">
                                        <h4>Very good</h4>

                                        <div class="review-content">
                                            <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum blanditiis laudantium iste amet. Cum non voluptate eos enim, ab cumque nam, modi, quas iure illum repellendus, blanditiis perspiciatis beatae!</p>
                                        </div><!-- End .review-content -->

                                        <div class="review-action">
                                            <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                            <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                        </div><!-- End .review-action -->
                                    </div><!-- End .col-auto -->
                                </div><!-- End .row -->
                            </div><!-- End .review -->
                        </div><!-- End .container -->
                    </div><!-- End .reviews -->
                </div><!-- .End .tab-pane --> --}}
            </div>
        </div>

        <div class="container">
            <h2 class="title text-center mb-4">You May Also Like</h2>
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                data-owl-options='{
                    "nav": false, 
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "480": {
                            "items":2
                        },
                        "768": {
                            "items":3
                        },
                        "992": {
                            "items":4
                        },
                        "1200": {
                            "items":4,
                            "nav": true,
                            "dots": false
                        }
                    }
                }'>

                @foreach ($getRelatedProduct as $product )
                @php
                    $getProductimage = $product->getSingleimage($product->id)
                @endphp
                
                <div class="product product-7">
                    <figure class="product-media">
                        <a href="{{ url($product->category_slug) }}">
                        @if (!empty($getProductimage) && !empty($getProductimage->getimageshow()))
                        <img src="{{ $getProductimage->getimageshow() }}" alt="{{ $product->title }}" class="product-image"
                        style="height: 350px; width: 100%; object-fit: cover">  
                        @endif

                       
                        <div class="product-action-vertical">
                            <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                        </div>

                        <div class="product-action">
                            <a href="{{ route('payment.cart') }}" class="btn-product btn-cart"><span>add to 00cart</span></a>
                        </div>
                    </figure>

                    <div class="product-body">
                        <div class="product-cat">
                            <a href="{{ url($product->category_slug.'/'.$product->sub_category_slug ) }}">{{ $product->sub_category_name }}</a>
                        </div>
                        <h3 class="product-title"><a href="{{ url($product->slug) }}">{{ $product->title }}</a></h3>
                        <div class="product-price">
                            ${{ number_format($product->price, 2) }}
                        </div>
                        <div class="ratings-container">
                            <div class="ratings">
                                <div class="ratings-val" style="width: 20%;"></div>
                            </div>
                            <span class="ratings-text">( 2 Reviews )</span>
                        </div>

                        
                    </div>
                </div>
      
                @endforeach

      
            </div>
        </div>
    </div>
</main>

@endsection


@section('script')

    
    <script src="{{asset('/')}}website/assets/js/jquery.elevateZoom.min.js"></script>
    <script src="{{asset('/')}}website/assets/js/bootstrap-input-spinner.js"></script>
    <script src="{{asset('/')}}website/assets/js/bootstrap-input-spinner.js"></script>

    <script>
        $('.getSizePrice').change(function()
        {
            var product_price = '{{ $getProduct->price }}';
            var price = $('option:selected', this).attr('data-price');   
            var  total = parseFloat(product_price) + parseFloat(price);
            $('#getTotalPrice').html(total.toFixed(2));
      
        });
    </script>

@endsection