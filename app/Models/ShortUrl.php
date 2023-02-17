<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class ShortUrl extends Model
{
    use HasFactory;

    protected $table = 'urls';
    protected $appends = ['shortened_url'];

    function getShortenedUrlAttribute()
    {
        return URL::to('/') . '/' . $this->slug;
    }

    function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
}
