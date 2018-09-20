<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        // get the currently authenticated user
        $user = Auth::user();

        return view('pages.settings')->with('user', $user);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        if ($request->has('theme')) {
            // get the currently authenticated user
            // overwrite theme
            $user = Auth::user();
            $user->theme = $request->input('theme');
            $user->save();

            return redirect()->back();
        } 
        
        else {

            if (!empty($request->input('current_password'))) {
                if (!(Hash::check($request->input('current_password'), $user->password))) {
                    // current password and input password does not match
                    return redirect()->back()->with('error', 'Your current password does not matches with the password you provided');
                }

                $this->validate($request, [
                    'current_password' => 'required|string|min:6',
                    'new_password' => 'required_with:current_password|string|min:6|different:current_password|confirmed'
                ]);

                // set new password
                $user->password = Hash::make($request->input('new_password'));
            } 
            
            elseif (empty($request->input('current_password')) && !empty($request->input('new_password'))) {
                $this->validate($request, [
                    'new_password' => 'required_with:current_password|string|min:6|different:current_password|confirmed'
                ]);
                // no changes
                $user->password = $user->password;
            }

            if ($request->input('name') <> $user->name && $request->input('email') <> $user->email) {
                $this->validate($request, [
                    'name' => 'required|string|max:255|min:5|unique:users',
                    'email' => 'required|string|email|max:255|unique:users'
                ]);

                // new username and email
                $user->name = $request->input('name');
                $user->email = $request->input('email');
            }

            elseif ($request->input('name') <> $user->name && $request->input('email') == $user->email) {
                $this->validate($request, [
                    'name' => 'required|string|max:255|min:5|unique:users',
                    'email' => 'required|string|email|max:255'
                ]);

                // new username
                $user->name = $request->input('name');
                $user->email = $request->input('email');
            }

            elseif ($request->input('name') == $user->name && $request->input('email') <> $user->email) {
                $this->validate($request, [
                    'name' => 'required|string|max:255|min:5',
                    'email' => 'required|string|email|max:255|unique:users'
                ]);

                // new email
                $user->name = $request->input('name');
                $user->email = $request->input('email');
            }

            elseif ($request->input('name') == $user->name && $request->input('email') == $user->email) {
                $this->validate($request, [
                    'name' => 'required|string|max:255|min:5',
                    'email' => 'required|string|email|max:255'
                ]);

                // no changes
                $user->name = $request->input('name');
                $user->email = $request->input('email');
            }

            // handle file upload
            if ($request->hasFile('avatar')) {

                $this->validate($request, [
                    'avatar' => 'image|required|mimetypes:image/gif,image/jpeg,image/png|max:3072'
                ]);

                // delete old post image
                Storage::delete('public/'.$user->avatar);

                // Get file extension
                $extension = $request->file('avatar')->getClientOriginalExtension();

                // Rename file
                $fileNameToStore = mt_rand(1000000, 9000000).'_'.time().'.'.$extension;

                // Store file
                $path = $request->file('avatar')->storeAs('public/avatar', $fileNameToStore);

                // path to image
                $avatar = 'avatar/'.$fileNameToStore;

                // set new avatar
                $user->avatar =  $avatar;
            }
            
            $user->save();

            return redirect()->back()->with('success', 'Account updated');
        }
    }
}
