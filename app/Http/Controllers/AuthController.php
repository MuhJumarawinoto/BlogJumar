<?php

namespace App\Http\Controllers;

  
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        return view('Auth/login');
    }

    public function register()
    {
        return view('Auth/Register');
    }

    public function daftar(Request $request)
    {
                
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
            $user->email_verified_at = \Carbon\Carbon::now();
            $simpan = $user->save();
            
            if($simpan){
                Session::flash('success', 'Register berhasil! Silahkan login untuk mengakses data');
                return redirect()->route('login');
            } else {
                Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
                return redirect()->route('register');
            }   
        }
    
}
