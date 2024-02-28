<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="#" method="get" class="mobile-search">
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..." required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>
        
        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li class="active">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                    @php
                      $getCategoryHeader = App\Models\Categories::getRecordMenu();
                    @endphp
                             {{-- @for($i=1;$i<=5;$i++) --}}
                @foreach ($getCategoryHeader as $value_category_header)
                   @if (!empty($value_category_header->getSubCategory->count()))
                 
                <li>
                    <a href="{{ url($value_category_header->category_slug ) }}">{{ $value_category_header->category_name }}</a>
                    <ul>
                        @foreach ($value_category_header->getSubCategory as $value_Subcategory_header )
                            <li><a href="{{ url($value_category_header->category_slug.'/'.$value_Subcategory_header->subcategory_slug) }}">{{  $value_Subcategory_header->subcategory_name }}</a></li>
                         @endforeach
                    </ul>
                </li>
                      
                @endif
                @endforeach
                <li>
                    <a href="product.html" class="sf-with-ul">Product</a>
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
                </li>
            
            </ul>
        </nav><!-- End .mobile-nav -->

        <div class="social-icons">
            <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
            <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->