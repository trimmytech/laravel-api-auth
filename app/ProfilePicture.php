<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilePicture extends Model
{
    //
    protected $table = 'profile_pictures';

    protected $fillable = ['img_url'];

    public function userprofile()
    {
        return $this->belongsTo(UserProfile::class);
    }
}
