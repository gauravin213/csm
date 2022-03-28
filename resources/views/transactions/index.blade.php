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
    @if ($message = Session::get('warning'))
     <div class="alert alert-warning">
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
            <div class="col-4">
             <select name="customer_id" class="form-control" id="customer_id">
                <option value="">Customer</option>
                @foreach($customers as $customer)
                <option value="{{$customer->id}}" {{(isset($_GET['customer_id']) && $customer->id==$_GET['customer_id']) ? 'selected' : ''}}>{{$customer->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-4">
              <select name="placed_by" class="form-control" id="placed_by">
                <option value="">User</option>
                @foreach($users as $user)
                <option value="{{$user->id}}" {{(isset($_GET['placed_by']) && $user->id==$_GET['placed_by']) ? 'selected' : ''}}>{{$user->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-4">
             <button class="btn btn-default">Filter</button>
            </div>
          </div>

          <div class="row" style="margin-top: 5px;">
            <div class="col-4">
              <input type="text" name="from_date" id="from_date" class="form-control" placeholder="from" autocomplete="off" value="{{(isset($_GET['from_date'])) ? $_GET['from_date'] : ''}}">
            </div>
            <div class="col-4">
               <input type="text" name="to_date" id="to_date" class="form-control" placeholder="to" autocomplete="off" value="{{(isset($_GET['to_date'])) ? $_GET['to_date'] : ''}}">
            </div>
          </div>


        </div>
        <!-- /.card-body -->
      </div>
      <!---->
    </form>

    
    <div class="row mb-2" style="display: none;">
      <div class="col-sm-6">
        <h1 class="m-0"><a href="{{ url('admin/transactions/create') }}" class="btn btn-primary">Add Transaction</a></h1>
      </div><!-- /.col -->
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
            <th>Id</th>
            <th>Order Id</th>
            <th>Customer</th>
            <th>Paid Amount</th>
            <th>Ballance Amount</th>
            <th>Order Total</th>
            <th>Date</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>

          @foreach($transactions as $transaction)
          <tr>
            <td>{{$transaction->id}}</td>
            <td>{{$transaction->order_id}}</td>
            <td>
              @if(is_object($transaction->order))
               {{App\Http\Controllers\TransactionController::get_customer_name($transaction->order->customer_id)}}
              @else
              N/A
              @endif
            </td>
            <td>{{$transaction->paid_amount}}</td>
            <td>{{$transaction->ballance_amount}}</td>
            <td>
              @if(is_object($transaction->order))
              {{$transaction->order->total}}
              @else
              N/A
              @endif
            </td> 
            <td>{{$transaction->created_at}}</td>
            <td>
              {!! Form::open(['method' => 'DELETE','route' => ['transactions.destroy', $transaction->id],'style'=>'display:inline']) !!}
              <a class="btn btn-primary" href="{{ route('transactions.edit',$transaction->id) }}">Edit</a>  
              {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
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
       {{ $transactions->appends(request()->query())->links('vendor.pagination.custom') }}
      </div>
    </div>
  </div>
</div>
<!-- /.content -->
@endsection