<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Clarifi;
use App\Models\Feature;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

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


    public function GetClarifis()
    {
        $clarifis = Clarifi::findOrFail(1);

        return view('admin.backend.clarifi.get_clarifi', compact('clarifis'));
    }

    public function UpdateClarifis(Request $request)
    {
        $clarifi = Clarifi::findOrFail(1);
        $imageName = $clarifi->image;

        if ($request->hasFile('image')) {
            if ($clarifi->image && file_exists(public_path('uploads/clarifi/' . $clarifi->image))) {
                unlink(public_path('uploads/clarifi/' . $clarifi->image));
            }
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $imageName = hexdec(uniqid()) . '.' . $image->extension();
            $img = $manager->read($image);
            $img->resize(302, 618)->save(public_path('uploads/clarifi/' . $imageName));
        }


        $clarifi->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName

        ]);
        $notification = array(
            'message' => 'Clarifis Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('get.clarifis')->with($notification);
    }
}
