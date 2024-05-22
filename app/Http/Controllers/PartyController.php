<?php

namespace App\Http\Controllers;

use App\Models\party;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Redirect;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $party = party::get();
        return view('party.partyView', compact('party'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('party.party');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if(isset($data['supplier'])){
            $data['supplier'] = 1;
        }
        if(isset($data['customer'])){
            $data['customer'] = 1;
        }
        if(isset($data['status'])){
            $data['status'] = 1;
        }
        unset($data['_token']);
        
        party::create($data);
        $request->session()->flash('success', 'New Party Created Successfully');
        return Redirect::back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\party  $party
     * @return \Illuminate\Http\Response
     */
    public function show(party $party)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\party  $party
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = party::find($id);
        return view('party.party',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\party  $party
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = $request->all();

        if(isset($data['supplier'])){
            $data['supplier'] = 1;
        }
        if(isset($data['customer'])){
            $data['customer'] = 1;
        }
        if(isset($data['status'])){
            $data['status'] = 1;
        }

        unset($data['_token']);
        unset($data['_method']);
        
        party::where('id',$id)->update($data);
        return redirect(route('party.index'))->with('success','Party Details Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\party  $party
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        party::where('id',$id)->delete();
        return redirect(route('party.index'))->with('success','Party Details Deleted Successfully');
    }
}
