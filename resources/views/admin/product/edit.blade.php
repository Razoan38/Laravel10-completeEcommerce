@extends('admin.layouts.app')

@section('style')
   <!-- Theme style -->
   <link rel="stylesheet" href="{{asset('/')}}public/admin/assets/plugins/summernote/summernote-bs4.min.css">
@endsection

@section('title')
    Edit Product
@endsection
@section('content')
<div class="content-wrapper">
      
  

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12" style="">
              @include('admin.layouts._message')
     
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Product</h3>
                </div>
                <form action="" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                  <div class="card-body">

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Titls<span style="color: red">*</span></label>
                          <input type="text" class="form-control"  value="{{ old('title', $product->title) }}"  name="title" placeholder="Enter title">
                        </div>
                      </div>

                      <div class="col-md-6">  
                        <div class="form-group">
                          <label>SKU<span style="color: red">*</span></label>
                          <input type="text" class="form-control" required  value="{{ old('sku', $product->sku) }}"  name="sku" placeholder="Enter SKU">
                        </div>
                      </div>

                      <div class="col-md-6">  
                        <div class="form-group">
                          <label>Category<span style="color: red">*</span></label>
                          <select class="form-control" name="category_id"  required id="ChangeCategory">
                            <option value="">Select</option>
                            @foreach ($getCategory as $category )
                            <option {{ ( $product->category_id == $category->id ) ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6">  
                        <div class="form-group">
                          <label>Sub Category<span style="color: red">*</span></label>
                          <select class="form-control" name="subcategory_id" required id="getSubcategory">
                            <option value="">Select</option>
                            @foreach ($getSubCategory as $subCategory )
                            <option {{ ( $product->subcategory_id == $subCategory->id ) ? 'selected' : ''}} value="{{ $subCategory->id }}">{{ $subCategory->subCategory_name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6">  
                        <div class="form-group">
                          <label>Brand<span style="color: red">*</span></label>
                          <select class="form-control" name="brand_id" id="brand_id">
                            <option value="">Select</option>
                            @foreach ($getBrand as $brand )
                            <option {{ ($product->brand_id == $brand->id ) ? 'selected' : ''}} value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      {{-- <div class="col-md-6">  
                        <div class="form-group">
                          <label>P<span style="color: red">*</span></label>
                          <select class="form-control" name="form-control" id="subcategory_id">
                            <option value="">Select</option>
                          </select>
                        </div>
                      </div> --}}

                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Color<span style="color: red">*</span></label>
                          @foreach ($getColor as $color )
                            @php
                                $checked = '';
                            @endphp
                              @foreach ($product->getColor as $pcolor )
                              
                              @if ($pcolor->color_id == $color->id )
                              @php
                                  $checked = 'checked';
                              @endphp
                            @endif
                            @endforeach
                          <div class="">
                            <label for=""><input {{ $checked }} type="checkbox" value="{{ $color->id }}"  name="color_id[]" >{{ $color->color_name }}</label>
                          </div>
                          @endforeach
        
                        </div>
                      </div>
                    </div>
                  <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>price<span style="color: red">*</span></label>
                          <input type="number" class="form-control"  value="{{!empty($product->price) ? $product->price : '' }}"  name="price" placeholder="Enter Price">
                        </div>
                      </div>

                      <div class="col-md-6">  
                        <div class="form-group">
                          <label>Old Price <span style="color: red">*</span></label>
                          <input type="number" class="form-control"  value="{{ !empty($product->old_price) ? $product->old_price : ''}}"  name="old_price" placeholder="Enter Old Price">
                        </div>
                      </div>

                    </div>
                     <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label>Size<span style="color: red">*</span></label>
                          <div class="">
                           <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th>name</th>
                                    <th>price ($)</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>

                                <tbody id="AppendSize">
                                  @php
                                     $i_size = 1;
                                  @endphp
                                  @foreach ( $product->getSize as $size)
                                  <tr id="DeleteSize{{ $i_size }}">
                                    <td>
                                      <input type="text" name="size[{{ $i_size }}][name]" value="{{ $size->name }}" placeholder="Name" class="form-control">
                                    </td>
                                    <td>
                                      <input type="number" name="size[{{ $i_size }}][price]" value="{{ $size->price }}" placeholder="Price" class="form-control">
                                    </td>
                                    <td style="width: 200px;">
                                      <button type="button" id="{{ $i_size }}" class="btn btn-danger DeleteSize">Delete</button>
                                    </td>
                                  </tr>

                                  @php
                                  $i_size++;
                                  @endphp
                                  @endforeach

                                  <tr>
                                    <td>
                                      <input type="text" name="size[100][name]" placeholder="Name" class="form-control">
                                    </td>
                                    <td>
                                      <input type="number" name="size[100][price]"  placeholder="Price" class="form-control">
                                    </td>
                                    <td style="width: 200px;">
                                      <button type="button" class="btn btn-primary AddSize">Add</button>
                                    </td>
                                  </tr>                                  
                           </table>
                          </div>
                        </div>
                      </div>
                    </div>
                     <hr> 

                     <div class="row">
                      <div class="col-md-12">  
                        <div class="form-group">
                          <label>Image <span style="color: red">*</span></label>
                          <input type="file" class="form-control" name="image[]" multiple accept="image/*"  style="padding: 5px;">
                        </div>
                      </div>
                    </div>
                      
                    @if (!empty($product->getimage->count()))
                    <div class="row" id="sortable">
                      @foreach ($product->getimage as $image )
                        @if (!empty($image->getimageshow()))
                           <div class="col-md-1 sortable_image " id="{{ $image->id }}"  style="text-align: center">
                            <img src="{{ $image->getimageshow() }}" alt="" style="width: 100%; height: 80px;">
                            <a href="{{ route('admin.product.image_delate',['id' => $image->id ]) }}" class="btn btn-danger btn-sm" style="margin-top:10px "
                              onclick="return confirm('Are you sure  you want to delete?');">Delete</a>
                           </div> 
                        @endif                       
                      @endforeach
                    </div>
                      
                    @endif
                     <hr>

                     <div class="row">
                      <div class="col-md-12">  
                        <div class="form-group">
                          <label>Short Description <span style="color: red">*</span></label>
                          <textarea type="text" class="form-control"  value="{{ $product->short_description }}"  name="short_description" placeholder="Enter Short Description">
                            {{ old('short_description',  $product->short_description) }}
                          </textarea>
                        </div>
                      </div>
                    </div>
                     <div class="row">
                      <div class="col-md-12">  
                        <div class="form-group">
                          <label> Description <span style="color: red">*</span></label>
                          <textarea  class="form-control editor" id="mytextarea" value="{{ $product->description }}"  name="description" placeholder="Enter  Description">
                            {{ old('description',  $product->description) }}
                          </textarea>
                        </div>
                      </div>
                    </div>

                     <div class="row">
                      <div class="col-md-12">  
                        <div class="form-group">
                          <label>Additional Information<span style="color: red">*</span></label>
                          <textarea type="text" class="form-control editor"  value="{{ $product->additional_information }}"  name="additional_information" placeholder="Enter Additional Information">
                            {{ old('additional_information',  $product->additional_information) }}
                          </textarea>
                        </div>
                      </div>
                    </div>
                     <div class="row">
                      <div class="col-md-12">  
                        <div class="form-group">
                          <label>Shipping Returns<span style="color: red">*</span></label>
                          <textarea type="text" class="form-control editor"  value="{{ $product->shipping_returns }}"  name="shipping_returns" placeholder="Enter Shipping Returns">
                            {{ old('shipping_returns',  $product->shipping_returns) }}</textarea>
                        </div>
                      </div>
                    </div>

                     <div class="row">
                      <div class="col-md-12">  
                        <div class="form-group">
                          <label>Status <span style="color: red">*</span></label>
                          <select class="form-control" name="status">
                             {{-- <option  value="0">Active </option>
                             <option  value="1">Inactive</option> --}}
                             <option {{ ($product->status == 0) ? 'selected' : ''}} value="0">Active </option>
                             <option {{ ($product->status == 1) ? 'selected' : ''}} value="1">Inactive</option>
                          </select>
                        </div>
                      </div>
                    </div>

                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
    </div>
    
</div>


@endsection

@section('script')
{{-- <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script> --}}
{{-- <script src="{{asset('/')}}public/admin/assets/tinymce/tinymce_jquery.min.js"></script> --}}

<script src="{{asset('/')}}public/admin/sortable/jquery-ui.js"></script>


{{-- <script src="{{asset('/')}}public/admin/assets/plugins/summernote/summernote-bs4.min.js"></script> --}}

<script src="https:cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js"></script>

     <script type="text/javascript">


    $(document).ready(function() {
        $( "#sortable" ).sortable({
           
          update: function(event,ui){
            var photo_id =new Array();
            $('.sortable_image').each(function(){
                var id =$(this).attr('id');
                photo_id.push(id);
                
            });
                $.ajax({
                    type :"POST",
                    url : "{{ url('admin/product_sortable_image') }}",//aita taika neya route gaci 
                    data : {
                          "photo_id" : photo_id,
                          "_token": "{{ csrf_token()  }}"
                    },
                    dataType : "json",
                    success: function (data) {
                     
                    },
                    error:function (data) {

                  }
                  });
          }
        });
      });

      //  $('.editor').summernote({
      //   height: 300,
      //  });
      
     // tinymce
     tinymce.init({
      selector:'.editor',
        height: 500,
        menubar: false,
        plugins: [
           'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
           'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
           'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
        ],
        toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
      });

      //end tinymce
     // Add Button 
      var i =1000;
         $('body').delegate('.AddSize','click',function(){
             var html = ' <tr id="DeleteSize'+i+'">\n\
                               <td>\n\
                                      <input type="text" name="size['+i+'][name]" placeholder="Name" value="'+i+'" class="form-control">\n\
                                </td>\n\
                                <td>\n\
                                      <input type="text" name="size['+i+'][price]" placeholder="Price" class="form-control">\n\
                                </td>\n\
                                <td>\n\
                                       <button type="button" id="'+i+'" class="btn btn-danger DeleteSize">Delete</button>\n\
                                 </td>\n\
                            </tr>';
                            i++;

                      $('#AppendSize').append(html);
         });
//add button end 
// add button delate
         $('body').delegate('.DeleteSize','click',function(){
          var id =$(this).attr('id');
           $('#DeleteSize'+id).remove();
         });
      //add button delate end 
         $('body').delegate('#ChangeCategory','change',function(e){
        var id =$(this).val();

        $.ajax({
         type :"POST",
         url : "{{ url('admin/get_sub_category') }}",
         data : {
              "id" : id,
              "_token": "{{ csrf_token()  }}"
         },
         dataType : "json",
         success: function (data) {
             $('#getSubcategory').html(data.html);
         },
         error:function (data) {

         }
        });
     });
     </script>


@endsection