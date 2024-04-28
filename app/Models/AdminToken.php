<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class AdminToken extends Model
{
    protected $fillable = ['token'];

    public function setTokenAttribute($value)
    {
        $this->attributes['token'] = Crypt::encryptString($value);
    }

    public function getTokenAttribute($value)
    {
        return Crypt::decryptString($value);
    }
}