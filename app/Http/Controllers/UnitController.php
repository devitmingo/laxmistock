<?php

namespace App\Http\Controllers;

use App\Models\unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $records = unit::orderBy('id','DESC')->get();
        return view('unit.unitView',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unit.unit');
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
        $res = unit::create($input);
        return redirect(route('unit.create'))->with('success','Unit added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = unit::find($id);
        return view('unit.unit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();

        $request->validate(['name'=>'required|max:255|unique:units,id,'.$id]);
        if($request->status=='on'){
            $input['status']=1;
        }else{
            $input['status']=0;
        }

        unset($input['_method']);
        unset($input['_token']);
        $res = unit::where('id',$id)->update($input);
        return redirect(route('unit.index'))->with('success','Unit Upated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        unit::find($id)->delete();
        return redirect(route('unit.index'))->with('success','Unit Deleted Successfully');
    }
}
