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
        <h3 class="card-title">Edit Product</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
         <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        @method('PUT')
        <div class="card-body">

          <div class="form-group">
            <a class="btn btn-primary back-btn" href="{{ URL::previous() }}">Go Back</a>
         </div>
         
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{$user->name}}">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Enter email" value="{{$user->email}}">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <input type="text" name="password" class="form-control" id="password" placeholder="Enter password" value="{{$user->password}}">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Role</label>
            <select name="user_type" id="user_type" class="form-control" >
              <option value="">select</option>
              <option value="administrator" {{$user->user_type == 'administrator'  ? 'selected' : ''}}>Administrator</option>
              <option value="sales_man" {{$user->user_type == 'sales_man'  ? 'selected' : ''}}>Sales Man</option>
              <option value="sales_manager" {{$user->user_type == 'sales_manager'  ? 'selected' : ''}}>Sales Manager</option>
            </select>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Parent User</label>
            <select name="parent" id="parent" class="form-control" >
              <option value="0">select</option>
              @foreach ($users as $parent_user)
                <option value="{{$parent_user->id}}" {{$user->parent == $parent_user->id  ? 'selected' : ''}} >{{$parent_user->name}}({{$parent_user->user_type}}) </option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Mobile No.</label>
            <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter mobile No." value="{{$user->mobile}}">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Alternate Mobile No.</label>
            <input type="text" name="mobile_alternate" class="form-control" id="mobile_alternate" placeholder="Enter Alternate mobile No." value="{{$user->mobile_alternate}}">
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