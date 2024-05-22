<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\sale;
use App\Models\saleDetails;
use App\Models\subCategory;
use App\Models\unit;
use Illuminate\Http\Request;
use DB;
use Session;
use Redirect;
use App\Models\PaymentType;
use App\Models\session as sessionTb;
use App\Models\Payment;
use PDF;
use App\Models\Company;


class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = sale::with('party')->get();
        return view('sales.salesView',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = categories::where('status',1)->get();
        $subCategory = subCategory::where('status',1)->get();
        $units = unit::where('status',1)->get();
        $paymentTypes = PaymentType::where('status',1)->get(); 
        
        $reNo = sale::where('session_id',Session::get('session_id'))->orderBy('id','DESC')->select('invoiceSn')->first();
        $prefix = sessionTb::where('id',Session::get('session_id'))->select('saleInvoicePrefix')->first();
       
              

        $invoiceSn = isset($reNo->invoiceSn) ? $reNo->invoiceSn +1 : 1;
        $SnNo = str_pad($invoiceSn, 4, '0', STR_PAD_LEFT); 
        $invoiceNo = $prefix->saleInvoicePrefix."/".$SnNo;
        
        return view('sales.sales',compact('category','subCategory','units','paymentTypes','invoiceNo','invoiceSn'));
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
        if(isset($request->sale_detail_id)){
            
            $saleDetails = array(
                'product_id' => $request->product_id,
                'unit_id' => $request->unit_id,
                'qty' => $request->qty,
                'buyRate' => $request->buyRate,
                'saleRate' => $request->saleRate,
                'profit' => $request->profit,
                'total' => $request->total,
                'user_id' => auth()->user()->id,
                'session_id' => Session::get('session_id'),
                
            );
    
            if(saleDetails::where('id',$request->sale_detail_id)->update($saleDetails)){
                return "UPDATE_SUCESSFULLY";
            }else{
                return "FAIL";
            }

        }else{
            $saleDetails = array(
                'sale_id' => $request->sale_id,
                'product_id' => $request->product_id,
                'unit_id' => $request->unit_id,
                'qty' => $request->qty,
                'buyRate' => $request->buyRate,
                'saleRate' => $request->saleRate,
                'profit' => $request->profit,
                'total' => $request->total,
                'user_id' => auth()->user()->id,
                'session_id' => Session::get('session_id'),
            );
            // return $saleDetails;
            if(saleDetails::create($saleDetails)){
                return "ADD_SUCESSFULLY";
            }else{
                return "FAIL";
            }

        }
    }


    public function saleFinalSubmit(Request $request)
    {
        $party_id = $request->party_id; 
        $date = date('Y-m-d', strtotime($request->date));

        $myArray = array(
            'date' => $date,
            'party_id' => $party_id,
            'total' => $request->total,
            'session_id'=>Session::get('session_id'),
            'invoiceNo'=>$request->invoiceNo,
            'invoiceSn'=>$request->invoiceSn,
            'user_id'=>auth()->user()->id,
            'created_at'=>\Carbon\Carbon::now(),

        );
        if($request->sale_id == 0){

            if(!empty($request->payamount) && !empty($request->paymentType)){

                $reNo = Payment::where('type',2)->where('session_id',Session::get('session_id'))->orderBy('id','DESC')->select('receiptSn')->first();
                $prefix = sessionTb::where('id',Session::get('session_id'))->select('SPPrefix')->first();
       
                $receiptSn = isset($reNo->receiptSn) ? $reNo->receiptSn +1 : 1;
                $SnNo = str_pad($receiptSn, 4, '0', STR_PAD_LEFT); 
                $NoReceipt = $prefix->SPPrefix."/".$SnNo;

               $pay = new Payment();
               $pay->payAmount = $request->payamount;
               $pay->payType = $request->paymentType;
               $pay->party_id = $request->party_id;
               $pay->type = "1";
               $pay->page = "4";
               $pay->receiptNo = $NoReceipt;
               $pay->receiptSn = $receiptSn;
               $pay->session_id = Session::get('session_id');
               $pay->user_id = auth()->user()->id;
               $pay->payDate = date('Y-m-d',strtotime($request->date));
               $pay->save();
               $myArray['payment_id'] = $pay->id;
            }



            $id = DB::table('sales')->insertGetId($myArray);           
            if(DB::table('sale_details')->where('sale_id',0)->update(['sale_id'=>$id,'date'=>$date])){
                return "ADD";
            }else{
                return "ADDED_FAIL";
            }

        }else{
           
           $ok=DB::table('sales')
                ->where('id', $request->sale_id)
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
     * @param  \App\Models\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::first();
        $sales = sale::with('party')->where('id', $id)->first();
        $sales_details = saleDetails::with('product', 'unit')
        ->where('sale_id', $id)
        ->orderBy('id', 'DESC')
        ->get();
        $pdf = PDF::loadView('sales.salePDF', compact('sales','sales_details','company'));
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit($id, sale $sale)
    {
        $sale = sale::with('party')->where('id', $id)->first();
        $saleDetails = saleDetails::where('sale_id', $id)->get();
        $payments = Payment::where('id', $sale->payment_id)->first();
        $paymentTypes = PaymentType::where('status',1)->get(); 
        return view('sales.sales', compact('sale', 'saleDetails','payments','paymentTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        saleDetails::where('sale_id',$id)->delete();
        sale::where('id',$id)->delete();
        return back()->with('success','Data Deleted');
    }
}
