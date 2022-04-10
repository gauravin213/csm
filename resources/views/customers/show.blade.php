@extends('layouts.admin')

@section('content')
<div class="content-header"></div>
<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Customer Details</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body card-body table-responsive p-0">

        <table class="table table-hover text-nowrap">
          <tbody>
            <tr>
              <td> <a class="btn btn-primary back-btn" href="{{ URL::previous() }}">Go Back</a></td>
              <td></td>
            </tr>
            <tr>
              <th>Client Name</th>
              <td>{{$customer->name}}</td>
            </tr>
            <tr>
              <th>Company Name</th>
              <td>{{$customer->company_name}}</td>
            </tr>
            @if($crr_user->user_type == 'administrator')
            <tr>
              <th>Credit Limit</th>
              <td>{{$customer->credit_limit}}</td>
            </tr>
            @endif
            <tr>
              <th>Billing Address</th>
              <td>{{$customer->address}}</td>
            </tr>
            <tr>
              <th>Mobile</th>
              <td>{{$customer->mobile}}</td>
            </tr>
            <tr>
              <th>Email</th>
              <td>{{$customer->email}}</td>
            </tr>
            <tr>
              <th>Profile Image</th>
              <td>
                @if ($customer->profile_image!='')
                  <img src="{{url($customer->profile_image)}}" id="pan_no_img" style="width: 20%;" />
                @else
                  <img src="" id="pan_no_img" style="width: 20%;" />
                @endif
              </td>
            </tr>
            <tr>
              <th>PAN Card No.</th>
              <td>{{$customer->pan_no}}</td>
            </tr>
            <tr>
              <th>PAN Card Front Image</th>
              <td>
                @if ($customer->pan_no_front_img!='')
                  <img src="{{url($customer->pan_no_front_img)}}" id="pan_no_img" style="width: 20%;" />
                 @else
                  <img src="" id="pan_no_img" style="width: 20%;" />
                @endif
              </td>
            </tr>
            <tr>
              <th>Aadhar Card No</th>
              <td>{{$customer->aadhar_no}}</td>
            </tr>
            <tr>
              <th>Aadhar Card Front Image</th>
              <td>
                @if ($customer->aadhar_no_front_img!='')
                  <img src="{{url($customer->aadhar_no_front_img)}}" id="pan_no_img" style="width: 20%;" />
                 @else
                  <img src="" id="pan_no_img" style="width: 20%;" />
                @endif
              </td>
            </tr>
            <tr>
              <th>Aadhar Card Back Image</th>
              <td>
                @if ($customer->aadhar_no_back_img!='')
                  <img src="{{url($customer->aadhar_no_back_img)}}" id="pan_no_img" style="width: 20%;" />
                 @else
                  <img src="" id="pan_no_img" style="width: 20%;" />
                @endif
              </td>
            </tr>
            <tr>
              <th>GST No</th>
              <td>{{$customer->gst_no}}</td>
            </tr>
            <tr>
              <th>GST Front Image</th>
              <td>
                @if ($customer->gst_no_front_img!='')
                  <img src="{{url($customer->gst_no_front_img)}}" id="pan_no_img" style="width: 20%;" />
                @else
                  <img src="" id="pan_no_img" style="width: 20%;" />
                @endif
              </td>
            </tr>
            <tr>
              <th>Gst Back Image</th>
              <td>
                @if ($customer->gst_no_back_img!='')
                  <img src="{{url($customer->gst_no_back_img)}}" id="pan_no_img" style="width: 20%;" />
                @else
                  <img src="" id="pan_no_img" style="width: 20%;" />
                @endif
              </td>
            </tr>
            <tr>
              <th>Gst Third Image</th>
              <td>
                @if ($customer->gst_no_third_img!='')
                  <img src="{{url($customer->gst_no_third_img)}}" id="pan_no_img" style="width: 20%;" />
                 @else
                  <img src="" id="pan_no_img" style="width: 20%;" />
                @endif
              </td>
            </tr>

            @if(is_object($customer->user))
            <tr>
              <th>Sales Persones</th>
              <td>{{$customer->user->name}}</td>
            </tr>
            @endif

          </tbody>
        </table>

      
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection