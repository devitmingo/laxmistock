<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = PaymentType::orderBy('id','DESC')->get();
        return view('paymentType.paymentTypeView',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paymentType.paymentType');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $request->validate(['name'=>'required|max:255|unique:units']);
        if($request->status=='on'){
            $input['status']=1;
        }else{
            $input['status']=0;
        }
        $res = PaymentType::create($input);
        return redirect(route('paymentType.create'))->with('success','Payment Type added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentType $paymentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PaymentType::find($id);
        return view('paymentType.paymentType',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();

        $request->validate(['name'=>'required|max:255|unique:payment_types,id,'.$id]);
        if($request->status=='on'){
            $input['status']=1;
        }else{
            $input['status']=0;
        }

        unset($input['_method']);
        unset($input['_token']);
        $res = PaymentType::where('id',$id)->update($input);
        return redirect(route('paymentType.index'))->with('success','Payment Type Upated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentType  $paymentType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PaymentType::find($id)->delete();
        return redirect(route('paymentType.index'))->with('success','Payment Type Deleted Successfully');
 
    }
}
