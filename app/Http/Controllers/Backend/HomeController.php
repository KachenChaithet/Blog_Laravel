<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function AllFeature()
    {
        $features = Feature::latest()->get();
        return view('admin.backend.feature.all_feature', compact('features'));
    }
}
