<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categories;
use App\Models\subCategory;
use App\Models\unit;
use App\Models\Product;
use App\Models\party;
use App\Models\Head;

class addShortController extends Controller
{
    public function addNew(Request $request){
        

        //add category;
        if($request->page=='category'){
            $input['name']=$request->xcategory;
            $input['status']='1';
            unset($input['page']);
           return categories::create($input);            
        }

        //add Sub category;
        if($request->page=='subCategory'){
            $input=$request->all();
            $input['status']='1';
            unset($input['page']);
           return subCategory::create($input);            
        }


         //add units;
         if($request->page=='unit'){
            $input=$request->all();
            $input['status']='1';
            unset($input['page']);
           return unit::create($input);            
        }

          //add units;
          if($request->page=='product'){
            $input=$request->all();
            unset($input['page']);
           return Product::create($input);            
        }


         //add party;
         if($request->page=='party'){
            $input=$request->all();
            unset($input['page']);
           return party::create($input);            
        }

        //add head;
        if($request->page=='head'){
         $input=$request->all();
         $input['status']='1';
         unset($input['page']);
        return Head::create($input);            
     }

    }
}
