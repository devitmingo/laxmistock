@extends('layout.app')
@section('content')

<?php 
$party_id = 0;
$date = date('d-m-Y', strtotime(date('d-m-Y')));
$quatation_id = 0;

if(isset($data)){
  $party_id = $data->party_id;
  $quatation_id = $data->id;
  $invoice = $data->invoice;
  $invoiceSn = $data->invoiceSn;
  $date = date('d-m-Y', strtotime(date($data->date)));
}
?>


<div class="page-content">

    <!-- Page title -->
    <div class="page-title">
        <h5><i class="fa fa-align-justify"></i>Create Quatation</h5>
    </div>
    <!-- /page title -->


    <!-- Advanced form components -->
    

        <!-- HTML5 inputs -->
        <div class="panel panel-default">
            <div class="panel-heading"><h6 class="panel-title">Create Quatation</h6></div>
            <div class="panel-body">
            <x-alert />
            
            <form id="quatation-form" class="form-horizontal" method="post" >
                @csrf
                
                <input type="hidden" id="quatation_id" value="{{ $quatation_id }}">

                <div class="form-group">
                    <label class="col-sm-2 control-label">Party Name : </label>
                    <div class="col-sm-10">
                    <input class="form-control"  type="text" name="partyName" id="partyName" required value="{{ old('partyName',isset($data->name) ? $data->name : '') }}">  
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">Mobile : </label>
                    <div class="col-sm-10">
                    <input class="form-control"  type="text" name="mobile" id="mobile" required value="{{ old('mobile',isset($data->mobile) ? $data->mobile : '') }}">  
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Email : </label>
                    <div class="col-sm-10">
                    <input class="form-control"  type="text" name="email" id="email" required value="{{ old('email',isset($data->email) ? $data->email : '') }}">  
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Address : </label>
                    <div class="col-sm-10">
                    <input class="form-control"  type="text" name="address" id="address" required value="{{ old('address',isset($data->address) ? $data->address : '') }}">  
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Date : </label>
                    <div class="col-sm-10">
                        <input class="form-control" data-mask="99-99-9999" type="text" name="date" id="date" required value="{{ $date }}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Invoice No : </label>
                    <div class="col-sm-10">
                        <input class="form-control" readonly type="text" name="invoice" id="invoice" required value="{{ $invoice }}">
                        <input class="form-control" readonly type="hidden" name="invoiceSn" id="invoiceSn" required value="{{ $invoiceSn }}">
                    </div>
                </div>

                <div class="panel panel-default">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Particular </th>                            
                                <th>Rate</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td>    
                                    <input type="hidden" name="qua_d_id" id="qua_d_id">
                                    <input class="form-control" type="text" name="particular" id="particular">
                                </td>
                                <td>
                                        <input class="form-control" type="number" name="rate" id="rate">
                                </td>

                                <td>
                                    <input class="form-control" type="number" name="qty" id="qty"  onkeyup="calcTotal(this.value)">                                    
                                </td>  

                                <td>
                                        <input class="form-control" type="text" name="total" id="total" readonly >
                                </td>

                                <td>
                                    <button id="AddBTN" class="form-control btn btn-default" type="submit">ADD</button>
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
                                <th>Particular</th>               
                                <th>Qty</th>
                                <th>Rate</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="details">
                            
                        </tbody>
                        
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

    <script>
        function final_submit(){
            var partyName = $("#partyName").val();
            var mobile = $("#mobile").val();
            var email = $("#email").val();
            var quatation_id = $("#quatation_id").val();
            var address = $("#address").val();
            var date = $("#date").val();
            var total = $("#grandTotal").val();
            var invoiceSn = $("#invoiceSn").val();
            var invoice = $("#invoice").val();

            var status = false;
            // alert(party_id+" - "+date);
            if(partyName==''){
                alert('Please Fill Party Name');
                status = false;
            }
            else{
                status = true;
            }

            if(mobile==''){
                alert('Please Fill Mobile');
                status = false;
            }
            else{
                status = true;
            }
            if(address==''){
                alert('Please Fill Address');
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
                    type:"POST",
                    url:"{{ route('quatation.store') }}",
                    // dataType:'json',
                    data:{name:partyName,date:date,mobile:mobile,address:address,quatation_id:quatation_id,invoiceSn:invoiceSn,invoice:invoice,total:total,id:quatation_id,email:email},
                    success:function(data){
                        console.log(data);
                        if(data=="ADD"){
                            alert('SUBMIT SUCESSFULLY');
                            location.reload();
                        }
                        else if(data=="UPDATED"){
                            alert('UPDATED SUCESSFULLY');
                           window.location.href="{{ route('quatation.index') }}";
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

    $('#quatation-form').on('submit', function(event){

            var particular = $("#particular").val();
            var rate = $("#rate").val();
            var qua_d_id = $("#qua_d_id").val();
            var qty = $("#qty").val();
            var total = $("#total").val();
            var qua_d_id = $("#qua_d_id").val();
            

        event.preventDefault();
        $.ajax({
          url: "{{ route('quatationD.store') }}",
          type: "POST",
          data:{rate:rate,particular:particular,qua_d_id:qua_d_id,qty:qty,total:total},
                
          success:function(response){
            //console.log(response);
            // alert(response);
            if(response=='UPDATE_SUCESSFULLY'){
                $("#AddBTN").html('ADD');
            }

            @if(isset($sale))
                getDataForEdit({{$sale_id}});
            @else
                getData();
            @endif
            
            $("#particular").val("");
            $("#rate").val("");
            $("#qty").val("");
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
                  url:"{{ route('quatationD.index') }}",
                  success:function(data){
                    //   console.log(data);
                      $("#details").html(data);
                  }
              });
          }

          function getDataForEdit(id){
              $.ajax({
                  type:"GET",
                  url:"{{ url('quatationDetailsedit')}}?id="+id,
                  success:function(data){
                      console.log(data);
                      $("#details").html(data);
                  }
              });
          }

          @if(isset($data))
            getDataForEdit({{$quatation_id}});
          @else
            getData();
          @endif
            
          function edit_record(id){
              $.ajax({
                type:"GET",
                url:"{{ url('common-get-edit') }}?table=quatation_details&key=id&value="+id,
                success:function(data){
                    // console.log(data);
                    var x = JSON.parse(data);
                    $("#rate").val(x.rate);
                    $("#particular").val(x.particular);
                    $("#qty").val(x.qty);
                    $("#total").val(x.total);
                    $("#qua_d_id").val(x.id);
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
                    url:"{{ url('common-ajax-delete') }}?table=quatation_details&key=id&value="+id,
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
  url:'{{ url("common-get-select2") }}?table=parties&id=id&column=name&type=customer',
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
    rate = $("#rate").val();
    total = parseFloat(rate)*qty;
    $("#total").val(total);
}
</script>

<script>
    function getPrice(id){
        $.ajax({
        type:'GET',
        url:'{{ url("common-get-value") }}?table=products&colum=price&key=id&val='+id,
        success:function(response){
             console.log(response);
            $("#rate").val(response);
        }
        });
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