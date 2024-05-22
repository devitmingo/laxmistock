@extends('layout.app')

@section('content')

<?php 
use \App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
?>
<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-table"></i> Product Min Stocks </h5>        
    </div>
    <!-- /page title -->

<x-alert/>

    <div class="panel panel-default">
        <div class="panel-heading"><h6 class="panel-title">Product Min Stocks</h6></div>
        <div class="panel panel-default">
            <div class="panel-body">
            <form>
                <div class="form-group">
                    <div class="col-sm-2"> From Date :
                    <input class="form-control" data-mask="99-99-9999" value="{{ old('toDate',isset($toDate) ? date('d-m-Y',strtotime($toDate)) : '') }}" type="text" name="toDate" id="date"  >
                    
                   
                    </div>

                    <div class="col-sm-2"> Product : 
                             <select data-placeholder="Choose a Product" class="select-search" name="product" id="product" tabindex="2">
                                    <option value="">All</option>
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
                        <th>Product Name</th>
                        <th>Min Stock</th>
                        <th>QTY</th>
                        
                    </tr>
                </thead>
                <tbody>
                  
                   
                    @foreach($products as $row)
                   @php 
                    $inStock = CommonController::minStocks($toDate,$row->id);
                   @endphp
                    @if($row->minStock>=$inStock)
                       <tr>
                            <td>{{ $loop->index +1  }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->minStock }}</td>
                            <td style="color:red;">{{ CommonController::minStocks($toDate,$row->id) }}</td>       
                       </tr>
                    @endif

                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>






</div>

@endsection