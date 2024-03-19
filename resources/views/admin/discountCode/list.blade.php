@extends('admin.layouts.app')

@section('style')
  
@endsection
@section('title')
  Color Page 
@endsection
@section('content')
<div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Discount Code  List </h1>
            </div>
            <div class="col-sm-6" style="text-align: right">
              <a href="{{ route('discount_code.add') }}" class="btn btn-primary">Add New Discount Code </a>
            </div>
          </div>
        </div>
      </section>
  

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
              @include('admin.layouts._message')
     
  
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Colors  List </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th >#</th>
                        <th >discountCode Name</th>
                        <th>Type</th>
                        <th>Precent Amount</th>
                        <th>Expire Date</th>
                        <th>Created By</th>
                        <th>Status</th>
                       
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ( $getRecord as $valu )
                        
                     
                      <tr>
                        <td>{{ $valu->id }}</td>
                        <td>{{ $valu->name }}</td>
                        <td>{{ $valu->type}}</td>
                        <td>{{ $valu->precent_amount}}</td>
                        <td>{{ date('d-m-y', strtotime($valu->expire_date))}}</td>
                        <td>{{ ($valu->status == 0 ) ? 'Active' : 'Inactive'}}</td>
                        <td>{{ date('d-m-y', strtotime($valu->created_at))}}</td>
                        <td>

                          {{--Route difine this code  --}}
                          <a href="{{ route('discount_code.edit',['id' => $valu->id ]) }}" class="btn btn-primary">Edit</a>
                          <a href="{{ route('discount_code.delate',['id' => $valu->id ] ) }}" class="btn btn-danger">Delate</a>

                      {{-- anader code  --}}
                          {{-- <a href="{{ url('admin/admin/edit',$valu->id ) }}" class="btn btn-primary">Edit</a>
                          <a href="{{ url('admin/admin/delate',$valu->id  ) }}" class="btn btn-danger">Delate</a> --}}
                        </td>
                    
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
        </div>
      </section>
    </div>
    
</div>


@endsection

@section('script')
<script src="{{asset('/')}}public/admin/assets/dist/js/pages/dashboard3.js"></script>
@endsection