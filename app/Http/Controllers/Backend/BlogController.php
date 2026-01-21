<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    //
    public function BlogCategory()
    {
        $categorys = BlogCategory::latest()->get();
        return view('admin.backend.blogcategory.blog_category', compact('categorys'));
    }

    public function StoreBlogCategory(Request $request)
    {
        BlogCategory::create([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name),
        ]);

        $notification = array(
            'message' => 'BlogCategory Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
