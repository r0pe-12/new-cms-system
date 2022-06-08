<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function permissions(){
        # code
        return $this->belongsToMany(Permission::class);
    }

    public function users(){
        # code
        return $this->belongsToMany(User::class);
    }

    public function hasPermission($permission_name){
        # code
        foreach ($this->permissions as $permission) {
            if (strtolower($permission_name) === strtolower($permission->slug)){
                return true;
            }
        }
        return false;
    }
}
