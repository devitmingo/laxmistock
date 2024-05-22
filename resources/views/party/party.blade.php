@extends('layout.app')
@section('content')

<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-align-justify"></i> {{ isset($data) ? 'Edit' : 'Add' }} Party</h5>
    </div>
    <!-- /page title -->


    <!-- Advanced form components -->
    

        <!-- HTML5 inputs -->
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title">{{ isset($data) ? 'Edit' : 'Add' }} Party</h6></div>
            <div class="panel-body">
            <x-alert />
            @if(isset($data))

            <form action="{{ route('party.update',$data->id ) }}" class="form-horizontal" method="post" >
            @method('PATCH');

            @else
            <form action="{{ route('party.store') }}" class="form-horizontal" method="post" >
            @endif
                @csrf

                <div class="form-group">
                    <label class="col-sm-2 control-label">Party Name : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name" value="{{ old('name',isset($data->name) ? $data->name : '' ) }}">

                            <script>document.getElementById("category_id").value = "{{ old('category_id',isset($data->category_id) ? $data->category_id : '' ) }}"; </script>
                    </div>
                </div>
                

                <div class="form-group">
                    <label class="col-sm-2 control-label">Mobile : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="mobile" value="{{ old('mobile',isset($data->mobile) ? $data->mobile : '' ) }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Address : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="address" value="{{ old('address',isset($data->address) ? $data->address : '' ) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Opening Balance : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="opening_balance" value="{{ old('opening_balance',isset($data->opening_balance) ? $data->opening_balance : '' ) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Opening Bal. Type : </label>
                    <div class="col-sm-10">
                            <select data-placeholder="Choose a Opening Bal. Type" class="select-search" name="opening_balance_type" id="opening_balance_type" required tabindex="2">
                                <option value=""></option> 
                                <option value="Dr">Dr</option> 
                                <option value="Cr">Cr</option> 
                            </select>

                            <script>document.getElementById("opening_balance_type").value = "{{ old('opening_balance_type',isset($data->opening_balance_type) ? $data->opening_balance_type : '' ) }}"; </script>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Party Type: </label>
                    <div class="col-sm-10">
                        <div class="widget-inner">
                            <label class="checkbox-inline">
                                <input type="checkbox"  class="styled" @if(isset($data)) @if($data->supplier==1) checked  @endif @endif name="supplier">
                                Supplier
                                &nbsp;&nbsp;&nbsp;
                                <input type="checkbox"  class="styled" @if(isset($data)) @if($data->customer==1) checked  @endif @endif name="customer">
                                Customer
                            </label>

                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Status: </label>
                    <div class="col-sm-10">
                        <div class="widget-inner">
                            <label class="checkbox-inline">
                                <input type="checkbox"  class="styled" @if(isset($data)) @if($data->status==1) checked  @endif @endif name="status">
                                Active
                            </label>

                        </div>
                    </div>
                </div>

                <div class="form-actions pull-right">
                    <a href="{{ route('party.index') }}" class="btn btn-danger">Back </a>
                    <input type="submit" value="{{ isset($data) ? 'Update' : 'Submit' }}" class="btn btn-primary">
                </div>
            </form>
            </div>
        </div>
        <!-- /HTML5 inputs -->

    


</div>


@endsection