<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Company::all();
        return view('company.companyView',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.company');
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
            'name'=>'required|max:255|unique:companies',
            'ownerName'=>'required|max:255',
            'mobile'=>'required|max:12',
            'email'=>'required|email',
            ]);
        
        $res = Company::create($input);
        return redirect(route('company.index'))->with('success','Company Added succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Company::find($id);
        return view('company.company',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();

        $request->validate([
            'name'=>'required|max:255|unique:companies,id,'.$id,
            'ownerName'=>'required|max:255',
            'mobile'=>'required|max:12',
            'email'=>'required|email',
            ]);
        unset($input['_method']);
        unset($input['_token']);
        
        $res = Company::where('id',$id)->update($input);
        return redirect(route('company.index'))->with('success','Company Updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Company::where('id',$id)->delete();
        return redirect(route('company.index'))->with('success','Company Deleted succesfully');
    }
}
