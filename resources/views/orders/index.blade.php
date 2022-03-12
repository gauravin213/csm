@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    @if ($message = Session::get('success'))
     <div class="alert alert-success">
      {{ $message }}
    </div>
    @endif

    <form action="" method="GET">
      <!---->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Filter</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-3">
              <select name="payment_status" class="form-control" id="payment_status">
                <option value="">Payment status</option>
                <option value="pending"  {{(isset($_GET['payment_status']) && $_GET['payment_status'] =='pending') ? 'selected' : ''}}>Pending</option>
                <option value="on-hold" {{(isset($_GET['payment_status']) && $_GET['payment_status'] =='on-hold') ? 'selected' : ''}}>On Hold</option>
                <option value="completed" {{(isset($_GET['payment_status']) && $_GET['payment_status'] =='completed') ? 'selected' : ''}}>Completed</option>
              </select>
            </div>
            <div class="col-3">
             <select name="customer_id" class="form-control" id="customer_id">
                <option value="">Customer</option>
                @foreach($customers as $customer)
                <option value="{{$customer->id}}" {{(isset($_GET['customer_id']) && $customer->id==$_GET['customer_id']) ? 'selected' : ''}}>{{$customer->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-3">
              <select name="placed_by" class="form-control" id="placed_by">
                <option value="">User</option>
                @foreach($users as $user)
                <option value="{{$user->id}}" {{(isset($_GET['placed_by']) && $user->id==$_GET['placed_by']) ? 'selected' : ''}}>{{$user->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-3">
             <button class="btn btn-default">Filter</button>
            </div>
          </div>
          <div class="row">
            <div class="col-3">
              <input type="text" name="from_date" id="from_date" class="form-control" autocomplete="off" value="{{(isset($_GET['from_date'])) ? $_GET['from_date'] : ''}}">
            </div>
            <div class="col-3">
               <input type="text" name="to_date" id="to_date" class="form-control" autocomplete="off" value="{{(isset($_GET['to_date'])) ? $_GET['to_date'] : ''}}">
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!---->
    </form>


    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><a href="{{ url('admin/orders/create') }}" class="btn btn-primary">Add Order</a></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
      </div>
    </div><!-- /.row -->

  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="card">
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Payment Status</th>
            <th>Placed By</th>
            <th>Customer</th>
            <th>Total</th>
            <th>Balance</th>
            <th>Discount</th>
            <th>Date</th>
            <th colspan="3">Action</th>
          </tr>
        </thead>
        <tbody>

          @foreach($orders as $order)
          <tr>
            <td>{{$order->id}}</td>
            <td>
              @if($order->payment_status =='pending')
                <span style="background-color:#588ca3;color: #ffff; padding: 3px; border-radius: 2px;">Pending</span>
              @elseif($order->payment_status =='on-hold')
                <span style="background-color:orange;color: #ffff; padding: 3px; border-radius: 2px;">On Hold</span>
              @elseif($order->payment_status =='completed')
                <span style="background-color:#63a363;color: #ffff; padding: 3px; border-radius: 2px;">Completed</span>
              @endif
            </td>
            <td>{{App\Http\Controllers\OrderController::get_user_name($order->placed_by)}}</td>
            <td>{{App\Http\Controllers\OrderController::get_customer_name($order->customer_id)}}</td> 
            <td>{{$order->total}}</td>
            <td>{{$order->balance_amount}}</td>
            <td>{{$order->discount}}</td>
            <td>{{$order->created_at}}</td>
            <td>
              {!! Form::open(['method' => 'DELETE','route' => ['orders.destroy', $order->id],'style'=>'display:inline']) !!}
              <a class="btn btn-primary" href="{{ route('orders.edit',$order->id) }}">Edit</a>  
              {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}

              @if($order->payment_status !='completed')
                <a class="btn btn-default" href="{{ route('transactions.create','order_id=') }}{{$order->id}}" target="_blank">Balance</a>
              @endif
                
              {!! Form::close() !!}
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>


    <!-- /.card-body -->
    <div class="card-header">
      <div class="card-tools">
        <!--pagination-->
       {{ $orders->appends(request()->query())->links('vendor.pagination.custom') }}
      </div>
    </div>
  </div>
</div>
<!-- /.content -->
@endsection