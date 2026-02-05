<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'badge_text',
        'badge_color',
        'original_price',
        'promo_price',
        'duration',
        'alert_text',
        'alert_color',
        'features',
        'button_text',
        'button_color',
        'whatsapp_message',
        'action_type',
        'is_featured',
        'is_active',
        'order',
    ];

    protected $casts = [
        'features' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'original_price' => 'decimal:2',
        'promo_price' => 'decimal:2',
        'order' => 'integer',
    ];

    /**
     * Get active programs ordered by order field
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order')->orderBy('id', 'asc');
    }

    /**
     * Get programs by category
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }
}
