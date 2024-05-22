@extends('layout.app')
@section('content')

<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-align-justify"></i> {{ isset($data) ? 'Edit' : 'Add' }} Expenses</h5>
    </div>
    <!-- /page title -->


    <!-- Advanced form components -->
    

        <!-- HTML5 inputs -->
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title">{{ isset($data) ? 'Edit' : 'Add' }} Expenses</h6></div>
            <div class="panel-body">
            <x-alert />
            @if(isset($data))

            <form action="{{ route('expenses.update',$data->id ) }}" class="form-horizontal" method="post" >
            @method('PATCH');

            @else
            <form action="{{ route('expenses.store') }}" class="form-horizontal" method="post" >
            @endif
                @csrf
            
               

                <div class="form-group">
                    <label class="col-sm-2 control-label">Head Name : <i class="fa fa-plus-square" style="color:green;font-size:18px;" data-toggle="modal" data-target="#addHead"></i></label>
                    <div class="col-sm-10">
                            <select data-placeholder="Choose a Head Name..." class="select-search" name="head_id" id="head_id" required tabindex="2">
                                <option value=""></option> 
                                
                            </select>

                            <script>document.getElementById("head_id").value = "{{ old('head_id',isset($data->head_id) ? $data->head_id : '' ) }}"; </script>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Date : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="date" name="date" value="{{ old('date',isset($data->date) ? $data->date : '' ) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Amount : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="amount" value="{{ old('amount',isset($data->amount) ? $data->amount : '' ) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Pay Type : </label>
                    <div class="col-sm-10">
                            <select data-placeholder="Choose a Pay Type..." class="select-search" name="payType" id="payType" required tabindex="2">
                                <option value=""></option> 
                                <option value="1">Cash</option> 
                                <option value="2">Check</option> 
                            
                            </select>

                            <script>document.getElementById("payType").value = "{{ old('payType',isset($data->payType) ? $data->payType : '' ) }}"; </script>
                    </div>
                </div>
                

                <div class="form-group">
                    <label class="col-sm-2 control-label">Note : </label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="note" value="{{ old('note',isset($data->note) ? $data->note : '' ) }}">

                        <input class="form-control" type="hidden" name="insertType" value="{{ old('insertType',isset($data->insertType) ? $data->insertType : '1' ) }}">
                        <input class="form-control" type="hidden" name="page" value="{{ old('page',isset($data->page) ? $data->page : '2' ) }}">

                    </div>
                </div>

                

                <div class="form-actions pull-right">
                    <a href="{{ route('expenses.index') }}" class="btn btn-danger">Back </a>
                    <input type="submit" value="{{ isset($data) ? 'Update' : 'Submit' }}" class="btn btn-primary">
                </div>
            </form>
            </div>
        </div>
        <!-- /HTML5 inputs -->

    


</div>



<!-- Modal Add Category -->
<div class="modal fade" id="addHead" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addHead">Add Head</h5>
      </div>
      <div class="modal-body">
        <input type="text" class="form-control" name="xhead"   id ="xhead" placeholder="Head Name" style="width:90%; margin:10px;" />
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onClick="addHead();">Save</button>
      </div>
    </div>
  </div>
</div>


<script>

function addHead() {
    var xhead = document.getElementById('xhead').value;

    if(xhead !='')
	{

		$.ajax({
                url:"{{ url('add_new') }}?page=head&name="+xhead,
                type: 'get',
                success: function(response){
                    $('#addHead').modal('hide')
                    swal("New Head Added", {
                    icon: "success",
                });	
             
			 $('#xhead').val('');
			 getHead();		
		  }
        });

		
	}
	else
	{
		alert("Please Head Name don't be Blank");
	}
    
}

function getHead(){
  $.ajax({
  type:'GET',
  url:'{{ url("common-get-select2") }}?table=heads&id=id&column=name&type=status',
  success:function(response){
      $("#head_id").html(response);
      $('#head_id').trigger("chosen:updated");	
  }
  });
}  

getHead();
</script>
@endsection