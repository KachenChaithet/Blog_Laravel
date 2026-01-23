<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

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
            'message' => 'BlogCategory Insert Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function EditBlogCategory($id)
    {
        $categories = BlogCategory::find($id);
        return response()->json($categories);
    }

    public function UpdateBlogCategory(Request $request)
    {
        $cat_id = $request->cat_id;

        BlogCategory::findOrFail($cat_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => Str::slug($request->category_name)
        ]);

        $notification = array(
            'message' => 'BlogCategory Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteBlogCategory(Request $request, $id)
    {
        $category = BlogCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'BlogCategory Delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function AllBlogPost()
    {
        $posts = BlogPost::latest()->get();
        return view('admin.backend.post.all_post', compact('posts'));
    }

    public function AddBlogPost()
    {
        $categories = BlogCategory::latest()->get();
        return view('admin.backend.post.add_post', compact('categories'));
    }

    public function StoreBlogPost(Request $request)
    {
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = Str::uuid() . '.' . $image->extension();
            $manager = new ImageManager(new Driver());
            $imageresize = $manager->read($image);
            $imageresize->resize(746, 500)->save(public_path('uploads/post/' . $imageName));
        }
        BlogPost::create([
            'post_title' => $request->post_title,
            'post_slug' => Str::slug($request->post_title),
            'blogcat_id' => $request->blogcat_id,
            'long_desrp' => $request->long_desrp,
            'image' => $imageName
        ]);

        $notification = array(
            'message' => 'BlogPost Created Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.post')->with($notification);
    }

    public function EditBlogPost($id)
    {
        $post = BlogPost::findOrFail($id);
        $categories = BlogCategory::latest()->get();
        return view('admin.backend.post.edit_post', compact('post', 'categories'));
    }

    public function UpdateBlogPost(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $imageName = $post->image;
        if ($request->hasFile('image')) {
            if ($post->image && file_exists(public_path(path: 'uploads/post/' . $post->image))) {
                unlink(public_path(path: 'uploads/post/' . $post->image));
            }
            $image = $request->file('image');
            $imageName = Str::uuid() . "." . $image->extension();
            $manager = new ImageManager(new Driver());
            $Imageresize = $manager->read($image);
            $Imageresize->resize(746, 500)->save(public_path('uploads/post/' . $imageName));
        }

        $post->update([
            'post_title' => $request->post_title,
            'post_slug' => Str::slug($request->post_title),
            'blogcat_id' => $request->blogcat_id,
            'long_desrp' => $request->long_desrp,
            'image' => $imageName
        ]);
        $notification = array(
            'message' => 'BlogPost Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.post')->with($notification);
    }

    public function DeleteBlogPost($id)
    {
        $post = BlogPost::findOrFail($id);
        if ($post->image && file_exists(public_path('uploads/post/' . $post->image))) {
            unlink(public_path('uploads/post/' . $post->image));
        }

        $post->delete();
        $notification = array(
            'message' => 'BlogPost Delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.post')->with($notification);
    }
}
