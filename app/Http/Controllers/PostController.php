<?php
namespace App\Http\Controllers;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\image;
use Illuminate\View\Middleware;


class PostController extends Controller
{
    public function getDashboard()
    {
        $posts = Post::Where('parent_id', Null)->get();
        return view('dashboard', ['posts' => $posts]);
    }

    public function postCreatePost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:1000'
        ]);
        $post = new Post();
        $post->body = $request['body'];
        $message = 'There was an error';
        if ($request->user()->posts()->save($post)) {
            $message = 'Post successfully created!';
        }
        return redirect()->route('dashboard')->with(['message' => $message]);
    }

    public function uploadImagePost(Request $request)
    {

        $image = $request->file('image');
        $filename = $image->getClientOriginalName();
        Storage::disk('uploadv')->put($filename, file_get_contents($request->file('image')->getRealPath()));


        $post = new Post();
        $post->imagename = $request['imagename'];
        $post->image = $filename;


        $message = 'There was an error';
        if ($request->user()->posts()->save($post)) {
            $message = 'Image successfully uploaded!';
        }
        return redirect()->route('dashboard')->with(['message' => $message]);
    }


    public function uploadVideoPost(Request $request)
    {

        $video = $request->file('video');
        $filename = $video->getClientOriginalName();
        Storage::disk('uploadv')->put($filename, file_get_contents($request->file('video')->getRealPath()));

        $post = new Post();
        $post->videoname = $request['videoname'];
        $post->video = $filename;


        $message = 'There was an error';
        if ($request->user()->posts()->save($post)) {
            $message = 'Video successfully uploaded!';
        }
        return redirect()->route('dashboard')->with(['message' => $message]);
    }


    /**
     * @param Request $request
     * @param $postId
     */
    public function postReply(Request $request, $postId)
    {

        $this->validate($request, ["reply-{$postId}" => 'required|max:1000',], [
            'required' => 'The reply body is required.'
        ]);

        $post = new Post();
        $post->body = $request->input("reply-{$postId}");
        $post->parent_id = $postId;

        if($request->user()->posts()->save($post)){
        $message = 'reply successfully created!';
         }
          return redirect()->route('dashboard')->with(['message' => $message]);

         }

}


