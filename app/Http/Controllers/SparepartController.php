<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Models\Sparepart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\StoreSparepartRequest;
use App\Http\Requests\UpdateSparepartRequest;

class SparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Sparepart::all();
        // if ($data) {
        //     return ApiFormatter::createApi(200, 'Success', $data);
        // } else {
        //     return ApiFormatter::createApi(400, 'Failed');
        // }
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $sparepart = Sparepart::create([
        //     'name' => $request->name,
        //     'color' => $request->color,
        //     'material' => $request->material,
        //     'price' => $request->price,
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSparepartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSparepartRequest $request)
    {
        $validateData = $request->validate([
            'name' => "string",
            'color' => "string",
            'material' => "string",
            'price' => "integer",
        ]);
        Sparepart::create($validateData);
        return response()->json([
            "message" => "Car created successfully"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sparepart  $sparepart
     * @return \Illuminate\Http\Response
     */
    public function show(Sparepart $sparepart)
    {
        return response()->json(
            $sparepart
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sparepart  $sparepart
     * @return \Illuminate\Http\Response
     */
    public function edit(Sparepart $sparepart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSparepartRequest  $request
     * @param  \App\Models\Sparepart  $sparepart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSparepartRequest $request, Sparepart $sparepart)
    {
        $sparepart->update($request->all());
        return response()->json([
            "message" => "Food updated successfully"
        ]);
        // return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sparepart  $sparepart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sparepart $sparepart)
    {
        $sparepart->delete();
        return response()->json([
            "message" => "sparepart deleted successfully"
        ]);
    }
}
