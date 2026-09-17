@extends('layouts.admin')

@section('title', 'All Agencies Directory & Management')

@section('content')
    <!-- Top Header Banner -->
    <div style="background: white; border-radius: 16px; padding: 2rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="badge" style="background: #ECFDF5; color: #047857; margin-bottom: 0.5rem;"><i class="fa-solid fa-building-circle-check me-1"></i> Agency Directory</span>
                <h1 class="font-heading" style="font-size: 2rem; color: var(--admin-dark);">Registered Agency Directory</h1>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Search, filter, view full profile details, manage subscription tiers, and 1-click impersonate agency accounts.</p>
            </div>
            <span class="badge" style="background: #EFF6FF; color: #1E40AF; font-weight: 700; font-size: 0.9rem; padding: 0.6rem 1.1rem; border-radius: 30px;">Total: {{ $allAgencies->count() }} Agencies</span>
        </div>
    </div>

    @if(session('success'))
        <div style="background: #D1FAE5; color: #065F46; padding: 1rem 1.25rem; border-radius: 12px; margin-bottom: 1.5rem; border: 1px solid #34D399; font-weight: 600;">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Search & Filter Controls Bar -->
    <div style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); margin-bottom: 2.5rem; box-shadow: var(--shadow-sm);">
        <form action="{{ route('admin.agencies') }}" method="GET" style="margin-bottom: 1.5rem; background: #F8FAFC; padding: 1.25rem; border-radius: 14px; border: 1px solid var(--border-color); display: flex; gap: 1rem; flex-wrap: wrap; align-items: center;">
            <div style="flex: 1; min-width: 260px;">
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 0.35rem;">Live Directory Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Search agency name, license no (HL/UL), phone, city..." style="width: 100%; padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.88rem; background: white;">
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 0.35rem;">Verification Status</label>
                <select name="status" style="padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.88rem; background: white;">
                    <option value="all">All Verification Statuses</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved Only</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Only</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected Only</option>
                </select>
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 700; color: var(--text-muted); margin-bottom: 0.35rem;">License Category</label>
                <select name="license_type" style="padding: 0.65rem 0.85rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.88rem; background: white;">
                    <option value="all">All License Categories</option>
                    <option value="hajj" {{ request('license_type') == 'hajj' ? 'selected' : '' }}>Hajj License (HL-)</option>
                    <option value="umrah" {{ request('license_type') == 'umrah' ? 'selected' : '' }}>Umrah License (UL-)</option>
                    <option value="both" {{ request('license_type') == 'both' ? 'selected' : '' }}>Both Hajj & Umrah</option>
                </select>
            </div>

            <div style="align-self: flex-end;">
                <button type="submit" class="btn-gold" style="padding: 0.65rem 1.25rem; font-size: 0.88rem;">
                    <i class="fa-solid fa-filter me-1"></i> Filter Directory
                </button>
            </div>

            @if(request()->hasAny(['search', 'status', 'license_type']))
                <div style="align-self: flex-end;">
                    <a href="{{ route('admin.agencies') }}" style="color: #64748B; font-size: 0.85rem; text-decoration: underline;">Reset Filters</a>
                </div>
            @endif
        </form>

        <!-- Directory Table -->
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.88rem;">
                <thead>
                    <tr style="background: #F8FAFC; border-bottom: 2px solid var(--border-color); color: var(--text-muted); font-size: 0.78rem; text-transform: uppercase;">
                        <th style="padding: 0.85rem;">Agency Name & Owner</th>
                        <th style="padding: 0.85rem;">License (HL / UL)</th>
                        <th style="padding: 0.85rem;">Contact & City</th>
                        <th style="padding: 0.85rem;">Verification Status</th>
                        <th style="padding: 0.85rem;">Subscription Tier</th>
                        <th style="padding: 0.85rem; text-align: right;">Admin Control Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allAgencies as $ag)
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <td style="padding: 1rem 0.85rem;">
                                <strong>{{ $ag->agency_name }}</strong>
                                <div style="font-size: 0.78rem; color: var(--text-muted);">Owner: {{ $ag->owner_name }}</div>
                            </td>

                            <td style="padding: 1rem 0.85rem;">
                                <div style="font-weight: 700; color: var(--admin-dark);">{{ $ag->formatted_license_display }}</div>
                                <span class="badge" style="background: #E0F2FE; color: #0369A1; font-size: 0.7rem; font-weight: 700;">
                                    {{ strtoupper($ag->license_type ?? 'hajj') }}
                                </span>
                            </td>

                            <td style="padding: 1rem 0.85rem;">
                                <div><i class="fa-solid fa-phone me-1 text-emerald-600"></i> {{ $ag->phone }}</div>
                                <div style="font-size: 0.78rem; color: var(--text-muted);">Hub: {{ $ag->city }}</div>
                            </td>

                            <td style="padding: 1rem 0.85rem;">
                                @if($ag->isApproved())
                                    <span class="badge" style="background: #D1FAE5; color: #065F46;"><i class="fa-solid fa-shield-check"></i> VERIFIED</span>
                                @elseif($ag->verification_status === 'pending')
                                    <span class="badge" style="background: #FEF3C7; color: #92400E;"><i class="fa-solid fa-clock"></i> PENDING</span>
                                @else
                                    <span class="badge" style="background: #FEE2E2; color: #991B1B;"><i class="fa-solid fa-xmark"></i> REJECTED</span>
                                @endif
                            </td>

                            <td style="padding: 1rem 0.85rem;">
                                <form action="{{ route('admin.subscription', $ag->id) }}" method="POST" style="display: inline-flex; gap: 0.35rem; align-items: center;">
                                    @csrf
                                    <select name="subscription_plan" onchange="this.form.submit()" style="padding: 0.35rem 0.5rem; border-radius: 6px; border: 1px solid var(--border-color); font-size: 0.8rem; background: white;">
                                        <option value="free" {{ $ag->subscription_plan == 'free' ? 'selected' : '' }}>Free Access Plan</option>
                                        <option value="monthly_b2b" {{ $ag->subscription_plan == 'monthly_b2b' ? 'selected' : '' }}>Monthly VIP Tag</option>
                                        <option value="yearly_b2b" {{ $ag->subscription_plan == 'yearly_b2b' ? 'selected' : '' }}>Yearly VIP Tag</option>
                                    </select>
                                </form>
                            </td>

                            <td style="padding: 1rem 0.85rem; text-align: right;">
                                <div style="display: flex; gap: 0.4rem; justify-content: flex-end;">
                                    <!-- Full Details Modal Trigger -->
                                    <button type="button" onclick="openAgencyModal({{ $ag->id }})" class="btn-primary" style="background: #0284C7; font-size: 0.78rem; padding: 0.4rem 0.65rem;" title="View Full Profile Details">
                                        <i class="fa-solid fa-circle-info me-1"></i> Details
                                    </button>

                                    <!-- 1-Click Agency Impersonation Login -->
                                    <form action="{{ route('admin.impersonate', $ag->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn-gold" style="font-size: 0.78rem; padding: 0.4rem 0.65rem; background: linear-gradient(135deg, #F59E0B, #D97706); color: white;" title="Login as Agency for debugging">
                                            <i class="fa-solid fa-key me-1"></i> 1-Click Login
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 2.5rem; color: var(--text-muted);">
                                No registered agencies match your search and filter criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Agency Full Profile Details Inspection Modal -->
    <div id="agencyDetailModal" class="modal" onclick="if(event.target === this) closeAgencyModal()">
        <div class="modal-content" style="max-width: 650px;">
            <button class="close-btn" onclick="closeAgencyModal()" title="Close (Esc)"><i class="fa-solid fa-xmark"></i></button>
            
            <div style="display: flex; align-items: center; gap: 0.85rem; margin-bottom: 1.25rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem;">
                <div style="width: 48px; height: 48px; background: linear-gradient(135deg, var(--admin-accent), #B38F22); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--admin-dark); font-size: 1.4rem;">
                    <i class="fa-solid fa-building"></i>
                </div>
                <div>
                    <h3 id="modal_agency_name" class="font-heading" style="color: var(--admin-dark); font-size: 1.4rem;">Agency Details</h3>
                    <span id="modal_verification_status" class="badge" style="background: #FEF3C7; color: #92400E;">Pending</span>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; font-size: 0.9rem; margin-bottom: 1.5rem; line-height: 1.6;">
                <div>
                    <strong style="color: var(--text-muted); display: block; font-size: 0.78rem;">Legal Company Name</strong>
                    <span id="modal_company_name" style="color: var(--admin-dark); font-weight: 700;">-</span>
                </div>

                <div>
                    <strong style="color: var(--text-muted); display: block; font-size: 0.78rem;">Proprietor / Owner Name</strong>
                    <span id="modal_owner_name" style="color: var(--admin-dark); font-weight: 700;">-</span>
                </div>

                <div>
                    <strong style="color: var(--text-muted); display: block; font-size: 0.78rem;">License Numbers (HL / UL)</strong>
                    <span id="modal_formatted_license" style="color: #047857; font-weight: 800;">-</span>
                </div>

                <div>
                    <strong style="color: var(--text-muted); display: block; font-size: 0.78rem;">HAAB & Trade License No</strong>
                    <span id="modal_haab_trade" style="color: var(--admin-dark); font-weight: 600;">-</span>
                </div>

                <div>
                    <strong style="color: var(--text-muted); display: block; font-size: 0.78rem;">Mobile & WhatsApp</strong>
                    <span id="modal_contacts" style="color: var(--admin-dark); font-weight: 600;">-</span>
                </div>

                <div>
                    <strong style="color: var(--text-muted); display: block; font-size: 0.78rem;">Email Address</strong>
                    <span id="modal_email" style="color: var(--admin-dark); font-weight: 600;">-</span>
                </div>

                <div style="grid-column: span 2;">
                    <strong style="color: var(--text-muted); display: block; font-size: 0.78rem;">City & Full Office Address</strong>
                    <span id="modal_address" style="color: var(--admin-dark); font-weight: 600;">-</span>
                </div>
            </div>

            <!-- Uploaded Document Hardcopies -->
            <div style="background: #F8FAFC; border: 1px solid var(--border-color); border-radius: 12px; padding: 1rem; margin-bottom: 1.5rem;">
                <strong style="display: block; font-size: 0.85rem; color: var(--admin-dark); margin-bottom: 0.5rem;">
                    <i class="fa-solid fa-file-image text-emerald-600 me-1"></i> Uploaded Document Hardcopies:
                </strong>
                <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                    <a id="modal_license_doc" href="#" target="_blank" class="badge" style="background: #D1FAE5; color: #065F46; font-size: 0.8rem; padding: 0.4rem 0.75rem; text-decoration: none; border: 1px solid #A7F3D0; display: none;">
                        <i class="fa-solid fa-file-image me-1"></i> Open Hajj/Umrah License Photo
                    </a>

                    <a id="modal_trade_doc" href="#" target="_blank" class="badge" style="background: #E0F2FE; color: #0369A1; font-size: 0.8rem; padding: 0.4rem 0.75rem; text-decoration: none; border: 1px solid #BAE6FD; display: none;">
                        <i class="fa-solid fa-file-invoice me-1"></i> Open Trade License Photo
                    </a>

                    <span id="modal_no_docs" style="font-size: 0.82rem; color: #94A3B8; font-style: italic;">No document hardcopies uploaded yet.</span>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.5rem;">
                <button type="button" onclick="closeAgencyModal()" style="background: #E2E8F0; color: #334155; border: none; padding: 0.5rem 1rem; border-radius: 6px; font-weight: 600; cursor: pointer;">Close Window</button>
            </div>
        </div>
    </div>

    <script>
        function openAgencyModal(agencyId) {
            fetch(`/admin/agency/${agencyId}`)
                .then(res => res.json())
                .then(data => {
                    document.getElementById('modal_agency_name').innerText = data.agency_name;
                    document.getElementById('modal_company_name').innerText = data.company_name;
                    document.getElementById('modal_owner_name').innerText = data.owner_name;
                    document.getElementById('modal_formatted_license').innerText = data.formatted_license;
                    document.getElementById('modal_haab_trade').innerText = `HAAB: ${data.haab_no} | Trade: ${data.trade_license_no}`;
                    document.getElementById('modal_contacts').innerText = `Phone: ${data.phone} | WA: ${data.whatsapp}`;
                    document.getElementById('modal_email').innerText = data.email;
                    document.getElementById('modal_address').innerText = `${data.city} - ${data.address}`;

                    const statusBadge = document.getElementById('modal_verification_status');
                    statusBadge.innerText = data.verification_status;
                    if (data.verification_status === 'Approved') {
                        statusBadge.style.background = '#D1FAE5';
                        statusBadge.style.color = '#065F46';
                    } else if (data.verification_status === 'Pending') {
                        statusBadge.style.background = '#FEF3C7';
                        statusBadge.style.color = '#92400E';
                    } else {
                        statusBadge.style.background = '#FEE2E2';
                        statusBadge.style.color = '#991B1B';
                    }

                    const licDoc = document.getElementById('modal_license_doc');
                    const tradeDoc = document.getElementById('modal_trade_doc');
                    const noDocs = document.getElementById('modal_no_docs');

                    let hasDocs = false;
                    if (data.license_document_url) {
                        licDoc.href = data.license_document_url;
                        licDoc.style.display = 'inline-flex';
                        hasDocs = true;
                    } else {
                        licDoc.style.display = 'none';
                    }

                    if (data.trade_license_document_url) {
                        tradeDoc.href = data.trade_license_document_url;
                        tradeDoc.style.display = 'inline-flex';
                        hasDocs = true;
                    } else {
                        tradeDoc.style.display = 'none';
                    }

                    noDocs.style.display = hasDocs ? 'none' : 'inline';

                    document.getElementById('agencyDetailModal').classList.add('open');
                })
                .catch(err => console.error(err));
        }

        function closeAgencyModal() {
            document.getElementById('agencyDetailModal').classList.remove('open');
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeAgencyModal();
            }
        });
    </script>
@endsection
