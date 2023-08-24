<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    //many to one relationship with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
