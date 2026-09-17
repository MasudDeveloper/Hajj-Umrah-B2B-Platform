@extends('layouts.app')

@section('title', 'Agency Verification Portal - License & Document Submission')

@section('content')
<div style="max-width: 860px; margin: 2rem auto; background: white; border-radius: 20px; padding: 2.5rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-md);">
    
    <!-- Header with Verification Status Badge -->
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem; border-bottom: 2px solid var(--accent); padding-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: #FEF3C7; color: #92400E; font-size: 0.8rem; font-weight: 700; padding: 0.35rem 0.85rem; border-radius: 20px; margin-bottom: 0.5rem; border: 1px solid #FCD34D;">
                <i class="fa-solid fa-shield-halved text-amber-600"></i> Step 2 of 2: Government & HAAB License Verification
            </div>
            <h1 class="font-heading" style="font-size: 1.85rem; color: var(--primary-dark); margin-bottom: 0.35rem;">Agency Verification Portal</h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">Submit your official Hajj/Umrah license number, trade license details, and hardcopy document photos for Super Admin approval.</p>
        </div>

        <div style="text-align: right;">
            @if($agency->isApproved())
                <span style="background: #D1FAE5; color: #065F46; padding: 0.6rem 1.1rem; border-radius: 30px; font-weight: 800; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.5rem; border: 1px solid #34D399;">
                    <i class="fa-solid fa-circle-check text-emerald-600"></i> VERIFIED & APPROVED AGENCY
                </span>
            @elseif($agency->hasSubmittedVerification() && $agency->verification_status === 'pending')
                <span style="background: #FEF3C7; color: #92400E; padding: 0.6rem 1.1rem; border-radius: 30px; font-weight: 800; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.5rem; border: 1px solid #FCD34D;">
                    <i class="fa-solid fa-clock text-amber-600"></i> UNDER SUPER ADMIN REVIEW
                </span>
            @elseif($agency->verification_status === 'rejected')
                <span style="background: #FEE2E2; color: #991B1B; padding: 0.6rem 1.1rem; border-radius: 30px; font-weight: 800; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.5rem; border: 1px solid #FCA5A5;">
                    <i class="fa-solid fa-circle-xmark text-red-600"></i> REJECTED - RESUBMIT DOCUMENTS
                </span>
            @else
                <span style="background: #EFF6FF; color: #1E40AF; padding: 0.6rem 1.1rem; border-radius: 30px; font-weight: 800; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.5rem; border: 1px solid #93C5FD;">
                    <i class="fa-solid fa-file-pen"></i> VERIFICATION PENDING SUBMISSION
                </span>
            @endif
        </div>
    </div>

    <!-- Step Indicator Progress Bar -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 2.25rem; background: #F8FAFC; padding: 1.25rem; border-radius: 14px; border: 1px solid var(--border-color);">
        <div style="display: flex; align-items: center; gap: 0.75rem;">
            <div style="width: 36px; height: 36px; background: #059669; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.95rem;">
                <i class="fa-solid fa-check"></i>
            </div>
            <div>
                <strong style="display: block; font-size: 0.88rem; color: var(--text-dark);">1. Phone OTP</strong>
                <span style="font-size: 0.75rem; color: #059669; font-weight: 700;">✓ Mobile Verified</span>
            </div>
        </div>

        <div style="display: flex; align-items: center; gap: 0.75rem;">
            <div style="width: 36px; height: 36px; background: {{ $agency->hasSubmittedVerification() ? '#059669' : 'var(--accent)' }}; color: {{ $agency->hasSubmittedVerification() ? 'white' : 'var(--primary-dark)' }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.95rem;">
                {{ $agency->hasSubmittedVerification() ? '✓' : '2' }}
            </div>
            <div>
                <strong style="display: block; font-size: 0.88rem; color: var(--text-dark);">2. License Uploads</strong>
                <span style="font-size: 0.75rem; color: {{ $agency->hasSubmittedVerification() ? '#059669' : 'var(--text-muted)' }}; font-weight: 600;">
                    {{ $agency->hasSubmittedVerification() ? '✓ Documents Uploaded' : 'Action Required' }}
                </span>
            </div>
        </div>

        <div style="display: flex; align-items: center; gap: 0.75rem;">
            <div style="width: 36px; height: 36px; background: {{ $agency->isApproved() ? '#059669' : '#CBD5E1' }}; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.95rem;">
                {{ $agency->isApproved() ? '✓' : '3' }}
            </div>
            <div>
                <strong style="display: block; font-size: 0.88rem; color: var(--text-dark);">3. Admin Approval</strong>
                <span style="font-size: 0.75rem; color: {{ $agency->isApproved() ? '#059669' : 'var(--text-muted)' }}; font-weight: 600;">
                    {{ $agency->isApproved() ? '✓ Verified B2B Access' : 'Awaiting Review' }}
                </span>
            </div>
        </div>
    </div>

    @if ($errors->any())
    <div class="alert-error" style="margin-bottom: 1.5rem;">
        <ul style="margin-left: 1rem; margin-top: 0.25rem;">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Information Status Box -->
    @if($agency->hasSubmittedVerification() && $agency->verification_status === 'pending')
    <div style="background: #FFFBEB; border: 1px solid #FCD34D; border-radius: 12px; padding: 1.25rem; margin-bottom: 2rem; color: #92400E; display: flex; gap: 1rem; align-items: flex-start;">
        <i class="fa-solid fa-circle-info fa-xl text-amber-600" style="margin-top: 0.3rem;"></i>
        <div>
            <h4 style="font-size: 1rem; font-weight: 700; margin-bottom: 0.25rem;">Verification Submission Received!</h4>
            <p style="font-size: 0.9rem; line-height: 1.5;">
                Your government license numbers and hardcopy document uploads are currently under review by our HAAB Super Admin verification team. You can update or re-upload corrected documents below if required.
            </p>
        </div>
    </div>
    @endif

    <form action="{{ route('verification.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary-dark); margin-bottom: 1.25rem; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem;">
            <i class="fa-solid fa-id-card text-emerald-700 me-1"></i> Agency Legal & Contact Information
        </h3>

        <!-- Grid 1: Agency Name & Legal Company Name -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.25rem;">
            <div>
                <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">Agency Brand Name *</label>
                <input type="text" name="agency_name" value="{{ old('agency_name', $agency->agency_name) }}" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.92rem;">
            </div>

            <div>
                <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">Registered Legal Company Name *</label>
                <input type="text" name="company_name" value="{{ old('company_name', $agency->company_name) }}" required placeholder="e.g. Al Haramain Travels Ltd." style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.92rem;">
            </div>
        </div>

        <!-- Grid 2: Owner Name & Contacts -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; margin-bottom: 1.25rem;">
            <div>
                <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">Proprietor / Managing Owner Name *</label>
                <input type="text" name="owner_name" value="{{ old('owner_name', $agency->owner_name !== 'Agency Owner' ? $agency->owner_name : '') }}" required placeholder="Full Name" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.92rem;">
            </div>

            <div>
                <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">Verified Mobile Phone *</label>
                <input type="text" value="{{ $agency->phone }}" disabled style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.92rem; background: #F1F5F9; color: var(--text-muted);">
            </div>

            <div>
                <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">WhatsApp Number (For Deals)</label>
                <input type="text" name="whatsapp" value="{{ old('whatsapp', $agency->whatsapp ?: $agency->phone) }}" placeholder="e.g. 01711223344" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.92rem;">
            </div>
        </div>

        <!-- Grid 3: City & Office Address -->
        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1.25rem; margin-bottom: 1.75rem;">
            <div>
                <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">City Hub *</label>
                <select name="city" required style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.92rem; background: white;">
                    <option value="Dhaka" {{ old('city', $agency->city) == 'Dhaka' ? 'selected' : '' }}>Dhaka</option>
                    <option value="Chittagong" {{ old('city', $agency->city) == 'Chittagong' ? 'selected' : '' }}>Chittagong</option>
                    <option value="Sylhet" {{ old('city', $agency->city) == 'Sylhet' ? 'selected' : '' }}>Sylhet</option>
                    <option value="Rajshahi" {{ old('city', $agency->city) == 'Rajshahi' ? 'selected' : '' }}>Rajshahi</option>
                    <option value="Khulna" {{ old('city', $agency->city) == 'Khulna' ? 'selected' : '' }}>Khulna</option>
                    <option value="Barisal" {{ old('city', $agency->city) == 'Barisal' ? 'selected' : '' }}>Barisal</option>
                </select>
            </div>

            <div>
                <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">Office Full Address *</label>
                <input type="text" name="address" value="{{ old('address', $agency->address) }}" required placeholder="e.g. Suite 402, Naya Paltan, Dhaka" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.92rem;">
            </div>
        </div>

        <h3 class="font-heading" style="font-size: 1.15rem; color: var(--primary-dark); margin-bottom: 1.25rem; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem; margin-top: 2rem;">
            <i class="fa-solid fa-file-contract text-emerald-700 me-1"></i> License Type & Government Numbers
        </h3>

        <!-- License Type Selection (Mandatory) -->
        <div style="margin-bottom: 1.5rem; background: #F8FAFC; padding: 1.25rem; border-radius: 12px; border: 1px solid var(--border-color);">
            <label style="display: block; font-weight: 700; font-size: 0.9rem; margin-bottom: 0.75rem; color: var(--primary-dark);">
                Select Agency License Category (Mandatory - Select At Least One) *
            </label>

            <div style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
                <label style="display: flex; align-items: center; gap: 0.5rem; background: white; padding: 0.6rem 1.1rem; border-radius: 8px; border: 2px solid #CBD5E1; cursor: pointer; font-weight: 600; font-size: 0.9rem;">
                    <input type="radio" name="license_type" value="hajj" id="type_hajj" onchange="toggleLicenseInputs()" {{ old('license_type', $agency->license_type ?? 'hajj') == 'hajj' ? 'checked' : '' }}>
                    <span>🕋 Hajj License Only (HL-)</span>
                </label>

                <label style="display: flex; align-items: center; gap: 0.5rem; background: white; padding: 0.6rem 1.1rem; border-radius: 8px; border: 2px solid #CBD5E1; cursor: pointer; font-weight: 600; font-size: 0.9rem;">
                    <input type="radio" name="license_type" value="umrah" id="type_umrah" onchange="toggleLicenseInputs()" {{ old('license_type', $agency->license_type) == 'umrah' ? 'checked' : '' }}>
                    <span>🌙 Umrah License Only (UL-)</span>
                </label>

                <label style="display: flex; align-items: center; gap: 0.5rem; background: white; padding: 0.6rem 1.1rem; border-radius: 8px; border: 2px solid var(--accent); cursor: pointer; font-weight: 700; font-size: 0.9rem; color: var(--primary-dark); background: #FFFDF5;">
                    <input type="radio" name="license_type" value="both" id="type_both" onchange="toggleLicenseInputs()" {{ old('license_type', $agency->license_type) == 'both' ? 'checked' : '' }}>
                    <span>✨ Both Hajj & Umrah Licenses</span>
                </label>
            </div>
        </div>

        <!-- Grid 4: Dynamic License Number Inputs -->
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem; margin-bottom: 1.75rem;">
            <!-- Hajj License Field -->
            <div id="hajj_license_wrapper">
                <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">
                    Hajj License Number (HL- Prefix) *
                </label>
                <div style="display: flex; align-items: center;">
                    <span style="background: #E2E8F0; padding: 0.75rem 0.85rem; border: 1px solid var(--border-color); border-right: none; border-radius: 8px 0 0 8px; font-weight: 800; font-size: 0.9rem; color: #047857;">HL-</span>
                    <input type="text" name="hajj_license_no" id="hajj_license_no" value="{{ old('hajj_license_no', preg_replace('/^HL-/i', '', $agency->hajj_license_no ?? '')) }}" placeholder="e.g. 1109" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 0 8px 8px 0; font-size: 0.92rem;">
                </div>
                <small style="color: var(--text-muted); font-size: 0.78rem;">Saved automatically as HL-{{ old('hajj_license_no', '1109') }} across system.</small>
            </div>

            <!-- Umrah License Field -->
            <div id="umrah_license_wrapper">
                <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">
                    Umrah License Number (UL- Prefix) *
                </label>
                <div style="display: flex; align-items: center;">
                    <span style="background: #E2E8F0; padding: 0.75rem 0.85rem; border: 1px solid var(--border-color); border-right: none; border-radius: 8px 0 0 8px; font-weight: 800; font-size: 0.9rem; color: #0284C7;">UL-</span>
                    <input type="text" name="umrah_license_no" id="umrah_license_no" value="{{ old('umrah_license_no', preg_replace('/^UL-/i', '', $agency->umrah_license_no ?? '')) }}" placeholder="e.g. 0482" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 0 8px 8px 0; font-size: 0.92rem;">
                </div>
                <small style="color: var(--text-muted); font-size: 0.78rem;">Saved automatically as UL-{{ old('umrah_license_no', '0482') }} across system.</small>
            </div>
        </div>

        <!-- Grid 4B: HAAB & Trade License -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; margin-bottom: 1.75rem;">
            <div>
                <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">HAAB Reg. No (Optional)</label>
                <input type="text" name="haab_no" value="{{ old('haab_no', $agency->haab_no) }}" placeholder="e.g. HAAB-882" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.92rem;">
            </div>

            <div>
                <label style="display: block; font-weight: 600; font-size: 0.88rem; margin-bottom: 0.35rem; color: var(--text-dark);">Trade License No *</label>
                <input type="text" name="trade_license_no" value="{{ old('trade_license_no', $agency->trade_license_no) }}" required placeholder="e.g. TRAD/22/1526" style="width: 100%; padding: 0.75rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.92rem;">
            </div>
        </div>

        <!-- Grid 5: Document Hardcopy Uploads -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
            <!-- Document 1: Hajj/Umrah License Photo -->
            <div style="background: #F8FAFC; border: 2px dashed #CBD5E1; border-radius: 12px; padding: 1.25rem; text-align: center;">
                <div style="font-size: 1.5rem; color: var(--primary); margin-bottom: 0.5rem;">
                    <i class="fa-solid fa-file-image"></i>
                </div>
                <strong style="display: block; font-size: 0.9rem; color: var(--text-dark); margin-bottom: 0.25rem;">
                    Hajj / Umrah License Hardcopy Copy *
                </strong>
                <p style="font-size: 0.78rem; color: var(--text-muted); margin-bottom: 1rem;">Upload clear photo or PDF scan of original Hajj/Umrah license certificate (Max 5MB).</p>

                @if($agency->license_document)
                    <div style="margin-bottom: 1rem; background: #D1FAE5; padding: 0.5rem 0.8rem; border-radius: 8px; font-size: 0.8rem; color: #065F46; font-weight: 700; display: inline-flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-solid fa-circle-check"></i> File Uploaded: 
                        <a href="{{ asset('storage/' . $agency->license_document) }}" target="_blank" style="color: #047857; text-decoration: underline;">View Uploaded Copy</a>
                    </div>
                @endif

                <input type="file" name="license_document" accept="image/*,.pdf" style="width: 100%; font-size: 0.85rem;">
            </div>

            <!-- Document 2: Trade License Photo -->
            <div style="background: #F8FAFC; border: 2px dashed #CBD5E1; border-radius: 12px; padding: 1.25rem; text-align: center;">
                <div style="font-size: 1.5rem; color: var(--primary); margin-bottom: 0.5rem;">
                    <i class="fa-solid fa-file-invoice"></i>
                </div>
                <strong style="display: block; font-size: 0.9rem; color: var(--text-dark); margin-bottom: 0.25rem;">
                    Trade License Hardcopy Copy *
                </strong>
                <p style="font-size: 0.78rem; color: var(--text-muted); margin-bottom: 1rem;">Upload clear photo or PDF scan of current updated Trade License (Max 5MB).</p>

                @if($agency->trade_license_document)
                    <div style="margin-bottom: 1rem; background: #D1FAE5; padding: 0.5rem 0.8rem; border-radius: 8px; font-size: 0.8rem; color: #065F46; font-weight: 700; display: inline-flex; align-items: center; gap: 0.5rem;">
                        <i class="fa-solid fa-circle-check"></i> File Uploaded: 
                        <a href="{{ asset('storage/' . $agency->trade_license_document) }}" target="_blank" style="color: #047857; text-decoration: underline;">View Uploaded Copy</a>
                    </div>
                @endif

                <input type="file" name="trade_license_document" accept="image/*,.pdf" style="width: 100%; font-size: 0.85rem;">
            </div>
        </div>

        <button type="submit" class="btn-gold" style="width: 100%; justify-content: center; font-size: 1.1rem; padding: 1rem; box-shadow: 0 4px 15px rgba(212, 175, 55, 0.4);">
            <i class="fa-solid fa-paper-plane me-2"></i> Submit Agency License Information & Documents for Approval
        </button>
    </form>
</div>

<script>
    function toggleLicenseInputs() {
        const isHajj = document.getElementById('type_hajj').checked;
        const isUmrah = document.getElementById('type_umrah').checked;
        const isBoth = document.getElementById('type_both').checked;

        const hajjWrapper = document.getElementById('hajj_license_wrapper');
        const umrahWrapper = document.getElementById('umrah_license_wrapper');
        const hajjInput = document.getElementById('hajj_license_no');
        const umrahInput = document.getElementById('umrah_license_no');

        if (isHajj) {
            hajjWrapper.style.display = 'block';
            umrahWrapper.style.display = 'none';
            hajjInput.required = true;
            umrahInput.required = false;
        } else if (isUmrah) {
            hajjWrapper.style.display = 'none';
            umrahWrapper.style.display = 'block';
            hajjInput.required = false;
            umrahInput.required = true;
        } else {
            hajjWrapper.style.display = 'block';
            umrahWrapper.style.display = 'block';
            hajjInput.required = true;
            umrahInput.required = true;
        }
    }
    document.addEventListener('DOMContentLoaded', toggleLicenseInputs);
</script>
@endsection
