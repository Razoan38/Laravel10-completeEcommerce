@extends('admin.layouts.app')

@section('style')
  
@endsection

@section('title')
    Edit Category
@endsection
@section('content')
<div class="content-wrapper">
      
  

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-8" style="">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit SubCategory</h3>
                </div>
                <form action="" method="POST">
                    {{ csrf_field() }}
                  <div class="card-body">

                    <div class="form-group">
                        <label>Category Name <span style="color: red">*</span></label>
                        <select class="form-control" name="category_id" id="category_id">
                            <option value="">Select</option>
                            @foreach($getCategory as $category)
                                <option {{ $category->id == $getRecord->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                      <label> Sub Category Name <span style="color: red">*</span></label>
                      <input type="text" class="form-control"  value="{{ old('subcategory_name',$getRecord->subcategory_name) }}"  name="subcategory_name" placeholder="Enter Category name">
                    </div>

                    <div class="form-group">
                      <label>Sub Category slug <span style="color: red">*</span> </label>
                      <input type="text" class="form-control"  value="{{ old('subcategory_slug',$getRecord->subcategory_slug) }}"  name="subcategory_slug" placeholder="Enter category_slug">
                      <div class="" style="color: red">{{ $errors->first('subcategory_slug') }}</div>
                    </div>
                    
                    <div class="form-group">
                      <label>Status <span style="color: red">*</span></label>
                      <select class="form-control" name="status">
                         <option {{ (old('status',$getRecord->status) == 0) ? 'selected' : ''}} value="0">Active </option>
                         <option {{ (old('status',$getRecord->status) == 1) ? 'selected' : ''}} value="1">Inactive</option>
                      </select>
                    </div>

                    <hr>
                     <div class="form-group">
                        <label> Meta Title <span style="color: red">*</span></label>
                        <input type="text" class="form-control"  value="{{ old('meta_title',$getRecord->meta_title) }}"  name="meta_title" placeholder="Enter meta_title">
                      </div>
                     


                     {{-- <div class="form-group">
                        <label> Meta Description  </label>
                        <textarea class="form-control"  value="{{ old('meta_description', $getRecord->meta_description) }}"  name="meta_description" placeholder="Enter meta description"></textarea>
                      </div> --}}

                      <div class="form-group">
                        <label> Meta Description </label>
                        <textarea class="form-control" name="meta_description" placeholder="Enter Meta Description ">
                          {{ old('meta_description',  $getRecord->meta_description) }}
                        </textarea>
                      </div>

                     <div class="form-group">
                        <label> Meta Keywords</label>
                        <input type="text" class="form-control"  value="{{ old('meta_keywords',$getRecord->meta_keywords) }}"  name="meta_keywords" placeholder="Enter meta_keywords ">
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
<script src="{{asset('/')}}public/admin/assets/dist/js/pages/dashboard3.js"></script>
@endsection