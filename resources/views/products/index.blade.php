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
        <h1 class="m-0"><a href="{{ url('admin/products/create') }}" class="btn btn-primary">Add Product</a></h1>
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
            <th>#</th>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>

          @foreach($products as $product)
          <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->price}}</td>
            <td>
              @if(is_object($product->category))
              {{$product->category->name}}
              @else
              N/A
              @endif
            </td>
            <td>
              <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}"><i class="fas fa-edit"></i></a> 
              {!! Form::open(['class' => 'mydeleteform_'.$product->id, 'method' => 'DELETE','route' => ['products.destroy', $product->id],'style'=>'display:inline']) !!} 
               <!-- {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!} -->
              <button class="btn btn-danger delete_ev" type="button" data-element_id="{{$product->id}}"><i class="fas fa-trash-alt"></i></button>
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
       {{ $products->appends(request()->query())->links('vendor.pagination.custom') }}
      </div>
    </div>
  </div>
</div>
<!-- /.content -->
@endsection