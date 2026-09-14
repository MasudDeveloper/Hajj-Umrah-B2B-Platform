@extends('layouts.admin')

@section('title', 'Super Admin Governance & Verification Dashboard')

@section('content')
    <!-- Header Banner -->
    <div style="background: white; border-radius: 16px; padding: 2rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="badge" style="background: #FCE7F3; color: #831843; margin-bottom: 0.5rem;"><i class="fa-solid fa-user-shield me-1"></i> Dedicated Super Admin Control</span>
                <h1 class="font-heading" style="font-size: 2rem; color: var(--admin-dark);">Agency Verification & B2B Governance</h1>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Review government Hajj licenses, HAAB registration numbers, and approve agency accounts to maintain 100% fraud-free platform security.</p>
            </div>
        </div>
    </div>

    <!-- Admin KPI Stats Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; margin-bottom: 2.5rem;">
        <div style="background: white; padding: 1.25rem; border-radius: 12px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between;">
            <div>
                <span style="font-size: 0.8rem; color: var(--text-muted); display: block;">Pending Verification</span>
                <strong style="font-size: 1.75rem; color: #D97706;">{{ $totalPendingCount }}</strong>
            </div>
            <div style="width: 44px; height: 44px; background: #FEF3C7; color: #D97706; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
        </div>

        <div style="background: white; padding: 1.25rem; border-radius: 12px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between;">
            <div>
                <span style="font-size: 0.8rem; color: var(--text-muted); display: block;">Approved Agencies</span>
                <strong style="font-size: 1.75rem; color: #047857;">{{ $totalVerifiedCount }}</strong>
            </div>
            <div style="width: 44px; height: 44px; background: #ECFDF5; color: #047857; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                <i class="fa-solid fa-shield-check"></i>
            </div>
        </div>

        <div style="background: white; padding: 1.25rem; border-radius: 12px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between;">
            <div>
                <span style="font-size: 0.8rem; color: var(--text-muted); display: block;">Active B2B Posts</span>
                <strong style="font-size: 1.75rem; color: #0284C7;">{{ $totalPostsCount }}</strong>
            </div>
            <div style="width: 44px; height: 44px; background: #E0F2FE; color: #0284C7; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                <i class="fa-solid fa-layer-group"></i>
            </div>
        </div>

        <div style="background: white; padding: 1.25rem; border-radius: 12px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between;">
            <div>
                <span style="font-size: 0.8rem; color: var(--text-muted); display: block;">Total B2B Leads</span>
                <strong style="font-size: 1.75rem; color: #7C3AED;">{{ $totalInquiriesCount }}</strong>
            </div>
            <div style="width: 44px; height: 44px; background: #F3E8FF; color: #7C3AED; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem;">
                <i class="fa-solid fa-handshake"></i>
            </div>
        </div>
    </div>

    <!-- Section 1: Pending Agency Verification Approvals Queue -->
    <div style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); margin-bottom: 2.5rem; box-shadow: var(--shadow-sm);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
            <h3 class="font-heading" style="font-size: 1.3rem; color: var(--admin-dark);">
                <i class="fa-solid fa-user-clock text-amber-500"></i> Pending Agency Registrations (Requires Approval)
            </h3>
            <span class="badge" style="background: #FEF3C7; color: #92400E;">{{ $pendingAgencies->count() }} Pending Review</span>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.88rem;">
                <thead>
                    <tr style="background: #F8FAFC; border-bottom: 2px solid var(--border-color); color: var(--text-muted); font-size: 0.78rem; text-transform: uppercase;">
                        <th style="padding: 0.85rem;">Agency & Owner Name</th>
                        <th style="padding: 0.85rem;">Hajj License / HAAB No</th>
                        <th style="padding: 0.85rem;">Trade License / NID</th>
                        <th style="padding: 0.85rem;">Contact Info</th>
                        <th style="padding: 0.85rem;">Registered On</th>
                        <th style="padding: 0.85rem; text-align: right;">1-Click Approval Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingAgencies as $agency)
                        <tr style="border-bottom: 1px solid var(--border-color); background: #FFFBEB;">
                            <td style="padding: 1rem 0.85rem;">
                                <strong>{{ $agency->agency_name }}</strong>
                                <div style="font-size: 0.78rem; color: var(--text-muted);">Owner: {{ $agency->owner_name }}</div>
                            </td>
                            <td style="padding: 1rem 0.85rem;">
                                <div style="font-weight: 700; color: var(--admin-dark);">{{ $agency->license_no }}</div>
                                <div style="font-size: 0.78rem; color: var(--text-muted);">HAAB: {{ $agency->haab_no ?? 'N/A' }}</div>
                            </td>
                            <td style="padding: 1rem 0.85rem;">
                                <div>{{ $agency->trade_license_no ?? 'N/A' }}</div>
                                <div style="font-size: 0.78rem; color: var(--text-muted);">NID: {{ $agency->nid_number ?? 'N/A' }}</div>
                            </td>
                            <td style="padding: 1rem 0.85rem;">
                                <div><i class="fa-solid fa-phone me-1 text-emerald-600"></i> {{ $agency->phone }}</div>
                                <div style="font-size: 0.78rem; color: var(--text-muted);">{{ $agency->email }}</div>
                            </td>
                            <td style="padding: 1rem 0.85rem;">{{ $agency->created_at->format('d M, Y') }}</td>
                            <td style="padding: 1rem 0.85rem; text-align: right;">
                                <div style="display: flex; gap: 0.4rem; justify-content: flex-end;">
                                    <form action="{{ route('admin.approve', $agency->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn-success">
                                            <i class="fa-solid fa-check me-1"></i> Approve & Verify
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.reject', $agency->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn-danger">
                                            <i class="fa-solid fa-xmark me-1"></i> Reject
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 2rem; color: var(--text-muted);">
                                <i class="fa-solid fa-circle-check text-emerald-600 me-1"></i> No pending verification requests. All agency accounts are fully reviewed!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Section 2: Approved Verified Agencies Directory -->
    <div style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
        <h3 class="font-heading" style="font-size: 1.3rem; color: var(--admin-dark); margin-bottom: 1.25rem;">
            <i class="fa-solid fa-building-circle-check text-emerald-600"></i> Approved Verified Agencies Directory
        </h3>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.88rem;">
                <thead>
                    <tr style="background: #F8FAFC; border-bottom: 2px solid var(--border-color); color: var(--text-muted); font-size: 0.78rem; text-transform: uppercase;">
                        <th style="padding: 0.85rem;">Agency Name</th>
                        <th style="padding: 0.85rem;">License & HAAB</th>
                        <th style="padding: 0.85rem;">Location Hub</th>
                        <th style="padding: 0.85rem;">Verification Status</th>
                        <th style="padding: 0.85rem;">SaaS Access Tier</th>
                        <th style="padding: 0.85rem; text-align: right;">Tier Plan Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($verifiedAgencies as $ag)
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <td style="padding: 1rem 0.85rem;">
                                <strong>{{ $ag->agency_name }}</strong>
                                <div style="font-size: 0.78rem; color: var(--text-muted);">{{ $ag->email }}</div>
                            </td>
                            <td style="padding: 1rem 0.85rem;">
                                <div>{{ $ag->license_no }}</div>
                                <div style="font-size: 0.78rem; color: var(--text-muted);">{{ $ag->haab_no ?? 'N/A' }}</div>
                            </td>
                            <td style="padding: 1rem 0.85rem;">{{ $ag->city }}, {{ $ag->country }}</td>
                            <td style="padding: 1rem 0.85rem;">
                                <span class="badge" style="background: #D1FAE5; color: #065F46;"><i class="fa-solid fa-shield-check"></i> VERIFIED</span>
                            </td>
                            <td style="padding: 1rem 0.85rem;">
                                <span style="background: #EFF6FF; color: #1D4ED8; font-weight: 700; font-size: 0.78rem; padding: 0.25rem 0.6rem; border-radius: 12px; border: 1px solid #BFDBFE;">
                                    <i class="fa-solid fa-gift text-amber-500 me-1"></i> 100% FREE ACCESS
                                </span>
                            </td>
                            <td style="padding: 1rem 0.85rem; text-align: right;">
                                <form action="{{ route('admin.subscription', $ag->id) }}" method="POST" style="display: inline-flex; gap: 0.35rem; align-items: center;">
                                    @csrf
                                    <select name="subscription_plan" onchange="this.form.submit()" style="padding: 0.35rem 0.5rem; border-radius: 6px; border: 1px solid var(--border-color); font-size: 0.8rem; background: white;">
                                        <option value="free" {{ $ag->subscription_plan == 'free' ? 'selected' : '' }}>Free Access Plan</option>
                                        <option value="monthly_b2b" {{ $ag->subscription_plan == 'monthly_b2b' ? 'selected' : '' }}>Monthly Plan Tag</option>
                                        <option value="yearly_b2b" {{ $ag->subscription_plan == 'yearly_b2b' ? 'selected' : '' }}>Yearly VIP Tag</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
