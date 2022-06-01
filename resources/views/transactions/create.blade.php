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
        <h3 class="card-title">Add Transaction</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
        <form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="card-body">

          <div class="form-group">
            <a class="btn btn-primary back-btn" href="{{ URL::previous() }}">Go Back</a>
         </div>

          <div class="form-group" id="customer_info">
            <h5>Customer Info</h5>
            <div>
               <label>Name: </label> <span>{{$order->customer->name}}</span> 
            </div>

            <div>
              <label>Company: </label><span>{{$order->customer->company_name}}</span> 
            </div>

            <div>
              <label style="color: green;">Wallet: </label>
              <span id="total_fund_text">{{$order->customer->total_fund}}</span> 
              @if($order->customer->total_fund != 0)
                (Use wallet) <input type="checkbox" name="total_fund_enable" id="total_fund_enable" value="yes"> 
              @endif
            </div>

            <div>
              <label>Order Total: </label><span>{{$order->total}}</span> 
            </div>
          </div>

          <div class="form-group" id="trans_summry" style="display: none;">
            <h5>Payment Summry</h5>
            <div>
              <label>Case: </label><span id="case_mode"></span> 
            </div>
            <div>
               <label>Condition: </label><span id="case_cond"></span> 
            </div>
            <div>
              <label>Wallet: </label><span id="update_wallet"></span> 
            </div>
            <div>
              <label>To pay: </label><span id="to_pay"></span> 
            </div>
             <div>
              <label>Balance amount: </label><span id="balance_amount">0</span> 
            </div>
          </div>

          <!-- <div>
            <label>Enter amount: </label> <input type="text" name="enter_amount" id="enter_amount">
          </div> -->

          <!-- <div>
            <button type="button" id="tras_summry_calculate_btn" class="btn btn-default btn-sm">Re calculate</button>
          </div> -->





          <!--hidden-->
          <input type="hidden" name="order_id"  value="{{$order->id}}">
          <input type="hidden" name="order_total" id="order_total" value="{{$order->total}}">
          <input type="hidden" name="customer_id" value="{{$order->customer->id}}">
          <input type="hidden" name="wallet_amount" id="wallet_amount" value="{{$order->customer->total_fund}}">
          <input type="hidden" name="placed_by"  value="{{$user_id}}">

          <input type="hidden" name="to_pay_x" id="to_pay_x"  value="">
          <input type="hidden" name="balance_amount_x" id="balance_amount_x"  value="">
          <input type="hidden" name="update_wallet_x" id="update_wallet_x"  value="">
          <!--hidden-->

          <!-- <div class="form-group">
            <label for="exampleInputEmail1" style="color: green;">
            Advance Payment Amount: <span id="total_fund_text">{{$order->customer->total_fund}}</span> 
            <input type="hidden" name="total_fund" id="total_fund" value="{{$order->customer->total_fund}}">
            <input type="checkbox" name="total_fund_enable" id="total_fund_enable" value="yes">
            </label>
          </div> -->

         <!--  <div class="form-group">
            <label for="exampleInputEmail1">Order Id</label>
            <input type="text" name="order_id" class="form-control" id="order_id" placeholder="Enter order_id" value="{{(isset($_GET['order_id'])) ? $_GET['order_id'] : ''}}">

            <input type="hidden" name="customer_id" class="form-control" id="customer_id2" placeholder="Enter customer_id" value="{{(isset($_GET['customer_id'])) ? $_GET['customer_id'] : ''}}">
            <input type="hidden" name="placed_by" class="form-control" id="placed_by" placeholder="Enter placed_by" value="{{(isset($_GET['placed_by'])) ? $_GET['placed_by'] : ''}}">
          </div> -->

          <div class="form-group">
            <label for="exampleInputEmail1">Paid Amount</label>
            <input type="text" name="paid_amount" class="form-control" id="paid_amount" placeholder="Enter Amount" value="">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Mode Of Payment</label>
            <select name="mode_of_payment" class="form-control" id="mode_of_payment">
              <option value="">select</option>
              <option value="Cash">Cash</option>
              <option value="Cheque">Cheque</option>
              <option value="RTGS">RTGS</option>
              <option value="NEFT">NEFT</option>
              <option value="IMPS">IMPS</option>
              <option value="DD">DD</option>
              <option value="UPI">UPI</option>              
            </select>
          </div>

           <div class="form-group">
            <label for="exampleInputEmail1">Upload Receipt</label>
            <input type="file" name="upload_receipt" class="form-control preview_img" id="upload_receipt" accept="image/*">
            <img src="" id="pan_no_img" style="width: 20%;" />
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Remark/Note</label>
            <textarea name="remark" class="form-control" id="remark" placeholder="Specify Cheque Date/Transaction ID Of Payment"></textarea>
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