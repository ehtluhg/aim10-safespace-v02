<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $all_categories = Category::where('status', '1')->get();
        $latest_post = Post::where('status', '1')->orderBy('created_at', 'DESC')->get()->take(10);
        return view('frontend.index', compact('all_categories', 'latest_post'));
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
}
