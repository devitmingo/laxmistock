@extends('layout.app')
@section('content')

<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-align-justify"></i> {{ isset($data) ? 'Edit' : 'Add' }} Session</h5>
    </div>
    <!-- /page title -->


    <!-- Advanced form components -->
    

        <!-- HTML5 inputs -->
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title">{{ isset($data) ? 'Edit' : 'Add' }} Session</h6></div>
            <div class="panel-body">
            <x-alert />
            @if(isset($data))
            <form action="{{ route('session.update',$data->id ) }}" class="form-horizontal" method="post" >
            @method('PATCH');
            @else
            <form action="{{ route('session.store') }}" class="form-horizontal" method="post" >
            @endif
                @csrf
        

                <div class="form-group">
                    <label class="col-sm-2 control-label">Start Date : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="date" name="startDate" value="{{ old('startDate',isset($data->startDate) ? $data->startDate : '' ) }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">End Date : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="date" name="endDate" value="{{ old('endDate',isset($data->endDate) ? $data->endDate : '' ) }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Session Name : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" name="name" value="{{ old('name',isset($data->name) ? $data->name : '' ) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Status : </label>
                    <div class="col-sm-6">
                            <select data-placeholder="Choose a Status..." class="select-search" name="status" id="status" required tabindex="2">
                                <option value="">Select</option> 
                                <option value="1">Active</option> 
                                <option value="2">InActive</option> 
                               
                            </select>

                            <script>document.getElementById("status").value = "{{ old('status',isset($data->status) ? $data->status : '' ) }}"; </script>
                         </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Sale Invoice Prefix : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" name="saleInvoicePrefix" value="{{ old('saleInvoicePrefix',isset($data->saleInvoicePrefix) ? $data->saleInvoicePrefix : '' ) }}">
                    </div>
                </div>

               


                <div class="form-group">
                    <label class="col-sm-2 control-label">Quatation Invoice Prefix : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" name="QuatationInvoicePrefix" value="{{ old('QuatationInvoicePrefix',isset($data->QuatationInvoicePrefix) ? $data->QuatationInvoicePrefix : '' ) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Customer Payment Prefix : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" name="CPPrefix" value="{{ old('CPPrefix',isset($data->CPPrefix) ? $data->CPPrefix : '' ) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Supplier Payment Prefix : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" name="SPPrefix" value="{{ old('SPPrefix',isset($data->SPPrefix) ? $data->SPPrefix : '' ) }}">
                    </div>
                </div>

          
                <div class="form-actions">
                    <a href="{{ route('session.index') }}" class="btn btn-danger">Back </a>
                    <input type="submit" value="{{ isset($data) ? 'Update' : 'Submit' }}" class="btn btn-primary">
                </div>
            </form>
            </div>
        </div>
        <!-- /HTML5 inputs -->

    


</div>


@endsection