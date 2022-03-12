<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('admin-lte-3.1.0-rc/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin-lte-3.1.0-rc/dist/css/adminlte.min.css') }}">

  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('admin-lte-3.1.0-rc/plugins/select2/css/select2.min.css') }}">

  <!--jquery-ui-->
  <link rel="stylesheet" href="{{ asset('admin-lte-3.1.0-rc/plugins/jquery-ui/jquery-ui.min.css') }}">


<style type="text/css">
.content-wrapper {
  min-height: 1000px !important;
}
.select2-selection__rendered {
    line-height: 31px !important;
}
.select2-container .select2-selection--single {
    height: 35px !important;
}
.select2-selection__arrow {
    height: 34px !important;
}
.modal-content {
    margin-top: 150px;
}
</style>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>


      @guest
        @if (Route::has('login'))
            <li class="nav-item d-none d-sm-inline-block">
              <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
        @endif
        
        @else
            <li class="nav-item d-none d-sm-inline-block">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        @endguest


    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('admin-lte-3.1.0-rc/dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('admin-lte-3.1.0-rc/dist/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('admin-lte-3.1.0-rc/dist/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('admin-lte-3.1.0-rc/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">CSM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('admin-lte-3.1.0-rc/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Hi {{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="{{ url('admin') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>


          @can('isAdministrator')
          <li class="nav-item">
            <a href="{{ url('admin/products') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Products
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/pricelists') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Price List
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/categories') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
          @endcan

          <li class="nav-item">
            <a href="{{ url('admin/orders') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Orders
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/transactions') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Transactions
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ url('admin/customers') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Customers
              </p>
            </a>
          </li>

          @can('isAdministrator')
          <li class="nav-item">
            <a href="{{ url('admin/users') }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          @endcan

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
     @yield('content')
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->


  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2020 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('admin-lte-3.1.0-rc/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin-lte-3.1.0-rc/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin-lte-3.1.0-rc/dist/js/adminlte.min.js') }}"></script>

<!-- Select2  -->
<script src="{{ asset('admin-lte-3.1.0-rc/plugins/select2/js/select2.min.js') }}"></script>

<!-- jquery-ui  -->
<script src="{{ asset('admin-lte-3.1.0-rc/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- table cell edit  -->
<script src="{{ asset('js/jquery-editable-table.min.js') }}"></script>



<!--model-->
<div class="modal fade" id="add-item" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Item</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <!---->
        <form id="csm_additem_form" method="post" action="http://127.0.0.1/array/csm/demo.php">
          {{ csrf_field() }}
          <div class="card-body" id="csm_item_append">
            <div class="row">
              <div class="col-10 csm_input_field" id="csm_input_field_0">
                <select class="csm_item_s_key" name="iten_data[0][product_id]" class="form-control"></select>
              </div>
              <div class="col-2">
                <input type="number" name="iten_data[0][qty]" value="1"  class="form-control">
              </div>
            </div>
          </div>
        </form>
        <!---->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_csm_additem_form">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="add-discount" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Discount</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <!---->
        <input type="number" name="discount" id="discount" value="" class="form-control">
        <!---->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_csm_add_discount_form">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="add-shipping" style="display: none;" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Shipping</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <!---->
        <input type="number" name="shipping" id="shipping" value="" class="form-control">
        <!---->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_csm_add_shipping_form">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!--end model-->


<script type="text/javascript">
  jQuery(document).ready(function(){

    var now = new Date();
    var dd = now.getDate();
    var mm = now.getMonth() + 1;
    var yy = now.getFullYear();
    var crr_date = `${dd}-${mm}-${yy}`;
    jQuery('#price_date').datepicker({dateFormat: 'dd-mm-yy'});
    jQuery("#price_date").datepicker("setDate", crr_date);


    jQuery("#from_date").datepicker({dateFormat: 'dd-mm-yy'});
    jQuery("#to_date").datepicker({dateFormat: 'dd-mm-yy'});

    jQuery('#product_id2').select2({
        width: '100%',
        placeholder : "Product" 
    });

    jQuery('#customer_id').select2({
        width: '100%',
        placeholder : "Customer" 
    });

    jQuery('#product_id').select2({
        width: '90%',
        placeholder : "Product" 
    });

  
    jQuery.fn.appendItemInputField = function() {

      var htm = '';
      var count = jQuery('#csm_item_append').find('.csm_input_field').length;
      htm = `
        <div class="row">
          <div class="col-10 csm_input_field" id="csm_input_field_${count}">
            <select class="csm_item_s_key" name="iten_data[${count}][product_id]" class="form-control"></select>
          </div>
          <div class="col-2">
            <input type="number" name="iten_data[${count}][qty]" value="1"  class="form-control">
          </div>
        </div>
      `;
      jQuery('#csm_item_append').append(htm);
    }

    //item search
    jQuery.fn.csm_item_search = function() {
      jQuery('.csm_item_s_key').select2({
        ajax: {
          url: "{{ url('orders/searchitem') }}",
          type: "POST",
          dataType: 'json',
          delay: 250, // delay in ms while typing when to perform a AJAX search
          data: function (params) {  
              return {
                searck_key: params.term, // search query
                _token: "{{ csrf_token() }}",
              };
          },
          processResults: function( data ) {  
            //console.log(data);
            //jQuery("#csm_item_s_key").select2('val', '0');
            var options = [];
            if ( data ) {
              jQuery.each( data, function( index, text ) { 
                options.push( { id: text.id, text: text.name  } );
              });
            }
            return {
              results: options
            };
        },
        cache: true
        },
        //minimumInputLength: 3, 
        width: '100%',
        placeholder : "Search for a product..." 
      });

      jQuery('.csm_item_s_key').on('select2:select', function (e) {
        var attr_id = jQuery('.csm_item_s_key').val();
        jQuery(this).appendItemInputField();
        jQuery(this).csm_item_search();
      });
    }
    jQuery(this).csm_item_search();

    //append selected item main fram
    jQuery.fn.csm_item_html = function(res){
      var htm = '';
      if (res.iten_data.length > 0) { //iten_data, items
        jQuery(res.iten_data).each(function(key, val){
            htm += `
            <tr id="item_${val.id}" class="items">
                <td>${val.name}
                <input type="hidden" name="iten_data[${key}][id]" value="${val.id}">
                <input type="hidden" name="iten_data[${key}][product_id]" value="${val.product_id}">
                </td>
                <td>${val.price} <input type="hidden" name="iten_data[${key}][price]" value="${val.price}"></td>
                <td><input type="number" class="itemqty" data-prodid="${val.id}" name="iten_data[${key}][qty]" value="${val.qty}" style="width:60px;"></td>
                <td>${val.line_subtotal} <input type="hidden" name="iten_data[${key}][line_subtotal]" value="${val.line_subtotal}"></td>
                <td><a href="#" class='csm_remove_item' data-product_id='${val.id}'>X</a></td>
            </tr>
            `;
        });
        jQuery('#csm_items_body').html(htm);
        jQuery('#subtotal_label').text(res.subtotal);
        jQuery('#subtotal').val(res.subtotal);
      }
    }

    //Submit selected items
    jQuery("#csm_additem_form").on('submit',(function(e) { 
      e.preventDefault();
      jQuery.ajax({
        url: "{{ url('orders/additem') }}",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        processData:false,
        beforeSend: function(){
        },
        complete: function(){
        },
        success: function(data){
          //console.log(data);
          jQuery(this).csm_item_html(data);
          jQuery('#add-item').modal('hide');
        },
        error: function(xhr, status, error) {
          var err = eval("(" + xhr.responseText + ")");
          alert(err.Message);
        }          
      });
    }));
    jQuery(document).on('click', '#btn_csm_additem_form', function (e) {
        e.preventDefault();
        jQuery("#csm_additem_form").submit();
    });
 
    //Remove item
    jQuery(document).on('click', '.csm_remove_item', function (e) {
        e.preventDefault();
        htm = `
          <tr id="item_0" class="items">
              <td>
              <input type="hidden" name="iten_data" value="">
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
          </tr>
          `;
        var product_id = jQuery(this).attr('data-product_id');
        jQuery('#item_'+product_id).remove();
        var items_count = jQuery('.items').length;
        if (items_count == 0) {
            jQuery('#csm_items_body').html(htm).hide();
        }
    });

    //Add diacount
    jQuery(document).on('click', '#btn_csm_add_discount_form', function (e) {
        e.preventDefault();
        var discount = jQuery('#discount').val();
        var htm = `
            <tr>
              <td></td>
              <td></td>
              <th>
                Discount <span id="discount_label">${discount}</span>% 
                <a href="#" id="remove_discount">Remove</a> 
                <input type="hidden" name="discount" id="discount" value="${discount}">
              </th>
              <td>
                (-)<span id="discount_price_label">0</span> 
                <input type="hidden" name="discount_price" value="0">
              </td>
            </tr>
        `;
        console.log('discount: ', discount);
        jQuery('#csm_item_discount_body').html(htm).show();
        jQuery('#add-discount').modal('hide');
    });

    //Remove diacount
    jQuery(document).on('click', '#remove_discount', function (e) {
        e.preventDefault();
        var htm = `
          <tr>
            <td></td>
            <td></td>
            <th>Discount 0% <input type="hidden" name="discount" value="0"></th>
            <td>(-)0 <input type="hidden" name="discount_price" value="0"></td>
          </tr>
        `;
        jQuery('#csm_item_discount_body').html(htm).hide();
        jQuery('#add-discount').modal('hide');

    });

    //Add shipping
    jQuery(document).on('click', '#btn_csm_add_shipping_form', function (e) {
        e.preventDefault();
        var shipping = jQuery('#shipping').val();
        var htm = `
            <tr>
              <td></td>
              <td></td>
              <th>Shipping <a href="#" id="remove_shipping">Remove</a></th>
              <td><span id="shipping_label">${shipping}</span> <input type="hidden" name="shipping" id="shipping" value="${shipping}"></td>
            </tr>
        `;
       
        console.log('shipping: ', shipping);
        jQuery('#csm_item_shipping_body').html(htm).show();
        jQuery('#add-shipping').modal('hide');
    });

    //Remove shipping
    jQuery(document).on('click', '#remove_shipping', function (e) {
        e.preventDefault();
        var htm = `
            <tr>
              <td></td>
              <td></td>
              <th>Shipping</th>
              <td>0 <input type="hidden" name="shipping" value="0"></td>
            </tr>
        `;
        jQuery('#csm_item_shipping_body').html(htm).hide();
        jQuery('#add-shipping').modal('hide');
    });

    //Calculate
    jQuery(document).on('click', '#calculate_cart_btn', function(){
      var fd = new FormData();
      var other_data = jQuery('#csm_order_form').serializeArray();
      jQuery.each(other_data,function(key,input){ //_method
          if (input.name != '_method') {
            fd.append(input.name,input.value);
          }else{
            console.log('excluded key _method: ', input.name);
          }
      });
      jQuery.ajax({
        url: "{{ url('orders/calculate_order') }}",
        type: "POST",
        data:  fd,
        contentType: false,
        processData:false,
        beforeSend: function(){
        },
        complete: function(){
        },
        success: function(data){
          console.log(data);
          jQuery(this).csm_item_html(data);

          jQuery('#subtotal').val(data.subtotal);
          jQuery('#subtotal_label').text(data.subtotal);

          jQuery('#discount').val(data.discount);
          jQuery('#discount_label').text(data.discount);

          jQuery('#discount_price').val(data.discount_price);
          jQuery('#discount_price_label').text(data.discount_price);

          jQuery('#shipping').val(data.shipping);
          jQuery('#shipping_label').text(data.shipping);

          jQuery('#total').val(data.total);
          jQuery('#total_label').text(data.total);
        },
        error: function(xhr, status, error) {
          var err = eval("(" + xhr.responseText + ")");
          alert(err.Message);
        }          
      });
    });
    //End Calculate

    //Preview images
    jQuery('.preview_img').change( function(event) {
      var target = jQuery(this);
      var file_url =  URL.createObjectURL(event.target.files[0]);
      console.log(file_url);
      target.next().attr('src',file_url );
    });



  });
</script>


<script>
  var loadFile_pan_no = function(event) {
    var pan_no_img = document.getElementById('pan_no_img');
    pan_no_img.src = URL.createObjectURL(event.target.files[0]);
  };
  var loadFile_aadhar_no = function(event) {
    var aadhar_no_img = document.getElementById('aadhar_no_img');
    aadhar_no_img.src = URL.createObjectURL(event.target.files[0]);
  };
  var loadFile_gst_no = function(event) {
    var gst_no_img= document.getElementById('gst_no_img');
    gst_no_img.src = URL.createObjectURL(event.target.files[0]);
  };
</script>

</body>
</html>