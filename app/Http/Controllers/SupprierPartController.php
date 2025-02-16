<?php

namespace App\Http\Controllers;

use App\Models\Supplier_Part;
use App\Models\SupplierPart;
use Illuminate\Http\Request;

class SupprierPartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $per_page = $request->get('per_page', 15);

        // Get supplier-parts with pagination
//        $supplierParts = Supplier_Part::paginate($per_page);


        $supplierParts = SupplierPart::with(['part.category', 'condition:id,condition_name','part.category'])
        ->paginate($per_page)
            ->through(function ($supplierPart) {
                return [
                    'supplier_name' => $supplierPart->supplier->supplier_name,
                    'days_valid' => $supplierPart->days_valid,
                    'priority' => $supplierPart->priority,
                    'part_number' => $supplierPart->part ? $supplierPart->part->part_number : 'N/A',
                    'part_desc' => $supplierPart->part ? $supplierPart->part->part_desc : 'N/A',
                    'quantity' => $supplierPart->quantity,
                    'price' => $supplierPart->price,
                    'condition_name' => $supplierPart->condition ? $supplierPart->condition->condition_name : 'N/A',
                    'category' => optional($supplierPart->part->category)->category_name ?? 'N/A',
                ];
            });

        return response()->json($supplierParts);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
