@extends('layout.app')

@section('content')

<?php 
use \App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
?>
<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-table"></i> Sales </h5>        
    </div>
    <!-- /page title -->

    
    <!-- Statistics -->
    <ul class="row stats">
        <li class="col-xs-3"><a href="#" class="btn btn-default">52</a> <span> Active</span></li>
        <li class="col-xs-3"><a href="#" class="btn btn-default">520</a> <span>In-Active</span></li>
        <li class="col-xs-3"></li>
        <li class="col-xs-3">
            <a href="{{ route('quatation.create') }}" class="btn btn-info">Create Quatation</a>
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
                        <th>Party Name</th>
                        <th>Mobile</th>
                        <th>Date</th>
                        <th>Total Amount</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $row)
                    <tr>
                    
                        <td class="text-center">
                            {{ $loop->index+1 }}
                        <td>
                            {{ $row->name }}
                        </td>
                        <td>
                            {{ $row->mobile }}
                        </td>

                        <td>
                            {{ date('d-m-Y', strtotime($row->date)) }}
                        </td>

                        <td>
                            {{ CommonController::getTotalAmountSale($row->id) }}
                        </td>                                                
                        
                       

                        <td>
                            <div >

                            <a target="_blank" href="{{ route('quatation.show',$row->id) }}" class="btn btn-default btn-icon btn-xs tip" rel="tooltip" title="View">
                            <i class="fa fa-file-text" aria-hidden="true"></i>
                            </a>
                          
                            <a href="{{ route('quatation.edit',$row->id)}}" class="btn btn-default btn-icon btn-xs tip" rel="tooltip" title="Edit">
                            <i class="fa fa-pencil"></i>
                            </a>                            
                            
                            <a href="#" class="btn" rel="tooltip" title="Delete">
                                                                
                                <form action="{{route('quatation.destroy',$row->id)}}" method="post">
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