<?php

namespace App\Http\Controllers\Frontend;

use App\Models\File;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\PostFormRequest;

class PostController extends Controller
{
    public function create()
    {
        $category = Category::where('status', '1')->get();
        return view('frontend.posts.create', compact('category'));
    }

    public function store(PostFormRequest $request)
    {
        $data = $request->validated();

        $post = new Post;

        $post->category_id = $data['category_id'];
        $post->title = $data['title'];
        $post->description = $data['description'];

        if($request->hasfile('file_id'))
        {
            $upload = new File;
            $file = $request->file('file_id');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/post/', $filename);
            $upload->file_name = $filename;
            $upload->save();
            $post->file_id = $upload->id;
        }

        $post->status = $request-> status == true ? '1':'0';
        $post->created_by = Auth::user()->id;
        $post->save();

        return redirect('profile')->with('message', 'Post Added Successfully!');
    }

    public function edit($post_id)
    {
        $category = Category::where('status', '1')->get();
        $posts = Post::find($post_id);
        return view('frontend.users.edit', compact('posts', 'category'));
    }

    public function update(PostFormRequest $request, $post_id)
    {
        $data = $request->validated();

        $post = Post::find($post_id);

        $post->category_id = $data['category_id'];
        $post->title = $data['title'];
        $post->description = $data['description'];
        
        if($request->hasfile('file_id'))
        {
            $upload = new File;
            $file = $request->file('file_id');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/post/', $filename);
            $upload->file_name = $filename;
            $upload->save();
            $post->file_id = $upload->id;
        }

        $post->status = $request-> status == true ? '1':'0';
        $post->created_by = Auth::user()->id;
        $post->update();

        return redirect('admin/posts')->with('message', 'Post Updated Successfully!');
    }

    public function delete($post_id)
    {
        $post = Post::find($post_id);
        $post->delete();
        
        return redirect('admin/posts')->with('message', 'Post Deleted Successfully!');
    }
}
