@extends('admin.layouts.app')

@section('style')
  
@endsection

@section('title')
    Edit Shipping Charge 
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
                  <h3 class="card-title">Edit Shipping Charge</h3>
                </div>
                <form action="" method="POST">
                    {{ csrf_field() }}
                  <div class="card-body">

                    <div class="form-group">
                      <label> Shipping Charge Name <span style="color: red">*</span></label>
                      <input type="text" class="form-control"  value="{{ old('name',$getRecord->name) }}"  name="name" placeholder="Enter Shipping Charge name">
                    </div>

                     <div class="form-group">
                        <label>Price <span style="color: red">*</span></label>
                        <input type="number" class="form-control"  value="{{ old('price',$getRecord->price) }}"  name="price" />
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