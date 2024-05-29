<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Illuminate\Http\Request;

class PurchaseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchase_details = PurchaseDetail::with('product', 'unit')->where('purchase_id', 0)->get();
        $html = '';
        $grandtotal=0;
        foreach($purchase_details as $row){
            $grandtotal += $row->total;
            $html .= '
                        <tr>
                                <td>'.$row->id.'</td>
                                <td>'.$row->product->name.'</td>
                                <td>'.$row->unit->name.'</td>
                                <td>'.$row->qty.'</td>
                                <td>'.$row->buyRate.'</td>
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
        $html.='<tr><th colspan="5">Total Amount</th><th>'.$grandtotal.'</th><th>
        <input type="hidden" id="grandTotal" name="grandTotal" value="'.$grandtotal.'" />
        </th></tr>';
        return $html;
    }

   
    public function purchseDetails(Request $request)
    {
        $purchase_id = $request->purchase_id;
        $purchase = Purchase::with('party')->where('id', $purchase_id)->first();
        $party_name = $purchase->party->name;
        $purchase_details = PurchaseDetail::with('product', 'unit')
        ->where('purchase_id', $purchase_id)
        ->orderBy('id', 'DESC')
        ->get();
        return view('purchase.purchaseDetails', compact('party_name', 'purchase_details'));
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
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $purchase_details = PurchaseDetail::with('product', 'unit')
        ->where('purchase_id', $request->purchase_id)
        ->get();
        $html = '';
        $grandtotal=0;
        foreach($purchase_details as $row){
            $grandtotal += $row->total;
            $html .= '
                        <tr>
                                <td>'.$row->id.'</td>
                                <td>'.$row->product->name.'</td>
                                <td>'.$row->unit->name.'</td>
                                <td>'.$row->qty.'</td>
                                <td>'.$row->buyRate.'</td>
                                <td>'.$row->saleRate.'</td>
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
        $html.='<tr><th colspan="5">Total Amount</th><th>'.$grandtotal.'</th><th>
        <input type="hidden" id="grandTotal" name="grandTotal" value="'.$grandtotal.'" />
        </th></tr>';
        return $html;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseDetail $purchaseDetail, Request $request)
    {
        return $request->id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseDetail $purchaseDetail)
    {
        //
    }
}
