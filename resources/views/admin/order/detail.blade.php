@extends('admin.layouts.app')

@section('style')
  
@endsection

@section('title')
Orders Details
@endsection
@section('content')
<div class="content-wrapper">
      
  

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12" style="">
              <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Orders Details</h3>
                </div>
                <div class="card-body">

                    <div class="form-group">
                      <label> ID : {{ $getRecord->id }}</label>
                  
                    </div>
                    <div class="form-group">
                      <label> Transaction Id : {{ $getRecord->transaction_id }}</label>
                  
                    </div>
                    <div class="form-group">
                      <label> Name : {{ $getRecord->first_name }}  {{ $getRecord->last_name }}</label>
                  
                    </div>

                    <div class="form-group">
                      <label> company_name : {{ $getRecord->company_name }} </label>
                  
                    </div>
                    <div class="form-group">
                      <label> country : {{ $getRecord->country }}</label>
                  
                    </div>
                    <div class="form-group">
                      <label> Address : {{ $getRecord->address_one }} {{ $getRecord->address_two }}</label>
                  
                    </div>
                    <div class="form-group">
                      <label> city : {{ $getRecord->city }}</label>
                  
                    </div>
                    <div class="form-group">
                      <label> state : {{ $getRecord->state }}</label>
                  
                    </div>
                    <div class="form-group">
                      <label> postcode : {{ $getRecord->postcode }}</label>
                  
                    </div>
                    <div class="form-group">
                      <label> phone : {{ $getRecord->phone }}</label>
                  
                    </div>
                    <div class="form-group">
                      <label> email : {{ $getRecord->email }}</label>
                  
                    </div>
                    <div class="form-group">
                      <label> Discount Code : {{ $getRecord->discount_code }}</label>
                  
                    </div>
                    <div class="form-group">
                      <label> Discount Amount : {{ number_format ($getRecord->discount_amount ,2) }}</label>
                  
                    </div>
                    
                    <div class="form-group">
                      <label>Shipping Name :  {{ $getRecord->getShipping->name }} </label>
                  
                    </div>

                    <div class="form-group">
                      <label>Shipping Amount : {{ number_format ($getRecord->shipping_amount,2) }} </label>
                  
                    </div>
                    <div class="form-group">
                      <label> Total Amount : {{ number_format ($getRecord->total_amount ,2) }} </label>
                  
                    </div>

                    
                    <div class="form-group">
                        <label> Payment Method : {{ $getRecord->payment_method }}</label>
                    
                      </div>

                      <div class="form-group">
                      <label> Status : {{ $getRecord->status }}</label>
                  
                    </div>
                      <div class="form-group">
                      <label> Created At : {{ $getRecord->created_at }}</label>
                  
                    </div>
                    
                    
                  </div>
               </div>
                  
            

            </div>

        <div class="col-md-12" style="">
            <div class="card">
             
                <div class="card-header">
                  <h3 class="card-title">Product Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0"  style="overflow: auto;">
                  <table class="table table-striped">
                    <thead>

                      <tr>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Qut</th>
                            <th>Price</th>
                            <th>Color Name</th>
                            <th>Size Name</th>
                            <th>Size Amount ($)</th>
                            <th>Total Amount ($)</th>
                      </tr>

                    </thead>
                    <tbody>

                        @foreach ( $getRecord->getItem as $item )
                        @php
                            $getProductimage = $item->getProduct->getSingleimage($item->getProduct->id)
                        @endphp
                         <tr> 
                              <td>
                                   <img style="height: 100px; width: 100px" src="{{ $getProductimage->getimageshow() }}" alt="">
                              </td>

                              <td>
                                <a target="_blank" href="{{ url( $item->getProduct->slug) }}">{{ $item->getProduct->title }}</a>
                              </td>
                              <td>{{ $item->quantity }}</td>
                              <td>{{ $item->price }}</td>
                              <td>{{ $item->color_name }}</td>
                              <td>{{ $item->size_name }}</td>
                              <td>{{ number_format ($item->size_amount, 2) }}</td>
                              <td>{{ number_format ($item->total_price, 2) }}</td>
                         </tr>
                        @endforeach
                     
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
</div>

@endsection

@section('script')

<script src="{{asset('/')}}public/admin/assets/dist/js/pages/dashboard3.js"></script>

@endsection