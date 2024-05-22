<?php

namespace App\Http\Controllers;

use App\Models\QuatationDetails;
use Illuminate\Http\Request;

class QuatationDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $quatations = QuatationDetails::where('quatation_id',0)->get();

        $html = '';
        $grandtotal=0;
        foreach($quatations as $row){
            $grandtotal += $row->total;
            $html .= '
                        <tr>
                                <td>'.$row->id.'</td>
                                <td>'.$row->particular.'</td>
                                <td>'.$row->qty.'</td>
                                <td>'.$row->rate.'</td>
                                <td>'.$row->total.'</td>
                                <td>
                                
                                <a href="#" onclick="edit_record('.$row->id.')" class="btn btn-default btn-icon btn-xs tip" rel="tooltip" title="EDIT">
                                <i class="fa fa-pencil"></i>
                                </a>

                                <a href="#" onclick="delete_record('.$row->id.')" class="btn btn-default btn-icon btn-xs tip" rel="tooltip" title="EDIT">
                                <i class="fa fa-minus"></i>
                                </a>

                                

                                </td>
                            </tr>
            ';
        }
        $html.='<tr><th colspan="4" style="text-align:right;">Total Amount</th><th>'.$grandtotal.'</th><th>
        <input type="hidden" id="grandTotal" name="grandTotal" value="'.$grandtotal.'" />
        </th></tr>';
        return $html;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if(empty($request->qua_d_id)){
       $quatationD = new QuatationDetails();
       $quatationD->particular = $request->particular;
       $quatationD->rate = $request->rate;
       $quatationD->qty = $request->qty;
       $quatationD->total = $request->total;
       $quatationD->save();
      }else{
        $quatationD = QuatationDetails::find($request->qua_d_id);
       $quatationD->particular = $request->particular;
       $quatationD->rate = $request->rate;
       $quatationD->qty = $request->qty;
       $quatationD->total = $request->total;
       $quatationD->save();   
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuatationDetails  $quatationDetails
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $quatations = QuatationDetails::where('quatation_id',$request->id)->get();

        $html = '';
        $grandtotal=0;
        foreach($quatations as $row){
            $grandtotal += $row->total;
            $html .= '
                        <tr>
                                <td>'.$row->id.'</td>
                                <td>'.$row->particular.'</td>
                                <td>'.$row->qty.'</td>
                                <td>'.$row->rate.'</td>
                                <td>'.$row->total.'</td>
                                <td>
                                
                                <a href="#" onclick="edit_record('.$row->id.')" class="btn btn-default btn-icon btn-xs tip" rel="tooltip" title="EDIT">
                                <i class="fa fa-pencil"></i>
                                </a>

                                <a href="#" onclick="delete_record('.$row->id.')" class="btn btn-default btn-icon btn-xs tip" rel="tooltip" title="EDIT">
                                <i class="fa fa-minus"></i>
                                </a>

                                

                                </td>
                            </tr>
            ';
        }
        $html.='<tr><th colspan="4" style="text-align:right;">Total Amount</th><th>'.$grandtotal.'</th><th>
        <input type="hidden" id="grandTotal" name="grandTotal" value="'.$grandtotal.'" />
        </th></tr>';
        return $html;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuatationDetails  $quatationDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(QuatationDetails $quatationDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuatationDetails  $quatationDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuatationDetails $quatationDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuatationDetails  $quatationDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuatationDetails $quatationDetails)
    {
        //
    }
}
