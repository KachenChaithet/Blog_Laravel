<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Clarifi;
use App\Models\Connect;
use App\Models\Faq;
use App\Models\Feature;
use App\Models\usability;
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
    public function GetUsability()
    {
        $usability = usability::findOrFail(1);

        return view('admin.backend.usability.get_usability', compact('usability'));
    }
    public function UpdateUsability(Request $request)
    {
        $usability = usability::findOrFail(1);
        $imageName = $usability->image;

        if ($request->hasFile('image')) {
            if ($usability->image && file_exists(public_path('uploads/usability/' . $usability->image))) {
                unlink(public_path('uploads/usability/' . $usability->image));
            }
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $imageName = hexdec(uniqid()) . '.' . $image->extension();
            $img = $manager->read($image);
            $img->resize(560, 400)->save(public_path('uploads/usability/' . $imageName));
        }

        $usability->update([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'image' => $imageName,
            'youtube' => $request->youtube,

        ]);
        $notification = array(
            'message' => 'Clarifis Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('get.usability')->with($notification);
    }


    public function AllConnect()
    {
        $connects = Connect::latest()->get();

        return view('admin.backend.connect.all_connect', compact('connects'));
    }

    public function AddConnect()
    {
        return view('admin.backend.connect.add_connect');
    }

    public function StoreConnect(Request $request)
    {
        Connect::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        $notification = array(
            'message' => 'Connect Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.Connect')->with($notification);
    }

    public function DeleteConnect($id)
    {
        $connect = Connect::findOrFail($id);
        $connect->delete();

        $notification = [
            'message' => 'Delete Connect Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.Connect')->with($notification);
    }

    public function EditConnect($id)
    {
        $connect = Connect::findOrFail($id);
        return view('admin.backend.connect.edit_connect', compact('connect'));
    }

    public function UpdateConnect(Request $request, $id)
    {
        $connect = connect::findOrFail($id);
        $connect->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        $notification = [
            'message' => 'Update Connect Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.Connect')->with($notification);
    }

    public function UpdateConnectFrontend(Request $request, $id)
    {
        $connect = Connect::findOrFail($id);
        $connect->update($request->only(['title', 'description']));
        return response()->json(['success' => true, 'message' => 'Update successfully']);

    }

    public function GetFaqs()
    {
        $faqs = Faq::latest()->get();
        return view('admin.backend.faqs.all_faqs', compact('faqs'));
    }

    public function AddFaqs()
    {
        return view('admin.backend.faqs.add_faqs');

    }

    public function StoreFaqs(Request $request)
    {
        Faq::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        $notification = [
            'message' => 'Faqs Inserted Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.faqs')->with($notification);
    }

    public function EditFaqs($id)
    {

        $faq = Faq::findOrFail($id);
        return view('admin.backend.faqs.edit_faqs', compact('faq'));
    }

    public function DeleteFaqs($id)
    {
        $faqs = Faq::findOrFail($id);
        $faqs->delete();

        $notification = [
            'message' => 'Delete faqs Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.faqs')->with($notification);
    }

    public function UpdateFaqs(Request $request, $id)
    {
        $faqs = Faq::findOrFail($id);
        $faqs->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        $notification = [
            'message' => 'Update faqs Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.faqs')->with($notification);
    }

}

