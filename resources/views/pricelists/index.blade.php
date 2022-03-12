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
        <h1 class="m-0"><a href="{{ url('admin/pricelists/create') }}" class="btn btn-primary">Add Price</a></h1>
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
      <table class="table" id="sample-table">
        <thead>
          <tr>
            <th>Product Name</th>
            <th>Price Date</th>
            <th>Price</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>

          @foreach($pricelists as $pricelist)
          <tr>
            <td>{{App\Http\Controllers\OrderController::get_product_name($pricelist->product_id)}}</td>
            <td>{{$pricelist->price_date}}</td>
            <td>{{$pricelist->price}}</td>
            <td>
              {!! Form::open(['method' => 'DELETE','route' => ['pricelists.destroy', $pricelist->id],'style'=>'display:inline']) !!}
              <a class="btn btn-primary" href="{{ route('pricelists.edit',$pricelist->id) }}">Edit</a>  
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
       {{ $pricelists->appends(request()->query())->links('vendor.pagination.custom') }}
      </div>
    </div>
  </div>
</div>
<!-- /.content -->
@endsection