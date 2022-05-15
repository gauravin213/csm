@extends('layouts.admin')

@section('content')


<style type="text/css">
a.pre_item {
    float: right;
}

@media screen {
  
}
@media print {

  @page{ 
      size: auto; /* auto is the initial value */ 
      /* this affects the margin in the printer settings */ 
      margin: 15mm 15mm 15mm 15mm;  /*top left bottom right*/
  } 

  body{ 
      /* this affects the margin on the content before sending to printer */ 
      /*margin: 0px;  */
  }

  footer.main-footer {
      display: none;
  }
  .pre_itemx {
      display: none;
  }
  aside.main-sidebar.sidebar-dark-primary.elevation-4{
    display: none;
  }
  nav.main-header.navbar.navbar-expand.navbar-white.navbar-light{
    display: none;
  }
  a.btn.btn-primary.back-btn {
      display: none;
  }
  
}
</style>
<script type="text/javascript">
  function printDiv(divName) {
    window.print();
  }
</script>


<div class="content-header"></div>
<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Order Info</h3>
      </div>
      <div class="card-body">
        
      <div class="card-body table-responsive p-0">

         <div class="form-group">
            <a class="btn btn-primary back-btn" href="{{ URL::previous() }}">Go Back</a>
         </div>

        <div class="form-group pre_itemx">
          <a class="pre_item" href="javascript://" onclick="printDiv('printableArea')">Print</a>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Order Details</label>
          <table class="table table-hover text-nowrap">
          <tbody>
            <tr>
              <th>Sales Man(placed by)</th>
              <td>{{$order->user->name}}</td>
            </tr>
            <tr>
              <th>Customer Name</th>
              <td>{{$order->customer->name}}</td>
            </tr>
            <tr>
              <th>Balance Amount</th>
              <td>{{$order->balance_amount}}</td>
            </tr>
          </tbody>
         </table>
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">Items</label>
          <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Qty</th>
            <th>Subtotal</th>
          </tr>
        </thead>
        <tbody>
        @foreach($order->items as $item)
        <tr>
          <td>{{$item->name}}</td>
          <td>
            @if($item->item_discount && $item->item_discount_price)
              <span style="text-decoration: line-through;">{{$item->price}}</span> - <span>{{$item->item_discount_price}}</span></td>
            @else
              <span>{{$item->price}}</span>
            @endif
          </td>
          <td>{{$item->item_discount}}</td>
          <td>{{$item->qty}}</td>
          <td>{{$item->line_subtotal}}</td>
        </tr>
        @endforeach
        </tbody>

        <tbody>
          @if($order->discount && $order->discount_price)
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <th>Discount(%{{$order->discount}})</th>
            <td>{{$order->discount_price}}</td>
          </tr>
          @endif
          
          @if($order->shipping)
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <th>Shipping</th>
            <td>{{$order->shipping}}</td>
          </tr>
          @endif
          
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <th>Total</th>
            <td>{{$order->total}}</td>
          </tr>
        </tbody>
       </table>
      </div>

        <style type="text/css">
        #trans td {
            width: 20%;
        }
        #trans .receipt_img{
          width: 50%;
        }
        </style>
        
       <div class="form-group">
          <label for="exampleInputEmail1">Transactions</label>
          <table class="table table-hover text-nowrap" id="trans">
            <thead>
              <tr>
                <th>Paid Amount</th>
                <th>Ballance Amount</th>
                <th>Mode of Payment</th>
                <th>Remark</th>
                <th>Receipt</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              @foreach($order->transaction as $transaction)
              <tr>
                <td>{{$transaction->paid_amount}}</td>
                <td>{{$transaction->ballance_amount}}</td>
                <td>{{$transaction->mode_of_payment}}</td>
                <td>{{$transaction->remark}}</td>
                <td>
                  <div>
                    @if ($transaction->upload_receipt!='')
                   
                    <a href="{{url($transaction->upload_receipt)}}" data-toggle="lightbox" data-title="Receipt Image" data-gallery="gallery">
                       <img src="{{url($transaction->upload_receipt)}}" class="receipt_img"/>
                    </a>
                    @else
                      N/A
                    @endif
                    </div>
                </td>
                <td>{{$transaction->created_at}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>


      </div>
              
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection