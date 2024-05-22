<?php

namespace App\Http\Controllers;

use App\Models\Quatation;
use App\Models\QuatationDetails;
use App\Models\Company;
use App\Models\session as sessionTb;
use Session;
use PDF;

use Illuminate\Http\Request;

class QuatationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Quatation::orderBy('id','DESC')->get();
        return view('quatation.quatationView',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $reNo = Quatation::where('session_id',Session::get('session_id'))->orderBy('id','DESC')->select('invoiceSn')->first();
        $prefix = sessionTb::where('id',Session::get('session_id'))->select('QuatationInvoicePrefix')->first();
       
              

        $invoiceSn = isset($reNo->invoiceSn) ? $reNo->invoiceSn +1 : 1;
        $SnNo = str_pad($invoiceSn, 4, '0', STR_PAD_LEFT); 
        $invoice = $prefix->QuatationInvoicePrefix."/".$SnNo;
        
        return view('quatation.quatation',compact('invoice','invoiceSn'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        if(isset($request->quatation_id))
        {
        $data = new Quatation();
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->date = date('Y-m-d',strtotime($request->date));
        $data->invoice = $request->invoice;
        $data->total = $request->total;
        $data->invoiceSn = $request->invoiceSn;
        $data->session_id = Session::get('session_id');
        $data->user_id = auth()->user()->id;
        $data->user_id = auth()->user()->id;
        $data->save();

         
        $data1=  array('quatation_id' => $data->id,
                'date' => date('Y-m-d',strtotime($request->date)));
         
        QuatationDetails::where('quatation_id',0)->update($data1);
        return "ADD";

        }else{
        $data = Quatation::find($request->quatation_id);
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->date = date('Y-m-d',strtotime($request->date));
        $data->invoice = $request->invoice;
        $data->total = $request->total;
        $data->invoiceSn = $request->invoiceSn;
        $data->session_id = Session::get('session_id');
        $data->user_id = auth()->user()->id;
        $data->user_id = auth()->user()->id;
        $data->save();
        return "UPDATED";
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quatation  $quatation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $company = Company::first();
        $quatation = Quatation::find($id);
        $quatation_details = QuatationDetails::where('quatation_id', $id)->get();
        $pdf = PDF::loadView('quatation.quatationPDF', compact('quatation','quatation_details','company'));
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quatation  $quatation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data =  Quatation::find($id);
        return view('quatation.quatation',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quatation  $quatation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        return $id;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quatation  $quatation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Quatation::find($id);
        QuatationDetails::where('quatation_id',$data->id)->delete();
        $data->delete();

        return redirect(route('quatation.index'))->with('success','Quatation Deleted Successfully');
    }

    public function quatationDetails(Request $request){
        return $request->all();
    }
}
