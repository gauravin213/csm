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
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"><a href="{{ url('admin/advance-payments/create') }}" class="btn btn-primary">Add Payment</a></h1>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="card">
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
  <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>#</th>
            <th>Customer Name</th>
            <th>Amount</th>
            <th>Date</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>

          @foreach($advance_payments as $advance_payment)
          <tr>
            <td>{{$advance_payment->id}}</td>
            <td>
              @if(is_object($advance_payment->customer))
                {{$advance_payment->customer->name}}
              @endif
            </td>
            <td>{{$advance_payment->amount}}</td>
            <td>{{$advance_payment->created_at}}</td>
            <td>
              <a class="btn btn-primary" href="{{ route('advance-payments.edit',$advance_payment->id) }}"><i class="fas fa-edit"></i></a>
              {!! Form::open(['class' => 'mydeleteform_'.$advance_payment->id,'method' => 'DELETE','route' => ['advance-payments.destroy', $advance_payment->id],'style'=>'display:inline']) !!}
                <!-- <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button> -->
                <button class="btn btn-danger delete_ev" type="button" data-element_id="{{$advance_payment->id}}"><i class="fas fa-trash-alt"></i></button>
              {{ Form::close() }}
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
       {{ $advance_payments->appends(request()->query())->links('vendor.pagination.custom') }}
      </div>
    </div>
  </div>
</div>
<!-- /.content -->
@endsection