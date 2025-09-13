@extends('admin.layouts.app')
@section('content')
	<!-- Content Header (Page header) -->
    <section class="content-header">					
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categories</h1>
                </div>
               
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="card">
                <form action="" method ="get">
                <div class="card-header">
                      <div class="card-title">
                        <button onclick="window.location.href= '{{ route('order.list') }}'" type="button"  class="btn btn-defualt btn-sm">Reset</button>
                      </div>
                    <div class="card-tools">
                        <div class="input-group input-group" style="width: 250px;">
                            <input type="text" name="keyword" value="{{ Request::get('keyword')}}" class="form-control float-right" placeholder="Search">
        
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                              </button>
                            </div>
                          </div>
                    </div>
                   </div>
                <form>
                <div class="card-body table-responsive p-0">								
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="60">Orders #</th>
                                <th>Customer</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th width="100">Status</th>
                                <th width="100">Total</th>
                                <th width="100">Purchase Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($orders->isNotEmpty())
                            @php
                                $i=1;
                            @endphp
                              @foreach($orders  as $order)
                              <tr>
                                <td><a href="{{ route('order.detail',$order->id) }}">{{ $order->id }}</td>
                                <td>{{ $order->name	}}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>
                                    @if($order->status == 'pending')
                                        <span class="badge bg-danger">Pending</span>
                                    @elseif ($order->status == 'shipped')
                                    <span class="badge bg-info">Shipped</span>
                                    @else
                                        <span class="badge bg-success">Delivered</span>
                                    @endif
                                </td>                                
                                <td>
                                    {{ $order->grand_total }}   
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($order->created_at)->format('d M,Y')}}   
                                </td>
                            </tr>
                                    @php
                                    $i++;
                                    @endphp
                              @endforeach

                            @else
                              <td colspan ="5">No records found</td>
                            @endif


                           
                           
                        </tbody>
                    </table>										
                </div>
                <div class="card-footer clearfix">
                   {{ $orders->links() }}
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->

    @endsection
    
    @section('script')
    
     @endsection