@extends('admin.layouts.app')

@section('style')
  
@endsection
@section('title')
      Customer List Page 
@endsection
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Customer List (Total : {{ $getRecord->total() }}) </h1>
            </div>
            {{-- <div class="col-sm-6" style="text-align: right">
              <a href="{{ route('category.add') }}" class="btn btn-primary">Add New Category </a>
            </div> --}}
          </div>
        </div>
      </section>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
       
            <div class="col-md-12">
              @include('admin.layouts._message')
     
   {{-- Search form start --}}
              <form action="" method="GET">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Customer Search</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">
                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">ID</label>
                              <input type="text" name="id" class="form-control"valuee="{{ Request::get('id') }}" placeholder="ID">
                          </div>
                       </div>
                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">First Name</label>
                              <input type="text" name="name" class="form-control"valuee="{{ Request::get('name') }}" placeholder=" Name">
                          </div>
                       </div>
  
  
                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">Email</label>
                              <input type="text" name="email" class="form-control"valuee="{{ Request::get('email') }}" placeholder="Email">
                          </div>
                       </div>

                       <div class="col-md-2">
                        <div class="form-group">
                           <label for="">Form Date</label>
                            <input type="date" name="form_date" class="form-control"valuee="{{ Request::get('form_date') }}" style="padding: 6px" placeholder="form_date">
                        </div>
                     </div>

                     <div class="col-md-2">
                        <div class="form-group">
                           <label for="">To Date</label>
                            <input type="date" name="to_date" class="form-control"valuee="{{ Request::get('to_date') }}" style="padding: 6px" placeholder="To Date">
                        </div>
                     </div>
  
                    </div>
                    {{-- Search button start --}}
                      <div class="row">
                        <div class="col-md-12">
                          <button class="btn btn-primary">Search</button>
                          <a href="{{ url('admin/customer/list') }}" class="btn btn-danger">Reset</a>
                        </div>
                      </div>
                      {{-- Search button end --}}
                  </div>
                 
                </div>
              </form>
              {{-- Search form end --}}

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Customer List </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th >#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Created Date</th>
                        <th>Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ( $getRecord as $valu )
                        
                     
                      <tr>
                        <td>{{ $valu->id }}</td>
                        <td>{{ $valu->name }}</td>
                        <td>{{ $valu->email }}</td>
                       
                        <td>{{ ($valu->status == 0 ) ? 'Active' : 'Inactive'}}</td>
                        <td>{{ date('d-m-Y H:i A', strtotime($valu->created_at)) }}</td>
                        <td>

                          {{--Route difine this code  --}}
                          {{-- <a href="{{ route('admin.edit',['id' => $valu->id ]) }}" class="btn btn-primary">Edit</a>
                          <a href="{{ route('admin.delate',['id' => $valu->id ] ) }}" class="btn btn-danger">Delate</a> --}}

                      {{-- anader code  --}}
                        
                          <a href="{{ url('admin/admin/delate',$valu->id  ) }}" class="btn btn-danger">Delate</a>
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