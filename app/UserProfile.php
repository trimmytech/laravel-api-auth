<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    //
    protected $table = 'user_profiles';

    protected $fillable = ['address', 'skype_username', 'dob'];


    public function profile_img() {
        return $this->hasOne(ProfilePicture::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
