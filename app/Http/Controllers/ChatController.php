<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Notification;
use App\Models\PostInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    public function getMessages($inquiryId)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $inquiry = PostInquiry::with(['post.agency', 'inquiringAgency'])->findOrFail($inquiryId);
        $currentAgencyId = Auth::id();

        $isSeller = ($inquiry->post->agency_id === $currentAgencyId);
        $isBuyer = ($inquiry->inquiring_agency_id === $currentAgencyId);

        if (!$isSeller && !$isBuyer && !Auth::user()->isAdmin()) {
            return response()->json(['error' => 'Unauthorized access to negotiation chat.'], 403);
        }

        // Mark incoming messages as read
        Message::where('post_inquiry_id', $inquiryId)
            ->where('receiver_agency_id', $currentAgencyId)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = Message::with(['sender'])
            ->where('post_inquiry_id', $inquiryId)
            ->orderBy('created_at', 'asc')
            ->get();

        $partnerAgency = $isSeller ? $inquiry->inquiringAgency : $inquiry->post->agency;

        return response()->json([
            'partner' => [
                'id' => $partnerAgency->id,
                'name' => $partnerAgency->agency_name,
                'owner' => $partnerAgency->owner_name,
                'phone' => $partnerAgency->phone,
                'haab_no' => $partnerAgency->haab_no ?? $partnerAgency->license_no,
            ],
            'inquiry' => [
                'id' => $inquiry->id,
                'post_title' => $inquiry->post->title,
                'requested_seats' => $inquiry->requested_seats,
                'status' => $inquiry->status,
            ],
            'messages' => $messages->map(function ($msg) use ($currentAgencyId) {
                return [
                    'id' => $msg->id,
                    'is_me' => ($msg->sender_agency_id === $currentAgencyId),
                    'sender_name' => $msg->sender->agency_name,
                    'message' => $msg->message,
                    'time' => $msg->created_at->format('h:i A'),
                    'date' => $msg->created_at->format('d M, Y'),
                ];
            }),
        ]);
    }

    public function sendMessage(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $request->validate([
            'post_inquiry_id' => 'required|exists:post_inquiries,id',
            'message' => 'required|string|max:3000',
        ]);

        $inquiry = PostInquiry::with(['post.agency', 'inquiringAgency'])->findOrFail($request->post_inquiry_id);
        $currentAgency = Auth::user();
        $currentAgencyId = $currentAgency->id;

        $isSeller = ($inquiry->post->agency_id === $currentAgencyId);
        $isBuyer = ($inquiry->inquiring_agency_id === $currentAgencyId);

        if (!$isSeller && !$isBuyer) {
            return response()->json(['error' => 'Unauthorized to send message.'], 403);
        }

        $receiverId = $isSeller ? $inquiry->inquiring_agency_id : $inquiry->post->agency_id;

        $msg = Message::create([
            'post_inquiry_id' => $inquiry->id,
            'sender_agency_id' => $currentAgencyId,
            'receiver_agency_id' => $receiverId,
            'message' => $request->message,
            'is_read' => false,
        ]);

        // Send Real-time notification to receiver
        Notification::send(
            $receiverId,
            'message',
            'নতুন B2B বার্তা: ' . $currentAgency->agency_name,
            Str::limit($request->message, 80),
            route('dashboard.index') . '#chat-' . $inquiry->id
        );

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $msg->id,
                'is_me' => true,
                'sender_name' => $currentAgency->agency_name,
                'message' => $msg->message,
                'time' => $msg->created_at->format('h:i A'),
                'date' => $msg->created_at->format('d M, Y'),
            ],
        ]);
    }
}
