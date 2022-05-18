<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

//    protected $fillable = [
//      'user_id',
//      'title',
//      'post_image',
//      'body'
//    ];

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

//    public function setPostImageAttribute($value){
//    # code
//        if (strpos($value, 'http://') !== FALSE || strpos($value, 'https://') !== FALSE){
//            $this->attributes['post_image']=$value;
//        }else {
//            $this->attributes['post_image'] = asset('storage/' . $value);
//        }
//    }

/*
|--------------------------------------------------------------------------
| You can do the same thing with accessor which is even better
|--------------------------------------------------------------------------
*/
    public function getPostImageAttribute($value){
        # code
        if (strpos($value, 'http://') !== FALSE || strpos($value, 'https://') !== FALSE){
            return $value;
        }else {
            return asset('storage/' . $value);
        }
    }
}
