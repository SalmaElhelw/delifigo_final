<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;


class RestaurantController extends Controller
{
    public function index()
    {
        return response()->json(Restaurant::all());
    }

   
   
    public function store(Request $request)
    {
      

        $restaurant = Restaurant::create([
            "name" =>$request->name,
            "type"=>$request->type,
            "location"=>$request->location,
            "phone_num"=> $request->phone_num
        ]
            );
        return response()->json($restaurant, 201);
    }

   
    
    public function show($id)
    {
        return response()->json(Restaurant::findOrFail($id));
    }

   
   
     public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'nullable|string',
            'type' => 'nullable|string',
            'location' => 'nullable|string',
            'phone_number' => 'nullable|string',
        ]);

        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update($validated);

        return response()->json($restaurant);
    }

    
    
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->delete();

        return response()->json(['message' => 'Restaurant deleted successfully']);
    }
}
