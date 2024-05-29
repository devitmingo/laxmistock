@extends('layout.app')
@section('content')

<?php 
$party_id = 0;
$date = '';
$purchase_id = 0;
$invoiceNo='';
if(isset($purchase)){
  $party_id = $purchase->party_id;
  $purchase_id = $purchase->id;
  $date = date('d-m-Y', strtotime(date($purchase->date))); 
  $invoiceNo = $purchase->invoiceNo;
}


?>
<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>

<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-align-justify"></i> {{ isset($data) ? 'Edit' : 'Add' }} Purchase</h5>
    </div>
    <!-- /page title -->


    <!-- Advanced form components -->
    

        <!-- HTML5 inputs -->
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title">{{ isset($data) ? 'Edit' : 'Add' }} Purchase</h6></div>
            <div class="panel-body">
            <x-alert />
            
            <form id="purchase-form" class="form-horizontal" method="post" >
                @csrf
                
                <input type="hidden" name="purchase_id" id="purchase_id" value="{{ $purchase_id }}">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Party Name :  <i class="fa fa-plus-square" style="color:green;font-size:14px;" data-toggle="modal" data-target="#addParty"></i></label>
                    <div class="col-sm-10">
                            <select data-placeholder="Choose a Party Name" class="select-search" name="party_id" id="party_id" required tabindex="2">
                            </select>
                    </div>
                </div>
                

                <div class="form-group">
                    <label class="col-sm-2 control-label">Date : </label>
                    <div class="col-sm-10">
                        <input class="form-control" data-mask="99-99-9999" value="<?php echo date('d-m-Y',strtotime(date('Y-m-d'))); ?>" type="text" name="date" id="date" required value="{{ $date }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Invoice No : </label>
                    <div class="col-sm-10">
                        <input class="form-control"  type="text" name="invoiceNo" id="invoiceNo" required value="{{ $invoiceNo }}">
                    </div>
                </div>

                <div class="panel panel-default">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product &nbsp <i class="fa fa-plus-square" style="color:green;font-size:14px;" data-toggle="modal" data-target="#addProduct"></i></th>    
                                <th>Unit </th>                            
                                <th>Rate</th>
                                <th style="display:none;">Sale Rate</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>    
                                    <input type="hidden" name="purchase_detail_id" id="purchase_detail_id">
                                      <select data-placeholder="Choose a Party Name" class="select-search" name="product_id" id="product_id"  tabindex="2" onchange="getProductDetails(this.value)">
                                      </select>
                                </td>

                                <td>
                                    <select data-placeholder="Choose a unit" class="select-search" name="unit_id" id="unit_id"  tabindex="2" readonly>
                                    </select>
                                </td>

                                <td>
                                        <input class="form-control" type="number" name="buyRate" id="buyRate"  >
                                </td>

                                <td style="display:none;">
                                        <input class="form-control" type="number" name="saleRate" id="saleRate" >
                                </td>

                                <td>
                                    <input class="form-control" type="number" name="qty" id="qty"  onkeyup="calcTotal(this.value)">                                    
                                </td>  

                                <td>
                                        <input class="form-control" type="text" name="total" id="total" readonly >
                                </td>

                                <td>
                                    <button id="AddBTN" class="form-control btn btn-default" type="submit" name="total">ADD</button>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
               



            <div class="panel panel-default">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product</th>    
                                <th>Unit</th>                            
                                <th>Qty</th>
                                <th>Rate</th>
                                
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="purchase_details">
                     
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3"></th>
                                <th>
                                <select data-placeholder="Choose a Payment Type" class="select-search" name="paymentType" id="paymentType" tabindex="2">
                                    <option value="">select</option>
                                    @foreach($paymentTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                <script>document.getElementById("paymentType").value = "{{ isset($payments->payType) ? $payments->payType : '' }}"; </script>
                                </th>
                                <th>
                                <input class="form-control" type="text" name="payamount" id="payamount" value="{{ isset($payments->payAmount) ? $payments->payAmount : '' }}" >
                                <input class="form-control" type="hidden" name="pay_id" id="pay_id" value="{{ isset($payments->id) ? $payments->id : '' }}" >
                                
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>


                <div class="form-actions pull-right">
                    {{-- <a href="" class="btn btn-danger">Back </a> --}}
                    <input type="button" onclick="final_submit()" value="Submit" class="btn btn-primary">
                </div>
                </form>
            </div>
        </div>
        <!-- /HTML5 inputs -->

    


</div>




<!-- model -->

<div class="modal fade" id="addParty" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addParty">Add Party</h5>
      </div>
      <div class="modal-body">
   

      <input type="text" class="form-control" name="xname"   id ="xname" placeholder=" Name" style="width:90%; margin:10px;" />
      <input type="text" class="form-control" name="xmobile"   id ="xmobile" placeholder="Mobile" style="width:90%; margin:10px;" />
      <input type="text" class="form-control" name="xaddress"   id ="xaddress" placeholder="Min Stcok " style="width:90%; margin:10px;" />
      <input type="text" class="form-control" name="xopen"   id ="xopen" placeholder="Opening Balance " style="width:90%; margin:10px;" />


      <div style="width:92%">
                            <select data-placeholder="Choose a Opening Bal. Type" class="select-search" name="xopenType" id="xopenType" required tabindex="2">
                                <option value=""></option> 
                                <option value="Dr">Dr</option> 
                                <option value="Cr">Cr</option> 
                            </select>

     </div>
        <br>
        <br>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onClick="addParty();">Save</button>
      </div>
    </div>
  </div>
</div>

<script>
function addParty() {
    var name = document.getElementById('xname').value;
    var mobile = document.getElementById('xmobile').value;
    var address = document.getElementById('xaddress').value;
    var opening_balance = document.getElementById('xopen').value;
    var opening_balance_type = document.getElementById('xopenType').value;
    
    if(name=='')
	{
        alert('Please Fill Party Name');
    }
		$.ajax({
                url:"{{ url('add_new') }}?page=party&opening_balance="+opening_balance+"&opening_balance_type="+opening_balance_type+"&name="+name+"&mobile="+mobile+"&address="+address+"&supplier=1&status=1",
                type: 'get',
                success: function(response){
                    $('#addParty').modal('hide')
                    swal("New Party Added", {
                    icon: "success",
                });	
             
			 $('#xname').val('');
             $('#xmobile').val('');
             $('#xaddress').val('');
             $('#xopen').val('');
             $('#xopenType').val('').trigger('chosen:updated');
          	 
             fetchParty();		
		  }
        });

}

</script>
<!-- model -->

<div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addProduct">Add Product</h5>
      </div>
      <div class="modal-body" style="padding: 20px;">
  <div style="width:100%;">
   <table width="100%">
    <tr>
    <td width="90%">
    Category
    <select data-placeholder="Choose a Category..." class="select-search xcategory_id" name="xcategory_id" id="xcategory_id"  tabindex="2" style="width:100%;" onclick="getSubCategory()">
    </select> 
    </td>
    <td width="10%">
    <i  class="fa fa-plus-square" style="color:green;font-size:20px;margin-left:15px;" data-toggle="modal" data-target="#addCategory"></i>
    </td>
    </tr>
    </table>
    </br>
    <table width="100%">
    <tr  style="margin-top:15px!important;">
    <td width="90%">
    Sub Category
    <select data-placeholder="Choose a Sub Category..." class="select-search xsubcategory_id" name="xsubcategory_id" id="xsubcategory_id"  style="width:100%;" tabindex="2">
      </select>
    </select> 
    </td>
    <td width="10%">
    <i  class="fa fa-plus-square" style="color:green;font-size:20px;margin-left:15px;" data-toggle="modal" data-target="#addSubCategory"></i>
    </td>
    </tr>
   </table>
    </br>
   <table width="100%">
    <tr  style="margin-top:15px!important;">
    <td width="90%">
    Unit
    <select data-placeholder="Choose a Unit..." class="select-search xunit_id" name="xunit_id" id="xunit_id"  tabindex="2" style="width:100%;">
      </select>
    </td>
    <td width="10%">
    <i class="fa fa-plus-square" style="color:green;font-size:20px;margin-left:15px;" data-toggle="modal" data-target="#addUnit"></i>

    </td>
    </tr>
   </table>

   </div>   
   </br>
   
      
      
    

      <input type="text" class="form-control" name="xproduct"   id ="xproduct" placeholder="Product Name" style="width:90%; " />
      </br>
      <input type="text" class="form-control" name="xprice"   id ="xprice" placeholder="Price" style="width:90%; " />
      </br>
      <input type="text" class="form-control" name="xinStock"   id ="xinStock" placeholder="Stcok" style="width:90%; ;" />
    </br>
      <input type="text" class="form-control" name="xminStock"   id ="xminStock" placeholder="Min Stcok" style="width:90%; ;" />
        
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onClick="addProduct();">Save</button>
      </div>
    </div>
  </div>
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
      <div style="width:90%;" >
      <span style="margin: 40px 0px 0px 20px;
    font-size: 14px">category</span >
      <select data-placeholder="Choose a Category..." class="select-search xcategory_id2" name="xcategory_id2" id="xcategory_id2" required tabindex="2" style="width:100% !important; margin:10px;">                     
     </select>
     </div>
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
             fetchUnit();	
		  }
        });

}

function addSubCategory() {
    var xcategory_id = document.getElementById('xcategory_id2').value;
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
             
			 $('#xcategory_id2').val('').trigger('chosen:updated');
             $('#xsubcategory').val('');
			 getSubCategory();		
		  }
        });

		
	
    
}

function addProduct() {
    var xcategory_id = document.getElementById('xcategory_id').value;
    var xsubcategory_id = document.getElementById('xsubcategory_id').value;
    var xunit_id = document.getElementById('xunit_id').value;
    var xproduct = document.getElementById('xproduct').value;
    var xprice = document.getElementById('xprice').value;
    var xminStock = document.getElementById('xminStock').value;
    var xinStock = document.getElementById('xinStock').value;
          
    if(xcategory_id=='')
	{
		alert("Please Select Category");
	}

    if(xsubcategory_id=='')
	{
		alert("Please Select Sub Category");
	}

    if(xunit_id=='')
	{
        alert("Please Select Unit");
	}

    if(xproduct=='')
	{
		alert("Please Fill Product Name");
	}

    if(xprice=='')
	{
		alert("Please Fill Price");
	}

		$.ajax({
                url:"{{ url('add_new') }}?page=product&name="+xproduct+"&price="+xprice+"&category_id="+xcategory_id+"&sub_category_id="+xsubcategory_id+"&unit_id="+xunit_id+"&minStock="+xminStock+"&inStock="+xinStock+"&status=1",
                type: 'get',
                success: function(response){
                    $('#addProduct').modal('hide')
                    swal("New Product Added", {
                    icon: "success",
                });	
             
			 $('#xproduct').val('');
             $('#minStock').val('');
             $('#xprice').val('');
             $('#xcategory_id').val('').trigger('chosen:updated');
             $('#xsubcategory_id').val('').trigger('chosen:updated');
             $('#xunit_id').val('').trigger('chosen:updated');
            
            fetchProduct();
		  }
        });

}


function getCategory(){
  $.ajax({
  type:'GET',
  url:'{{ url("common-get-select2") }}?table=categories&id=id&column=name&type=status',
  success:function(response){
      $("#xcategory_id").html(response);
      $('#xcategory_id').trigger("chosen:updated");	
  }
  });
}  

getCategory();


function getCategory2(){
  $.ajax({
  type:'GET',
  url:'{{ url("common-get-select2") }}?table=categories&id=id&column=name&type=status',
  success:function(response){
      $("#xcategory_id2").html(response);
      $('#xcategory_id2').trigger("chosen:updated");	
  }
  });
}  

getCategory2();

function getSubCategory(){
    var xcategory_id = document.getElementById('xcategory_id').value;   
  $.ajax({
  type:'GET',
  url:'{{ url("common-get-select-where") }}?table=sub_categories&id=id&column=name&type=status&val='+xcategory_id+'&key=category_id',
  success:function(response){
      console.log(response);
      $("#xsubcategory_id").html(response);
      $('#xsubcategory_id').trigger("chosen:updated");	
  }
  });
}  

getSubCategory();

function getUnit2(){ 
    $.ajax({
  type:'GET',
  url:'{{ url("common-get-select2") }}?table=units&id=id&column=name&type=status',
  success:function(response){
      $("#xunit_id").html(response);
      $('#xunit_id').trigger("chosen:updated");	
  }
  });
}  

getUnit2();


</script>

    <script>
        function final_submit(){
            var party_id = $("#party_id").val();
            var date = $("#date").val();
            var purchase_id = $("#purchase_id").val();
            var payamount = $("#payamount").val();
            var paymentType = $("#paymentType").val();
            var pay_id = $("#pay_id").val();
            var invoiceNo = $("#invoiceNo").val();
            var total = $("#grandTotal").val();
            

            var status = false;
            // alert(party_id+" - "+date);
            if(party_id=='' || party_id==null){
                alert('Select a party');
                status = false;
            }
            else{
                status = true;
            }

            if(date=='' || date==null){
                alert('Enter Date');
                status = false;
            }
            else{
                status = true;
            }

            if(status){
                $.ajax({
                    type:"GET",
                    url:"{{ route('purchase.final.submit') }}",
                    // dataType:'json',
                    data:{party_id:party_id,date:date,purchase_id:purchase_id,payamount:payamount,invoiceNo:invoiceNo,paymentType:paymentType,pay_id:pay_id,total:total},
                    success:function(data){
                        console.log(data);
                        if(data=="ADD"){
                            alert('SUBMIT SUCESSFULLY');
                            location.reload();
                        }
                        else if(data=="UPDATED"){
                            alert('UPDATED SUCESSFULLY');
                            window.location.href="{{ route('purchase.index') }}";
                        }
                        else{
                            alert('SOMETHING WENT WRONG');
                        }
                    }
                });
            }

        }
    </script>



    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#purchase-form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
          url: "{{ route('purchase.store') }}",
          type: "POST",
          data: $(this).serialize(),
          success:function(response){
            console.log(response);
            // alert(response);
            if(response=='UPDATE_SUCESSFULLY'){
                $("#AddBTN").html('ADD');
            }

            @if(isset($purchase))
                getDataForEdit({{$purchase_id}});
            @else
                getData();
            @endif
            
            fetchUnit(0);
            fetchProduct(0);
            $("#product_id").val("");
            $("#rate").val("");
            $("#qty").val("");
            $("#buyRate").val("");
            $("#saleRate").val("");
            $("#total").val("");
            
          },
          error: function(response) {
           }
         });

        });
      </script>

      <script>
          function getData(){
              $.ajax({
                  type:"GET",
                  url:"{{ route('purchaseDetails.index') }}",
                  success:function(data){
                    //   console.log(data);
                      $("#purchase_details").html(data);
                  }
              });
          }

          function getDataForEdit(id){
              $.ajax({
                  type:"GET",
                  url:"{{ url('purchaseDetailsEdit') }}?purchase_id="+id,
                  success:function(data){
                    //   console.log(data);
                      $("#purchase_details").html(data);
                  }
              });
          }

          @if(isset($purchase))
            getDataForEdit({{$purchase_id}});
          @else
            getData();
          @endif
            
          function edit_record(id){
              $.ajax({
                type:"GET",
                url:"{{ url('common-get-edit-purchase') }}?table=purchase_details&key=id&value="+id,
                success:function(data){
                     console.log(data);
                    var x = JSON.parse(data);
                    fetchUnit(x.unit_id);
                    fetchProduct(x.product_id);
                    $("#saleRate").val(x.rate);
                    $("#buyRate").val(x.rate);
                    $("#qty").val(x.qty);
                    $("#total").val(x.total);
                    $("#paymentType").val(x.paymentType);
                    $("#payamount").val(x.payamount);
                    $("#purchase_detail_id").val(x.id);
                    $("#AddBTN").html('UPDATE');
                }
              });
          }
      </script>

      <script>
          function delete_record(id){
              if(confirm("Are you sure?")){
                    $.ajax({
                    type:"GET",
                    url:"{{ url('common-ajax-delete') }}?table=purchase_details&key=id&value="+id,
                    success:function(data){
                        // console.log(data);
                        alert(data);
                        getData();                   
                    }
                });
              }              
          }
      </script>



<script>
//Fetch Parties list 

function fetchParty(){
  $.ajax({
  type:'GET',
  url:'{{ url("common-get-select2") }}?table=parties&id=id&column=name&type=supplier',
  success:function(response){
        //   console.log(response);
      $("#party_id").html(response);
      $("#party_id").val({{$party_id}});
      $('#party_id').trigger('change'); 
  }
  });
}   
//onload rung party function
fetchParty();

function fetchUnit(id=0){
  $.ajax({
  type:'GET',
  url:'{{ url("common-get-select2") }}?table=units&id=id&column=name&type=status',
  success:function(response){
    //   console.log(response);
      $("#unit_id").html(response);
      $("#unit_id").val(id);
      $('#unit_id').trigger('change'); 
  }
  });
}  

//onload rung party function
fetchUnit();
</script>

<script>
function fetchProduct(id=0){
$.ajax({
type:'GET',
url:'{{ url("common-get-select2") }}?table=products&id=id&column=name&type=status',
success:function(response){
    //  console.log(response);
    $("#product_id").html(response);
    $("#product_id").val(id);
    $('#product_id').trigger('change');
}
});
}  

fetchProduct();


//Calc Total
function calcTotal(qty){
    rate = $("#buyRate").val();
    total = parseFloat(rate)*qty;
    $("#total").val(total);
}
</script>

<script>
    function getProductDetails(id){
        $.ajax({
        type:'GET',
        url:'{{ url("common-get-row") }}?table=products&key=id&val='+id,
        success:function(response){
             
            var x = JSON.parse(response);
            console.log(x);
            $("#rate").val(x.price);
            $("#unit_id").val(x.unit_id);
            $('#unit_id').trigger('change');
        }
        });
    }
</script>

@endsection