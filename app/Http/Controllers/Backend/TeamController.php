<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class TeamController extends Controller
{
    //
    public function AllTeam()
    {
        $teams = Team::latest()->get();
        return view('admin.backend.team.all_team', compact('teams'));
    }

    public function AddTeam()
    {
        return view('admin.backend.team.add_team');
    }

    public function StoreTeam(Request $request)
    {

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $imageName = Str::uuid() . '.' . $image->extension();
            $imageresize = $manager->read($image);
            $imageresize->resize(306, 400)->save(public_path('uploads/teams/' . $imageName));

            Team::create([
                'name' => $request->name,
                'position' => $request->name,
                'image' => $imageName,
            ]);
        }

        $notification = array(
            'message' => 'Team Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.team')->with($notification);
    }

    public function EditTeam($id)
    {
        $team = Team::findOrFail($id);
        return view('admin.backend.team.edit_team', compact('team'));

    }

    public function UpdateTeam(Request $request, $id)
    {
        $team = Team::findOrFail($id);
        $imageName = $team->image;
        if ($request->hasFile('image')) {
            if ($team->image && file_exists(public_path('uploads/teams/' . $team->image))) {
                unlink(public_path('uploads/teams/' . $team->image));
            }
            $image = $request->file('image');
            $imageName = Str::uuid() . '.' . $image->extension();
            $manager = new ImageManager(new Driver());
            $imageresize = $manager->read($image);
            $imageresize->resize(306, 400)->save(public_path('uploads/teams/' . $imageName));
        }

        $team->update([
            'name' => $request->name,
            'position' => $request->position,
            'image' => $imageName
        ]);
        $notification = array(
            'message' => 'Team Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.team')->with($notification);

    }

    public function DeleteTeam($id)
    {

        $team = Team::findOrFail($id);

        if ($team->image && file_exists(public_path('uploads/teams/' . $team->image))) {
            unlink(public_path('uploads/teams/' . $team->image));
        }
        ;
        $team->delete();
        $notification = array(
            'message' => 'Team Delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.team')->with($notification);

    }
}
