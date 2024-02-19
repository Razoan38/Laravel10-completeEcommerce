@extends('admin.layouts.app')

@section('style')
  
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
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Product</h3>
                </div>
                <form action="" method="POST">
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
                          <input type="text" class="form-control"  value="{{ old('sku', $product->sku) }}"  name="sku" placeholder="Enter SKU">
                        </div>
                      </div>

                      <div class="col-md-6">  
                        <div class="form-group">
                          <label>Category<span style="color: red">*</span></label>
                          <select class="form-control" name="category_id" id="ChangeCategory">
                            <option value="">Select</option>
                            @foreach ($getCategory as $category )
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6">  
                        <div class="form-group">
                          <label>Sub Category<span style="color: red">*</span></label>
                          <select class="form-control" name="get_sub_category" id="getSubcategory">
                            <option value="">Select</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6">  
                        <div class="form-group">
                          <label>Brand<span style="color: red">*</span></label>
                          <select class="form-control" name="brand_id" id="brand_id">
                            <option value="">Select</option>
                            @foreach ($getBrand as $brand )
                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
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
                          <div class="">
                            <label for=""><input type="checkbox" value="{{ $color->id }}"  name="color_id[]" >{{ $color->color_name }}</label>
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
                          <input type="text" class="form-control"  value=""  name="price" placeholder="Enter Price">
                        </div>
                      </div>

                      <div class="col-md-6">  
                        <div class="form-group">
                          <label>Old Price <span style="color: red">*</span></label>
                          <input type="text" class="form-control"  value=""  name="old_price" placeholder="Enter Old Price">
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
                                  <tr>
                                    <td>
                                      <input type="text" name="" placeholder="Name" class="form-control">
                                    </td>
                                    <td>
                                      <input type="text" name=""  placeholder="Price" class="form-control">
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
                          <label>Short Description <span style="color: red">*</span></label>
                          <textarea type="text" class="form-control"  value=""  name="short_description" placeholder="Enter Short Description"></textarea>
                        </div>
                      </div>
                    </div>
                     <div class="row">
                      <div class="col-md-12">  
                        <div class="form-group">
                          <label> Description <span style="color: red">*</span></label>
                          <textarea type="text" class="form-control editor"  value=""  name="description" placeholder="Enter  Description"></textarea>
                        </div>
                      </div>
                    </div>

                     <div class="row">
                      <div class="col-md-12">  
                        <div class="form-group">
                          <label>Additional Information<span style="color: red">*</span></label>
                          <textarea type="text" class="form-control editor"  value=""  name="additional_information" placeholder="Enter Additional Information"></textarea>
                        </div>
                      </div>
                    </div>
                     <div class="row">
                      <div class="col-md-12">  
                        <div class="form-group">
                          <label>Shipping Returns<span style="color: red">*</span></label>
                          <textarea type="text" class="form-control editor"  value=""  name="shipping_returns" placeholder="Enter Shipping Returns"></textarea>
                        </div>
                      </div>
                    </div>

                     <div class="row">
                      <div class="col-md-12">  
                        <div class="form-group">
                          <label>Status <span style="color: red">*</span></label>
                          <select class="form-control" name="status">
                             <option  value="0">Active </option>
                             <option  value="1">Inactive</option>
                             {{-- <option {{ (old('status',$getRecord->status) == 0) ? 'selected' : ''}} value="0">Active </option>
                             <option {{ (old('status',$getRecord->status) == 1) ? 'selected' : ''}} value="1">Inactive</option> --}}
                          </select>
                        </div>
                      </div>
                    </div>

                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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

{{-- <script src="{{asset('/')}}public/admin/assets/tinymce/tinymce-jquery.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script>

     <script type="text/javascript">
     
     $('.editor').tinymce({
        height: 500,
        menubar: false,
        plugins: [
           'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
           'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
           'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
        ],
        toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
      });

      var i =1000;
         $('body').delegate('.AddSize','click',function(){
             var html = ' <tr id="DeleteSize'+i+'">\n\
                               <td>\n\
                                      <input type="text" name="" placeholder="Name" value="'+i+'" class="form-control">\n\
                                </td>\n\
                                <td>\n\
                                      <input type="text" name="" placeholder="Price" class="form-control">\n\
                                </td>\n\
                                <td>\n\
                                       <button type="button" id="'+i+'" class="btn btn-danger DeleteSize">Delete</button>\n\
                                 </td>\n\
                            </tr>';
                            i++;

                      $('#AppendSize').append(html);
         });

         $('body').delegate('.DeleteSize','click',function(){
          var id =$(this).attr('id');
           $('#DeleteSize'+id).remove();
         });
      
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