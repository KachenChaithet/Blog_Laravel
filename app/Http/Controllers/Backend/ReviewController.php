<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use League\Flysystem\UnableToCheckFileExistence;

class ReviewController extends Controller
{
    //
    public function AllReview()
    {
        $reviews = Review::latest()->get();
        return view('admin.backend.review.all_review', compact('reviews'));
    }

    public function AddReview()
    {
        return view('admin.backend.review.add_review');
    }

    public function StoreReview(Request $request)
    {


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->extension();
            $img = $manager->read($image);
            $img->resize(60, 60)->save(public_path('uploads/reviews/' . $name_gen));

            Review::create([
                'name' => $request->name,
                'position' => $request->position,
                'message' => $request->message,
                'image' => $name_gen,
            ]);
        }

        $notification = array(
            'message' => 'Review Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.review')->with($notification);
    }

    public function EditReview($id)
    {
        $review = Review::findOrFail($id);

        return view('admin.backend.review.edit_review', compact('review'));
    }

    public function UpdateReview(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $imageName = $review->image;

        if ($request->hasFile('image')) {
            if ($review->image && file_exists(public_path('uploads/reviews/' . $review->image))) {
                unlink(public_path('uploads/reviews/' . $review->image));
            }
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $imageName = hexdec(uniqid()) . '.' . $image->extension();
            $img = $manager->read($image);
            $img->resize(60, 60)->save(public_path('uploads/reviews/' . $imageName));
        }


        $review->update([
            'name' => $request->name,
            'position' => $request->position,
            'message' => $request->message,
            'image' => $imageName,
        ]);
        $notification = array(
            'message' => 'Review Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.review')->with($notification);
    }

    public function DeleteReview($id)
    {
        $review = Review::findOrFail($id);

        $path = public_path('uploads/reviews/' . $review->image);

        if ($review->image && file_exists($path)) {
            unlink($path);
        }

        $review->delete();
        $notification = [
            'message' => 'Review Deleted Successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('all.review')->with($notification);
    }
}
