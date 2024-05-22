@extends('layout.app')

@section('content')

<?php 
use \App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
?>
<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-table"></i> Profit Loss Statement </h5>        
    </div>
    <!-- /page title -->

<x-alert/>

    <div class="panel panel-default">
        <div class="panel-heading"><h6 class="panel-title">Profit Loss Statement</h6></div>
        <div class="panel panel-default">
            <div class="panel-body">
            <form>
                <div class="form-group">
                    <div class="col-sm-2"> From Date :
                    <input class="form-control" data-mask="99-99-9999" value="{{ old('fromDate',isset($fromDate) ? date('d-m-Y',strtotime($fromDate)) : '') }}" type="text" name="fromDate" id="date"  >
                    
                   
                    </div>
                    <div class="col-sm-2"> To Date : 
                    <input class="form-control" data-mask="99-99-9999" value="{{ old('toDate',isset($toDate) ? date('d-m-Y',strtotime($toDate)) : '') }}" type="text" name="toDate" id="date"  >
                    
                   
                    </div>

                    <div class="col-sm-2"> Product : 
                             <select data-placeholder="Choose a Product" class="select-search" name="product" id="product" tabindex="2">
                                    <option value="">select</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                             </select>
                             <script>document.getElementById("product").value = "<?php if(isset($_GET['product'])){ echo $_GET['product']; } ?>"; </script>
                              
                    </div>
                    <div class="col-sm-2">
                    </br>
                    <button id="AddBTN" class="form-control btn btn-default" type="submit" >Search</button>
                               
                   
                    </div>
                </div>
            </form>
       </div>
       </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>SNO.</th>
                        <th>Date</th>
                        <th>Product Name</th>
                        <th>Buy Rate</th>
                        <th>Sale Rate</th>
                        <th>Qty</th>
                        <th>Sale Amount</th>
                        <th>Buy Amount</th>
                        <th>Profit Amount</th>
                    </tr>
                </thead>
                <tbody>
                  
                    @php 
                    $grandTotal = 0;
                    $grandProfit = 0;
                    @endphp
                    @foreach($records as $row)
                    @php 
                    $grandTotal += $row->total;
                    $grandProfit += $row->profit;
                    $get =  CommonController::getValue('products',$row->product_id);
                    @$sumBuyAmount += $row->qty*$row->buyRate;
                    @endphp
                       <tr>
                            <td>{{ $loop->index +1  }}</td>
                            <td>{{ date('d-m-Y',strtotime($row->date)) }}</td>
                            <td>
                               {{ $get[0]->name }}
                            </td>
                         
                            <td style="text-align:right;">{{ $row->buyRate }}</td>
                            <td style="text-align:right;">{{ $row->saleRate }}</td>
                            <td style="text-align:right;">{{ $row->qty }}</td>
                            <td style="text-align:right;">{{ $row->total }}</td>
                            <td style="text-align:right;">{{ $row->qty*$row->buyRate }}</td>
                            <td style="text-align:right;">{{ $row->profit }}</td>
                           
                       </tr>

                    @endforeach
                    <tr>
                        
                        <th colspan="6" style="text-align:right;" >Total </th>
                       
                        <th style="text-align:right;">{{ $grandTotal }}  </th>
                        <th style="text-align:right;">{{ $sumBuyAmount }}  </th>
                        <th style="text-align:right;">{{ $grandProfit }}  </th>
                    </tr>
                    
                        
                     
                </tbody>
            </table>
        </div>
    </div>






</div>

@endsection