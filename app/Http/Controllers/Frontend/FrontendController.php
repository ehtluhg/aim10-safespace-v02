<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\User;
use App\Models\Setting;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $settings = Setting::find(1);
        $all_categories = Category::where('status', '1')->get();
        $latest_post = Post::where('status', '1')->orderBy('created_at', 'DESC')->get()->take(10);
        return view('frontend.index', compact('all_categories', 'latest_post', 'settings'));
    }

    public function viewCategoryPost($category_id)
    {
        $category = Category::where('id', $category_id)->where('status', '1')->first();
        if ($category)
        {
            $post = Post::where('category_id', $category->id)->where('status', '1')->paginate(2);
            return view('frontend.posts.index', compact('post', 'category'));
        }
        else
        {
            return redirect('/');
        }
        return view('frontend.index');
    }

    public function viewPost($category_id, $post_id)
    {
        $category = Category::where('id', $category_id)->where('status', '1')->first();
        if ($category)
        {
            $post = Post::where('category_id', $category->id)->where('id', $post_id)->where('status', '1')->first();
            $latest_post = Post::where('category_id', $category->id)->where('status', '1')->orderBy('created_at', 'DESC')->get()->take(3);
            return view('frontend.posts.view', compact('post', 'category', 'latest_post'));
        }
        else
        {
            return redirect('/');
        }
        return view('frontend.index');
    }

    public function searchUsers(Request $request)
    {
        if ($request->search)
        {
            $searchUsers = User::where('name', 'LIKE', '%' . $request->search . '%')->latest()->paginate(3);
            return view('frontend.pages.search', compact('searchUsers'));
        } else {
            return redirect()->back()->with('message', 'No matches found...');
        }
    }
}
