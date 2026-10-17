<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\PostInquiry;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CleanExpiredPostsAndInquiries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'platform:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto-archive expired posts and auto-cancel stale inquiries';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting B2B Platform automated maintenance cleanup...');

        // 1. Auto-close posts where flight date has passed
        $expiredPosts = Post::whereIn('status', ['open', 'partially_filled'])
            ->whereDate('flight_date', '<', Carbon::today())
            ->get();

        $closedPostsCount = 0;
        foreach ($expiredPosts as $post) {
            $post->status = 'closed';
            $post->save();
            $closedPostsCount++;

            // Send notification to agency
            Notification::send(
                $post->agency_id,
                'post_expired',
                'ফ্লাইটের তারিখ অতিক্রান্ত: পোস্ট স্বয়ংক্রিয়ভাবে বন্ধ করা হয়েছে',
                '"' . $post->title . '" প্যাকেজটির ফ্লাইটের তারিখ অতিক্রান্ত হওয়ায় সিস্টেম স্বয়ংক্রিয়ভাবে মার্কেটপ্লেস থেকে বন্ধ করেছে।',
                route('dashboard.index')
            );
        }

        $this->info("Closed {$closedPostsCount} expired posts.");

        // 2. Auto-cancel stale pending inquiries (older than 7 days)
        $staleInquiries = PostInquiry::with(['post', 'inquiringAgency'])
            ->where('status', 'pending')
            ->where('created_at', '<', Carbon::now()->subDays(7))
            ->get();

        $cancelledInquiriesCount = 0;
        foreach ($staleInquiries as $inq) {
            $inq->status = 'rejected';
            $inq->seller_note = 'সময়সীমা (৭ দিন) অতিক্রান্ত হওয়ায় সিস্টেম কর্তৃক স্বয়ংক্রিয়ভাবে বাতিল করা হয়েছে।';
            $inq->save();
            $cancelledInquiriesCount++;

            Notification::send(
                $inq->inquiring_agency_id,
                'inquiry_cancelled',
                'প্রস্তাবের মেয়াদ শেষ',
                'পোস্ট "' . ($inq->post->title ?? 'Post') . '"-এর প্রস্তাবটি ৭ দিন কোনো উত্তর না থাকায় সিস্টেম বাতিল করেছে।',
                route('dashboard.index')
            );
        }

        $this->info("Cancelled {$cancelledInquiriesCount} stale pending inquiries.");
        $this->info('B2B Platform maintenance completed successfully!');

        return Command::SUCCESS;
    }
}
