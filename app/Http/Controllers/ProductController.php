<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\unit;
use App\Models\categories;
use App\Models\subCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Product::with('category','subCategory','unit')->orderBy('id','DESC')->get();
        return view('product.productView',compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = categories::where('status',1)->get();
        $subCategory = subCategory::where('status',1)->get();
        $units = unit::where('status',1)->get();
        return view('product.product',compact('category','subCategory','units'));
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
            'name'=>'required|max:255|unique:products,id',
            'price'=>'required|max:16',
            'category_id'=>'required',
            'sub_category_id'=>'required',
            'unit_id'=>'required',
        ]);
        if($request->status=='on'){
            $input['status']=1;
        }else{
            $input['status']=0;
        }
        Product::create($input);
        return redirect(route('product.create'))->with('success','Product Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = categories::where('status',1)->get();
        $subCategory = subCategory::where('status',1)->get();
        $units = unit::where('status',1)->get();
        $data = product::find($id);
        return view('product.product',compact('category','subCategory','units','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();
        $request->validate([
            'name'=>'required|max:255|unique:products,id,'.$id,
            'price'=>'required|max:16',
            'category_id'=>'required',
            'sub_category_id'=>'required',
            'unit_id'=>'required',
        ]);

        if($request->status=='on'){
            $input['status']=1;
        }else{
            $input['status']=0;
        }
        unset($input['_method']);
        unset($input['_token']);
        Product::where('id',$id)->update($input);
        return redirect(route('product.index'))->with('success','Product Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::where('id',$id)->delete();
        return redirect(route('product.index'))->with('success','Product Deleted Successfully');
    }
}
