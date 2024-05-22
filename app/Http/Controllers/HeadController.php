<?php

namespace App\Http\Controllers;

use App\Models\Head;
use Illuminate\Http\Request;

class HeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Head::orderBy('id','DESC')->get();
        return view('head.headView',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('head.head'); 
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
        $request->validate(['name'=>'required|max:255|unique:heads']);
        if($request->status=='on'){
            $input['status']=1;
        }else{
            $input['status']=0;
        }
        Head::create($input);
        return redirect(route('head.create'))->with('success','Head added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Head  $head
     * @return \Illuminate\Http\Response
     */
    public function show(Head $head)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Head  $head
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Head::find($id);
        return view('head.head',compact('data')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Head  $head
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $request->validate(['name'=>'required|max:255|unique:heads,id,'.$id]);
        if($request->status=='on'){
            $input['status']=1;
        }else{
            $input['status']=0;
        }
        unset($input['_method']);
        unset($input['_token']);
        Head::where('id',$id)->update($input);
        return redirect(route('head.index'))->with('success','Head updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Head  $head
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Head::where('id',$id)->delete();
        return redirect(route('head.index'))->with('success','Head deleted successfully');

    }
}
