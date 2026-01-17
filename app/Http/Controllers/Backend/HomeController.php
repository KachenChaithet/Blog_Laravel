<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;
use League\Uri\FeatureDetection;

class HomeController extends Controller
{

    public function AllFeature()
    {
        $features = Feature::latest()->get();
        return view('admin.backend.feature.all_feature', compact('features'));
    }

    public function AddFeature()
    {
        return view('admin.backend.feature.add_feature');
    }

    public function StoreFeature(Request $request)
    {
        Feature::create([
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $request->icon,
        ]);

        $notification = [
            'message' => 'Feature Inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.feature')->with($notification);
    }

    public function DeleteFeature($id)
    {
        $feature = Feature::findOrFail($id);
        $feature->delete();

        $notification = [
            'message' => 'Delete Feature Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.feature')->with($notification);
    }


    public function EditFeature($id)
    {
        $feature = Feature::findOrFail($id);
        return view('admin.backend.feature.edit_feature', compact('feature'));
    }

    public function UpdateFeature(Request $request, $id)
    {
        $feature = Feature::findOrFail($id);
        $feature->update([
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $request->icon,

        ]);

        $notification = [
            'message' => 'Update Feature Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.feature')->with($notification);


    }
}
