@extends('layouts.admin')

@section('title', 'Pending Agency Verification Queue')

@section('content')
    <!-- Top Header Banner -->
    <div style="background: white; border-radius: 16px; padding: 2rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="badge" style="background: #FEF3C7; color: #92400E; margin-bottom: 0.5rem;"><i class="fa-solid fa-user-clock me-1"></i> Verification Queue</span>
                <h1 class="font-heading" style="font-size: 2rem; color: var(--admin-dark);">Agency Document Verification Queue</h1>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Inspect government Hajj/Umrah licenses, HAAB registration numbers, trade license photos, and approve agency accounts for 100% security compliance.</p>
            </div>
            
            <div style="background: #FFFBEB; border: 1px solid #FCD34D; padding: 0.75rem 1.25rem; border-radius: 12px; color: #B45309; font-weight: 700; font-size: 0.95rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-clock-rotate-left text-amber-600 fa-lg"></i> {{ $totalPendingCount }} Pending Applications
            </div>
        </div>
    </div>

    @if(session('success'))
        <div style="background: #D1FAE5; color: #065F46; padding: 1rem 1.25rem; border-radius: 12px; margin-bottom: 1.5rem; border: 1px solid #34D399; font-weight: 600;">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Verification Table Card -->
    <div style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.88rem;">
                <thead>
                    <tr style="background: #F8FAFC; border-bottom: 2px solid var(--border-color); color: var(--text-muted); font-size: 0.78rem; text-transform: uppercase;">
                        <th style="padding: 0.85rem;">Agency & Owner Info</th>
                        <th style="padding: 0.85rem;">License Type & Numbers</th>
                        <th style="padding: 0.85rem;">Trade License No</th>
                        <th style="padding: 0.85rem;">Contact Info</th>
                        <th style="padding: 0.85rem;">Hardcopy Uploads</th>
                        <th style="padding: 0.85rem; text-align: right;">Approval Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingAgencies as $agency)
                        <tr style="border-bottom: 1px solid var(--border-color); background: #FFFBEB;">
                            <td style="padding: 1rem 0.85rem;">
                                <strong>{{ $agency->agency_name }}</strong>
                                <div style="font-size: 0.78rem; color: var(--text-muted);">Owner: {{ $agency->owner_name }}</div>
                                <div style="font-size: 0.75rem; color: #475569;">Company: {{ $agency->company_name }}</div>
                            </td>

                            <td style="padding: 1rem 0.85rem;">
                                <div style="font-weight: 700; color: var(--admin-dark);">{{ $agency->formatted_license_display }}</div>
                                <span class="badge" style="background: #FEF3C7; color: #92400E; font-size: 0.72rem; font-weight: 700; margin-top: 0.2rem;">
                                    {{ strtoupper($agency->license_type ?? 'hajj') }}
                                </span>
                                <div style="font-size: 0.78rem; color: var(--text-muted); margin-top: 0.15rem;">HAAB: {{ $agency->haab_no ?? 'N/A' }}</div>
                            </td>

                            <td style="padding: 1rem 0.85rem;">
                                <div style="font-weight: 600;">{{ $agency->trade_license_no ?? 'N/A' }}</div>
                                <div style="font-size: 0.78rem; color: var(--text-muted);">City: {{ $agency->city }}</div>
                            </td>

                            <td style="padding: 1rem 0.85rem;">
                                <div>
                                    <i class="fa-solid fa-phone me-1 text-emerald-600"></i> {{ $agency->phone }}
                                    @if($agency->is_phone_verified)
                                        <span style="color: #059669; font-size: 0.75rem; font-weight: 700;">(OTP Verified ✓)</span>
                                    @endif
                                </div>
                                <div style="font-size: 0.78rem; color: var(--text-muted);"><i class="fa-brands fa-whatsapp text-emerald-500 me-1"></i> WA: {{ $agency->whatsapp ?: $agency->phone }}</div>
                            </td>

                            <td style="padding: 1rem 0.85rem;">
                                <div style="display: flex; flex-direction: column; gap: 0.35rem;">
                                    @if($agency->license_document)
                                        <a href="{{ asset('storage/' . $agency->license_document) }}" target="_blank" class="badge" style="background: #D1FAE5; color: #065F46; text-decoration: none; border: 1px solid #A7F3D0; font-size: 0.75rem;">
                                            <i class="fa-solid fa-file-image me-1"></i> View License Photo
                                        </a>
                                    @else
                                        <span style="color: #94A3B8; font-size: 0.75rem; italic;"><i class="fa-solid fa-triangle-exclamation text-amber-500 me-1"></i> License Copy Missing</span>
                                    @endif

                                    @if($agency->trade_license_document)
                                        <a href="{{ asset('storage/' . $agency->trade_license_document) }}" target="_blank" class="badge" style="background: #E0F2FE; color: #0369A1; text-decoration: none; border: 1px solid #BAE6FD; font-size: 0.75rem;">
                                            <i class="fa-solid fa-file-invoice me-1"></i> View Trade Copy
                                        </a>
                                    @else
                                        <span style="color: #94A3B8; font-size: 0.75rem; italic;"><i class="fa-solid fa-triangle-exclamation text-amber-500 me-1"></i> Trade Copy Missing</span>
                                    @endif
                                </div>
                            </td>

                            <td style="padding: 1rem 0.85rem; text-align: right;">
                                <div style="display: flex; gap: 0.4rem; justify-content: flex-end;">
                                    <form action="{{ route('admin.approve', $agency->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn-success" style="font-size: 0.82rem; padding: 0.45rem 0.85rem;">
                                            <i class="fa-solid fa-check me-1"></i> Approve & Verify
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.reject', $agency->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn-danger" style="font-size: 0.82rem; padding: 0.45rem 0.85rem;">
                                            <i class="fa-solid fa-xmark me-1"></i> Reject
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                                <i class="fa-solid fa-circle-check text-emerald-600 fa-2xl me-2"></i>
                                <h4 style="margin-top: 0.75rem; color: var(--admin-dark); font-size: 1.1rem;">No Pending Applications!</h4>
                                <p style="font-size: 0.85rem;">All agency verification applications have been fully reviewed and processed.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
