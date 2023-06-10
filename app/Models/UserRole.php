<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    
    use HasFactory;
    protected $table = 'role_user';

    public function users()
        {
            return $this->belongsTo(User::class,'user_id');
        }

    public function roles(){
        return $this->belongsTo(Role::class);
    }
}

