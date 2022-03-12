@extends('layouts.admin')

@section('content')
<div class="content-header"></div>
<!-- Main content -->
<div class="content">
  <div class="container-fluid">

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Transaction</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
         <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        @method('PUT')
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Order Id</label>
            <input type="text" name="order_id" class="form-control" id="order_id" placeholder="Enter order_id" value="{{$transaction->order_id}}">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Paid Amount</label>
            <input type="text" name="paid_amount" class="form-control" id="paid_amount" placeholder="Enter paid_amount" value="{{$transaction->paid_amount}}">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Ballance Amount</label>
            <input type="text" name="ballance_amount" class="form-control" id="ballance_amount" placeholder="Enter ballance_amount" value="{{$transaction->ballance_amount}}">
          </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection