<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['user_creator', 'user_created'];
    public function user_creator()
    {
        return $this->belongsTo(User::class, 'user_creator', 'id');
    }

    public function user_created()
    {
        return $this->belongsTo(User::class, 'user_created', 'id');
    }
}
