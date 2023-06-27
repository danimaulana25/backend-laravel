<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Models\Car;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Car::all();
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarRequest $request)
    {
        $validateData = $request->validate([
            'name' => "string",
            'image' => "image|file",
            'brandsName' => "string",
            'typesName' => "string",
            'price' => "integer",
            'color' => "string",
            'year' => "integer",
            'stok' => "integer",
        ]);
        if ($request->file('image')) {
            $imageName = '/storage/cars/' . time() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/cars'), $imageName);
            $validateData['image'] = $imageName;
        }
        Car::create($validateData);
        return response()->json([
            "message" => "Car created successfully"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        // $data = Car::where('id', '=', $id)->get();

        // if ($data) {
        //     return ApiFormatter::createApi(200, 'Success', $data);
        // } else {
        //     return ApiFormatter::createApi(400, 'Failed');
        // }
        return response()->json(
            $car
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarRequest  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $validateData = $request->validate([
            'name' => "string",
            'image' => "image|file",
            'brandsName' => "string",
            'typesName' => "string",
            'price' => "integer",
            'color' => "string",
            'year' => "integer",
            'stok' => "integer",
        ]);
        if ($request->file('image')) {
            $name = explode('/', $car->image)[3];
            if (Storage::exists('public/cars/' . $name)) {
                Storage::delete('public/cars/' . $name);
            }
            $imageName = '/storage/cars/' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('storage/cars'), $imageName);
            $validateData['image'] = $imageName;
        }
        $car->update($validateData);
        return response()->json([
            "message" => "Food updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $name = explode('/', $car->image)[3];
        if (Storage::exists('public/cars/' . $name)) {
            Storage::delete('public/cars/' . $name);
        }
        $car->delete();
        return response()->json([
            "message" => "Car deleted successfully"
        ]);
    }
}
