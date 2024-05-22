@extends('layout.app')
@section('content')

<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-align-justify"></i> {{ isset($data) ? 'Edit' : 'Add' }} Customer Payment</h5>
    </div>
    <!-- /page title -->


    <!-- Advanced form components -->
    

        <!-- HTML5 inputs -->
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title">{{ isset($data) ? 'Edit' : 'Add' }} Customer Payment</h6></div>
            <div class="panel-body">
            <x-alert />
            @if(isset($data))

            <form action="{{ route('supplierPayment.update',$data->id ) }}" class="form-horizontal" method="post" >
            @method('PATCH');

            @else
            <form action="{{ route('supplierPayment.store') }}" class="form-horizontal" method="post" >
            @endif
                @csrf
            
              

                <div class="form-group">
                    <label class="col-sm-2 control-label">Customer Name : </label>
                    <div class="col-sm-10">
                            <select data-placeholder="Choose a Customer Name..." class="select-search" name="party_id" id="party_id" required tabindex="2">
                                <option value=""></option> 
                                @foreach($parties as $party)
                                <option value="{{ $party->id }}">{{ $party->name }}</option> 
                                @endforeach
                            </select>

                            <script>document.getElementById("party_id").value = "{{ old('party_id',isset($data->party_id) ? $data->party_id : '' ) }}"; </script>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Receipt No: </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="receiptNo" value="{{ old('receiptNo',isset($data->receiptNo) ? $data->receiptNo : $NoReceipt ) }}" readonly>
                        <input class="form-control" type="hidden" name="receiptSn" value="{{ old('receiptSn',isset($data->receiptSn) ? $data->receiptSn : $receiptSn ) }}" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Pay Amount : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="payAmount" value="{{ old('payAmount',isset($data->payAmount) ? $data->payAmount : '' ) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Pay Date : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="payDate" value="{{ old('payDate',isset($data->payDate) ? $data->payDate : '' ) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Pay Type : </label>
                    <div class="col-sm-10">
                       <select data-placeholder="Choose a Payment Type" class="select-search" name="payType" id="payType" tabindex="2">
                                    <option value="">select</option>
                                    @foreach($paymentTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                <script>document.getElementById("payType").value = "{{ isset($payments->payType) ? $payments->payType : '' }}"; </script>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Note : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="note" value="{{ old('note',isset($data->note) ? $data->note : '' ) }}">

                        <input class="form-control" type="hidden" name="type" value="{{ old('type',isset($data->type) ? $data->type : '1' ) }}">
                        <input class="form-control" type="hidden" name="page" value="{{ old('page',isset($data->page) ? $data->page : '4' ) }}">

                    </div>
                </div>

                

                <div class="form-actions pull-right">
                    <a href="{{ route('customerPayment') }}" class="btn btn-danger">Back </a>
                    <input type="submit" value="{{ isset($data) ? 'Update' : 'Submit' }}" class="btn btn-primary">
                </div>
            </form>
            </div>
        </div>
        <!-- /HTML5 inputs -->

    


</div>


@endsection