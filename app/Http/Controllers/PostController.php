<?php

namespace App\Http\Controllers;

use App\Models\Posts as ModelsPosts;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Http\FileHelpers;
use Illuminate\Support\Facades\Storage;

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
        $this->validate($request,[
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2000',
            'judul' => 'required',
            'artikel' => 'required',
        ]);
        
        

        //Cara 1 apabila ada kebutuhan khusus
        // $item = new Posts();
        // $item->judul = $validatedData['judul'];
        // $item->artikel = $validatedData['artikel'];
        // $item->save();

        //cara 2 apabila semua masukan string tidak ada kebutuhan khusus 
        // Posts::create($request->all()); 

        //cara 3 paling efektif untuk menyimpan gambar
        $gambar = $request->file('gambar');
        $gambar->storeAs('public/gambar',$gambar->hashName());
        // dd($gambar->hashName());
        // dd($gambar);
        $post = Posts::create([
            'gambar' =>$gambar->hashName(),
            'judul' =>$request->judul,
            'artikel' =>$request->artikel,
        ]);
        
        
        // Redirect to the index page with a success message
            if($post){
            return redirect()->route('post.index')->with('success', 'Item created successfully.');
        }   else{
            return redirect()->route('post.index')->with('success', 'Item created Failed!.');
        }

    }
    public function edit($id){
        $post = Posts::find($id);
        return view('post/edit', compact('post'));
    }
}