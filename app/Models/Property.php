<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['title', 'description', 'type', 'price', 'location', 'region_id', 'status', 'featured_image'];

    public function region()
    {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }

}
