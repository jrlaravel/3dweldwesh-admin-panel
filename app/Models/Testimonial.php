<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonial';

    protected $fillable = [
        'name',
        'message',
        'location',
        'designation',
        'image_id',
    ];

    public function image()
    {
        return $this->belongsTo(MediaManager::class, 'image_id');
    }
}
