<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\session as sessionTb;
use App\Models\party;
use Illuminate\Http\Request;
use Session;
use App\Models\PaymentType;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Payment::with('party')->where('type',2)->where('session_id',Session::get('session_id'))->get();
        return view('supplierPayment.supplierPaymentView',compact('records'));
    }

    public function customerPaymentIndex()
    {
        $records = Payment::with('party')->where('type',1)->where('session_id',Session::get('session_id'))->get();
        return view('customerPayment.customerPaymentView',compact('records'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reNo = Payment::where('type',2)->where('session_id',Session::get('session_id'))->orderBy('id','DESC')->select('receiptSn')->first();
        $prefix = sessionTb::where('id',Session::get('session_id'))->select('SPPrefix')->first();
       
       $receiptSn = isset($reNo->receiptSn) ? $reNo->receiptSn +1 : 1;
        $SnNo = str_pad($receiptSn, 4, '0', STR_PAD_LEFT); 
        $NoReceipt = $prefix->SPPrefix."/".$SnNo;
        $parties = party::where('supplier',1)->get();
        $paymentTypes = PaymentType::where('status',1)->get(); 
        return view('supplierPayment.supplierPayment',compact('parties','NoReceipt','receiptSn','paymentTypes'));
    }

    public function customerPayment()
    {
        $reNo = Payment::where('type',1)->where('session_id',Session::get('session_id'))->orderBy('id','DESC')->select('receiptSn')->first();
        $prefix = sessionTb::where('id',Session::get('session_id'))->select('CPPrefix')->first();
       
       $receiptSn = isset($reNo->receiptSn) ? $reNo->receiptSn +1 : 1;
        $SnNo = str_pad($receiptSn, 4, '0', STR_PAD_LEFT); 
        $NoReceipt = $prefix->CPPrefix."/".$SnNo;
        $parties = party::where('customer',1)->get();
        $paymentTypes = PaymentType::where('status',1)->get(); 
        return view('customerPayment.customerPayment',compact('parties','NoReceipt','receiptSn','paymentTypes'));
   

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input =  $request->all();

       $request->validate([
        'party_id'=>'required',
        'payAmount'=>'required|max:16',
        'payDate'=>'required|date',
       ]);
       
       $input['session_id']=Session::get('session_id');
       $input['user_id']=auth()->user()->id;
       Payment::create($input);
       return redirect()->back()->with('success','Payment Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
       $data = Payment::find($id);
       $paymentTypes = PaymentType::where('status',1)->get(); 
       if($data->type=='2'){
       $parties = party::where('supplier',1)->get();
        return view('supplierPayment.supplierPayment',compact('parties','data','paymentTypes'));
       }

       if($data->type=='1'){
        $parties = party::where('customer',1)->get();
        return view('customerPayment.customerPayment',compact('parties','data','paymentTypes'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input =  $request->all();

       $request->validate([
        'party_id'=>'required',
        'payAmount'=>'required|max:16',
        'payDate'=>'required|date',
       ]);
       unset($input['_token']);
       unset($input['_method']);
       
       Payment::where('id',$id)->update($input);
       if($request->type=='2'){
       return redirect(route('supplierPayment.index'))->with('success','Payment Updated Successfully');
       }
       if($request->type=='1'){
        return redirect(route('customerPaymentIndex'))->with('success','Payment Updated Successfully');
        }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Payment::where('id',$id)->delete();
        return redirect()->back()->with('success','Payment Deleted Successfully');
 
    }
}
