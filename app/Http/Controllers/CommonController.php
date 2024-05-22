<?php

namespace App\Http\Controllers;

use App\Models\PurchaseDetail;
use App\Models\session;
use Illuminate\Http\Request;
use DB;
use Redirect;

class CommonController extends Controller
{
    
    public function getSelectOption2(Request $request){
       
        $table = $request->table;       
        $id = $request->id;        
        $column = $request->column;
        $type = $request->type;            
        $collection=DB::table($table)->where($type,1)->get();
        $select_option='';
        $select_option.="<option value='0' selected>Select</option>";
        foreach ($collection as $row) {
            $select_option.="<option value='".$row->$id."'>".$row->$column."</option>";
        }
        return $select_option;    
    
    }


    public function getSelectOptionWhere(Request $request){
       
        $table = $request->table;       
        $id = $request->id;        
        $column = $request->column;
        $type = $request->type;    
        $key = $request->key;    
        $val = $request->val;            
        $collection=DB::table($table)->where($type,1)->where($key,$val)->get();
        $select_option='';
        $select_option.="<option value='0' selected>Select</option>";
        foreach ($collection as $row) {
            $select_option.="<option value='".$row->$id."'>".$row->$column."</option>";
        }
        return $select_option;    
    
    }

    public static function getValue($table,$id){
       return DB::table($table)->where('id',$id)->get();
    }

    public function getValueByAjax(Request $request)
    {
        $table = $request->table;
        $colum = $request->colum;
        $key = $request->key;
        $val = $request->val;

        $res = DB::table($table)->where($key, $val)->value($colum);
        return $res;
    }

    public function getValueRow(Request $request)
    {
        $table = $request->table;
        $key = $request->key;
        $val = $request->val;

        $res = DB::table($table)->where($key, $val)->get()->first();
        return json_encode($res);
    }

    public function editValueByAjax(Request $request)
    {
        $table = $request->table;
        $key = $request->key;
        $value = $request->value;
        $res = DB::table($table)->where($key, $value)->first();
        return json_encode($res);
    }

    public function deleteRecordByAjax(Request $request)
    {
        $table = $request->table;
        $key = $request->key;
        $value = $request->value;
        $res = DB::table($table)->where($key, $value)->delete();
        return "DELETE_SUCESSFULLY";
    }

    public static function getTotalAmount($purchase_id)
    {
        $res = DB::select("SELECT SUM(total) AS total_amount FROM `purchase_details` WHERE purchase_id = $purchase_id");
        return $res[0]->total_amount;
    }

    public static function getTotalAmountSale($purchase_id)
    {
        $res = DB::select("SELECT SUM(total) AS total_amount FROM `sale_details` WHERE sale_id = $purchase_id");
        return $res[0]->total_amount;
    }


    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        
        DB::table('sessions')->update(['status'=>2]);
     
        $data = session::find($id);
        $data->status = $status;
        $data->save();
        return Redirect::back();

    }

    public function getSaleBuyRate(Request $request)
    {
        $data ='';
        $id = $request->id;
        $date=date('Y-m-d');
        $min = $this->minStocks($date,$id);
        $minStocks = "In Stocks : ".$min;
        $res = DB::table('purchase_details')->where('product_id', $id)->orderBy('id','DESC')->get();
        if($res->count()){
          $data =  array('buyRate'=>$res[0]->buyRate,'saleRate'=>$res[0]->saleRate,'unit_id'=>$res[0]->unit_id,'minStocks'=>$minStocks);
        }else{
             $res = \App\Models\Product::where('id',$id)->first();
            $data = array('buyRate'=>$res->price,'saleRate'=>'','unit_id'=>$res->unit_id,'minStocks'=>$minStocks);
        }
      return json_encode($data,true);
    }

    static function minStocks($date,$id)
    {
        $data = \App\Models\Product::where('id',$id)->first();
        $stock = $data->inStock;
        $purchase_qty = DB::table('purchase_details')->where('date','<=',$date)->where('product_id', $id)->sum('qty');
        $sale_qty = DB::table('sale_details')->where('date','<=',$date)->where('product_id', $id)->sum('qty');
        return $stock+$purchase_qty-$sale_qty;
    }

}
