<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $casts = [
        'info' => 'array',
    ];

    public function updateFromAPI($attributes, $options = [])
    {
        $this->name = $attributes['name'];
        $this->info = $attributes;
        $this->updated_at = now();
        $this->save($options);
    }
}
