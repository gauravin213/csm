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
        <h3 class="card-title">Add Customer</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
        <form action="{{ route('customers.store') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Address</label>
            <input type="text" name="address" class="form-control" id="address" placeholder="Enter address">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Mobile</label>
            <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter mobile">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Enter name">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Pan No</label>
            <input type="text" name="pan_no" class="form-control" id="pan_no" placeholder="Enter pan no">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Pan Front Image</label>
            <input type="file" name="pan_no_front_img" class="form-control preview_img" id="pan_no_front_img" accept="image/*">
            <img id="pan_no_img" style="width: 20%;" />
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Pan Back Image</label>
            <input type="file" name="pan_no_back_img" class="form-control preview_img" id="pan_no_back_img" accept="image/*">
            <img id="pan_no_img" style="width: 20%;" />
          </div>


          <div class="form-group">
            <label for="exampleInputEmail1">Aadhar No</label>
            <input type="text" name="aadhar_no" class="form-control" id="aadhar_no" placeholder="Enter aadhar no">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Aadhar Front Image</label>
            <input type="file" name="aadhar_no_front_img" class="form-control preview_img" id="aadhar_no_front_img" accept="image/*">
            <img id="pan_no_img" style="width: 20%;" />
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Aadhar Back Image</label>
            <input type="file" name="aadhar_no_back_img" class="form-control preview_img" id="aadhar_no_back_img" accept="image/*">
            <img id="pan_no_img" style="width: 20%;" />
          </div>


          <div class="form-group">
            <label for="exampleInputEmail1">Gst No</label>
            <input type="text" name="gst_no" class="form-control" id="gst_no" placeholder="Enter gst no">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Gst Front Image</label>
            <input type="file" name="gst_no_front_img" class="form-control preview_img" id="gst_no_front_img" accept="image/*">
            <img id="pan_no_img" style="width: 20%;" />
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Gst Back Image</label>
            <input type="file" name="gst_no_back_img" class="form-control preview_img" id="gst_no_back_img" accept="image/*">
            <img id="pan_no_img" style="width: 20%;" />
          </div>
          
          <div class="form-group" style="display: none;">
            <label for="exampleInputEmail1">Sales Persones</label>
            <input type="text" name="sales_persone_id" class="form-control" id="sales_persone_id" value="{{$user_id}}">
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