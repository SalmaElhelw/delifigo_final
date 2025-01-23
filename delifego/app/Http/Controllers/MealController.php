<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\Meal;


class MealController extends Controller
{
    public function store(Request $request)
    {
      $validated = $request->validate([

    'restaurant_id' => 'required|exists, restaurants_id',
    'name' => 'required|string',
    'description' => 'nullable|string',
    'price' => 'required|numeric',
    'size' => 'nullable|string',
    'flavour' => 'nullable|string',
    'extras' => 'nullable|array',
    'type' => 'nullable|in::chicken,beef,other',

      ]);
    
    
        $meal = Meal::create($validated);
        return response()->json($meal, 201);
    
    }


    public function show($id)
    {

        return response()->json(Meal::findOrFail($id));
    
    }

public function update(Request $request , $id)
{

    $validated = $request->validate([

    
    'name' => 'nullable|string',
    'description' => 'nullable|string',
    'price' => 'nullable|numeric',
    'size' => 'nullable|string',
    'flavour' => 'nullable|string',
    'extras' => 'nullable|array',
    'type' => 'nullable|in::chicken,beef,other',
    ]);

  $meal = Meal::findOrFail($id);
  return response()->json($meal);

}


public function destory($id)
{

    $meal = Meal::findOrFail($id);
    $meal->delete();

    return response()->json(['message' => 'Meal deleted successfully']);

}

}
