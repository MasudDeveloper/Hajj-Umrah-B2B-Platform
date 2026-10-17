@extends('layouts.admin')

@section('title', 'Transactions & Payments')

@section('content')
    <!-- Top Header Banner -->
    <div style="background: white; border-radius: 16px; padding: 2rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm); margin-bottom: 2rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="badge" style="background: #E0E7FF; color: #3730A3; margin-bottom: 0.5rem;"><i class="fa-solid fa-file-invoice-dollar me-1"></i> Finance & Billing</span>
                <h1 class="font-heading" style="font-size: 2rem; color: var(--admin-dark);">Transactions & Subscriptions</h1>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Review manual payment verifications and manage agency subscription plans.</p>
            </div>
            
            <div style="background: #F1F5F9; border: 1px solid #CBD5E1; padding: 0.75rem 1.25rem; border-radius: 12px; color: #334155; font-weight: 700; font-size: 0.95rem; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-receipt text-slate-500 fa-lg"></i> {{ $transactions->count() }} Total Records
            </div>
        </div>
    </div>

    @if(session('success'))
        <div style="background: #D1FAE5; color: #065F46; padding: 1rem 1.25rem; border-radius: 12px; margin-bottom: 1.5rem; border: 1px solid #34D399; font-weight: 600;">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background: #FEE2E2; color: #991B1B; padding: 1rem 1.25rem; border-radius: 12px; margin-bottom: 1.5rem; border: 1px solid #F87171; font-weight: 600;">
            <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('error') }}
        </div>
    @endif

    <!-- Transactions Table Card -->
    <div style="background: white; border-radius: 16px; padding: 1.75rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.88rem;">
                <thead>
                    <tr style="background: #F8FAFC; border-bottom: 2px solid var(--border-color); color: var(--text-muted); font-size: 0.78rem; text-transform: uppercase;">
                        <th style="padding: 0.85rem;">Date</th>
                        <th style="padding: 0.85rem;">Agency</th>
                        <th style="padding: 0.85rem;">Method & Sender</th>
                        <th style="padding: 0.85rem;">Trx ID & Amount</th>
                        <th style="padding: 0.85rem;">Status</th>
                        <th style="padding: 0.85rem; text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $trx)
                        <tr style="border-bottom: 1px solid var(--border-color); {{ $trx->status == 'pending' ? 'background: #FFFBEB;' : '' }}">
                            <td style="padding: 1rem 0.85rem;">
                                <div style="font-weight: 600;">{{ $trx->created_at->format('d M, Y') }}</div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $trx->created_at->format('h:i A') }}</div>
                            </td>

                            <td style="padding: 1rem 0.85rem;">
                                <strong>{{ $trx->agency->agency_name ?? 'N/A' }}</strong>
                                <div style="font-size: 0.78rem; color: var(--text-muted);"><i class="fa-solid fa-phone me-1"></i>{{ $trx->agency->phone ?? 'N/A' }}</div>
                            </td>

                            <td style="padding: 1rem 0.85rem;">
                                <div style="font-weight: 700; color: #334155;">
                                    @if($trx->payment_method == 'bkash')
                                        <span style="color: #E2136E;"><i class="fa-solid fa-wallet"></i> bKash</span>
                                    @elseif($trx->payment_method == 'nagad')
                                        <span style="color: #ED1C24;"><i class="fa-solid fa-wallet"></i> Nagad</span>
                                    @elseif($trx->payment_method == 'rocket')
                                        <span style="color: #8C1515;"><i class="fa-solid fa-wallet"></i> Rocket</span>
                                    @else
                                        <span style="color: #F6921E;"><i class="fa-solid fa-wallet"></i> Upay</span>
                                    @endif
                                </div>
                                <div style="font-size: 0.82rem; margin-top: 0.2rem;">From: <strong>{{ $trx->gateway_response['sender_number'] ?? 'N/A' }}</strong></div>
                            </td>

                            <td style="padding: 1rem 0.85rem;">
                                <div style="font-weight: 700; letter-spacing: 0.5px;">{{ $trx->transaction_id }}</div>
                                <div style="color: var(--primary-dark); font-weight: 800; font-size: 1rem;">{{ number_format($trx->amount) }} BDT</div>
                            </td>

                            <td style="padding: 1rem 0.85rem;">
                                @if($trx->status == 'completed')
                                    <span class="badge" style="background: #D1FAE5; color: #065F46;"><i class="fa-solid fa-check me-1"></i> Completed</span>
                                @elseif($trx->status == 'pending')
                                    <span class="badge" style="background: #FEF3C7; color: #92400E;"><i class="fa-solid fa-clock me-1"></i> Pending</span>
                                @else
                                    <span class="badge" style="background: #FEE2E2; color: #991B1B;"><i class="fa-solid fa-xmark me-1"></i> Failed</span>
                                @endif
                            </td>

                            <td style="padding: 1rem 0.85rem; text-align: right;">
                                @if($trx->status == 'pending')
                                <div style="display: flex; gap: 0.4rem; justify-content: flex-end;">
                                    <form action="{{ route('admin.transactions.approve', $trx->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn-success" style="font-size: 0.75rem; padding: 0.35rem 0.6rem;">
                                            <i class="fa-solid fa-check"></i> Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.transactions.reject', $trx->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn-danger" style="font-size: 0.75rem; padding: 0.35rem 0.6rem;" onclick="return confirm('Are you sure you want to reject this transaction?');">
                                            <i class="fa-solid fa-xmark"></i> Reject
                                        </button>
                                    </form>
                                </div>
                                @else
                                    <span style="color: #94A3B8; font-size: 0.8rem; font-style: italic;">No actions needed</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 3rem; color: var(--text-muted);">
                                <i class="fa-solid fa-receipt text-slate-300 fa-2xl me-2"></i>
                                <h4 style="margin-top: 0.75rem; color: var(--admin-dark); font-size: 1.1rem;">No Transactions Found</h4>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
