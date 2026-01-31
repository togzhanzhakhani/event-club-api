<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityResource;
use App\Http\Resources\EventCategoryResource;
use App\Models\City;
use App\Models\EventCategory;

class MetaController extends Controller
{
    public function index()
    {
        return response()->json([
            'cities' => CityResource::collection(
                City::orderBy('name')->get()
            ),
            'categories' => EventCategoryResource::collection(
                EventCategory::orderBy('name')->get()
            ),
        ]);
    }
}
