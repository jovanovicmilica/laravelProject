<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $per_page = $request->get('per_page') ? $request->get('per_page') : 15;

        $supplier_id = $request->get('supplier_id');

        $key = $request->get('key');

        if($supplier_id){
            $supplier = Supplier::find($supplier_id);
            if($supplier){
                $query = $supplier->parts();
            }
            else{
                return response()->json(['Message'=>'Supplier not found'],404);
            }

        }
        else{
            $query = Part::query();
//            $parts = Part::paginate($per_page);
        }
        if ($key) {
            $query->where('part_desc', 'LIKE', "%{$key}%");
        }

        $parts = $query->paginate($per_page);


        return response()->json($parts);
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

        $validator = \Validator::make($request->all(), [
            'part_number' => 'required|string',
            'part_desc' => 'required|string',
            'category_id' => 'nullable|exists:categories,id'
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $part = Part::find($id);



        if(!$part){
            return response()->json(['message' => 'Part not found'], 404);
        }


        $part->part_number = $request->part_number;
        $part->part_desc = $request->part_desc;
        if($request->category_id){
            $part->category_id = $request->category_id;
        }
        $part->save();


        return response()->json($part, 200);
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
        $part = Part::find($id);


        if(!$part){
            return response()->json(['message' => "Part $id not found."], 404);
        }


        $part->delete();

        return response()->json(['message' => "Part $id deleted successfully."], 200);
    }
}
