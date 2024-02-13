@extends('admin.layouts.app')

@section('style')
  
@endsection

@section('title')
    Add New Admin
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
                  <h3 class="card-title">Add New Admin</h3>
                </div>
                <form action="" method="POST">
                    {{ csrf_field() }}
                  <div class="card-body">
                    <div class="form-group">
                      <label > Name </label>
                      <input type="name" class="form-control"  value="{{ old('name') }}"  name="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                      <label >Email address</label>
                      <input type="email" class="form-control"   value="{{ old('email') }}"   name="email" placeholder="Enter email">
                      <div class="" style="color: red">{{ $errors->first('email') }}</div>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="status">
                         <option {{ (old('status') == 0) ? 'selected' : ''}} value="0">Active </option>
                         <option {{ (old('status') == 1) ? 'selected' : ''}} value="1">Inactive</option>
                      </select>
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