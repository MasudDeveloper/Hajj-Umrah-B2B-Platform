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
                    'attachment' => $msg->attachment ? asset($msg->attachment) : null,
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
            'message' => 'nullable|string|max:3000',
            'attachment' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif,bmp|max:10240',
        ]);

        if (empty(trim((string)$request->message)) && !$request->hasFile('attachment')) {
            return response()->json(['error' => 'অনুগ্রহ করে মেসেজ লিখুন অথবা ছবি আপলোড করুন।'], 422);
        }

        $inquiry = PostInquiry::with(['post.agency', 'inquiringAgency'])->findOrFail($request->post_inquiry_id);
        $currentAgency = Auth::user();
        $currentAgencyId = $currentAgency->id;

        $isSeller = ($inquiry->post->agency_id === $currentAgencyId);
        $isBuyer = ($inquiry->inquiring_agency_id === $currentAgencyId);

        if (!$isSeller && !$isBuyer) {
            return response()->json(['error' => 'Unauthorized to send message.'], 403);
        }

        $receiverId = $isSeller ? $inquiry->inquiring_agency_id : $inquiry->post->agency_id;

        // Process and compress image to WebP format
        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $this->processAndCompressToWebp($request->file('attachment'));
        }

        $msg = Message::create([
            'post_inquiry_id' => $inquiry->id,
            'sender_agency_id' => $currentAgencyId,
            'receiver_agency_id' => $receiverId,
            'message' => $request->message ?: '',
            'attachment' => $attachmentPath,
            'is_read' => false,
        ]);

        // Send Real-time notification to receiver
        $notifPreview = $request->message ? Str::limit($request->message, 80) : '📷 একটি ছবি/ডকুমেন্ট পাঠিয়েছেন';
        Notification::send(
            $receiverId,
            'message',
            'নতুন B2B বার্তা: ' . $currentAgency->agency_name,
            $notifPreview,
            route('dashboard.index') . '#chat-' . $inquiry->id
        );

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $msg->id,
                'is_me' => true,
                'sender_name' => $currentAgency->agency_name,
                'message' => $msg->message,
                'attachment' => $msg->attachment ? asset($msg->attachment) : null,
                'time' => $msg->created_at->format('h:i A'),
                'date' => $msg->created_at->format('d M, Y'),
            ],
        ]);
    }

    /**
     * Convert and compress uploaded image to WebP format with max dimension 1600px
     */
    protected function processAndCompressToWebp($file)
    {
        $destinationDir = public_path('uploads/chat_attachments');
        if (!file_exists($destinationDir)) {
            mkdir($destinationDir, 0777, true);
        }

        $fileName = 'chat_' . time() . '_' . Str::random(10) . '.webp';
        $targetPath = $destinationDir . DIRECTORY_SEPARATOR . $fileName;

        $tempPath = $file->getRealPath();
        $mime = $file->getMimeType();

        try {
            $sourceImage = null;
            switch ($mime) {
                case 'image/jpeg':
                case 'image/jpg':
                    $sourceImage = @imagecreatefromjpeg($tempPath);
                    break;
                case 'image/png':
                    $sourceImage = @imagecreatefrompng($tempPath);
                    break;
                case 'image/webp':
                    $sourceImage = @imagecreatefromwebp($tempPath);
                    break;
                case 'image/gif':
                    $sourceImage = @imagecreatefromgif($tempPath);
                    break;
                case 'image/bmp':
                case 'image/x-ms-bmp':
                    $sourceImage = @imagecreatefrombmp($tempPath);
                    break;
            }

            if ($sourceImage) {
                $origWidth = imagesx($sourceImage);
                $origHeight = imagesy($sourceImage);

                // Auto resize if larger than 1600px width or height
                $maxDimension = 1600;
                if ($origWidth > $maxDimension || $origHeight > $maxDimension) {
                    if ($origWidth >= $origHeight) {
                        $newWidth = $maxDimension;
                        $newHeight = (int) round(($origHeight / $origWidth) * $maxDimension);
                    } else {
                        $newHeight = $maxDimension;
                        $newWidth = (int) round(($origWidth / $origHeight) * $maxDimension);
                    }

                    $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

                    // Preserve alpha transparency for PNG/WebP
                    imagealphablending($resizedImage, false);
                    imagesavealpha($resizedImage, true);
                    $transparent = imagecolorallocatealpha($resizedImage, 255, 255, 255, 127);
                    imagefilledrectangle($resizedImage, 0, 0, $newWidth, $newHeight, $transparent);

                    imagecopyresampled($resizedImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
                    imagedestroy($sourceImage);
                    $sourceImage = $resizedImage;
                } else {
                    imagepalettetotruecolor($sourceImage);
                    imagealphablending($sourceImage, true);
                    imagesavealpha($sourceImage, true);
                }

                // Save as WebP with 80% quality (great compression ratio without visual loss)
                imagewebp($sourceImage, $targetPath, 80);
                imagedestroy($sourceImage);

                return 'uploads/chat_attachments/' . $fileName;
            }
        } catch (\Throwable $e) {
            // Fallback in case GD fails: save original file
        }

        // Fallback: direct move
        $fallbackName = 'chat_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $file->move($destinationDir, $fallbackName);
        return 'uploads/chat_attachments/' . $fallbackName;
    }
}
