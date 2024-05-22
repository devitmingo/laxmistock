@extends('layout.app')

@section('content')
    
<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-table"></i> PAYMENT </h5>        
    </div>
    <!-- /page title -->

    
    <!-- Statistics -->
    <ul class="row stats">
        <li class="col-xs-3"><a href="#" class="btn btn-default">52</a> <span> Active</span></li>
        <li class="col-xs-3"><a href="#" class="btn btn-default">520</a> <span>In-Active</span></li>
        <li class="col-xs-3"></li>
        <li class="col-xs-3">
            <a href="{{ route('supplierPayment.create') }}" class="btn btn-info">ADD NEW SUPPLIER PAYMENT</a>
        </li>
    </ul>
    <!-- /statistics -->

<x-alert/>

    <div class="panel panel-default">
        <div class="panel-heading"><h6 class="panel-title">Payments</h6></div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>SNO.</th>
                        <th>Receipt No</th>
                        <th>Supplier Name</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Note</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $row)
                    <tr>
                    
                       <td>{{ $loop->index + 1 }}</td>
                       <td>{{ $row->receiptNo }}</td>
                       <td>{{ $row->party->name }}</td>
                       <td>{{ $row->payDate }}</td>
                       <td>{{ $row->payAmount }}</td>
                       <td>{{ $row->note }}</td>
                        <td>
                            <div >


                            <a href="{{route('supplierPayment.edit',$row->id)}}" class="btn btn-default btn-icon btn-xs tip" rel="tooltip" title="Edit">
                            <i class="fa fa-pencil"></i>
                            </a>
                            
                            <a href="#" class="btn" rel="tooltip" title="Delete">
                                                                
                                <form action="{{route('supplierPayment.destroy',$row->id)}}" method="post">
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