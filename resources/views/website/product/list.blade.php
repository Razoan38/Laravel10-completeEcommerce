  
@extends('website.layouts.app')

@section('title')
  Product List Page
@endsection

@section('style')

<link rel="stylesheet" href="{{asset('/')}}website/assets/css/plugins/nouislider/nouislider.css">
  <style type="text/css">
       .active-color {
		border: 3px solid #000 !important;
	   }
  </style>

@endsection
@section('content')

    <main class="main">
        	<div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        		<div class="container">
                    @if (!empty($getSubCategory))
                            <h1 class="page-title">{{ $getSubCategory->subcategory_name }}</h1>
                       @elseif(!empty($getCategory)) 
                            <h1 class="page-title">{{ $getCategory->category_name }}</h1>
							@else
                            <h1 class="page-title"> Search for {{Request::get('q') }}</h1>
                    @endif
        			
        		</div><!-- End .container -->
        	</div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="javaScript:;">Shop</a></li>
                      
                        @if (!empty($getSubCategory))
                        <li class="breadcrumb-item " aria-current="page"><a href="{{ url($getCategory->category_slug) }}">{{ $getCategory->category_name }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $getSubCategory->subcategory_name }}</li>
						@elseif(!empty($getCategory)) 
                        <li class="breadcrumb-item active" aria-current="page">{{ $getCategory->category_name }}</li>
                        @endif
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="container">
                	<div class="row">
                		<div class="col-lg-9">
                			<div class="toolbox">
                				<div class="toolbox-left">
                					<div class="toolbox-info">
                						Showing <span> {{ $getProduct->perPage() }} of {{ $getProduct->total() }}</span> Products
                					</div><!-- End .toolbox-info -->
                				</div><!-- End .toolbox-left -->

                				<div class="toolbox-right">
                					<div class="toolbox-sort">
                						<label for="sortby">Sort by:</label>
                						<div class="select-custom">
											<select name="sortby" id="sortby" class="form-control changeSortBy ">
												<option value="" >Select</option>
												<option value="popularity" selected="selected">Most Popular</option>
												<option value="rating">Most Rated</option>
												<option value="date">Date</option>
											</select>
										</div>
                					</div>
                					
                				</div>
                			</div>

							<div class="" id="getProductAjax">
								@include('website.product.allProduct')
							</div>
							
							<div class="" style="text-align: center;">
								<a href="javascript:;" @if(empty($page)) style="display: none;" @endif
								data-page="{{$page}}" class="btn btn-primary LoadMore">Load More</a>
							</div>

                		</div>

                		<aside class="col-lg-3 order-lg-first">
							<form action="" id="FilterForm" method="POST">
								{{ csrf_field() }}

								<input type="hidden" name="q" id=""
								value="{{ !empty(Request::get('q')) ? Request::get('q') : '' }}" >
								
								<input type="hidden" name="old_category_id" id=""
								value="{{ !empty($getCategory) ? $getCategory->id : '' }}" >
								
							    <input type="hidden" name="old_subcategory_id" id=""
								value="{{ !empty($getSubCategory) ? $getSubCategory->id : ''}}">

								<input type="hidden" name="subcategory_id" id="get_subcategory_id">
								<input type="hidden" name="brand_id" id="get_Brand_id">
								<input type="hidden" name="color_id" id="get_color_id">
								<input type="hidden" name="sortBy_id" id="get_sortBy_id">

								<input type="hidden" name="start_price" id="get_start_price">
								<input type="hidden" name="end_price" id="get_end_price">
							</form>

                			<div class="sidebar sidebar-shop">
                				<div class="widget widget-clean">
                					<label>Filters:</label>
                					<a href="#" class="sidebar-filter-clear">Clean All</a>
                				</div><!-- End .widget widget-clean -->
                              @if (!empty($getSubCategoryFilter))
                				<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
									        Category
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-1">
										<div class="widget-body">
											<div class="filter-items filter-items-count">
                                                @foreach($getSubCategoryFilter as $f_category)
												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input changeCategory" value="{{ $f_category->id }}" id="cat-{{ $f_category->id }}">
														<label class="custom-control-label" for="cat-{{ $f_category->id }}">{{ $f_category->subcategory_name }}</label>
													</div><!-- End .custom-checkbox -->
													<span class="item-count">{{ $f_category->TotalProduct() }}</span>
												</div><!-- End .filter-item -->
                                                @endforeach
												
											</div><!-- End .filter-items -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->
								@endif

        						{{-- <div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
									        Size
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-2">
										<div class="widget-body">
											<div class="filter-items">
												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="size-1">
														<label class="custom-control-label" for="size-1">XS</label>
													</div><!-- End .custom-checkbox -->
												</div><!-- End .filter-item -->

												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="size-2">
														<label class="custom-control-label" for="size-2">S</label>
													</div><!-- End .custom-checkbox -->
												</div><!-- End .filter-item -->

												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" checked id="size-3">
														<label class="custom-control-label" for="size-3">M</label>
													</div><!-- End .custom-checkbox -->
												</div><!-- End .filter-item -->

												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" checked id="size-4">
														<label class="custom-control-label" for="size-4">L</label>
													</div><!-- End .custom-checkbox -->
												</div><!-- End .filter-item -->

												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="size-5">
														<label class="custom-control-label" for="size-5">XL</label>
													</div><!-- End .custom-checkbox -->
												</div><!-- End .filter-item -->

												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input" id="size-6">
														<label class="custom-control-label" for="size-6">XXL</label>
													</div><!-- End .custom-checkbox -->
												</div><!-- End .filter-item -->
											</div><!-- End .filter-items -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget --> --}}

        						<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true" aria-controls="widget-3">
									        Colour
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-3">
										<div class="widget-body">
											<div class="filter-colors">
                                                   @foreach ($getColor as $color )
                                                   <a href="#" style="background:{{$color->color_code }};" id="{{ $color->id }}" data-val="0" class="ChangeColor">
												    	<span class="sr-only">{{$color->color_name  }}</span>
												   </a>
                                                   @endforeach
												
											</div><!-- End .filter-colors -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->

        						<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
									        Brand
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-4">
										<div class="widget-body">
											<div class="filter-items">
                                                @foreach ($getBrand as $brand )
                                                    
                                               
												<div class="filter-item">
													<div class="custom-control custom-checkbox">
														<input type="checkbox" class="custom-control-input changeBrand" value="{{ $brand->id  }}" id="brand-{{$brand->id  }}">
														<label class="custom-control-label" for="brand-{{$brand->id }}">{{$brand->brand_name  }}</label>
													</div><!-- End .custom-checkbox -->
												</div><!-- End .filter-item -->
                                                @endforeach

											</div><!-- End .filter-items -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->

        						<div class="widget widget-collapsible">
    								<h3 class="widget-title">
									    <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true" aria-controls="widget-5">
									        Price
									    </a>
									</h3><!-- End .widget-title -->

									<div class="collapse show" id="widget-5">
										<div class="widget-body">
                                            <div class="filter-price">
                                                <div class="filter-price-text">
                                                    Price Range:
                                                    <span id="filter-price-range"></span>
                                                </div><!-- End .filter-price-text -->

                                                <div id="price-slider"></div><!-- End #price-slider -->
                                            </div><!-- End .filter-price -->
										</div><!-- End .widget-body -->
									</div><!-- End .collapse -->
        						</div><!-- End .widget -->
                			</div><!-- End .sidebar sidebar-shop -->
                		</aside><!-- End .col-lg-3 -->
                	</div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

  

@endsection


@section('script')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{asset('/')}}website/assets/js/nouislider.min.js"></script>
<script src="{{asset('/')}}website/assets/js/wNumb.js"></script>
<script src="{{asset('/')}}website/assets/js/bootstrap-input-spinner.js"></script>

<script type="text/javascript">
        
		$('.changeSortBy').change(function(){
		
			var id = $(this).val();
			$('#get_sortBy_id').val(id);
			FilterForm()
		});

		$('.changeCategory').change(function(){
			var ids = '';
			$('.changeCategory').each(function(){
			    if(this.checked)
				{
					var id = $(this).val();
					ids += id+',';
					
				}
		    });
             $('#get_subcategory_id').val(ids);
			 FilterForm()
		});
		
		$('.changeBrand').change(function(){
			var ids = '';
			$('.changeBrand').each(function(){
			    if(this.checked)
				{
					var id = $(this).val();
					ids += id+',';
					
				}
		    });
             $('#get_Brand_id').val(ids);
			 FilterForm()
		});

	
		$(document).ready(function() {
            $('.ChangeColor').click(function() {
                var id = $(this).attr('id');
                var status = $(this).attr('data-val');
                
                if (status == 0) {
                    $(this).attr('data-val', 1);
                    $(this).addClass('active-color');
                } else {
                    $(this).attr('data-val', 0);
                    $(this).removeClass('active-color');
                }

                var ids = '';

                $('.ChangeColor').each(function() {
                    var status = $(this).attr('data-val');
                    if (status == 1) {
                        var id = $(this).attr('id');
                        ids += id + ',';
                    }
                });

                $('#get_color_id').val(ids);
				FilterForm()
            });
        });

		var xhr;
		function FilterForm()
		{
			if(xhr && xhr.readyState != 4)
			{
				xhr.abort();
			}

			xhr = $.ajax({
				type : "POST",
				url  :  "{{ url('get_filter_product_ajax') }}",
				data :  $('#FilterForm').serialize(),
				dataType : "json",
				success  : function(data) {
                     $('#getProductAjax').html(data.success)

					 $('.LoadMore').attr('data-page', data.page);
					 if(data.page == 0)
					 {
						$('.LoadMore').hide();
					 }
					 else
					 {
						$('.LoadMore').show();
					 }
				},
				error :   function(data) {

				}
			});
		}

		$('body').on( 'click', '.LoadMore', function() {
			var page = $(this).attr('data-page');

			$('.LoadMore').html('Loading ....');

			if(xhr && xhr.readyState !== 4)
			{
				xhr.abort();
			}

			xhr = $.ajax({
				type : "POST",
				url  :  "{{ url('get_filter_product_ajax') }}?page="+page,
				data :  $('#FilterForm').serialize() + '&page=' +page,
				dataType : "json",
				success  : function(data) {
                     $('#getProductAjax').html(data.success)
					 $('.LoadMore').attr('data-page',data.page);
					 $('.LoadMore').html('Load More');

					 if(data.page == 0)
					 {
						$('.LoadMore').hide();
					 }
					 else
					 {
						$('.LoadMore').show();
					 }
				},
				error :   function(data) {

				}
			});

		});

		var i = 0;
		if ( typeof noUiSlider === 'object' ) {
		var priceSlider  = document.getElementById('price-slider');

		noUiSlider.create(priceSlider, {
			start: [ 0, 8000 ],
			connect: true,
			step: 1,
			margin: 1,
			range: {
				'min': 0,
				'max': 8000
			},
			tooltips: true,
			format: wNumb({
		        decimals: 0,
		        prefix: '$'
		    })
		});
		priceSlider.noUiSlider.on('update', function( values, handle ){
			
			var start_price = values[0];
			var end_price = values[1];
			$('#get_start_price').val(start_price);
			$('#get_end_price').val(end_price);
			$('#filter-price-range').text(values.join(' - '));

			 if(i == 0 || i == 1)
			 {
				i++;
			 }
			 else{

				FilterForm();
			 }
		 });
	    }
		

</script>
@endsection