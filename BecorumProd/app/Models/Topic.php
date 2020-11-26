<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Topic extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    protected $fillable = [
        'title', 'content', 'user_id'
    ];
    protected $table = 'topics';

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable')->latest();
    }
}
