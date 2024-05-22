@extends('layout.app')

@section('content')

<?php 
use \App\Http\Controllers\CommonController;
use Illuminate\Http\Request;
?>
<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-table"></i> Company Ledger </h5>        
    </div>
    <!-- /page title -->

<x-alert/>

    <div class="panel panel-default">
        <div class="panel-heading"><h6 class="panel-title">Company Ledger</h6></div>
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
                        <th>Party Name</th>
                        <th>Particular</th>
                        <th>Credit</th>
                        <th>Debit</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        
                        <th colspan="6" style="text-align:right;" >Opeing Balance</th>
                       
                        <th style="text-align:right;">{{ number_format(abs ($openingBalance),2) }} @if($openingBalance < 1) {{ "Dr" }} @else {{ "Cr" }} @endif  </th>
                    </tr>
                    @foreach($records as $row)
                    @php
                            $debit='';
                            $credit = '';
                        if($row->page==0 || $row->page==4 || $row->page==3 ){
                            $openingBalance += $row->amount;
                            $credit =  number_format($row->amount,2)." Cr";
                        }

                        if($row->page==1 || $row->page==2 || $row->page==5){
                            $openingBalance -= $row->amount;
                            $debit=  number_format($row->amount,2)." Dr"; 
                        }
                   


                               if($row->page==0 || $row->page==1 || $row->page==4 || $row->page==5 ){

                                $get =  CommonController::getValue('parties',$row->partyId);
                                $partyName = $get[0]->name;
                               }
                                elseif($row->page==2 || $row->page==3){

                                $get =  CommonController::getValue('heads',$row->partyId);
                                $partyName = $get[0]->name;

                                }
                                else{
                                    $partyName ='';
                                }

                        @endphp
                       <tr>
                            <td>{{ $loop->index +1  }}</td>
                            <td>{{ date('d-m-Y',strtotime($row->date)) }}</td>
                            <td>
                               {{ $partyName }}
                            </td>
                            <td>
                                @if($row->page==0)
                                {{ $row->invoiceNo }}
                                </br>
                                {{ "Purchase" }}
                               
                                
                                @elseif($row->page==1)
                                {{ $row->invoiceNo }}
                                </br>
                                {{ "Sale" }}
                                
                                @elseif($row->page==2)
                               
                                {{ "Expenses" }}
                                
                                @elseif($row->page==3)
                               
                                {{ "Income" }}
                               
                                @elseif($row->page==4)
                                {{ $row->invoiceNo }}
                                   </br>
                                {{ "Customer Payment" }}
    
                                @elseif($row->page==5)
                                {{ $row->invoiceNo }}
                                </br>
                                {{ "Supplier Payment" }}
                                @else
                                    {{ "" }}
                                @endif
                            
                            
                            </td>
                            <td style="text-align:right;">{{ $credit }}</td>
                            <td style="text-align:right;">{{ $debit }}</td>
                            <td style="text-align:right;">{{ number_format(abs ($openingBalance),2) }} @if($openingBalance < 1) {{ "Dr" }} @else {{ "Cr" }} @endif</td>
                       </tr>

                    @endforeach

                    <tr>
                        
                        <th colspan="6" style="text-align:right;" >Closing Balance</th>
                       
                        <th style="text-align:right;">{{ number_format(abs ($openingBalance),2) }} @if($openingBalance < 1) {{ "Dr" }} @else {{ "Cr" }} @endif  </th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>






</div>

@endsection