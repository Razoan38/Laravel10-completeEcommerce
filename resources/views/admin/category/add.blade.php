@extends('admin.layouts.app')

@section('style')
  
@endsection

@section('title')
    Add New Category
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
                  <h3 class="card-title">Add New Category</h3>
                </div>
                <form action="" method="POST">
                    {{ csrf_field() }}
                  <div class="card-body">

                    <div class="form-group">
                      <label> Category Name <span style="color: red">*</span></label>
                      <input type="text" class="form-control"  value="{{ old('category_name') }}"  name="category_name" placeholder="Enter Category name">
                    </div>

                    <div class="form-group">
                      <label> Category slug <span style="color: red">*</span> </label>
                      <input type="text" class="form-control"  value="{{ old('category_slug') }}"  name="category_slug" placeholder="Enter category_slug">
                      <div class="" style="color: red">{{ $errors->first('category_slug') }}</div>
                    </div>
                    
                    <div class="form-group">
                      <label>Status <span style="color: red">*</span></label>
                      <select class="form-control" name="status">
                         <option {{ (old('status') == 0) ? 'selected' : ''}} value="0">Active </option>
                         <option {{ (old('status') == 1) ? 'selected' : ''}} value="1">Inactive</option>
                      </select>
                    </div>

                    <hr>
                     <div class="form-group">
                        <label> Meta Title <span style="color: red">*</span></label>
                        <input type="text" class="form-control"  value="{{ old('meta_title') }}"  name="meta_title" placeholder="Enter meta_title">
                      </div>
                     


                     <div class="form-group">
                        <label> Meta Description  </label>
                        <textarea type="" class="form-control"  value="{{ old('meta_description') }}"  name="meta_description" placeholder="Enter meta description"></textarea>
                      </div>

                     <div class="form-group">
                        <label> Meta Keywords</label>
                        <input type="text" class="form-control"  value="{{ old('meta_keywords') }}"  name="meta_keywords" placeholder="Enter meta_keywords ">
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