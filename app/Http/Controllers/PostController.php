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
    public function edit(Posts $post){
        return view('post/edit', compact('post'));
    }

    public function update(Request $request, Posts $post){
        // dd($post->id);
        
    //    dd($request);
        //jika ada file->gambar baru maka lanjut jalan ke sintak di bawah
        if($request->hasFile('gambar')){
            $this->validate($request,[
                'judul' => 'required|min:5',
                'artikel' => 'required|min:10',
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            //jadi kita simpan dulu filenya yang baru
            // dd('test');
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/gambar',$gambar->hashName());
            // dd($request->gambar);
            //setelah disimpan maka hapus file yang lama dengan parameter $post
            // dd($post->gambar);
            Storage::delete('public/gambar'.$post->gambar);
            
        //setelah semua urusan file beres lalu langsung simpan data yang lainnya 
        $post->update([
            'gambar' => $gambar->hashName(),
            'judul' => $request->judul,
            'artikel' => $request->artikel,
            
        ]);
        
        }
        else{
            // dd('stop');
            $this->validate($request,[
                'judul' => 'required|min:5',
                'artikel' => 'required|min:10',
            ]);
        $post->update([
            'judul' => $request->judul,
            'artikel' => $request->artikel
            ]);
        }
        // dd('is here');
        return redirect()->route('post.index')->with(['success' => 'Data Berhasil di Update!']);
    }
    
}