<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Friendship;
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
            $user_id = Auth::user()->id;
            // $friend_id = User::where('id', $id)->value('id');
            $friend_id = User::where('id', $user_id)->value('id');

            $friendCount = Friendship::where('user_id', $user_id)->where('friend_id',$friend_id)->count();

            if($friendCount>0){
                $friendDetails = Friendship::where('user_id', $user_id)->where('friend_id',$friend_id)->first();

                if($friendDetails->status == 1){
                    $friendStatus = "Unfriend";
                } elseif($friendDetails->status == 0) {
                    $friendStatus = "Friend Request Sent";
                } else {
                    $friendStatus = "Add Friend";
                }
            } else {
                $friendStatus = "";
            }

            return view('frontend.users.view', compact('user', 'friendStatus'));
        }
        else
        {
            return redirect('/');
        }
        return view('frontend.index');
    }

    public function addFriend($friend_id)
    {
        $userCount = User::where('id', $friend_id)->count();
        if ($userCount>0){
            
            $user_id = Auth::user()->id;
            $friend = new Friendship;
            $friend->user_id = $user_id;
            $friend->friend_id = $friend_id;
            $friend->save();
            
            $friendCount = Friendship::where('user_id', $user_id)->count();
            if($friendCount>0){
                    $friendDetails = Friendship::where('user_id',$user_id)->where('friend_id',$friend_id)->first();
                    if($friendDetails->status == 1){
                        $friendStatus = "Unfriend";
                    } else {
                        $friendStatus = "Friend Request Sent";
                    } 
                } else {
                    $friendStatus = "Add Friend";
                }
        } 
        else {
                $friendStatus = "";
        }

            $searchUsers = User::where('id', 'LIKE', '%' . $friend_id . '%')->latest()->paginate(3);

            return view('frontend.pages.search', compact('friendStatus', 'searchUsers'));
        }
        
        public function acceptFriend($friend_id)
        {
            $user_id = Auth::user()->id;
            $friend = Friendship::where('user_id', $friend_id)->where('friend_id', $user_id);
            // $friend->user_id = $data['user_id'];
            // $friend->friend_id = $data['friend_id'];
            $friend->update([
                'status' => '1'
            ]);

            return redirect()->back()->with('message', 'You have successfully accepted a friend!');
        }

}