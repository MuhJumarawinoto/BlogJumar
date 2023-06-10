<?php

namespace App\Http\Controllers;

  
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('Auth/login');
    }
    public function login(){
        if (Auth::check()) {
            return redirect()->route('post.index');
        }else{
            return redirect()->route('auth.login');
        }
    }

    public function check(Request $request){
        // dd($request->email);
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt($data)) {
            return redirect()->route('post.index');
        }else{
            Session::flash('error', 'Email atau Password Salah');
            return redirect()->route('auth.login');
        }

    }
    public function register()
    {
        return view('Auth/Register');
    }

    public function daftar(Request $request)
    {
        // dd($request);
        $request->validate([
                    'name'                  => 'required|min:5|max:30',
                    'email'                 => 'required|email|unique:users,email',
                    'password'              => 'required|confirmed'
        ]);
        $rules = [
                    'name'                  => 'required|min:5|max:30',
                    'email'                 => 'required|email|unique:users,email',
                    'password'              => 'required|confirmed'
                 ];
        $messages = [
                    'name.required'         => 'Nama Lengkap wajib',
                    'name.min'              => 'Nama lengkap minimal 5 karakter',
                    'name.max'              => 'Nama lengkap maksimal 30 karakter',
                    'email.required'        => 'Email wajib diisi',
                    'email.email'           => 'Email tidak valid',
                    'email.unique'          => 'Email sudah terdaftar',
                    'password.required'     => 'Password wajib diisi',
                    'password.confirmed'    => 'Password tidak sama dengan konfirmasi password'
                    ];

            $validator = Validator::make($request->all(), $rules, $messages);
                
            if($validator->fails()){
                        return redirect()->back()->withErrors($validator)->withInput($request->all);
                    }
            
            $user = new User;
            $user->name = ucwords(strtolower($request->name));
            $user->email = strtolower($request->email);
            $user->password = Hash::make($request->password);
            
            $simpan = $user->save();
            $user->roles()->attach(Role::where('name','user')->first());

            // dd($user);
            if($simpan){
                Session::flash('success', 'Register berhasil! Silahkan login untuk mengakses data');
                return redirect()->route('auth.login');
            } else {
                Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
                return redirect()->route('auth.register');
            }   
        }

        public function logout()
        {
            Auth::logout(); // menghapus session yang aktif
            return redirect()->route('auth.login');
        }
    
}
