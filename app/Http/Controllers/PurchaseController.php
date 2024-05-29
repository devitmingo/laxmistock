<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Company;
use App\Models\Payment;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use App\Models\PurchaseDetail;
use DB; 
use Session;
use App\Models\session as sessionTb;
use PDF;


class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Purchase::with('party')->get();
        return view('purchase.purchaseView',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paymentTypes = PaymentType::where('status',1)->get(); 
        return view('purchase.purchase',compact('paymentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        if(isset($request->purchase_detail_id)){
            
            $purchaseDetails = array(
                'product_id' => $request->product_id,
                'unit_id' => $request->unit_id,
                'buyRate' => $request->buyRate,
                // 'saleRate' => $request->saleRate,
                'rate' => $request->rate,
                'total' => $request->total
            );
    
            if(PurchaseDetail::where('id',$request->purchase_detail_id)->update($purchaseDetails)){
                return "UPDATE_SUCESSFULLY";
            }else{
                return "FAIL";
            }

        }else{

             $purchaseDetails = array(
                'purchase_id' => $request->purchase_id,
                'product_id' => $request->product_id,
                'unit_id' => $request->unit_id,
                'qty' => $request->qty,
                'buyRate' => $request->buyRate,
                // 'saleRate' => $request->saleRate,
                'total' => $request->total,
                'user_id' => auth()->user()->id,
                'session_id' => Session::get('session_id')
            );
            
            if(PurchaseDetail::create($purchaseDetails)){
                return "ADD_SUCESSFULLY";
            }else{
                return "FAIL";
            }

        }

    }


    public function purchaseFinalSubmit(Request $request)
    {

        $party_id = $request->party_id; 
        $date = date('Y-m-d', strtotime($request->date));

         $myArray = array(
            'date' => $date,
            'party_id' => $party_id,
            'invoiceNo'=>$request->invoiceNo,
            'total'=>$request->total,
            'session_id'=>Session::get('session_id'),
            'user_id'=>auth()->user()->id,
            'created_at'=>\Carbon\Carbon::now(),
        );
        
        if($request->purchase_id == 0){

            if(!empty($request->payamount) && !empty($request->paymentType)){

                $reNo = Payment::where('type',1)->where('session_id',Session::get('session_id'))->orderBy('id','DESC')->select('receiptSn')->first();
                $prefix = sessionTb::where('id',Session::get('session_id'))->select('CPPrefix')->first();
               
                $receiptSn = isset($reNo->receiptSn) ? $reNo->receiptSn +1 : 1;
                $SnNo = str_pad($receiptSn, 4, '0', STR_PAD_LEFT); 
                $NoReceipt = $prefix->CPPrefix."/".$SnNo;

               $pay = new Payment();
               $pay->payAmount = $request->payamount;
               $pay->payType = $request->paymentType;
               $pay->party_id = $request->party_id;
               $pay->type = "2";
               $pay->page = "5";
               $pay->receiptNo = $NoReceipt;
               $pay->receiptSn = $receiptSn;
               $pay->session_id = Session::get('session_id');
               $pay->user_id = auth()->user()->id;
               $pay->payDate = date('Y-m-d',strtotime($request->date));
               $pay->save();
               $myArray['payment_id'] = $pay->id;
            }


            $id = DB::table('purchases')->insertGetId($myArray);  
            
            

            $ok =DB::table('purchase_details')->where('purchase_id',0)->update(['purchase_id'=>$id,'date' => $date]);

           

            if($ok){
                return "ADD";
            }else{
                return "ADDED_FAIL";
            }

        }else{
            
            $ok = DB::table('purchases')
                ->where('id', $request->purchase_id)
                ->update($myArray);
            if(isset($request->pay_id)){
            $pay =Payment::find($request->pay_id);
            $pay->payAmount = $request->payamount;
            $pay->payType = $request->paymentType;
            $pay->save();
            }
            
            
                return "UPDATED";
            
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::first();
        $purchase = Purchase::with('party')->where('id', $id)->first();
        $party_name = $purchase->party->name;
        $purchase_details = PurchaseDetail::with('product', 'unit')
        ->where('purchase_id', $id)
        ->orderBy('id', 'DESC')
        ->get();
        $pdf = PDF::loadView('purchase.purchasePDF', compact('purchase','purchase_details','company'));
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Purchase $purchase)
    {
        $paymentTypes = PaymentType::where('status',1)->get(); 
        $purchase = Purchase::with('party')->where('id', $id)->first();
        $payments = Payment::where('id', $purchase->payment_id)->first();

        $purchaseDetails = PurchaseDetail::where('purchase_id', $id)->get();
        return view('purchase.purchase', compact('purchase', 'purchaseDetails','paymentTypes','payments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
