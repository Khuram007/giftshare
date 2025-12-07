<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','description','category_id','city','weight_kg','dimensions','status','user_id'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function category() { return $this->belongsTo(Category::class); }
    public function photos() { return $this->hasMany(ItemPhoto::class)->orderBy('id'); }
    public function comments() { return $this->hasMany(Comment::class)->latest(); }
    public function votes() { return $this->hasMany(Vote::class); }

    public function isGifted() { return $this->status === 'gifted'; }

    public function score()
    {
        return $this->upvotes_count - $this->downvotes_count;
    }
}
