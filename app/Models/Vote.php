<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = ['item_id','user_id','vote'];

    public function item(){ return $this->belongsTo(Item::class); }
    public function user(){ return $this->belongsTo(User::class); }
}
