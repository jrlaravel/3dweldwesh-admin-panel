<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'name',
        'image_id',
    ];

    public function image()
    {
        return $this->hasOne(MediaManager::class, 'id', 'image_id');
    }
}
