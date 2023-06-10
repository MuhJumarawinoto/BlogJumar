<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    use HasFactory;
    public function userroles()
    {
        // return $this->hasOne(UserRole::class);
        return $this->hasOne(UserRole::class);
    }

    public function user()
    {
        // return $this->hasOne(UserRole::class);
        return $this->hasMany(user::class);
    }
}

