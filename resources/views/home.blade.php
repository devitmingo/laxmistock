@extends('layout.app')
@section('content')

<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-bars"></i> Dashboard <small>Welcome, Admin!</small></h5>
       
    </div>
    <!-- /page title -->

    
   

<style>
    a{
        color:black;
    }
    .shadow-lg{
        height:160px;
       
    }
    .fontawesome-list > .row > div > div {
        margin-bottom :14px !important;;
    }

    </style>
 
    <div class="panel panel-default">
                <div class="panel-body">

                    <div class="fontawesome-list widget">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="card shadow-lg mb-4">
                                    <div class="card-body">
                                        <center>
                                    <a href="{{ route('sales.create') }}">
                                    
                                        <i class="fa fa-plus-circle" aria-hidden="true" style="font-size:70px;"></i>
                                        <h1>Add Sale</h1>
                                    </a>
                                    </center>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <center>
                                    <a href="{{ route('sales.index') }}">
                                    
                                        <i class="fa fa-list-alt" aria-hidden="true" style="font-size:70px;"></i>
                                        <h1>Sale List</h1>
                                    </a>
                                    </center>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <center>
                                    <a href="{{ route('purchase.create') }}">
                                    
                                        <i class="fa fa-cart-plus" aria-hidden="true" style="font-size:70px;"></i>
                                        <h1>Add Purchase</h1>
                                    </a>
                                    </center>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <center>
                                    <a href="{{ route('purchase.index') }}">
                                    
                                        <i class="fa fa-list-alt" aria-hidden="true" style="font-size:70px;"></i>
                                        <h1>Purchase List</h1>
                                    </a>
                                    </center>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <center>
                                    <a href="{{ route('supplierPayment.create') }}">
                                    
                                        <i class="fa fa-cart-plus" aria-hidden="true" style="font-size:70px;"></i>
                                        <h1>Add Supplier Payment</h1>
                                    </a>
                                    </center>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <center>
                                    <a href="{{ route('supplierPayment.index') }}">
                                    
                                        <i class="fa fa-list-alt" aria-hidden="true" style="font-size:70px;"></i>
                                        <h1> Supplier Payment List</h1>
                                    </a>
                                    </center>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-2">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <center>
                                    <a href="{{ route('customerPayment') }}">
                                    
                                        <i class="fa fa-user" aria-hidden="true" style="font-size:70px;"></i>
                                        <h1>Add Customer Payment</h1>
                                    </a>
                                    </center>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <center>
                                    <a href="{{ route('customerPaymentIndex') }}">
                                    
                                        <i class="fa fa-list-alt" aria-hidden="true" style="font-size:70px;"></i>
                                        <h1> Customer Payment List</h1>
                                    </a>
                                    </center>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <center>
                                    <a href="{{ route('expenses.create') }}">
                                    
                                        <i class="fa fa-credit-card" aria-hidden="true" style="font-size:70px;"></i>
                                        <h1>Add Expensess</h1>
                                    </a>
                                    </center>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <center>
                                    <a href="{{ route('expenses.index') }}">
                                    
                                        <i class="fa fa-list-alt" aria-hidden="true" style="font-size:70px;"></i>
                                        <h1> Expensess List</h1>
                                    </a>
                                    </center>
                                    </div>
                                </div>
                            </div>    
                            
                            <div class="col-md-2">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <center>
                                    <a href="{{ route('incomeCreate') }}">
                                    
                                        <i class="fa fa-money" aria-hidden="true" style="font-size:70px;"></i>
                                        <h1>Add Income</h1>
                                    </a>
                                    </center>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <center>
                                    <a href="{{ route('incomeIndex') }}">
                                    
                                        <i class="fa fa-list-alt" aria-hidden="true" style="font-size:70px;"></i>
                                        <h1> Income List</h1>
                                    </a>
                                    </center>
                                    </div>
                                </div>
                            </div>   
                            
                            
                            <div class="col-md-2">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <center>
                                    <a href="{{ route('companyLedger') }}">
                                    
                                        <i class="fa fa-book" aria-hidden="true" style="font-size:70px;"></i>
                                        <h1>Company Ledger</h1>
                                    </a>
                                    </center>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <center>
                                    <a href="{{ route('saleLedger') }}">
                                    
                                        <i class="fa fa-book" aria-hidden="true" style="font-size:70px;"></i>
                                        <h1> Supplier Ledger</h1>
                                    </a>
                                    </center>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="col-md-2">
                                <div class="card shadow-lg">
                                    <div class="card-body">
                                        <center>
                                    <a href="{{ route('purchaseLadger') }}">
                                    
                                        <i class="fa fa-book" aria-hidden="true" style="font-size:70px;"></i>
                                        <h1> Customer Ledger</h1>
                                    </a>
                                    </center>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                   

                </div>
            </div>

 



    <!-- Footer -->
    <div class="footer">
        &copy; Copyright 2011. All rights reserved. Powered by <a href="#" title="">Codaxo Information Technology</a>
    </div>
    <!-- /footer -->

</div>

@endsection