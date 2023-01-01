<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.users.profile');
    }

    public function updateUserDetails(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string'],
            'middle_name' => ['nullable', 'string'],
            'last_name' => ['required', 'string'],
            'phone_number' => ['required', 'digits:11'],
            'birthdate' => ['required', 'date'],
            'gender' => ['required', 'integer']
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->name
        ]);

        $user->userDetails()->updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'phone_number' => $request->phone_number,
                'birthdate' => $request->birthdate,
                'gender' => $request->gender,
                'file_id' => $request->file_id
            ]
        );

        return redirect()->back()->with('message', 'User Profile Updated!');
    }

    public function viewUserDetails($user_id)
    {
        $user = User::where('id', $user_id)->first();
        if ($user)
        {
            return view('frontend.users.view', compact('user'));
        }
        else
        {
            return redirect('/');
        }
        return view('frontend.index');
    }
}
