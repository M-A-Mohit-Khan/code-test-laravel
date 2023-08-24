<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\BlogPost;

use Inertia\Inertia;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function index()
    {
        // $user = auth()->user();
        // dd($user);
        return Inertia::render('CreateBlog');
    }

    public function store(Request $request)
    {
        //dd($request->all());

        //Validate the request for title, content and image type
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // adjust mime types and max size as needed
        ]);
        
        //if image is present, store it in public folder
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_post_images', 'public');
            $data['image'] = $imagePath;
        }
        $blogPost=new BlogPost();
        $blogPost->title=$request->input('title');
        $blogPost->content=$request->input('content');

        //if image is present, store the path in database or store null
        if ($request->hasFile('image')) {
            $blogPost->image=$imagePath;
        }
        else
        {
            $blogPost->image=null;
        }
            
        //store the user id of the logged in user
        $userId = auth()->user();
        $blogPost->user_id=$userId->id;
        $blogPost->save();
        

        return redirect()->route('blog.index');
    }

    public function blogListing(Request $request)
    {
        
        //retrieve all blog posts with user details, order by created_at in descending order and paginate 10 records per page
        //when used for conditional queries, the first argument is the condition and the second argument is the callback function, which is executed when the condition is true
        //if search term is present, filter the blog posts by title
        $blogPosts = BlogPost::with('user')
        ->when($request->has('search'), function ($query) use ($request) {
            $searchTerm = $request->input('search');
            return $query->where('title', 'like', '%' . $searchTerm . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        
        //dd($blogPosts);
        return Inertia::render('BlogListing', [
            'blogPosts' => $blogPosts,
        ]);
        
    }
}
