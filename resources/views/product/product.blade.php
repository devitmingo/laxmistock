@extends('layout.app')
@section('content')

<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-align-justify"></i> {{ isset($data) ? 'Edit' : 'Add' }} Product</h5>
    </div>
    <!-- /page title -->


    <!-- Advanced form components -->
    

        <!-- HTML5 inputs -->
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title">{{ isset($data) ? 'Edit' : 'Add' }} Product</h6></div>
            <div class="panel-body">
            <x-alert />
            @if(isset($data))

            <form action="{{ route('product.update',$data->id ) }}" class="form-horizontal" method="post" >
            @method('PATCH');

            @else
            <form action="{{ route('product.store') }}" class="form-horizontal" method="post" >
            @endif
                @csrf

                <div class="form-group">
                    <label class="col-sm-2 control-label">Category Name :    <i class="fa fa-plus-square" style="color:green;font-size:18px;" data-toggle="modal" data-target="#addCategory"></i></label>
                    <div class="col-sm-10">
                            <select data-placeholder="Choose a Category..." class="select-search category_id" name="category_id" id="category_id" required tabindex="2">
                               
                            </select>

                            <script>document.getElementById("category_id").value = "{{ old('category_id',isset($data->category_id) ? $data->category_id : '' ) }}"; </script>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Sub Category Name : <i class="fa fa-plus-square" style="color:green;font-size:18px;" data-toggle="modal" data-target="#addSubCategory" ></i> </label>
                    <div class="col-sm-10">
                            <select data-placeholder="Choose a Category..." class="select-search" name="sub_category_id" id="sub_category_id" required tabindex="2">
                                <option value=""></option> 
                                
                            </select>

                            <script>document.getElementById("sub_category_id").value = "{{ old('sub_category_id',isset($data->sub_category_id) ? $data->sub_category_id : '' ) }}"; </script>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Unit Name : <i class="fa fa-plus-square" style="color:green;font-size:18px;" data-toggle="modal" data-target="#addUnit"></i> </label>
                    <div class="col-sm-10">
                            <select data-placeholder="Choose a Category..." class="select-search" name="unit_id" id="unit_id" required tabindex="2">
                                <option value=""></option> 
                              
                            </select>

                            <script>document.getElementById("unit_id").value = "{{ old('unit_id',isset($data->unit_id) ? $data->unit_id : '' ) }}"; </script>
                    </div>
                </div>
                

                <div class="form-group">
                    <label class="col-sm-2 control-label">Product Name : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name" value="{{ old('name',isset($data->name) ? $data->name : '' ) }}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Price : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="price" value="{{ old('price',isset($data->price) ? $data->price : '' ) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Stock : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="inStock" value="{{ old('inStock',isset($data->inStock) ? $data->inStock : '' ) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Min Stock : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="minStock" value="{{ old('minStock',isset($data->minStock) ? $data->minStock : '' ) }}">
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
                    <a href="{{ route('product.index') }}" class="btn btn-danger">Back </a>
                    <input type="submit" value="{{ isset($data) ? 'Update' : 'Submit' }}" class="btn btn-primary">
                </div>
            </form>
            </div>
        </div>
        <!-- /HTML5 inputs -->

    


</div>



<!-- Modal Add Category -->
<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCategory">Add Category</h5>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" name="xcategory"   id ="xcategory" placeholder="Category Name" style="width:90%; margin:10px;" />
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onClick="addCategory();">Save</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Add Sub Category -->
<div class="modal fade" id="addSubCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSubCategory">Add Sub Category</h5>
      </div>
      <div class="modal-body">
      <select data-placeholder="Choose a Category..." class="select-search xcategory_id" name="xcategory_id" id="xcategory_id" required tabindex="2" style="width:80% !important; margin:10px;">
                               
     </select>
      <input type="text" class="form-control" name="xsubcategory"   id ="xsubcategory" placeholder="Sub Category Name" style="width:90%; margin:10px;" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onClick="addSubCategory();">Save</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Add Sub Category -->
<div class="modal fade" id="addUnit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addUnit">Add Unit</h5>
      </div>
      <div class="modal-body">
      <input type="text" class="form-control" name="xunit"   id ="xunit" placeholder="Unit Name" style="width:90%; margin:10px;" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onClick="addUnit();">Save</button>
      </div>
    </div>
  </div>
</div>



<script>

function addCategory() {
    var xcategory = document.getElementById('xcategory').value;

    if(xcategory !='')
	{

		$.ajax({
                url:"{{ url('add_new') }}?page=category&xcategory="+xcategory,
                type: 'get',
                success: function(response){
                    $('#addCategory').modal('hide')
                    swal("New Category Added", {
                    icon: "success",
                });	
             
			 $('#xcategory').val('').trigger('chosen:updated');
			 getCategory();		
		  }
        });

		
	}
	else
	{
		alert("Please Category don't be Blank");
	}
    
}


function addSubCategory() {
    var xcategory_id = document.getElementById('xcategory_id').value;
    var xsubcategory = document.getElementById('xsubcategory').value;
    
    if(xcategory_id=='')
	{
		alert("Please Select Category");
	}

    if(xsubcategory=='')
	{
		alert("Please Fill Sub Category Name");
	}

		$.ajax({
                url:"{{ url('add_new') }}?page=subCategory&category_id="+xcategory_id+"&name="+xsubcategory,
                type: 'get',
                success: function(response){
                    $('#addSubCategory').modal('hide')
                    swal("New Sub Category Added", {
                    icon: "success",
                });	
             
			 $('#xcategory_id').val('').trigger('chosen:updated');
             $('#xsubcategory').val('');
			 getSubCategory();		
		  }
        });

		
	
    
}


function getCategory(){
  $.ajax({
  type:'GET',
  url:'{{ url("common-get-select2") }}?table=categories&id=id&column=name&type=status',
  success:function(response){
      $("#category_id").html(response);
      $('#category_id').trigger("chosen:updated");	
  }
  });
}  

getCategory();


function getCategory2(){
  $.ajax({
  type:'GET',
  url:'{{ url("common-get-select2") }}?table=categories&id=id&column=name&type=status',
  success:function(response){
      $("#xcategory_id").html(response);
      $('#xcategory_id').trigger("chosen:updated");	
  }
  });
}  

getCategory2();


function getSubCategory(){
  $.ajax({
  type:'GET',
  url:'{{ url("common-get-select2") }}?table=sub_categories&id=id&column=name&type=status',
  success:function(response){
      $("#sub_category_id").html(response);
      $('#sub_category_id').trigger("chosen:updated");	
  }
  });
}  

getSubCategory();
</script>

<script>

function addUnit() {
    var xunit = document.getElementById('xunit').value;

    if(xunit=='')
	{
		alert("Please Fill Unit Name");
	}

		$.ajax({
                url:"{{ url('add_new') }}?page=unit&name="+xunit,
                type: 'get',
                success: function(response){
                    $('#addUnit').modal('hide')
                    swal("New Unit Added", {
                    icon: "success",
                });	
             
			 $('#xunit').val('');
			 getUnit();		
		  }
        });

}

function getUnit(){ 
    $.ajax({
  type:'GET',
  url:'{{ url("common-get-select2") }}?table=units&id=id&column=name&type=status',
  success:function(response){
      $("#unit_id").html(response);
      $('#unit_id').trigger("chosen:updated");	
  }
  });
}  

getUnit();
</script>

@endsection