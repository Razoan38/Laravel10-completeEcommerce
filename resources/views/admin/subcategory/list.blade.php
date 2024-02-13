@extends('admin.layouts.app')

@section('style')
  
@endsection
@section('title')
      Sub Category Page 
@endsection
@section('content')
<div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Sub Category  List </h1>
            </div>
            <div class="col-sm-6" style="text-align: right">
              <a href="{{ route('admin.sub_category.add') }}" class="btn btn-primary">Add New Sub Category </a>
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
                  <h3 class="card-title">Sub Category  List </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th >#</th>
                        <th>Category Name</th>
                        <th>SubCategory Name</th>
                        <th>SubCategory slug</th>
                     
                        <th>Meta Title</th>
                        <th>Meta Description</th>
                        <th>Meta Keywords</th>
                        <th>Created By</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ( $getRecord as $valu )
                      <tr>
                        <td>{{ $valu->id }}</td>
                        <td>{{ $valu->category_name }}</td>
                        <td>{{ $valu->subcategory_name }}</td>
                        <td>{{ $valu->subcategory_slug }}</td>
                        <td>{{ $valu->meta_title }}</td>
                        <td>{{ $valu->meta_description }}</td>
                        <td>{{ $valu->meta_keywords }}</td>
                        <td>{{ $valu->created_by_name }}</td>
                        <td>{{ ($valu->status == 0 ) ? 'Active' : 'Inactive'}}</td>
                        <td>{{ date('d-m-y', strtotime($valu->created_at))}}</td>
                        <td>

                          {{--Route difine this code  --}}
                          <a href="{{ route('admin.sub_category.edit',['id' => $valu->id ]) }}" class="btn btn-primary">Edit</a>
                          <a href="{{ route('admin.sub_category.delate',['id' => $valu->id ] ) }}" class="btn btn-danger">Delate</a>

                      {{-- anader code  --}}
                          {{-- <a href="{{ url('admin/admin/edit',$valu->id ) }}" class="btn btn-primary">Edit</a>
                          <a href="{{ url('admin/admin/delate',$valu->id  ) }}" class="btn btn-danger">Delate</a> --}}
                        </td>
                    
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div class="" style="padding: 10px ; float: right;" >
                   {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!} 
                  </div>
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