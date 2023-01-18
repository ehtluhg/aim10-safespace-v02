<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\User;
use App\Models\Friendship;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $settings = Setting::find(1);
        $all_categories = Category::where('status', '1')->get();
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $latest_post = Post::where('status', '1')->orderBy('created_at', 'DESC')->get()->take(10);
            return view('frontend.index', compact('all_categories', 'latest_post', 'settings'));
        } else {
            return view('frontend.index', compact('settings', 'all_categories'));
        }
    }

    public function home()
    {
        $settings = Setting::find(1);
        $all_categories = Category::where('status', '1')->get();
        $latest_post = Post::where('status', '1')->orderBy('created_at', 'DESC')->get()->take(10);
        return view('home', compact('all_categories', 'latest_post', 'settings'));
    }

    public function viewCategories()
    {
        $categories = Category::where('status', '1')->get();
        return view('frontend.pages.categories', compact('categories'));
    }

    public function viewCategoryPost($category_id)
    {
        if (Auth::check()) {
            $category = Category::where('id', $category_id)->where('status', '1')->first();
            if ($category) {
                $post = Post::where('category_id', $category->id)->where('status', '1')->paginate(2);
                return view('frontend.posts.index', compact('post', 'category'));
            } else {
                return redirect('/');
            }
            return view('frontend.index');
        } else {
            return redirect()->back()->with('message', 'Please log in first to view posts...');
        }
    }

    public function viewPost($category_id, $post_id, $friend_id)
    {
        if (Auth::check()) {
            $category = Category::where('id', $category_id)->where('status', '1')->first();
            if ($category) {
                $post = Post::where('category_id', $category->id)->where('id', $post_id)->where('status', '1')->first();
                $latest_post = Post::where('category_id', $category->id)->where('status', '1')->where('created_by', $friend_id)->orderBy('created_at', 'DESC')->get()->take(3);
                $user_id = Auth::user()->id;
                $friendsList = Friendship::where('user_id', $user_id)->where('friend_id', $friend_id)->first();
                $friendExist = Friendship::where('user_id', $user_id)->where('friend_id', $friend_id)->exists();
                return view('frontend.posts.view', compact('post', 'category', 'latest_post', 'friendsList', 'friendExist'));
            } else {
                return redirect('/');
            }

            return view('frontend.index', compact('friendsList'));
        }
    }

    public function searchUsers(Request $request)
    {
        if (Auth::check()) {
            if ($request->search) {

                $searchUsers = User::where('name', 'LIKE', '%' . $request->search . '%')->latest()->paginate(3);

                $id = User::where('name', 'LIKE', '%' . $request->search . '%')->value('id');
                $user_id = Auth::user()->id;
                // $friend_id = User::where('id', $id)->value('id');
                $friend_id = User::where('id', $id)->value('id');
                $latest_post = Post::where('status', '1')->orderBy('created_at', 'DESC')->get()->take(10);


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

                return view('frontend.pages.search', compact('searchUsers', 'friendStatus', 'user_id', 'friend_id', 'latest_post'));
            } else {
                return redirect()->back()->with('message', 'No matches found...');
            }
        } else {
            return redirect()->back()->with('message', 'Please log in first to find users...');
        }
    }

    public function unfollow($friend_id)
    {
        $user_id = Auth::user()->id;
        $friend = Friendship::where('user_id', $user_id)->where('friend_id', $friend_id);
        // $friend->user_id = $data['user_id'];
        // $friend->friend_id = $data['friend_id'];
        $friend->update([
            'status' => '1'
        ]);

        return redirect()->back()->with('message', 'You have unfollowed a friend!');
    }

    public function follow($friend_id)
    {
        $user_id = Auth::user()->id;
        // $friend_id = User::where('id', $id)->value('id');
        $friend_id = User::where('id', $friend_id);

        $friendCount = Friendship::where('user_id', $user_id)->where('friend_id', $friend_id)->count();

        if ($friendCount > 0) {
            $friendDetails = Friendship::where('user_id', $friend_id)->where('friend_id', $user_id)->first();

            if ($friendDetails->status == 1) {
                $friendStatus = "Unfriend";
            } elseif ($friendDetails->status == 0) {
                $friendStatus = "Friend Request Sent";
            } else {
                $friendStatus = "Add Friend";
            }
        } else {
            $friendStatus = "";
        }

        return view('frontend.users.view', compact('searchUsers', 'friendStatus', 'user_id', 'friend_id'));
    }

    // $user_id = Auth::user()->id;
    // $friend_id = User::where('id', $id)->value('id');
    // $friend_id = User::where('id', $friend_id);

    // $friendCount = Friendship::where('user_id', $user_id)->where('friend_id', $friend_id)->count();

    // if ($friendCount > 0) {
    //     $friendDetails = Friendship::where('user_id', $user_id)->where('friend_id', $friend_id)->first();

    //     if ($friendDetails->status == 1) {
    //         $friendStatus = "Unfriend";
    //     } elseif ($friendDetails->status == 0) {
    //         $friendStatus = "Friend Request Sent";
    //     } else {
    //         $friendStatus = "Add Friend";
    //     }
    // } else {
    //     $friendStatus = "";
    // }


    public function friendRequests()
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $friendRequestsList = Friendship::where('friend_id', $user_id)->where('status', '0')->get();
            $requestsCount = Friendship::where('friend_id', $user_id)->where('status', '0')->count();
            $friendsList = Friendship::where('friend_id', $user_id)->where('status', '1')->get();
            $friendsCount = Friendship::where('friend_id', $user_id)->where('status', '1')->count();
            return view('frontend.users.requests', compact('friendRequestsList', 'friendsList', 'requestsCount', 'friendsCount'));
        } else {
            return view('frontend.users.requests');
        }
    }
}
