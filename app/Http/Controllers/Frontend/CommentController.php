<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::check()) {
            $validator = Validator::make($request->all(), [
                'comment_body' => 'required|string'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('message', 'Comment area is required.');
            }

            $post = Post::where('id', $request->post_id)->where('status', '1')->first();
            if ($post) {
                Comment::create([
                    'post_id' => $post->id,
                    'user_id' => Auth::user()->id,
                    'comment_body' => $request->comment_body
                ]);

                return redirect()->back()->with('message', 'Comment posted successfully!');
            } else {
                return redirect()->back()->with('message', 'No post found.');
            }
        } else {
            return redirect('login')->with('message', 'Please log in first.');
        }
    }

    public function delete(Request $request)
    {
        if (Auth::check()) {
            $comment = Comment::where('id', $request->comment_id)->where('user_id', Auth::user()->id)->first();

            if ($comment) {
                $comment->delete();
                return response()->json([
                    'status' => 200,
                    'message' => 'Comment deleted successfully.'
                ]);
            }
            else
            {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong.'
                ]);
            }
        } else {
            return response()->json([
                'status' => 401,
                'message' => 'Please login to delete this comment.'
            ]);
        }
    }
}
