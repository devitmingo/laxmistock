@extends('layout.app')

@section('content')
    
<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-table"></i> PRODUCT </h5>        
    </div>
    <!-- /page title -->

    
    <!-- Statistics -->
    <ul class="row stats">
        <li class="col-xs-3"><a href="#" class="btn btn-default">52</a> <span> Active</span></li>
        <li class="col-xs-3"><a href="#" class="btn btn-default">520</a> <span>In-Active</span></li>
        <li class="col-xs-3"></li>
        <li class="col-xs-3">
            <a href="{{ route('party.create') }}" class="btn btn-info">ADD NEW PARTY</a>
        </li>
    </ul>
    <!-- /statistics -->

<x-alert/>

    <div class="panel panel-default">
        <div class="panel-heading"><h6 class="panel-title">Table elements</h6></div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>SNO.</th>
                        <th>Name</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Opening Bal</th>
                        <th>Party Type</th>
                        <th>Status</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($party as $row)
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
                            {{ $row->address }}
                        </td>

                        <td>
                            {{ $row->opening_balance }} <b>{{ $row->opening_balance_type }}</b>
                        </td>

                        <td>
                            @if($row->supplier == 1)
                            <span class="label label-primary">{{ "supplier" }}</span>
                            @endif
                            @if($row->customer == 1)
                            <span class="label label-primary"> {{"customer"}} </span>
                            @endif
                        </td>
                        
                        
                        <td>
                        @if($row->status==1)
                           <span class="label label-success"> {{ "Active" }} </span>
                         @else 
                         <span class="label label-danger"> {{ "Inctive" }} </span>
                         @endif   
                        </td>

                        <td>
                            <div >


                            <a href="{{route('party.edit',$row->id)}}" class="btn btn-default btn-icon btn-xs tip" rel="tooltip" title="Edit">
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