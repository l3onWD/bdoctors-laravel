<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'services',
        'address',
        'photo',
        'visible',
        'user_id'
    ];


    //*** RELATIONS ***//
    /**
     * User Relation
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Typologies Relation
     */
    public function typologies()
    {
        return $this->belongsToMany(Typology::class);
    }

    /**
     * Stars Relation
     */
    public function stars()
    {
        return $this->belongsToMany(Star::class);
    }

    /**
     * Reviews Relation
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    //*** GETTERS ***//
    /**
     * Get Photo absolute path on API
     */
    protected function photo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => app('request')->is('api/*') && $value ? url('storage/' . $value) : $value,
        );
    }


    //*** UTILITIES ***//
    public function getPhotoPath()
    {
        return asset("storage/$this->photo");
    }
}
