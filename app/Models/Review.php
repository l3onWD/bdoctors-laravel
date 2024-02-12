<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['profile_id', 'first_name', 'last_name', 'email', 'text'];


    //*** RELATIONS ***//
    /**
     * Profile Relation
     */
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
