@extends('layout.app')

@section('content')
    
<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-table"></i> Company </h5>        
    </div>
    <!-- /page title -->

    
    <!-- Statistics -->
    <ul class="row stats">
        <li class="col-xs-3"></li>
        <li class="col-xs-3"></li>
        <li class="col-xs-3"></li>
        <li class="col-xs-3">
        @if(count($records)==0)
            <a href="{{ route('company.create') }}" class="btn btn-info">ADD NEW COMPANY</a>
        @endif
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
                        <th>Company Name</th>
                        <th>Owner Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Opening Date</th>
                        <th>Opening Balance</th>
                          
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $row)
                    <tr>
                    
                        <td class="text-center">{{ $loop->index+1 }} </td>
                        <td> {{ $row->name }}</td>
                        <td> {{ $row->ownerName }}</td>
                        <td> {{ $row->mobile }}</td>
                        <td> {{ $row->email }}</td>
                        <td> {{ $row->date }}</td>
                        <td> {{ $row->openingBal }}</td>

                        <td>
                            <div >


                            <a href="{{route('company.edit',$row->id)}}" class="btn btn-default btn-icon btn-xs tip" rel="tooltip" title="Edit">
                            <i class="fa fa-pencil"></i>
                            </a>
                            
                            <a href="#" class="btn" rel="tooltip" title="Delete">
                                                                
                                <form action="{{route('company.destroy',$row->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-default btn-icon btn-xs tip">
                                        <i class="fa fa-minus" onclick="return confirm('Are you sure to Delete?')" title="Delete"></i>
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