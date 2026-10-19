<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getUnread()
    {
        if (!Auth::check()) {
            return response()->json(['count' => 0, 'notifications' => []]);
        }

        $agencyId = Auth::id();
        $notifications = Notification::where('agency_id', $agencyId)
            ->orderBy('created_at', 'desc')
            ->take(15)
            ->get();

        $unreadCount = Notification::where('agency_id', $agencyId)
            ->where('is_read', false)
            ->count();

        // Check specifically for unread chat messages
        $unreadMessagesCount = \App\Models\Message::where('receiver_agency_id', $agencyId)
            ->where('is_read', false)
            ->count();

        $latestUnreadMessage = \App\Models\Message::with(['sender', 'inquiry.post'])
            ->where('receiver_agency_id', $agencyId)
            ->where('is_read', false)
            ->latest()
            ->first();

        $unreadNotif = $notifications->firstWhere('is_read', false);

        return response()->json([
            'count' => $unreadCount,
            'unread_messages_count' => $unreadMessagesCount,
            'latest_message' => $latestUnreadMessage ? [
                'id' => $latestUnreadMessage->id,
                'inquiry_id' => $latestUnreadMessage->post_inquiry_id,
                'sender_name' => $latestUnreadMessage->sender ? $latestUnreadMessage->sender->agency_name : 'Partner Agency',
                'message' => $latestUnreadMessage->message,
                'time_ago' => $latestUnreadMessage->created_at->diffForHumans(),
            ] : null,
            'verification_status' => Auth::user()->verification_status,
            'rejection_reason' => Auth::user()->rejection_reason,
            'latest_unread' => $unreadNotif ? [
                'id' => $unreadNotif->id,
                'type' => $unreadNotif->type,
                'title' => $unreadNotif->title,
                'message' => $unreadNotif->message,
                'link' => $unreadNotif->link,
                'time_ago' => $unreadNotif->created_at->diffForHumans(),
            ] : null,
            'notifications' => $notifications->map(function ($n) {
                return [
                    'id' => $n->id,
                    'type' => $n->type,
                    'title' => $n->title,
                    'message' => $n->message,
                    'link' => $n->link,
                    'is_read' => $n->is_read,
                    'time_ago' => $n->created_at->diffForHumans(),
                ];
            }),
        ]);
    }

    public function markAsRead($id)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false], 401);
        }

        $notification = Notification::where('agency_id', Auth::id())->findOrFail($id);
        $notification->is_read = true;
        $notification->save();

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect($notification->link ?: route('dashboard.index'));
    }

    public function markAllAsRead()
    {
        if (!Auth::check()) {
            return response()->json(['success' => false], 401);
        }

        Notification::where('agency_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}
