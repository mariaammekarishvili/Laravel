<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Notifications\PostApprovedNotification;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;

class PostsController extends Controller
{

	public function show() {
        $posts=Post::with(['tags'])->get();
		return view("list", compact("posts"));
	}

	public function deleteById($id) {
		Post::findOrFail($id)->delete();
	}

    public function show_post($id){
        $post = Post::findOrFail($id);
        return view('show',compact("post"));
    }

    public function tag($id){
        $tag=Tag::findOrFail($id);
        return view('tag',compact('tag'));
    }

	public function create() {
        $tags = Tag::all();
        return view("create", compact('tags'));
	}


	public function createPostRecord(Request $request) {
	    $request->validate([
            'title' => 'required',
            'text' => 'required',
            'image' => 'required',
        ]);

		$post = new Post($request->all());

        $file=$request->file('image');
        $extension=$file->getClientOriginalExtension();
        $filename=time().'.'.$extension;
        $file->move('uploads/posts/', $filename);
        $post->image=$filename;

        $post->user_id = Auth::id();
        $post->save();
        $post->tags()->attach($request->tags);


		return Redirect::back()->with("message", "information add");
	}


	public function update($id) {
		$post = Post::find($id);
		return view("update", compact("post"));
	}


	public function updateRecord(Request $request, $id) {
        $post=Post::findOrFail($id);
        $post->update($request->all());
		return Redirect::back()->with("message", "information add");
	}

	public function ownPosts() {
        $posts = Post::all()->where('user_id', Auth::id());
        $author = User::find(Auth::id());
        return view('my', compact('posts', 'author'));
    }
    public function approve(Post $post){

        if ($post->is_approves==false){
            $post->is_approves=true;
            $data=[
                "text"=>'post with id of'.'  '.$post->id.'  '.'has been approved'
            ];

        }else{
            $post->is_approves=false;
            $data=[
                "text"=>'post with id of'.'  '.$post->id.'  '.'has been dis_approved'
            ];
        }
        $post->save();
        $user=User::find(1);
        $user->notify(new PostApprovedNotification($data));
    }

}
