<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\BlogCategory;
use App\Models\BlogPost;
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

    public function BlogPage()
    {
        $categories = BlogCategory::latest()->withCount('countPost')->get();
        $posts = BlogPost::latest()->limit(5)->get();
        $recentpost = BlogPost::latest()->limit(3)->get();
        return view('home.blog.list_blog', compact('categories', 'posts', 'recentpost'));
    }

    public function BlogDetails($slug)
    {
        $blog = BlogPost::where('post_slug', $slug)->first();
        $categories = BlogCategory::latest()->withCount('countPost')->get();
        $recentpost = BlogPost::latest()->limit(3)->get();
        return view('home.blog.blog_details', compact('blog', 'categories', 'recentpost'));
    }
}
