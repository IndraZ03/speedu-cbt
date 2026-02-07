<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'content',
        'photo',
        'rating',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating' => 'integer',
        'order' => 'integer',
    ];

    /**
     * Get active testimonials ordered by order field
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order')->orderBy('id', 'desc');
    }
}
