<?php

namespace App\Http\Controllers;

use App\Models\CollectionPoint;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $collectionPoints = CollectionPoint::all();
        return view('peta.index', compact('collectionPoints'));
    }
}