<?php

namespace App\Http\Controllers;

use App\Models\sale;
use App\Models\saleDetails;
use Illuminate\Http\Request;

class SaleDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sale_details = saleDetails::with('product', 'unit')->where('sale_id', 0)->get();
        $html = '';
        $grandtotal=0;
        $grandprofit=0;
        $grandBuy=0;
        foreach($sale_details as $row){
            $grandtotal += $row->total;
            $grandprofit += $row->profit;
            $grandBuy += $row->qty*$row->buyRate;
            $html .= '
                        <tr>
                                <td>'.$row->id.'</td>
                                <td>'.$row->product->name.'</td>
                                <td>'.$row->unit->name.'</td>
                               
                                <td>'.$row->buyRate.'</td>
                                <td>'.$row->saleRate.'</td>
                                <td>'.$row->qty.'</td>
                                <td>'.$row->total.'</td>
                                <td>'.$grandBuy.'</td>
                                <td>'.$row->profit.'</td>
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
        $html.='<tr><th colspan="6" style="text-align:right;">Total Amount</th><th>'.$grandtotal.'</th><th>'.$grandprofit.'</th><th>'.$grandBuy.'</th><th>
        <input type="hidden" id="grandTotal" name="grandTotal" value="'.$grandtotal.'" />
        </th></tr>';
        return $html;
    }


    public function saleDetails(Request $request)
    {
        $sale_id = $request->sale_id;
        $sales = sale::with('party')->where('id', $sale_id)->first();
        $party_name = $sales->party->name;
        $sales_details = saleDetails::with('product', 'unit')
        ->where('sale_id', $sale_id)
        ->orderBy('id', 'DESC')
        ->get();
        return view('sales.salesDetails', compact('party_name', 'sales_details'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\saleDetails  $saleDetails
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $sales_details = saleDetails::with('product', 'unit')
        ->where('sale_id', $request->sale_id)
        ->get();
        
        $html = '';
        $grandtotal=0;
        $grandprofit=0;
        $grandBuy=0;
        foreach($sales_details as $row){
            $grandtotal += $row->total;
            $grandprofit += $row->profit;
            $grandBuy += $row->qty*$row->buyRate;
            $html .= '
                        <tr>
                                <td>'.$row->id.'</td>
                                <td>'.$row->product->name.'</td>
                                <td>'.$row->unit->name.'</td>
                               
                                <td>'.$row->buyRate.'</td>
                                <td>'.$row->saleRate.'</td>
                                <td>'.$row->qty.'</td>
                                <td>'.$row->total.'</td>
                                <td>'.$grandBuy.'</td>
                                <td>'.$row->profit.'</td>
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
        $html.='<tr><th colspan="6" style="text-align:right;">Total Amount</th><th>'.$grandtotal.'</th><th>'.$grandprofit.'</th><th>'.$grandBuy.'</th><th>
        <input type="hidden" id="grandTotal" name="grandTotal" value="'.$grandtotal.'" />
        </th></tr>';
        return $html;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\saleDetails  $saleDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(saleDetails $saleDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\saleDetails  $saleDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, saleDetails $saleDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\saleDetails  $saleDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(saleDetails $saleDetails)
    {
        //
    }
}
