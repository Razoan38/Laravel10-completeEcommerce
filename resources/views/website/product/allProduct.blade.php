
<div class="products mb-3">
    <div class="row justify-content-center">
         @foreach ($getProduct as $product )
          @php
              $getProductimage = $product->getSingleimage($product->id)
          @endphp
        <div class="col-12 col-md-4 col-lg-4">
            <div class="product product-7 text-center">
                <figure class="product-media">
                    <span class="product-label label-new">New</span>
                    <a href="product.html">
                        @if (!empty($getProductimage) && !empty($getProductimage->getimageshow()))
                        <img src="{{ $getProductimage->getimageshow() }}" alt="{{ $product->title }}" class="product-image"
                        style="height: 350px; width: 100%; object-fit: cover">  
                        @endif
                       
                    </a>

                    <div class="product-action-vertical">
                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                        <a href="popup/quickView.html" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                    </div><!-- End .product-action-vertical -->

                    <div class="product-action">
                        <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                    </div><!-- End .product-action -->
                </figure><!-- End .product-media -->

                <div class="product-body">
                    <div class="product-cat">
                        <a href="{{ url($product->category_slug.'/'.$product->sub_category_slug ) }}">{{ $product->sub_category_name }}</a>
                    </div><!-- End .product-cat -->
                    <h3 class="product-title"><a href="{{ url($product->slug) }}">{{ $product->title }}</a></h3><!-- End .product-title -->
                    <div class="product-price">
                        ${{ number_format($product->price, 2) }}
                    </div><!-- End .product-price -->
                    <div class="ratings-container">
                        <div class="ratings">
                            <div class="ratings-val" style="width: 20% "></div><!-- End .ratings-val -->
                        </div><!-- End .ratings -->
                        <span class="ratings-text">( 2 Reviews )</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div><!-- End .row -->
</div><!-- End .products -->
{{-- <div class="" style="padding: 10px ; padding-left: 100%" >
    {!! $getProduct->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} 
 </div> --}}