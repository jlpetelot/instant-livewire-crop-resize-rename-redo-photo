<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    // We allow all fields for registration.
    protected $guarded = [];

    // The photo belongs to a single user.
    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
