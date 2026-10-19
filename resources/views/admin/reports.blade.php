@extends('layouts.admin')

@section('title', 'Disputes & Post Reports Governance Center')

@section('content')
    <!-- Top Header Banner -->
    <div style="background: white; border-radius: 16px; padding: 2rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="badge" style="background: #FFE4E6; color: #E11D48; margin-bottom: 0.5rem; font-weight: 700; padding: 0.35rem 0.75rem; border-radius: 20px;">
                    <i class="fa-solid fa-triangle-exclamation me-1"></i> Fraud & Duplicate Seat Prevention
                </span>
                <h1 class="font-heading" style="font-size: 2rem; color: var(--admin-dark); margin-top: 0.25rem;">ডুপ্লিকেট ও ফেক সিট ডিসপুট ম্যানেজমেন্ট</h1>
                <p style="color: var(--text-muted); font-size: 0.95rem; margin-top: 0.25rem;">
                    অননুমোদিত সিট রিসেলিং, ভূয়া ইনভেন্টরি বা অন্যের টিকিট দখল করে পোস্ট করার অভিযোগসমূহ নিরপেক্ষভাবে যাচাই ও নিষ্পত্তি করুন।
                </p>
            </div>
            
            <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                <div style="background: #FEF2F2; border: 1px solid #FECDD3; padding: 0.65rem 1.15rem; border-radius: 12px; text-align: center;">
                    <span style="font-size: 0.75rem; color: #9F1239; font-weight: 700; display: block;">পেন্ডিং অভিযোগ</span>
                    <strong style="font-size: 1.4rem; color: #BE123C;">{{ $metrics['pending'] }}</strong>
                </div>
                <div style="background: #F0FDF4; border: 1px solid #BBF7D0; padding: 0.65rem 1.15rem; border-radius: 12px; text-align: center;">
                    <span style="font-size: 0.75rem; color: #166534; font-weight: 700; display: block;">নিষ্পত্তিকৃত (পোস্ট বাতিল)</span>
                    <strong style="font-size: 1.4rem; color: #15803D;">{{ $metrics['resolved'] }}</strong>
                </div>
                <div style="background: #F8FAFC; border: 1px solid #E2E8F0; padding: 0.65rem 1.15rem; border-radius: 12px; text-align: center;">
                    <span style="font-size: 0.75rem; color: #475569; font-weight: 700; display: block;">খারিজকৃত</span>
                    <strong style="font-size: 1.4rem; color: #334155;">{{ $metrics['dismissed'] }}</strong>
                </div>
            </div>
        </div>

        <!-- Filter Navigation Tabs -->
        <div style="display: flex; gap: 0.5rem; margin-top: 1.75rem; border-top: 1px solid var(--border-color); padding-top: 1.25rem;">
            <a href="{{ route('admin.reports', ['status' => 'all']) }}" style="text-decoration: none; padding: 0.5rem 1rem; border-radius: 8px; font-size: 0.88rem; font-weight: 600; {{ $status == 'all' ? 'background: var(--admin-dark); color: white;' : 'background: #F1F5F9; color: #475569;' }}">
                সব রিপোর্ট ({{ $metrics['total'] }})
            </a>
            <a href="{{ route('admin.reports', ['status' => 'pending']) }}" style="text-decoration: none; padding: 0.5rem 1rem; border-radius: 8px; font-size: 0.88rem; font-weight: 600; {{ $status == 'pending' ? 'background: #E11D48; color: white;' : 'background: #F1F5F9; color: #475569;' }}">
                <i class="fa-solid fa-clock me-1"></i> অপেক্ষমান পর্যালোচনা ({{ $metrics['pending'] }})
            </a>
            <a href="{{ route('admin.reports', ['status' => 'resolved_removed']) }}" style="text-decoration: none; padding: 0.5rem 1rem; border-radius: 8px; font-size: 0.88rem; font-weight: 600; {{ $status == 'resolved_removed' ? 'background: #059669; color: white;' : 'background: #F1F5F9; color: #475569;' }}">
                <i class="fa-solid fa-check-circle me-1"></i> কার্যকর/সাসপেন্ডেড ({{ $metrics['resolved'] }})
            </a>
            <a href="{{ route('admin.reports', ['status' => 'dismissed']) }}" style="text-decoration: none; padding: 0.5rem 1rem; border-radius: 8px; font-size: 0.88rem; font-weight: 600; {{ $status == 'dismissed' ? 'background: #475569; color: white;' : 'background: #F1F5F9; color: #475569;' }}">
                <i class="fa-solid fa-ban me-1"></i> খারিজকৃত ({{ $metrics['dismissed'] }})
            </a>
        </div>
    </div>

    @if(session('success'))
        <div style="background: #D1FAE5; color: #065F46; padding: 1rem 1.25rem; border-radius: 12px; margin-bottom: 1.5rem; border: 1px solid #34D399; font-weight: 600; display: flex; align-items: center; gap: 0.65rem;">
            <i class="fa-solid fa-circle-check text-emerald-600 fa-lg"></i> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #FEE2E2; color: #991B1B; padding: 1rem 1.25rem; border-radius: 12px; margin-bottom: 1.5rem; border: 1px solid #F87171; font-weight: 600; display: flex; align-items: center; gap: 0.65rem;">
            <i class="fa-solid fa-triangle-exclamation text-rose-600 fa-lg"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Reports List Container -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        @forelse($reports as $report)
            <div style="background: white; border-radius: 16px; border: 1px solid {{ $report->status == 'pending' ? '#FDA4AF' : 'var(--border-color)' }}; box-shadow: var(--shadow-sm); overflow: hidden;">
                
                <!-- Report Top Status Ribbon -->
                <div style="padding: 0.85rem 1.5rem; background: {{ $report->status == 'pending' ? '#FFF1F2' : ($report->status == 'resolved_removed' ? '#F0FDF4' : '#F8FAFC') }}; border-bottom: 1px solid {{ $report->status == 'pending' ? '#FECDD3' : 'var(--border-color)' }}; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <span style="font-weight: 800; font-size: 0.95rem; color: var(--admin-dark);">
                            রিপোর্ট #{{ $report->id }} &bull; {{ $report->created_at->format('d M, Y (h:i A)') }}
                        </span>
                        
                        @if($report->status == 'pending')
                            <span style="background: #E11D48; color: white; font-size: 0.72rem; font-weight: 800; padding: 3px 10px; border-radius: 20px;">
                                <i class="fa-solid fa-clock"></i> পর্যালোচনা অপেক্ষমান
                            </span>
                        @elseif($report->status == 'resolved_removed')
                            <span style="background: #059669; color: white; font-size: 0.72rem; font-weight: 800; padding: 3px 10px; border-radius: 20px;">
                                <i class="fa-solid fa-circle-check"></i> অভিযোগ কার্যকর (পোস্ট বাতিল)
                            </span>
                        @else
                            <span style="background: #64748B; color: white; font-size: 0.72rem; font-weight: 800; padding: 3px 10px; border-radius: 20px;">
                                <i class="fa-solid fa-ban"></i> অভিযোগ খারিজ
                            </span>
                        @endif
                    </div>

                    <div style="font-size: 0.82rem; font-weight: 700; color: #9F1239;">
                        অভিযোগের ধরণ: <span style="background: white; padding: 2px 8px; border-radius: 6px; border: 1px solid #FECDD3;">{{ \App\Models\PostReport::reasonLabel($report->reason) }}</span>
                    </div>
                </div>

                <!-- Comparison Grid: Complainant (Left) vs Accused (Right) -->
                <div style="padding: 1.5rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; border-bottom: 1px solid var(--border-color);">
                    
                    <!-- Left Column: Complainant Agency & Their Proof -->
                    <div style="background: #F8FAFC; padding: 1.25rem; border-radius: 12px; border: 1px solid #E2E8F0;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
                            <span style="font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: #0369A1; letter-spacing: 0.5px;">
                                <i class="fa-solid fa-shield-halved me-1"></i> অভিযোগকারী এজেন্সি (মূল মালিকের দাবি)
                            </span>
                            <span style="font-size: 0.75rem; background: #E0F2FE; color: #0369A1; padding: 2px 8px; border-radius: 6px; font-weight: 700;">
                                লাইসেন্স: {{ $report->reporterAgency->license_no ?? 'N/A' }}
                            </span>
                        </div>

                        <h3 style="font-size: 1.1rem; color: var(--admin-dark); font-weight: 800;">
                            {{ $report->reporterAgency->agency_name }}
                        </h3>
                        <div style="font-size: 0.82rem; color: var(--text-muted); margin-top: 0.2rem;">
                            স্বত্বাধিকারী: <strong>{{ $report->reporterAgency->owner_name }}</strong> &bull; ফোন: <strong>{{ $report->reporterAgency->phone }}</strong>
                        </div>

                        @if($report->originalPost)
                            <div style="background: white; border: 1px solid #CBD5E1; border-radius: 8px; padding: 0.75rem; margin-top: 0.85rem;">
                                <span style="font-size: 0.72rem; color: #0284C7; font-weight: 700; display: block;">সংযুক্ত মূল পোস্ট:</span>
                                <strong style="font-size: 0.88rem; color: #0F172A;">{{ $report->originalPost->title }}</strong>
                                <div style="display: flex; gap: 0.85rem; font-size: 0.78rem; color: #475569; margin-top: 0.35rem;">
                                    <span><i class="fa-solid fa-plane text-sky-600"></i> {{ $report->originalPost->airline }}</span>
                                    <span><i class="fa-solid fa-calendar text-emerald-600"></i> {{ $report->originalPost->flight_date ? $report->originalPost->flight_date->format('d M, Y') : 'N/A' }}</span>
                                    <span><i class="fa-solid fa-users text-amber-600"></i> মোট সিট: {{ $report->originalPost->total_group_size }} টি</span>
                                    @if($report->originalPost->pnr_code)
                                        <span style="background: #FEF3C7; padding: 1px 6px; border-radius: 4px; font-weight: 700;">PNR: {{ $report->originalPost->pnr_code }}</span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if($report->proof_file)
                            <div style="margin-top: 0.85rem; padding-top: 0.75rem; border-top: 1px dashed #CBD5E1;">
                                <a href="{{ asset($report->proof_file) }}" target="_blank" style="display: inline-flex; align-items: center; gap: 0.5rem; background: #0284C7; color: white; text-decoration: none; padding: 0.45rem 0.95rem; border-radius: 8px; font-size: 0.82rem; font-weight: 700;">
                                    <i class="fa-solid fa-file-invoice"></i> টিকিট স্লিপ / PNR ডকুমেন্টস দেখুন
                                </a>
                            </div>
                        @else
                            <div style="font-size: 0.75rem; color: #94A3B8; margin-top: 0.65rem;">
                                <i class="fa-solid fa-info-circle me-1"></i> কোনো অতিরিক্ত ফাইল আপলোড করা হয়নি।
                            </div>
                        @endif
                    </div>

                    <!-- Right Column: Accused Agency & Reported Listing -->
                    <div style="background: #FFF1F2; padding: 1.25rem; border-radius: 12px; border: 1px solid #FECDD3;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
                            <span style="font-size: 0.75rem; font-weight: 800; text-transform: uppercase; color: #BE123C; letter-spacing: 0.5px;">
                                <i class="fa-solid fa-triangle-exclamation me-1"></i> অভিযুক্ত এজেন্সি ও অভিযুক্ত পোস্ট
                            </span>
                            <span style="font-size: 0.75rem; background: #FEE2E2; color: #991B1B; padding: 2px 8px; border-radius: 6px; font-weight: 700;">
                                স্ট্রাইক সংখ্যা: {{ $report->offendingAgency->strike_count ?? 0 }} টি
                            </span>
                        </div>

                        <h3 style="font-size: 1.1rem; color: #881337; font-weight: 800;">
                            {{ $report->offendingAgency->agency_name ?? 'Unknown Agency' }}
                        </h3>
                        <div style="font-size: 0.82rem; color: #9F1239; margin-top: 0.2rem;">
                            স্বত্বাধিকারী: <strong>{{ $report->offendingAgency->owner_name ?? 'N/A' }}</strong> &bull; ফোন: <strong>{{ $report->offendingAgency->phone ?? 'N/A' }}</strong>
                        </div>

                        @if($report->post)
                            <div style="background: white; border: 1px solid #FDA4AF; border-radius: 8px; padding: 0.75rem; margin-top: 0.85rem;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <strong style="font-size: 0.88rem; color: #0F172A;">{{ $report->post->title }}</strong>
                                    <span style="font-size: 0.72rem; padding: 2px 6px; border-radius: 4px; font-weight: 800; background: {{ $report->post->status == 'suspended' ? '#FEE2E2; color: #991B1B;' : '#D1FAE5; color: #065F46;' }}">
                                        {{ strtoupper($report->post->status) }}
                                    </span>
                                </div>
                                <div style="display: flex; gap: 0.85rem; font-size: 0.78rem; color: #475569; margin-top: 0.35rem; flex-wrap: wrap;">
                                    <span><i class="fa-solid fa-plane text-sky-600"></i> {{ $report->post->airline }}</span>
                                    <span><i class="fa-solid fa-calendar text-emerald-600"></i> {{ $report->post->flight_date ? $report->post->flight_date->format('d M, Y') : 'N/A' }}</span>
                                    <span><i class="fa-solid fa-chair text-amber-600"></i> অফার সিট: {{ $report->post->available_seats }} টি</span>
                                    <span><i class="fa-solid fa-tag text-indigo-600"></i> ৳{{ number_format($report->post->price_per_seat) }}</span>
                                    @if($report->post->pnr_code)
                                        <span style="background: #FEF3C7; padding: 1px 6px; border-radius: 4px; font-weight: 700;">PNR: {{ $report->post->pnr_code }}</span>
                                    @endif
                                </div>
                                <div style="margin-top: 0.5rem;">
                                    <a href="{{ route('posts.show', $report->post->id) }}" target="_blank" style="font-size: 0.78rem; color: #0284C7; text-decoration: underline; font-weight: 700;">
                                        <i class="fa-solid fa-arrow-up-right-from-square"></i> লাইভ মার্কেটপ্লেসে সম্পূর্ণ পোস্টটি দেখুন
                                    </a>
                                </div>
                            </div>
                        @else
                            <div style="background: #F1F5F9; padding: 0.75rem; border-radius: 8px; font-size: 0.82rem; color: var(--text-muted); margin-top: 0.85rem;">
                                উক্ত পোস্টটি ইতোমধ্যে মুছে ফেলা হয়েছে।
                            </div>
                        @endif
                    </div>

                </div>

                <!-- Dispute Statement & Admin Audit Area -->
                <div style="padding: 1.25rem 1.5rem; background: #FAFAFA; display: flex; flex-direction: column; gap: 0.85rem;">
                    <div>
                        <span style="font-size: 0.78rem; font-weight: 700; color: #475569; text-transform: uppercase;">
                            অভিযোগের বিস্তারিত বিবরণ:
                        </span>
                        <p style="font-size: 0.92rem; color: #1E293B; line-height: 1.5; margin-top: 0.25rem; background: white; padding: 0.75rem 1rem; border-radius: 8px; border: 1px solid #E2E8F0;">
                            "{{ $report->details }}"
                        </p>
                    </div>

                    @if($report->admin_notes)
                        <div style="background: #FEF3C7; border: 1px solid #FCD34D; padding: 0.75rem 1rem; border-radius: 8px; font-size: 0.85rem; color: #92400E;">
                            <strong><i class="fa-solid fa-user-shield me-1"></i> অ্যাডমিন অডিট নোট:</strong> {{ $report->admin_notes }}
                            <div style="font-size: 0.75rem; color: #B45309; margin-top: 0.25rem;">
                                নিষ্পত্তিকারী: {{ $report->reviewer->agency_name ?? 'Super Admin' }} &bull; সময়: {{ $report->reviewed_at ? $report->reviewed_at->format('d M, Y h:i A') : 'N/A' }}
                            </div>
                        </div>
                    @endif

                    <!-- Action Buttons for Pending Reports -->
                    @if($report->status == 'pending')
                        <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 0.5rem; padding-top: 0.85rem; border-top: 1px solid #E2E8F0;">
                            
                            <!-- Dismiss Action Form -->
                            <form action="{{ route('admin.reports.dismiss', $report->id) }}" method="POST" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই অভিযোগটি খারিজ করবেন? পোস্টটি বহাল থাকবে।')">
                                @csrf
                                <input type="hidden" name="admin_notes" value="যাচাই শেষে অভিযোগটি ভিত্তিহীন বা অপ্রমাণিত পাওয়ায় খারিজ করা হলো।">
                                <button type="submit" class="btn-danger" style="background: #64748B; font-size: 0.85rem; padding: 0.55rem 1.15rem; border-radius: 8px;">
                                    <i class="fa-solid fa-xmark me-1"></i> অভিযোগ খারিজ (পোস্ট বহাল রাখুন)
                                </button>
                            </form>

                            <!-- Approve & Suspend Post Form -->
                            <form action="{{ route('admin.reports.approve', $report->id) }}" method="POST" onsubmit="return confirm('⚠️ সতর্কতা: আপনি কি নিশ্চিত যে পোস্টটি সাসপেন্ড করবেন এবং অভিযুক্ত এজেন্সিকে ১টি স্ট্রাইক যোগ করবেন?')">
                                @csrf
                                <input type="hidden" name="admin_notes" value="ডুপ্লিকেট ও অননুমোদিত সিটের অভিযোগ প্রমাণিত হওয়ায় পোস্টটি বাতিল করা হয়েছে।">
                                <button type="submit" class="btn-danger" style="background: #DC2626; font-size: 0.85rem; padding: 0.55rem 1.25rem; border-radius: 8px; font-weight: 700;">
                                    <i class="fa-solid fa-ban me-1"></i> অভিযোগ সঠিক (পোস্ট স্থগিত ও স্ট্রাইক দিন)
                                </button>
                            </form>

                        </div>
                    @endif
                </div>

            </div>
        @empty
            <div style="background: white; border-radius: 16px; padding: 4rem 2rem; text-align: center; border: 1px solid var(--border-color);">
                <i class="fa-solid fa-shield-halved" style="font-size: 3.5rem; color: #10B981; margin-bottom: 1rem;"></i>
                <h3 style="font-size: 1.3rem; color: var(--admin-dark); font-weight: 800;">কোনো অমীমাংসিত অভিযোগ নেই!</h3>
                <p style="color: var(--text-muted); font-size: 0.95rem; max-width: 450px; margin: 0.5rem auto 0;">
                    প্ল্যাটফর্মের সকল পোস্ট ও ইনভেন্টরি বর্তমানে স্বচ্ছ ও বিরোধহীন রয়েছে। নতুন কোনো অভিযোগ আসলে এখানে তালিকাভুক্ত হবে।
                </p>
            </div>
        @endforelse

        <!-- Pagination -->
        <div style="margin-top: 1rem;">
            {{ $reports->links() }}
        </div>
    </div>
@endsection
