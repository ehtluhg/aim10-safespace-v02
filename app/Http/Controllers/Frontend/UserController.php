<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
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

    public function about()
    {
        return view('frontend.pages.about');
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

    public function viewUserDetails($category_id, $post_id, $friend_id)
    {
        $friend = User::where('id', $friend_id)->first();

        if ($friend) {
            $category = Category::where('id', $category_id)->where('status', '1')->first();
            $post = Post::where('category_id', $category->id)->where('id', $post_id)->where('status', '1')->first();
            $latest_post = Post::where('category_id', $category->id)->where('status', '1')->where('created_by', $friend_id)->orderBy('created_at', 'DESC')->get()->take(5);
            $user_id = Auth::user()->id;
            // $friend_id = User::where('id', $id)->value('id');
            $friend_id = User::where('id', $friend_id)->value('id');



            $friendCount = Friendship::where('user_id', $user_id)->where('friend_id', $friend_id)->count();

            if ($friendCount > 0) {
                $friendDetails = Friendship::where('user_id', $user_id)->where('friend_id', $friend_id)->first();
                $alreadyExist = Friendship::where('user_id', $friend_id)->where('friend_id', $user_id)->first();

                if ($friendDetails->status == 1) {
                    $friendStatus = "Unfriend";
                } elseif ($friendDetails->status == 0) {
                    $friendStatus = "Friend Request Sent";
                } elseif ($alreadyExist->status == 0) {
                    $friendStatus = "Accept";
                } else {
                    $friendStatus = "Add Friend";
                }
            } else {
                $friendStatus = "";
            }

            return view('frontend.users.view', compact('friend', 'friendStatus', 'latest_post', 'post', 'category'));
        } else {
            return redirect('/');
        }
        return view('frontend.index');
    }

    public function addFriend($friend_id)
    {
        $userCount = User::where('id', $friend_id)->count();
        if ($userCount > 0) {

            $user_id = Auth::user()->id;
            $friendExist = Friendship::where('user_id', $user_id)->where('friend_id', $friend_id)->exists();

            if ($friendExist == true) {
                $friendExist = Friendship::where('user_id', $user_id)->first();
                $friendExist->update([
                    'status' => '0'
                ]);
            }

            if ($friendExist == false) {
                $friend = new Friendship;
                $friend->user_id = $user_id;
                $friend->friend_id = $friend_id;
                $friend->save();
            }

            $friendCount = Friendship::where('user_id', $user_id)->count();
            $friendDetails = Friendship::where('user_id', $user_id)->where('friend_id', $friend_id)->exists();
            if ($friendDetails == true) {
                if ($friendCount > 0) {
                    $friendDetails = Friendship::where('user_id', $user_id)->where('friend_id', $friend_id)->first();
                    if ($friendDetails->status == 1) {
                        $friendStatus = "Unfriend";
                    } elseif ($friendDetails->status == 0) {
                        $friendStatus = "Friend Request Sent";
                    } else {
                        $friendStatus = "Add Friend";
                    }
                } else {
                    $friendStatus = "Add Friend";
                }
            }
        } else {
            $friendStatus = "";
        }

        $searchUsers = User::where('id', 'LIKE', '%' . $friend_id . '%')->latest()->paginate(3);

        return view('frontend.pages.search', compact('friendStatus', 'searchUsers'));
    }

    public function acceptFriend($friend_id)
    {

        $user_id = Auth::user()->id;
        // $friend = Friendship::where('user_id', $friend_id)->where('friend_id', $user_id);
        // $friend->update([
        //     'status' => '1'
        // ]);
        // $newFriendship = new Friendship;
        // $newFriendship->user_id = $user_id;
        // $newFriendship->friend_id = $friend_id;
        // $newFriendship->status = 1;
        // $newFriendship->save();

        $friendExist = Friendship::where('user_id', $user_id)->where('friend_id', $friend_id)->exists();

        if ($friendExist == true) {
            $friendExist = Friendship::where('user_id', $user_id)->where('friend_id', $friend_id)->first();
            if ($friendExist->status == 0) {
                $friendExist->update([
                    'status' => '1'
                ]);

                $asFriend = Friendship::where('user_id', $friend_id)->where('friend_id', $user_id)->first();
                $asFriend->update([
                    'status' => '1'
                ]);
            } elseif ($friendExist->status == 2) {
                $friendExist->update([
                    'status' => '1'
                ]);

                $asFriend = Friendship::where('user_id', $friend_id)->where('friend_id', $user_id)->first();
                $asFriend->update([
                    'status' => '1'
                ]);
            } else {
                $friend = Friendship::where('user_id', $friend_id)->where('friend_id', $user_id);
                $friend->update([
                    'status' => '1'
                ]);
                $newFriendship = new Friendship;
                $newFriendship->user_id = $user_id;
                $newFriendship->friend_id = $friend_id;
                $newFriendship->status = 1;
                $newFriendship->save();
                // $userCount = User::where('id', $friend_id)->count();
                // if ($userCount > 0) {
                //     $newFriendship = new Friendship;
                //     $newFriendship->user_id = $user_id;
                //     $newFriendship->friend_id = $friend_id;
                //     $newFriendship->status = 1;
                //     $newFriendship->save();
                // }
            }
        } else {
            $friend = Friendship::where('user_id', $friend_id)->where('friend_id', $user_id);
            $friend->update([
                'status' => '1'
            ]);
            $newFriendship = new Friendship;
            $newFriendship->user_id = $user_id;
            $newFriendship->friend_id = $friend_id;
            $newFriendship->status = 1;
            $newFriendship->save();
        }

        return redirect()->back()->with('message', 'You have successfully accepted a friend!');
    }

    public function unfriend($friend_id)
    {
        $user_id = Auth::user()->id;
        $friend = Friendship::where('user_id', $friend_id)->where('friend_id', $user_id);
        $friend->update([
            'status' => '2'
        ]);

        $friend = Friendship::where('user_id', $user_id)->where('friend_id', $friend_id);
        $friend->update([
            'status' => '2'
        ]);

        return redirect()->back()->with('message', 'User successfully removed from your friends list');
    }

    public function cancel($friend_id)
    {
        $user_id = Auth::user()->id;
        $friend = Friendship::where('user_id', $user_id)->where('friend_id', $friend_id)->exists();
        if ($friend == true) {
            $friend = Friendship::where('user_id', $friend_id)->where('friend_id', $user_id)->first();
            $friend->update([
                'status' => '2'
            ]);

            $friend = Friendship::where('user_id', $user_id)->where('friend_id', $friend_id);
            $friend->update([
                'status' => '2'
            ]);
        }
        if ($friend == false) {
            $friend = Friendship::where('user_id', $friend_id)->where('friend_id', $user_id)->first();
            $friend->update([
                'status' => '2'
            ]);

            $newFriendship = new Friendship;
            $newFriendship->user_id = $user_id;
            $newFriendship->friend_id = $friend_id;
            $newFriendship->status = 2;
            $newFriendship->save();
        }


        return redirect()->back()->with('message', 'User successfully removed from your friends list');
    }
}
