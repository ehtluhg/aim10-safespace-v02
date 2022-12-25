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
        return view('frontend.index');
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
            return view('frontend.posts.view', compact('post', 'category'));
        }
        else
        {
            return redirect('/');
        }
        return view('frontend.index');
    }
}
