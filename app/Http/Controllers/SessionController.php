<?php

namespace App\Http\Controllers;

use App\Models\session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = session::orderBy('id','DESC')->get();
        return view('session.sessionView',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('session.session');
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

       $request->validate([
           'name'=>'required|max:255|unique:sessions',
           'startDate'=>'date|required',
           'endDate'=>'date|required',
           ]);

    
        $res = session::create($input);

        return redirect(route('session.index'))->with('success','Session Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\session  $session
     * @return \Illuminate\Http\Response
     */
    public function show(session $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\session  $session
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = session::find($id);
        return view('session.session',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\session  $session
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();

       $request->validate([
           'name'=>'required|max:255|unique:sessions,id,'.$id,
           'startDate'=>'date|required',
           'endDate'=>'date|required',
           ]);

        unset($input['_method']);
        unset($input['_token']);
        $res = session::where('id',$id)->update($input);

        return redirect(route('session.index'))->with('success','Session Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\session  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = session::find($id)->delete();
        return redirect(route('session.index'))->with('success','Session Deleted Successfully');



    }
}
