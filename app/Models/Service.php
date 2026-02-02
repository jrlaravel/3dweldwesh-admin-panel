<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service';
    
    protected $fillable = [
        'name',
        'description',
        'image_id',
    ];

    public function image()
    {
        return $this->hasOne(MediaManager::class, 'id', 'image_id');
    }
}
