<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ asset('public/cdn/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('public/cdn/css/brain-theme.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('public/cdn/css/styles.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Cuprum' rel='stylesheet' type='text/css'>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/charts/flot.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/charts/flot.orderbars.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/charts/flot.pie.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/charts/flot.time.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/charts/flot.animator.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/charts/excanvas.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/charts/flot.resize.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/forms/uniform.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/forms/select2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/forms/inputmask.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/forms/autosize.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/forms/inputlimit.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/forms/listbox.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/forms/multiselect.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/forms/validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/forms/tags.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/forms/uploader/plupload.full.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/forms/uploader/plupload.queue.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/forms/wysihtml5/wysihtml5.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/forms/wysihtml5/toolbar.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/interface/jgrowl.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/interface/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/interface/prettify.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/interface/fancybox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/interface/colorpicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/interface/timepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/interface/fullcalendar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/plugins/interface/collapsible.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/cdn/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/cdn/js/application.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/cdn/js/charts/simple_graph.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	

<style>
    .select-search{
        width: 100%!important;
    }

    <style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

</style>

</head>

<body>
    

    <!-- Navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <div class="hidden-lg pull-right">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-right">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-chevron-down"></i>
                    </button>

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar">
                        <span class="sr-only">Toggle sidebar</span>
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <ul class="nav navbar-nav navbar-left-custom">
                    <li class="user dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <!--<img src="{{ asset('public/cdn/images/demo/users/face6.png') }}" alt="">-->
                            <span>Admin</span>
                            <i class="caret"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <!--<li><a href="#"><i class="fa fa-user"></i> Profile</a></li>-->
                            <!--<li><a href="#"><i class="fa fa-tasks"></i> Tasks</a></li>-->
                            <!--<li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>-->
                            <li><a href="{{ route('user.logout') }}"><i class="fa fa-mail-forward"></i> Logout</a></li>
                        </ul>
                    </li>
                    <li><a class="nav-icon sidebar-toggle"><i class="fa fa-bars"></i></a></li>
                </ul>
            </div>

            <ul class="nav navbar-nav navbar-right collapse" id="navbar-right">
                <!--<li>-->
                <!--    <a href="#">-->
                <!--        <i class="fa fa-rotate-right"></i>-->
                <!--        <span>Updates</span>-->
                <!--        <strong class="label label-danger">15</strong>-->
                <!--    </a>-->
                <!--</li>-->

                <!--<li>-->
                <!--    <a href="#">-->
                <!--        <i class="fa fa-comments"></i>-->
                <!--        <span>Messages</span>-->
                <!--        <strong class="label label-danger">7</strong>-->
                <!--    </a>-->
                <!--</li>-->

                <!--<li>-->
                <!--    <a href="#">-->
                <!--        <i class="fa fa-tasks"></i>-->
                <!--        <span>Notifications</span>-->
                <!--    </a>-->
                <!--</li>-->
            </ul>
        </div>
    </div>
    <!-- /navbar -->


    <!-- Switches -->
    <!--<div class="color-switch">-->
    <!--    <a href="https://demo.interface.club/itsbrain/liquid/dark/index.html" title="Switch to dark verion"></a>-->
    <!--</div>-->

    <!--<div class="layout-switch">-->
    <!--    <a href="https://demo.interface.club/itsbrain/fixed/light/index.html" title="Switch to fixed verion"></a>-->
    <!--</div>-->
    <!-- /switches -->


    <!-- Page header -->
    <div class="container-fluid">
        <div class="page-header">
            <div class="logo"><a href="{{ url('/') }}" title=""><h2>Mohan Enterprises</h2></a></div>
            <ul class="middle-nav">
                <li><a href="#" class="btn btn-default"><h4 id="openingBalance"></h4> <span>Opeing Balance</span></a></li>
                <li><a href="#" class="btn btn-default"><h4 id="closeBalance"></h4> <span>Closing Balance</span></a></li>
                <li><a href="#" class="btn btn-default"><h4 id="total_sale"></h4> <span>Total Today Sale</span></a></li>
                <li><a href="#" class="btn btn-default"><h4 id="total_purchase"></h4> <span>Total Today Purchase</span></a></li>
                <li><a href="#" class="btn btn-default"><h4 id="total_expenses"> </h4><span>Total Today Expenses</span></a></li>
                <!-- <li><a href="#" class="btn btn-default"><h4 id="total_expenses"> </h4><span>Total Today Expenses</span></a><div class="label label-info">9</div></li> -->
                <li><a href="#" class="btn btn-default"><h4 id="total_income"> </h4><span>Total Today Income</span></a></li>
                <li><a href="#" class="btn btn-default"><h4 id="total_supplier_pay"> </h4><span>Total Today Supplier Payment</span></a></li>
                <li><a href="#" class="btn btn-default"><h4 id="total_customer_pay"> </h4><span>Total Today Customer Pay</span></a></li>
                
            </ul>
        </div>
    </div>
    <!-- /page header -->

    <script>

function getInfo(){
  $.ajax({
  type:'GET',
  url:'{{ url("getInfo") }}',
  success:function(response){
    var x = JSON.parse(response);
            console.log(x);
            $("#openingBalance").html(x.openingBalance);
            $("#closeBalance").html(x.closeBalance);
            $("#total_sale").html(x.total_sale);
            $("#total_purchase").html(x.total_purchase);
            $("#total_expenses").html(x.total_expenses);
            $("#total_income").html(x.total_income);
            $("#total_customer_pay").html(x.total_customer_pay);
            $("#total_supplier_pay").html(x.total_supplier_pay);
            
     
  }
  });
}   
//onload rung party function
getInfo();
</script>
    <!-- Page container -->
    <div class="page-container container-fluid">
    	
    	<!-- Sidebar -->
        <div class="sidebar collapse">
        	<ul class="navigation">
            	<li class="active"><a href="{{ url('/') }}"><i class="fa fa-laptop"></i> Dashboard</a></li>
               <li>
                    <a href="#" class="expand"><i class="fa fa-align-justify"></i> Master</a>
                    <ul>
                        <li><a href="{{ route('company.index') }}">Add Company</a></li>
                        <li><a href="{{ route('session.index') }}">Add Session</a></li>
                        <li><a href="{{ route('category.index') }}">Add Category</a></li>
                        <li><a href="{{ route('sub-category.index') }}">Add Sub Category</a></li>
                        <li><a href="{{ route('unit.index') }}">Add Unit</a></li>
                        <li><a href="{{ route('paymentType.index') }}">Add Payment Type</a></li>
                        <li><a href="{{ route('product.index') }}">Add Product</a></li>
                        <li><a href="{{ route('head.index') }}">Add Head</a></li>
                        <li><a href="{{ route('party.index') }}">Add Party</a></li>
                        
                     </ul>
                </li>


                <li>
                    <a href="#"  class="expand"><i class="fa fa-align-justify"></i> Purchase</a>
                    <ul>
                        <li><a href="{{ route('purchase.create') }}">Add Purchase</a></li>
                        <li><a href="{{ route('purchase.index') }}">Purchase List</a></li>
                     </ul>
                </li>

                <li>
                    <a href="#"  class="expand"><i class="fa fa-align-justify"></i> Sales</a>
                    <ul>
                        <li><a href="{{ route('sales.create') }}">Add Sales</a></li>
                        <li><a href="{{ route('sales.index') }}">Sales List</a></li>
                     </ul>
                </li>
                <li>
                    <a href="#" class="expand"><i class="fa fa-align-justify"></i> Payments</a>
                    <ul>
                        <li><a href="{{ route('supplierPayment.create') }}">Add Supplier Payment</a></li>
                        <li><a href="{{ route('supplierPayment.index') }}">Supplier Payments List</a></li>
                        <li><a href="{{ route('customerPayment') }}">Add Customer Payment</a></li>
                        <li><a href="{{ route('customerPaymentIndex') }}">Customer Payment List</a></li>
                     </ul>
                </li>

                <li>
                    <a href="#" class="expand"><i class="fa fa-align-justify"></i> Acconts</a>
                    <ul>
                        <li><a href="{{ route('expenses.create') }}">Add Expenses</a></li>
                        <li><a href="{{ route('expenses.index') }}">Expenses List</a></li>
                        <li><a href="{{ route('incomeCreate') }}">Add income</a></li>
                        <li><a href="{{ route('incomeIndex') }}">Income List</a></li>
                     </ul>
                </li>
                <li>
                    <a href="#" class="expand"><i class="fa fa-align-justify"></i> Quotation</a>
                    <ul>
                        <li><a href="{{ route('quatation.create') }}">Add Quotation</a></li>
                        <li><a href="{{ route('quatation.index') }}">Quotation List</a></li>
                     </ul>
                </li>
                
                <li>
                    <a href="#" class="expand"><i class="fa fa-align-justify"></i> Reports</a>
                    <ul>
                        <li><a href="{{ route('profitLossStatement') }}">Profit Loss Statement</a></li>
                        <li><a href="{{ route('productMinStocks') }}">Product Min Stocks</a></li>
                        <li><a href="{{ route('companyLedger') }}">Company Legder</a></li>
                        <li><a href="{{ route('saleLedger') }}">Supplier Report</a></li>
                        <li><a href="{{ route('purchaseLadger') }}">Customer Report</a></li>
                     </ul>
                </li>
                
          
            </ul>
        </div>
        <!-- /sidebar -->

    
        <!-- Page content -->
        @yield('content')
        
    </div>

</body>

</html>
