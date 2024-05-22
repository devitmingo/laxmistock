<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Expenses;
use App\Models\Payment;
use App\Models\sale;
use App\Models\saleDetails;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use DB;
use App\Models\party;


class ReportController extends Controller
{
  public function index(){
    $date = date('Y-m-d');

    $openingBalance = $this->OpeningBalance2($date);

    $total_sale = sale::where('date',$date)->sum('total');
    $total_purchase = Purchase::where('date',$date)->sum('total');
    $total_expenses = Expenses::where('insertType',1)->where('date',$date)->sum('amount');
    $total_income = Expenses::where('insertType',2)->where('date',$date)->sum('amount');
    $total_customer_pay = Payment::where('type',2)->where('payDate',$date)->sum('payAmount');
    $total_supplier_pay = Payment::where('type',1)->where('payDate',$date)->sum('payAmount');
    $closeBalance = $openingBalance - $total_sale - $total_purchase - $total_expenses + $total_income + $total_customer_pay - $total_supplier_pay;
    return view('home',compact('openingBalance','closeBalance','total_sale','total_purchase','total_expenses','total_income','total_customer_pay','total_supplier_pay'));
  }

  public  function getInfo(){
    $date = date('Y-m-d');

     $openingBalance = $this->OpeningBalance2($date);

    $total_sale = sale::where('date',$date)->sum('total');
    $total_purchase = Purchase::where('date',$date)->sum('total');
    $total_expenses = Expenses::where('insertType',1)->where('date',$date)->sum('amount');
    $total_income = Expenses::where('insertType',2)->where('date',$date)->sum('amount');
    $total_customer_pay = Payment::where('type',2)->where('payDate',$date)->sum('payAmount');
    $total_supplier_pay = Payment::where('type',1)->where('payDate',$date)->sum('payAmount');
    $closeBalance = $openingBalance - $total_sale - $total_purchase - $total_expenses + $total_income + $total_customer_pay - $total_supplier_pay;
  

    $data = array('openingBalance'=>$openingBalance,
                'closeBalance'=>$closeBalance,
                'total_sale'=>$total_sale,
                'total_purchase'=>$total_purchase,
                'total_expenses'=>$total_expenses,
                'total_income'=>$total_income,
                'total_customer_pay'=>$total_customer_pay,
                'total_supplier_pay'=>$total_supplier_pay);
  return json_encode($data,true);

}




    public function companyLedger(Request $request){
        date_default_timezone_set('Asia/Kolkata');
       if(isset($request->fromDate) && isset($request->toDate))
       {
        $fromDate = date('Y-m-d', strtotime($request->fromDate));
        $toDate = date('Y-m-d', strtotime($request->toDate));
       }else{
        $fromDate = date('Y-m-d', strtotime(date('Y-m-d')));
        $toDate = date('Y-m-d', strtotime(date('Y-m-d'))); 
       }
     $condition="date between '".$fromDate."' AND '".$toDate."'";
     $condition2="payDate between '".$fromDate."' AND '".$toDate."'";
    
      $openingBalance = $this->OpeningBalance2($fromDate);

     

     $records = DB::select("SELECT id AS id, date AS date, invoiceNo AS invoiceNo, total AS amount, party_id AS partyId, page FROM sales  WHERE $condition 
     UNION 
     SELECT id AS id, date AS date, invoiceNo AS invoiceNo,  total AS amount, party_id AS partyId ,page
     FROM purchases 
     WHERE $condition 
     UNION
     SELECT id AS id, payDate AS date, receiptNo AS invoiceNo, payAmount AS amount, party_id AS partyId ,page FROM payments 
     WHERE  $condition2
     UNION
     SELECT id AS id, date AS date, id AS invoiceNo, amount AS amount, head_id AS partyId ,page FROM expenses 
     WHERE $condition order by date");  
       
    
        return view('reports.companyLedger',compact('openingBalance','records','fromDate','toDate'));
    }


    public function OpeningBalance2($date)
    {
        date_default_timezone_set('Asia/Kolkata');

        $newDate = date('Y-m-d',(strtotime ( '-1 day' , strtotime ( $date) ) ));

        $company = Company::first();
        $openBal = $company->openingBal;
         $openDate = $company->date;
        if($openDate==$newDate){
          return  $openBal = $company->openingBal;
        }elseif($openDate>$newDate){
          return  $openBal = $company->openingBal; 
        }else{

         $openBal = $company->openingBal; 
           $purchases = Purchase::whereBetween('date',[$openDate,$newDate])->get();
           $total_purchases =0;
           foreach($purchases as $purch){
            $total_purchases += PurchaseDetail::where('purchase_id',$purch->id)->sum('total');
           }

          $sales = sale::whereBetween('date',[$openDate,$newDate])->get();
           $total_sales =0;
           foreach($sales as $salesRow){
            $total_sales += saleDetails::where('sale_id',$salesRow->id)->sum('total');
           }
           $customerPayment = Payment::whereBetween('payDate',[$openDate,$newDate])->where('type',1)->sum('payAmount');
           $supplierPayment = Payment::whereBetween('payDate',[$openDate,$newDate])->where('type',2)->sum('payAmount');
           $income = Expenses::whereBetween('date',[$openDate,$newDate])->where('insertType',2)->sum('amount');
           $expenses = Expenses::whereBetween('date',[$openDate,$newDate])->where('insertType',1)->sum('amount');
           
        return  $openBal + $total_purchases + $customerPayment + $income - $supplierPayment - $total_sales  - $expenses ;
        }
       
    }

    public function saleLedger(Request $request){
      
      date_default_timezone_set('Asia/Kolkata');
       if(isset($request->fromDate) && isset($request->toDate))
       {
        $fromDate = date('Y-m-d', strtotime($request->fromDate));
        $toDate = date('Y-m-d', strtotime($request->toDate));
       }else{
        $fromDate = date('Y-m-d', strtotime(date('Y-m-d')));
        $toDate = date('Y-m-d', strtotime(date('Y-m-d'))); 
       }
       $openingBalance=0;
       $records =[];
       $id = $request->party_id;
       if(isset($request->party_id)){
        $condition="party_id=".$id." AND date between '".$fromDate."' AND '".$toDate."'";
        $condition2="party_id=".$id." AND payDate between '".$fromDate."' AND '".$toDate."'";
       
         $openingBalance = $this->customerOpeing($fromDate,$toDate,$id);
         $records = DB::select("SELECT id AS id, date AS date, invoiceNo AS invoiceNo, total AS amount, party_id AS partyId, page FROM sales  WHERE $condition 
          UNION 
          SELECT id AS id, payDate AS date, receiptNo AS invoiceNo, payAmount AS amount, party_id AS partyId ,page FROM payments 
          WHERE  $condition2
          order by date"); 
          }
        $parties = party::where('status',1)->where('customer',1)->get();
        return view('reports.saleLedger',compact('openingBalance','fromDate','toDate','records','parties'));
    }


    public function customerOpeing($fromDate,$toDate,$party_id){
      date_default_timezone_set('Asia/Kolkata');

      $newDate = date('Y-m-d',(strtotime ( '-1 day' , strtotime ($fromDate) ) ));

      $sup = Party::find($party_id);
      
      $openBal = $sup->opening_balance;
      
      $balanceType = $sup->opening_balance_type;


      $total_sales = sale::where('party_id',$party_id)->where('date','<=', $newDate)->sum('total');
      $customerPayment = Payment::where('party_id',$party_id)->where('payDate','<=', $newDate)->where('type',1)->sum('payAmount');
         if($balanceType=='Dr'){
          return  $customerPayment  - $openBal - $total_sales;
    
        }
         if($balanceType=='Cr'){
          return  $openBal + $customerPayment - $total_sales;
    
        }
      
    
    }


    public function purchaseLadger(Request $request){
      date_default_timezone_set('Asia/Kolkata');
      if(isset($request->fromDate) && isset($request->toDate))
      {
       $fromDate = date('Y-m-d', strtotime($request->fromDate));
       $toDate = date('Y-m-d', strtotime($request->toDate));
      }else{
       $fromDate = date('Y-m-d', strtotime(date('Y-m-d')));
       $toDate = date('Y-m-d', strtotime(date('Y-m-d'))); 
      }
      $openingBalance=0;
      $records =[];
      $id = $request->party_id;
      if(isset($request->party_id)){
        $condition="party_id=".$id." AND date between '".$fromDate."' AND '".$toDate."'";
        $condition2="party_id=".$id." AND payDate between '".$fromDate."' AND '".$toDate."'";
      
        $openingBalance = $this->supplierOpeing($fromDate,$toDate,$id)  ;
        $records = DB::select("SELECT id AS id, date AS date, invoiceNo AS invoiceNo, total AS amount, party_id AS partyId, page FROM sales  WHERE $condition 
         UNION 
         SELECT id AS id, payDate AS date, receiptNo AS invoiceNo, payAmount AS amount, party_id AS partyId ,page FROM payments 
         WHERE  $condition2
         order by date"); 
         }
       $parties = party::where('status',1)->where('supplier',1)->get();
     return view('reports.purchaseLadger',compact('openingBalance','fromDate','toDate','records','parties'));
    }
    
    public function supplierOpeing($fromDate,$toDate,$party_id){
      date_default_timezone_set('Asia/Kolkata');

      $newDate = date('Y-m-d',(strtotime ( '-1 day' , strtotime ($fromDate) ) ));

      $sup = Party::find($party_id);
      
      $openBal = $sup->opening_balance;
      
      $balanceType = $sup->opening_balance_type;


      $total_purchase = Purchase::where('party_id',$party_id)->where('date','<=', $newDate)->sum('total');
      $supplierPayment = Payment::where('party_id',$party_id)->where('payDate','<=', $newDate)->where('type',2)->sum('payAmount');
         if($balanceType=='Dr'){
          return $total_purchase - $supplierPayment  - $openBal;
        }
         if($balanceType=='Cr'){
          return  $openBal - $supplierPayment + $total_purchase;
    
        }
      
    
    }

    public function profitLossStatement(Request $request){
      date_default_timezone_set('Asia/Kolkata');
      if(isset($request->fromDate) && isset($request->toDate))
      {
       $fromDate = date('Y-m-d', strtotime($request->fromDate));
       $toDate = date('Y-m-d', strtotime($request->toDate));
      }else{
       $fromDate = date('Y-m-d', strtotime(date('Y-m-d')));
       $toDate = date('Y-m-d', strtotime(date('Y-m-d'))); 
      }

      
      $products = \App\Models\Product::where('status',1)->get();
      $records = saleDetails::whereBetween('date',[$fromDate,$toDate])->get();

       if(isset($request->product)){
        $records = $records->where('product_id',$request->product);  
      }

      return view('reports.profit-loss',compact('records','products','toDate','fromDate'));
    }


    public function productMinStocks(Request $request){
      $toDate = date('Y-m-d', strtotime(date('Y-m-d')));
      $products = \App\Models\Product::where('status',1)->get();
      return view('reports/product-min-stocks',compact('products','toDate'));
    }


}
