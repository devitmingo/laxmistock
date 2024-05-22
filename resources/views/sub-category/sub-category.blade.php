@extends('layout.app')
@section('content')

<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-align-justify"></i> {{ isset($data) ? 'Edit' : 'Add' }} Categories</h5>
    </div>
    <!-- /page title -->


    <!-- Advanced form components -->
    

        <!-- HTML5 inputs -->
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title">{{ isset($data) ? 'Edit' : 'Add' }} Categories</h6></div>
            <div class="panel-body">
            <x-alert />
            @if(isset($data))

            <form action="{{ route('sub-category.update',$data->id ) }}" class="form-horizontal" method="post" >
            @method('PATCH');

            @else
            <form action="{{ route('sub-category.store') }}" class="form-horizontal" method="post" >
            @endif
            
                @csrf
        
                <div class="form-group">
                    <label class="col-sm-2 control-label">Category Name : </label>
                    <div class="col-sm-10">
                            <select data-placeholder="Choose a Category..." class="select-search" name="category_id" id="category_id" required tabindex="2">
                                <option value=""></option> 
                                @foreach($category as $cate)
                                <option value="{{ $cate->id }}">{{ $cate->name }}</option> 
                                @endforeach
                            </select>

                            <script>document.getElementById("category_id").value = "{{ old('category_id',isset($data->category_id) ? $data->category_id : '' ) }}"; </script>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Sub Category Name : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name" value="{{ old('name',isset($data->name) ? $data->name : '' ) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Status: </label>
                    <div class="col-sm-6">
                        <div class="widget-inner">
                            <label class="checkbox-inline">
                                <input type="checkbox" class="styled" @if(isset($data)) @if($data->status==1) checked  @endif @endif name="status">
                                Active
                            </label>

                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('sub-category.index') }}" class="btn btn-danger">Back </a>
                    <input type="submit" value="{{ isset($data) ? 'Update' : 'Submit' }}" class="btn btn-primary">
                </div>
            </form>
            </div>
        </div>
        <!-- /HTML5 inputs -->

    


</div>


@endsection