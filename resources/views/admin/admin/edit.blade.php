@extends('admin.layouts.app')

@section('style')
  
@endsection

@section('title')
    Edit Admin
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
                  <h3 class="card-title">Edit Admin</h3>
                </div>
                {{-- <form action="{{ route('admin.update') }}" method="POST"> --}}
                <form action="" method="POST">
                    {{ csrf_field() }}
                  <div class="card-body">
                    <div class="form-group">
                      <label > Name </label>
                      <input type="name" class="form-control"  value="{{ old('name', $getRecord->name)}}"  name="name" placeholder="Enter name">
                    </div>
                    <div class="form-group">
                      <label >Email address</label>
                      <input type="email" class="form-control"  value="{{ old('email', $getRecord->email) }}"   name="email" placeholder="Enter email">
                      <div class="" style="color: red">{{ $errors->first('email') }}</div>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="text" class="form-control"  value="{{ $getRecord->password }}"  name="password" placeholder="Password">
                      <p>Do you want to change password so plesse add</p>
                    </div>
                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="status">
                         <option  {{($getRecord->status  == 0) ? 'selected' : '' }} value="0">Active </option>
                         <option  {{($getRecord->status  == 1) ? 'selected' : '' }} value="1">Inactive</option>
                      </select>
                    </div>
                  </div>
  
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