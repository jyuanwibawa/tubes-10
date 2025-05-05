<?php

namespace App\Http\Controllers;

use App\Models\CollectionPoint;
use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Display the map with collection points.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collectionPoints = CollectionPoint::all();
        return view('peta.index', compact('collectionPoints'));
    }
}