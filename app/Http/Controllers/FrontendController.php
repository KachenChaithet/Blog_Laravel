<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class FrontendController extends Controller
{
    //
    public function OutTeam()
    {
        return view('home.team.team_page');
    }

    public function AboutUs()
    {
        return view('home.about.about_us');
    }

    public function GetAboutUs()
    {
        $about = About::find(1);

        return view('admin.backend.about.get_about', compact('about'));
    }

    public function UpdateAbout(Request $request)
    {
        $about = About::find(1);
        $imageName = $about->image;

        if ($request->hasFile('image')) {
            if ($about->image && file_exists(public_path('uploads/about/' . $about->image))) {
                unlink(public_path('uploads/about/' . $about->image));
            }
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $imageName = Str::uuid() . '.' . $image->extension();
            $imageresize = $manager->read($image);
            $imageresize->resize(526, 550)->save(public_path('uploads/about/' . $imageName));
        }

        $about->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
        ]);
        $notification = array(
            'message' => 'About Page Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('get.aboutus')->with($notification);
    }
}
