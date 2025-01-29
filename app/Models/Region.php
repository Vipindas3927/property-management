<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name', 'code'];
    public function properties()
    {
        return $this->hasmany(Property::class);
    }
}
