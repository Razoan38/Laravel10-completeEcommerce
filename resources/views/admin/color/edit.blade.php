@extends('admin.layouts.app')

@section('style')
  
@endsection

@section('title')
    Edit brand
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
                  <h3 class="card-title">Edit brand</h3>
                </div>
                <form action="" method="POST">
                    {{ csrf_field() }}
                  <div class="card-body">

                    <div class="form-group">
                      <label> Color Name <span style="color: red">*</span></label>
                      <input type="text" class="form-control"  value="{{ old('color_name',$getRecord->color_name) }}"  name="color_name" placeholder="Enter Color name">
                    </div>

                    <div class="form-group">
                        <label> Color Ccde <span style="color: red">*</span> </label>
                        <input type="color" class="form-control"  value="{{ old('color_code',$getRecord->color_code) }}"  name="color_code" placeholder="Enter color_code">
                       
                      </div>
                    
                    <div class="form-group">
                      <label>Status <span style="color: red">*</span></label>
                      <select class="form-control" name="status">
                         <option {{ (old('status',$getRecord->status) == 0) ? 'selected' : ''}} value="0">Active </option>
                         <option {{ (old('status',$getRecord->status) == 1) ? 'selected' : ''}} value="1">Inactive</option>
                      </select>
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