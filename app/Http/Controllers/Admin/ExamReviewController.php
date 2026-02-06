<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam\ExamReview;
use Inertia\Inertia;

class ExamReviewController extends Controller
{
    /**
     * Display a listing of the reviews.
     */
    public function index(Request $request)
    {
        $query = ExamReview::with(['user', 'examGroup'])
            ->orderBy('created_at', 'desc');

        // Filter by rating
        if ($request->has('rating') && $request->rating) {
            $query->where('rating', $request->rating);
        }

        // Filter by complaint
        if ($request->has('has_complaint') && $request->has_complaint == '1') {
            $query->where('has_complaint', true);
        }

        // Filter by read status
        if ($request->has('is_read')) {
            if ($request->is_read == '0') {
                $query->where('is_read', false);
            } elseif ($request->is_read == '1') {
                $query->where('is_read', true);
            }
        }

        // Search by user name or exam title
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'like', "%{$search}%");
                })->orWhereHas('examGroup', function ($examQuery) use ($search) {
                    $examQuery->where('title', 'like', "%{$search}%");
                });
            });
        }

        $reviews = $query->paginate(15)->withQueryString();

        // Get stats
        $stats = [
            'total' => ExamReview::count(),
            'unread' => ExamReview::unread()->count(),
            'complaints' => ExamReview::withComplaints()->count(),
            'average_rating' => round(ExamReview::avg('rating'), 1),
        ];

        return Inertia::render('Admin/ExamReview/Index', [
            'reviews' => $reviews,
            'stats' => $stats,
            'filters' => $request->only(['rating', 'has_complaint', 'is_read', 'search']),
        ]);
    }

    /**
     * Mark a review as read.
     */
    public function markAsRead($id)
    {
        $review = ExamReview::findOrFail($id);
        $review->update(['is_read' => true]);

        return back()->with('success', 'Review ditandai sudah dibaca.');
    }

    /**
     * Mark all reviews as read.
     */
    public function markAllAsRead()
    {
        ExamReview::where('is_read', false)->update(['is_read' => true]);

        return back()->with('success', 'Semua review ditandai sudah dibaca.');
    }

    /**
     * Delete a review.
     */
    public function destroy($id)
    {
        $review = ExamReview::findOrFail($id);
        $review->delete();

        return back()->with('success', 'Review berhasil dihapus.');
    }

    /**
     * Get unread review count (for sidebar badge).
     */
    public static function getUnreadCount()
    {
        return ExamReview::unread()->count();
    }
}
