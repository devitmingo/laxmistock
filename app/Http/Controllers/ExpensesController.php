<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\Head;
use Illuminate\Http\Request;
use Session;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Expenses::with('head')->where('insertType',1)->get();
        return view('expenses.expensesView',compact('records'));
        
    }


    public function incomeIndex()
    {
        $records = Expenses::with('head')->where('insertType',2)->get();
        return view('income.incomeView',compact('records'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $heads = Head::where('status',1)->get();
        return view('expenses.expenses',compact('heads'));
    }

    public function incomeCreate()
    {
        $heads = Head::where('status',1)->get();
        return view('income.income',compact('heads'));
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
        'head_id'=>'required',
        'amount'=>'required|max:16',
        'date'=>'required|date',
        'payType'=>'required',
       ]);
       unset($input['_token']);
       unset($input['_method']);
       $input['session_id']=Session::get('session_id');
       $input['user_id']=auth()->user()->id;
       Expenses::create($input);
      if($request->insertType==1){
       return redirect(route('expenses.index'))->with('success','Expenses Added Successfully');
      }
      else if($request->insertType==2){
        return redirect(route('incomeIndex'))->with('success','Income Added Successfully');
       }else{
           return redirect()->back();
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function show(Expenses $expenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $data = Expenses::find($id);
        $heads = Head::where('status',1)->get();
        if($data->insertType==1){
        return view('expenses.expenses',compact('heads','data'));
        }

        if($data->insertType==2){
            return view('income.incomeView',compact('heads','data'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input =  $request->all();

        $request->validate([
         'head_id'=>'required',
         'amount'=>'required|max:16',
         'date'=>'required|date',
         'payType'=>'required',
        ]);
        unset($input['_token']);
        unset($input['_method']);
        $input['session_id']=Session::get('session_id');
        $input['user_id']=auth()->user()->id;
        Expenses::where('id',$id)->update($input); 
        return redirect(route('expenses.index'))->with('success','Expenses Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Expenses::where('id',$id)->delete(); 
        return redirect()->back()->with('success','Expenses Deleted Successfully');

    }
}
