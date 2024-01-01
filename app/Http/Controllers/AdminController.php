<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    } //End Method

    public function Profile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);

        $role = $adminData->role;

        if ($role == 'Author') {
            return view('admin.admin_profile_view', compact('adminData'));
        } elseif ($role == 'Reviewer') {
            return view('admin.reviewer_profile_view', compact('adminData'));
        } else {
            // Handle other user roles or provide a default view
            return view('admin.leader_profile_view', compact('adminData'));
        }

    } //End Method

    public function EditProfile() {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit', compact('editData'));
    } //End Method

    public function StoreProfile(Request $request) {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->username = $request->username;

        if ($request->file('profile_picture')) {
            $file = $request->file('profile_picture');

            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['profile_picture'] = $filename;
        }
        $data->save();

        return redirect()->back();

    } //End Method

}

