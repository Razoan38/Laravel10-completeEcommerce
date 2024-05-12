@extends('admin.layouts.app')

@section('style')
  
@endsection
@section('title')
Order Page 
@endsection
@section('content')
<div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Order List (Total : {{ $getRecord->total() }}) </h1>
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
            <!-- /.col -->
            <div class="col-md-12">
              @include('admin.layouts._message')
     
          {{-- Search form start --}}
              <form action="" method="GET">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Order Search</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">
                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">ID</label>
                              <input type="text" name="id" class="form-control" value="{{ Request::get('id') }}" placeholder="ID">
                          </div>
                       </div>
                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">First Name</label>
                              <input type="text" name="first_name" class="form-control" value="{{ Request::get('first_name') }}" placeholder="First Name">
                          </div>
                       </div>
  
                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">Last Name</label>
                              <input type="text" name="last_name" class="form-control" value="{{ Request::get('last_name') }}" placeholder="Last Name">
                          </div>
                       </div>
  
                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">Email</label>
                              <input type="text" name="email" class="form-control" value="{{ Request::get('email') }}" placeholder="Email">
                          </div>
                       </div>
                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">Phone</label>
                              <input type="text" name="phone" class="form-control" value="{{ Request::get('phone') }}" placeholder="Phone">
                          </div>
                       </div>
  
                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">Country</label>
                              <input type="text" name="country" class="form-control" value="{{ Request::get('country') }}" placeholder="Country">
                          </div>
                       </div>
                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">State</label>
                              <input type="text" name="state" class="form-control" value="{{ Request::get('state') }}" placeholder="State">
                          </div>
                       </div>

                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">City</label>
                              <input type="text" name="city" class="form-control" value="{{ Request::get('city') }}" placeholder=" City">
                          </div>
                       </div>

                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">Discount Code</label>
                              <input type="text" name="discount_code" class="form-control" value="{{ Request::get('discount_code') }}" placeholder=" Discount Code">
                          </div>
                       </div>

                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">Pyment Method</label>
                              <input type="text" name="payment_method" class="form-control" value="{{ Request::get('payment_method') }}" placeholder="Payment Method">
                          </div>
                       </div>

                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">Form Date</label>
                              <input type="date" name="form_date" class="form-control" value="{{ Request::get('form_date') }}" style="padding: 6px" placeholder="form_date">
                          </div>
                       </div>
                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">To Date</label>
                              <input type="date" name="to_date" class="form-control" value="{{ Request::get('to_date') }}" style="padding: 6px" placeholder="To Date">
                          </div>
                       </div>
  
                    </div>
                    {{-- Search button start --}}
                      <div class="row">
                        <div class="col-md-12">
                          <button class="btn btn-primary">Search</button>
                          <a href="{{ url('admin/orders/list') }}" class="btn btn-danger">Reset</a>
                        </div>
                      </div>
                      {{-- Search button end --}}
                  </div>
                 
                </div>
              </form>
              {{-- Search form end --}}
              
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Order List </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0"  style="overflow: auto;">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th >#</th>
                        <th>Name</th>
                        <th>company_name</th>
                        <th>country</th>
                        <th>Address</th>
                        <th>city</th>
                        <th>state</th>
                        <th>postcode</th>
                        <th>phone</th>
                        <th>email</th>
                        <th>Discount Code</th>
                        <th>Discount Amount</th>
                        <th>Shipping Amount</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Total Amount</th>
                        <th>Created Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ( $getRecord as $valu )
                        
                     
                      <tr>
                        <td>{{ $valu->id }}</td>
                        <td>{{ $valu->first_name }} {{ $valu->last_name }}</td>
                        <td>{{ $valu->company_name }}</td>
                        <td>{{ $valu->country }}</td>
                        <td>{{ $valu->address_one }} {{ $valu->address_two }}</td>
                        <td>{{ $valu->city }}</td>
                        <td>{{ $valu->state }}</td>
                        <td>{{ $valu->postcode }}</td>
                        <td>{{ $valu->phone }}</td>
                        <td>{{ $valu->email	 }}</td>
                        <td>{{$valu->discount_code }}</td>
                        <td>{{ number_format ($valu->discount_amount ,2) }}</td>
                        <td>{{ number_format ($valu->shipping_amount,2) }}</td>
                        <td style="text-transform: capitalize">{{$valu->payment_method }}</td>
                        <td>{{ $valu->status	 }}</td>
                        <td>{{ number_format ($valu->total_amount ,2) }}</td>
                        <td>{{ date('d-m-y', strtotime($valu->created_at))}}</td>
                        <td>

                         <a href="{{ route('orders.detail',['id' => $valu->id ]) }}" class="btn btn-primary">Detail</a>
                          {{-- <a href="{{ route('orders.delate',['id' => $valu->id ] ) }}" class="btn btn-danger">Delate</a> --}}

                    
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