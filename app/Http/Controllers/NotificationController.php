<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Get unread notifications for the currently authenticated user.
     */
    public function getUnread()
    {
        if (!Auth::check()) {
            return response()->json(['recent' => [], 'count' => 0]);
        }

        $user = Auth::user();
        
        // Get 10 recent notifications (both read and unread)
        $notifications = $user->notifications()->take(10)->get()->map(function ($notif) {
            return [
                'id' => $notif->id,
                'data' => $notif->data,
                'created_at' => $notif->created_at->diffForHumans(),
                'read_at' => $notif->read_at,
            ];
        });

        return response()->json([
            'recent' => $notifications,
            'count' => $user->unreadNotifications()->count(),
        ]);
    }

    /**
     * Mark a specific notification as read.
     */
    public function markAsRead($id)
    {
        if (Auth::check()) {
            $notification = Auth::user()->notifications()->where('id', $id)->first();
            if ($notification) {
                $notification->markAsRead();
            }
        }
        return response()->json(['success' => true]);
    }
    
    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        if (Auth::check()) {
            Auth::user()->unreadNotifications->markAsRead();
        }
        return response()->json(['success' => true]);
    }
}
