@extends('layout.app')
@section('content')

<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-align-justify"></i> {{ isset($data) ? 'Edit' : 'Add' }} Company</h5>
    </div>
    <!-- /page title -->


    <!-- Advanced form components -->
    

        <!-- HTML5 inputs -->
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title">{{ isset($data) ? 'Edit' : 'Add' }} Company</h6></div>
            <div class="panel-body">
            <x-alert />
            @if(isset($data))
            <form action="{{ route('company.update',$data->id ) }}" class="form-horizontal" method="post" >
            @method('PATCH');
            @else
            <form action="{{ route('company.store') }}" class="form-horizontal" method="post" >
            @endif
                @csrf
        

                <div class="form-group">
                    <label class="col-sm-2 control-label">Company Name : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" name="name" value="{{ old('name',isset($data->name) ? $data->name : '' ) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Owner Name : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" name="ownerName" value="{{ old('ownerName',isset($data->ownerName) ? $data->ownerName : '' ) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Mobile : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="number" name="mobile" value="{{ old('mobile',isset($data->mobile) ? $data->mobile : '' ) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Mobile 2: </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="number" name="mobile2" value="{{ old('mobile2',isset($data->mobile2) ? $data->mobile2 : '' ) }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Email : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="email" name="email" value="{{ old('email',isset($data->email) ? $data->email : '' ) }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Email 2 : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="email" name="email2" value="{{ old('email2',isset($data->email2) ? $data->email2 : '' ) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Pan No : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" name="panNo" value="{{ old('panNo',isset($data->panNo) ? $data->panNo : '' ) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">GST : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="text" name="gst" value="{{ old('gst',isset($data->gst) ? $data->gst : '' ) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">opening Balance : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="number" name="openingBal" value="{{ old('openingBal',isset($data->openingBal) ? $data->openingBal : '' ) }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Opening Date : </label>
                    <div class="col-sm-6">
                        <input class="form-control" type="date" name="date" value="{{ old('date',isset($data->date) ? $data->date : '' ) }}">
                    </div>
                </div>


               
          
                <div class="form-actions">
                    <a href="{{ route('company.index') }}" class="btn btn-danger">Back </a>
                    <input type="submit" value="{{ isset($data) ? 'Update' : 'Submit' }}" class="btn btn-primary">
                </div>
            </form>
            </div>
        </div>
        <!-- /HTML5 inputs -->

    


</div>


@endsection