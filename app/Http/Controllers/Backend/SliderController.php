<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    //
    public function GetSlider()
    {
        $slider = Slider::findOrFail(1);

        return view('admin.backend.slider.get_slider', compact('slider'));
    }
}
