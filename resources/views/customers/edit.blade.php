@extends('layouts.admin')

@section('content')
<div class="content-header"></div>
<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Customer</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
        <form action="{{ route('customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        @method('PUT')
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Client Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{$customer->name}}">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Billing Address</label>
            <input type="text" name="address" class="form-control" id="address" placeholder="Enter address" value="{{$customer->address}}">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Mobile</label>
            <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter mobile" value="{{$customer->mobile}}">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="Enter name" value="{{$customer->email}}">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Profile Image</label>
            <input type="file" name="profile_image" class="form-control preview_img" id="profile_image" accept="image/*">
            @if ($customer->profile_image!='')
              <img src="{{url($customer->profile_image)}}" id="pan_no_img" style="width: 20%;" />
            @else
              <img src="" id="pan_no_img" style="width: 20%;" />
            @endif
          </div>

         
          <div class="form-group">
             <label for="exampleInputEmail1">PAN Card No.</label>
            <input type="text" name="pan_no" class="form-control" id="pan_no" placeholder="Enter pan no" value="{{$customer->pan_no}}">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">PAN Card Front Image</label>
            <input type="file" name="pan_no_front_img" class="form-control preview_img" id="pan_no_front_img" accept="image/*">
            @if ($customer->pan_no_front_img!='')
              <img src="{{url($customer->pan_no_front_img)}}" id="pan_no_img" style="width: 20%;" />
             @else
              <img src="" id="pan_no_img" style="width: 20%;" />
            @endif
          </div>
          <!-- <div class="form-group">
            <label for="exampleInputEmail1">Pan Back Image</label>
            <input type="file" name="pan_no_back_img" class="form-control preview_img" id="pan_no_back_img" accept="image/*">
            @if ($customer->pan_no_back_img!='')
              <img src="{{url($customer->pan_no_back_img)}}" id="pan_no_img" style="width: 20%;" />
             @else
              <img src="" id="pan_no_img" style="width: 20%;" />
            @endif
          </div> -->

          <div class="form-group">
            <label for="exampleInputEmail1">Aadhar Card No</label>
            <input type="text" name="aadhar_no" class="form-control" id="aadhar_no" placeholder="Enter aadhar no" value="{{$customer->aadhar_no}}">
          </div>
           <div class="form-group">
            <label for="exampleInputEmail1">Aadhar Card Front Image</label>
            <input type="file" name="aadhar_no_front_img" class="form-control preview_img" id="aadhar_no_front_img" accept="image/*">
            @if ($customer->aadhar_no_front_img!='')
              <img src="{{url($customer->aadhar_no_front_img)}}" id="pan_no_img" style="width: 20%;" />
             @else
              <img src="" id="pan_no_img" style="width: 20%;" />
            @endif
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Aadhar Card Back Image</label>
            <input type="file" name="aadhar_no_back_img" class="form-control preview_img" id="aadhar_no_back_img" accept="image/*">
            @if ($customer->aadhar_no_back_img!='')
              <img src="{{url($customer->aadhar_no_back_img)}}" id="pan_no_img" style="width: 20%;" />
             @else
              <img src="" id="pan_no_img" style="width: 20%;" />
            @endif
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">GST No</label>
            <input type="text" name="gst_no" class="form-control" id="gst_no" placeholder="Enter gst no" value="{{$customer->gst_no}}">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">GST Front Image</label>
            <input type="file" name="gst_no_front_img" class="form-control preview_img" id="gst_no_front_img" accept="image/*">
            @if ($customer->gst_no_front_img!='')
              <img src="{{url($customer->gst_no_front_img)}}" id="pan_no_img" style="width: 20%;" />
            @endif
          </div>
          <!-- <div class="form-group">
            <label for="exampleInputEmail1">Gst Back Image</label>
            <input type="file" name="gst_no_back_img" class="form-control preview_img" id="gst_no_back_img" accept="image/*">
            @if ($customer->gst_no_back_img!='')
              <img src="{{url($customer->gst_no_back_img)}}" id="pan_no_img" style="width: 20%;" />
            @endif
          </div> -->

          <div class="form-group" style="display: none;">
            <label for="exampleInputEmail1">Sales Persones</label>
            <input type="text" name="sales_persone_id" class="form-control" id="sales_persone_id" value="{{$user_id}}" value="{{$customer->sales_persone_id}}">
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