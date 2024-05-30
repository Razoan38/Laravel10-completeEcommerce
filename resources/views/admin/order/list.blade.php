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
                              <input type="text" name="id" class="form-control"valuee="{{ Request::get('id') }}" placeholder="ID">
                          </div>
                       </div>
                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">First Name</label>
                              <input type="text" name="first_name" class="form-control"valuee="{{ Request::get('first_name') }}" placeholder="First Name">
                          </div>
                       </div>
  
                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">Last Name</label>
                              <input type="text" name="last_name" class="form-control"valuee="{{ Request::get('last_name') }}" placeholder="Last Name">
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
                             <label for="">Phone</label>
                              <input type="text" name="phone" class="form-control"valuee="{{ Request::get('phone') }}" placeholder="Phone">
                          </div>
                       </div>
  
                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">Country</label>
                              <input type="text" name="country" class="form-control"valuee="{{ Request::get('country') }}" placeholder="Country">
                          </div>
                       </div>
                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">State</label>
                              <input type="text" name="state" class="form-control"valuee="{{ Request::get('state') }}" placeholder="State">
                          </div>
                       </div>

                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">City</label>
                              <input type="text" name="city" class="form-control"valuee="{{ Request::get('city') }}" placeholder=" City">
                          </div>
                       </div>

                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">Discount Code</label>
                              <input type="text" name="discount_code" class="form-control"valuee="{{ Request::get('discount_code') }}" placeholder=" Discount Code">
                          </div>
                       </div>

                       <div class="col-md-2">
                          <div class="form-group">
                             <label for="">Pyment Method</label>
                              <input type="text" name="payment_method" class="form-control"valuee="{{ Request::get('payment_method') }}" placeholder="Payment Method">
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
                      @foreach ( $getRecord as $value )
                        
                     
                      <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->first_name }} {{ $value->last_name }}</td>
                        <td>{{ $value->company_name }}</td>
                        <td>{{ $value->country }}</td>
                        <td>{{ $value->address_one }} {{ $value->address_two }}</td>
                        <td>{{ $value->city }}</td>
                        <td>{{ $value->state }}</td>
                        <td>{{ $value->postcode }}</td>
                        <td>{{ $value->phone }}</td>
                        <td>{{ $value->email	 }}</td>
                        <td>{{$value->discount_code }}</td>
                        <td>{{ number_format ($value->discount_amount ,2) }}</td>
                        <td>{{ number_format ($value->shipping_amount,2) }}</td>
                        <td style="text-transform: capitalize">{{$value->payment_method }}</td>

                          <td>
                          <select name="order_status"  class="form-control ChangeStatus" id="{{ $value->id }}" style="width:150px;">
                            <option {{ ($value->status == 0 ) ? 'selected' : ''}} value="0">Pending</option>
                            <option {{ ($value->status == 1 ) ? 'selected' : ''}} value="1">Inporgress</option>
                            <option {{ ($value->status == 2 ) ? 'selected' : ''}} value="2">Delivered</option>
                            <option {{ ($value->status == 3 ) ? 'selected' : ''}} value="3">Completed</option>
                            <option {{ ($value->status == 4 ) ? 'selected' : ''}} value="4">Cencelled</option>
                          </select>
      
                          </td>

                        <td>{{ number_format ($value->total_amount ,2) }}</td>
                        <td>{{ date('d-m-y', strtotime($value->created_at))}}</td>
                        <td>

                         <a href="{{ route('orders.detail',['id' => $value->id ]) }}" class="btn btn-primary">Detail</a>
                          {{-- <a href="{{ route('orders.delate',['id' => $value->id ] ) }}" class="btn btn-danger">Delate</a> --}}

                    
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

   $('body').delegate('.ChangeStatus' , 'change', function() {
        var status = $(this).val();
        var order_id = $(this).attr('id');

        $.ajax({
				type : "GET",
				url  :  "{{ url('admin/orders_status') }}",
				data :  {
                  status    : status,
                  order_id : order_id
        },
				dataType : "json",
				success  : function(data) {
             alert(data.message);
				},
				
			});
   });


// $(document).ready(function() {
//             $('body').on('change', '.ChangeStatus', function() {
//                 var status = $(this).val();
//                 var order_id = $(this).attr('id');

//                 console.log("Status: " + status);
//                 console.log("Order ID: " + order_id);

//                 $.ajax({
//                     type: "GET",
//                     url: "{{ url('admin/orders_status') }}",
//                     data: {
//                         status: status,
//                         order_id: order_id
//                     },
//                     dataType: "json",
//                     success: function(data) {
//                         console.log("Success response: ", data);
//                         alert(data.message);
//                     },
//                     error: function(xhr, status, error) {
//                         console.error("Error: ", error);
//                         alert("An error occurred: " + error);
//                     }
//                 });
//             });
//         });


</script>
@endsection