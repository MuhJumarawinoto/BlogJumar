<?php

namespace App\Http\Controllers;

use App\Models\Posts as ModelsPosts;
use App\Models\Posts;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Posts::paginate(2);
        // dd($item);
        return view('beranda',compact('posts'));
        
    }

    public function create()
    {
        return view('post/create');
    }

    public function store(Request $request){
        // Validate the input
        $validatedData = $request->validate([
            'judul' => 'required',
            'artikel' => 'required',
            // Add validation rules for other fields
        ]);

        //------------- Opsi1
        // Posts::create([
        //     'judul'     =>$request->judul,
        //     'artikel'   =>$request->artikel
        // ]);

        // -----------------Opsi2
        // dd($request);
        // Create a new instance of YourModel
        $item = new Posts();
        
        // Assign values to the model's properties
        $item->judul = $validatedData['judul'];
        $item->artikel = $validatedData['artikel'];
        // Assign values for other fields

        // Save the model to the database
        $item->save();

        
        // Redirect to the index page with a success message
        return redirect()->route('post.index')->with('success', 'Item created successfully.');
    }

    // public function create()
    //     {
    //         return view('posts.post');

    //     }
}
