@extends('layout.app')

@section('content')

<?php 
use \App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
?>
<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-table"></i> Quatation > {{ $party_name }}</h5>        
    </div>
    <!-- /page title -->

    
    <!-- Statistics -->
    <ul class="row stats">
        <li class="col-xs-3"><a href="#" class="btn btn-default">52</a> <span> Active</span></li>
        <li class="col-xs-3"><a href="#" class="btn btn-default">520</a> <span>In-Active</span></li>
        <li class="col-xs-3"></li>
        <li class="col-xs-3">
            <a href="{{ route('purchase.create') }}" class="btn btn-info">Sales Entry</a>
        </li>
    </ul>
    <!-- /statistics -->

<x-alert/>

    <div class="panel panel-default">
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>SNO.</th>
                        <th>Product</th>
                        <th>Unit</th>
                        <th>QTY</th>
                        <th>Rate</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales_details as $row)
                    <tr>
                    
                        <td class="text-center">
                            {{ $loop->index+1 }}
                        </td>

                        <td>{{ $row->product->name }}</td>

                        <td>{{ $row->unit->name }}</td>

                        <td>{{ $row->qty }}</td>  
                        
                        <td>{{ $row->rate }}</td>
                        
                        <td>{{ $row->total }}</td>                        
                        

                        <td>
                            <div >

                            

                            <a href="{{url('sale-edit/'.$row->sale_id)}}" class="btn btn-default btn-icon btn-xs tip" rel="tooltip" title="Edit">
                            <i class="fa fa-pencil"></i>
                            </a>                            
                            
                            <a href="#" class="btn" rel="tooltip" title="Delete">
                                                                
                                <form action="{{route('party.destroy',$row->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-default btn-icon btn-xs tip">
                                        <i class="fa fa-minus" onclick="return confirm('Are you sure to Delete?')"></i>
                                    </button>
                                </form>
                            </a>

                            </div>
                        </td>
                    </tr>

                   @endforeach 
                   
                </tbody>
            </table>
        </div>
    </div>

</div>



@endsection