<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    use HasFactory;

    protected $fillable = ['vote'];


    //*** RELATIONS ***//
    /**
     * Profiles Relation
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
