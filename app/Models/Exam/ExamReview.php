<?php

namespace App\Models\Exam;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Exam\ExamGroup;

class ExamReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_group_id',
        'rating',
        'review',
        'has_complaint',
        'complaint',
        'is_read',
    ];

    protected $casts = [
        'has_complaint' => 'boolean',
        'is_read' => 'boolean',
    ];

    /**
     * Get the user that owns the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the exam group.
     */
    public function examGroup()
    {
        return $this->belongsTo(ExamGroup::class);
    }

    /**
     * Scope for unread reviews.
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope for reviews with complaints.
     */
    public function scopeWithComplaints($query)
    {
        return $query->where('has_complaint', true);
    }
}
