<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class SliderController extends Controller
{
    //
    public function GetSlider()
    {
        $slider = Slider::findOrFail(1);

        return view('admin.backend.slider.get_slider', compact('slider'));
    }

    public function UpdateSlider(Request $request)
    {
        $slider = Slider::findOrFail(1);
        $imageName = $slider->image;

        if ($request->hasFile('image')) {
            if ($slider->image && file_exists(public_path('uploads/sliders/' . $slider->image))) {
                unlink(public_path('uploads/sliders/' . $slider->image));
            }
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $imageName = hexdec(uniqid()) . '.' . $image->extension();
            $img = $manager->read($image);
            $img->resize(306, 618)->save(public_path('uploads/sliders/' . $imageName));
        }


        $slider->update([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'image' => $imageName

        ]);
        $notification = array(
            'message' => 'Slider Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('get.slider')->with($notification);
    }
}
