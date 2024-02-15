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
                          <select class="form-control" name="category_id" id="category_id">
                            <option value="">Select</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6">  
                        <div class="form-group">
                          <label>Sub Category<span style="color: red">*</span></label>
                          <select class="form-control" name="subcategory_id" id="subcategory_id">
                            <option value="">Select</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6">  
                        <div class="form-group">
                          <label>Brand<span style="color: red">*</span></label>
                          <select class="form-control" name="brand_id" id="brand_id">
                            <option value="">Select</option>
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
                          <div class="">
                            <label for=""><input type="checkbox" value=""  name="color_id[]" >RED</label>
                          </div>
                          <div class="">
                            <label for=""><input type="checkbox" value=""  name="color_id[]" >red</label>
                          </div>
                          <div class="">
                            <label for=""><input type="checkbox" value=""  name="color_id[]" >Red</label>
                          </div>
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
                                    <th>price</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>

                                <tbody>
                                  <tr>
                                    <td>
                                      <input type="text" name="" class="form-control">
                                    </td>
                                    <td>
                                      <input type="text" name="" class="form-control">
                                    </td>
                                    <td>
                                      <button type="button" class="btn btn-primary ">Add</button>
                                    </td>
                                    <td>
                                      <button type="button" class="btn btn-danger ">Delete</button>
                                    </td>
                                  </tr>
                              
                              
                                  <tr>
                                    <td>
                                      <input type="text" name="" class="form-control">
                                    </td>
                                    <td>
                                      <input type="text" name="" class="form-control">
                                    </td>
                                    
                                    <td>
                                      <button type="button" class="btn btn-danger ">Delete</button>
                                    </td>
                                  </tr>
                              
                               
                                  <tr>
                                    <td>
                                      <input type="text" name="" class="form-control">
                                    </td>
                                    <td>
                                      <input type="text" name="" class="form-control">
                                    </td>
                                    
                                    <td>
                                      <button type="button" class="btn btn-danger ">Delete</button>
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
                          <textarea type="text" class="form-control"  value=""  name="description" placeholder="Enter  Description"></textarea>
                        </div>
                      </div>
                    </div>

                     <div class="row">
                      <div class="col-md-12">  
                        <div class="form-group">
                          <label>Additional Information<span style="color: red">*</span></label>
                          <textarea type="text" class="form-control"  value=""  name="additional_information" placeholder="Enter Additional Information"></textarea>
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
<script src="{{asset('/')}}public/admin/assets/dist/js/pages/dashboard3.js"></script>
@endsection