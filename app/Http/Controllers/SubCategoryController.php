<?php

namespace App\Http\Controllers;

use App\Models\subCategory;
use App\Models\categories;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = subCategory::with('category')->orderBy('id','DESC')->get();
        return view('sub-category.sub-category-view',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = categories::where('status',1)->get();
        // $records = subCategory::with('category')->orderBy('id','DESC')->get();
        return view('sub-category.sub-category',compact('category'));
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

        $request->validate(['name'=>'required|max:255|unique:sub_categories','category_id'=>'required']);
        if($request->status=='on'){
            $input['status']=1;
        }else{
            $input['status']=0;
        }
        $res = subCategory::create($input);
        return redirect(route('sub-category.create'))->with('success','Category added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(subCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = categories::where('status',1)->get();
        $data = subCategory::find($id);
        $records = subCategory::with('category')->orderBy('id','DESC')->get();
        return view('sub-category.sub-category',compact('records','data','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $request->validate(['name'=>'required|max:255|unique:sub_categories,id,'.$id,'category_id'=>'required']);
        if($request->status=='on'){
            $input['status']=1;
        }else{
            $input['status']=0;
        }
        unset($input['_method']);
        unset($input['_token']);
        $res = subCategory::where('id',$id)->update($input);
         return redirect(route('sub-category.index'))->with('success','Category Updated successfully');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = subCategory::find($id)->delete();
        return redirect(route('sub-category.index'))->with('success','Category Deleted successfully');
    }
}
