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

    <div class="margin" style="margin-bottom: 5px;">
      <div class="btn-group">
        <a href="{{ url('admin/customers/create') }}" class="btn btn-primary">Add Customers</a>
      </div>
      <div class="btn-group">
        <button type="button" id="csm_export_btn" class="btn btn-success">Export</button>
      </div>
    </div>

    <!---->
    <form id="csm_export_form" action="{{url('/customers/exportcsv')}}" method="GET">
      <input type="hidden" name="s" id="search" class="form-control" placeholder="search" value="{{(isset($_GET['s'])) ? $_GET['s'] : ''}}">
    </form>
    <!---->

    <form action="" method="GET">
      <!---->
      <div class="card">
        <div class="card-header">
         <h3 class="card-title">Search&nbsp; &nbsp; &nbsp;</h3>  
        </div>
        <div class="card-body">
          <div class="row" style="margin-top: 5px;">
            <div class="col-sm-4">
              <input type="text" name="s" id="search" class="form-control" placeholder="search" value="{{(isset($_GET['s'])) ? $_GET['s'] : ''}}">
            </div>
            <div class="col-sm-4">
              <button class="btn btn-default">Search</button>
              @if(isset($_GET['s']) && $_GET['s'] !='')
              <a href="{{url('/admin/customers')}}" class="btn btn-danger">Remove Filter</a>
             @endif
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!---->
    </form>
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
            <th>Name</th>
            <th>Mobile</th>
            <th>Wallet</th>
            <th>Sales Man</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>

          @foreach($customers as $customer)
          <tr>
            <td>{{$customer->id}}</td>
            <td>{{$customer->name}}</td>
            <td>{{$customer->mobile}}</td>
            <td>{{$customer->total_fund}}</td>
            <td>
              @if(is_object($customer->user))
              {{$customer->user->name}}
              @else
              N/A
              @endif
            </td>
            <td>
              @can('isAdministrator')
              <a class="btn btn-primary" href="{{ route('customers.edit',$customer->id) }}"><i class="fas fa-edit"></i></a> 
              @endcan

              {!! Form::open(['class' => 'mydeleteform_'.$customer->id, 'method' => 'DELETE','route' => ['customers.destroy', $customer->id],'style'=>'display:inline']) !!}
              <!-- <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button> -->
              <button class="btn btn-danger delete_ev" type="button" data-element_id="{{$customer->id}}"><i class="fas fa-trash-alt"></i></button>
              {{ Form::close() }}

               <a class="btn btn-success" href="{{ route('customers.show',$customer->id) }}"><i class="fas fa-eye"></i></a>
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
       {{ $customers->appends(request()->query())->links('vendor.pagination.custom') }}
      </div>
    </div>
  </div>
</div>
<!-- /.content -->
@endsection