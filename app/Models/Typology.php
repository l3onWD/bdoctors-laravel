<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typology extends Model
{
    use HasFactory;

    protected $fillable = ['name'];


    //*** RELATIONS ***//
    /**
     * Profiles Relation
     */
    public function profiles()
    {
        return $this->belongsToMany(Profile::class);
    }
}
