<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = categories::orderBy('id','DESC')->get();
        return view('category.categories',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.category_create');
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

        $request->validate(['name'=>'required|max:255|unique:categories']);
        if($request->status=='on'){
            $input['status']=1;
        }else{
            $input['status']=0;
        }
        $res = categories::create($input);
        return redirect(route('category.create'))->with('success','Category added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = categories::find($id);
        return view('category.category_create',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $request->validate(['name'=>'required|max:255|unique:categories,id,'.$id]);
        if($request->status=='on'){
            $input['status']=1;
        }else{
            $input['status']=0;
        }
        unset($input['_method']);
        unset($input['_token']);
        $res = categories::where('id',$id)->update($input);
        return redirect(route('category.index'))->with('success','Category updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = categories::find($id)->delete();
        return redirect(route('category.index'))->with('success','Category deleted successfully');
    }
}
