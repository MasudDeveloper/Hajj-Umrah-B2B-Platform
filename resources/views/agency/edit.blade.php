@extends('layouts.app')

@section('title', 'এজেন্সি প্রোফাইল ও সেটিংস - Agency Profile & Settings')

@section('content')
    @php
        $lang = session('locale', 'bn');
    @endphp

    <div style="max-width: 960px; margin: 0 auto; padding-bottom: 3rem;">
        <!-- Top Header & Navigation -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <a href="{{ route('dashboard.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 600; font-size: 0.88rem; display: inline-flex; align-items: center; gap: 0.4rem; margin-bottom: 0.5rem;">
                    <i class="fa-solid fa-arrow-left"></i> {{ $lang == 'bn' ? 'ড্যাশবোর্ডে ফিরে যান' : 'Back to Dashboard' }}
                </a>
                <h1 class="font-heading" style="font-size: 2rem; color: var(--primary-dark); margin: 0;">
                    <i class="fa-solid fa-sliders text-emerald-600 me-2"></i> {{ $lang == 'bn' ? 'এজেন্সি প্রোফাইল ও ব্র্যান্ডিং সেটিংস' : 'Agency Profile & Brand Settings' }}
                </h1>
                <p style="color: var(--text-muted); font-size: 0.92rem; margin-top: 0.35rem;">
                    {{ $lang == 'bn' ? 'অফিসিয়াল লোগো, যোগাযোগের ঠিকানা, লাইসেন্স নম্বর ও অ্যাকাউন্টের নিরাপত্তা হালনাগাদ করুন' : 'Manage official logo, business contacts, licensing credentials, and security settings' }}
                </p>
            </div>

            <a href="{{ route('agencies.show', $agency->id) }}" class="btn-primary" style="background: #044E35; font-size: 0.88rem; padding: 0.65rem 1.25rem; text-decoration: none; border-radius: 10px; box-shadow: 0 4px 12px rgba(4,78,53,0.15);">
                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> {{ $lang == 'bn' ? 'পাবলিক প্রোফাইল প্রিভিউ' : 'View Public Profile' }}
            </a>
        </div>

        @if(session('success'))
            <div style="background: #ECFDF5; border-left: 5px solid #10B981; padding: 1.1rem 1.5rem; border-radius: 12px; margin-bottom: 2rem; color: #065F46; font-weight: 600; display: flex; align-items: center; gap: 0.75rem; box-shadow: 0 2px 8px rgba(16,185,129,0.1);">
                <i class="fa-solid fa-circle-check text-emerald-600" style="font-size: 1.3rem;"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if(isset($errors) && $errors->any())
            <div style="background: #FEF2F2; border-left: 5px solid #EF4444; padding: 1.1rem 1.5rem; border-radius: 12px; margin-bottom: 2rem; color: #991B1B; box-shadow: 0 2px 8px rgba(239,68,68,0.1);">
                <div style="font-weight: 700; margin-bottom: 0.35rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fa-solid fa-triangle-exclamation text-red-600"></i> তথ্যাদি সংরক্ষণে ত্রুটি দেখা দিয়েছে:
                </div>
                <ul style="margin: 0; padding-left: 1.5rem; font-size: 0.9rem;">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Card 1: Official Branding & Profile Information -->
        <div style="background: white; border-radius: 18px; border: 1px solid var(--border-color); box-shadow: 0 4px 20px rgba(0,0,0,0.05); padding: 2.25rem; margin-bottom: 2.25rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #F1F5F9; padding-bottom: 1.25rem; margin-bottom: 2rem;">
                <div>
                    <h3 class="font-heading" style="font-size: 1.35rem; color: var(--primary-dark); margin: 0;">
                        <i class="fa-solid fa-building-circle-check text-emerald-600 me-2"></i> {{ $lang == 'bn' ? 'এজেন্সি পরিচিতি ও ব্র্যান্ডিং' : 'Agency Profile & Branding' }}
                    </h3>
                    <p style="color: var(--text-muted); font-size: 0.85rem; margin: 0.25rem 0 0 0;">
                        মার্কেটপ্লেসে আপনার এজেন্সি কার্ড, অফার এবং দ্বিপাক্ষিক চুক্তিপত্রে প্রদর্শিত হবে।
                    </p>
                </div>
                <span class="badge badge-verified" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">
                    <i class="fa-solid fa-shield-check"></i> {{ strtoupper($agency->verification_status) }}
                </span>
            </div>

            <form action="{{ route('agency.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Logo Upload Section -->
                <div style="background: #F8FAFC; border: 1.5px dashed #CBD5E1; border-radius: 16px; padding: 1.75rem; margin-bottom: 2rem; display: flex; align-items: center; gap: 1.75rem; flex-wrap: wrap;">
                    <div style="width: 90px; height: 90px; border-radius: 18px; background: white; border: 2px solid #E2E8F0; display: flex; align-items: center; justify-content: center; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.06); flex-shrink: 0;" id="logoPreviewContainer">
                        @if($agency->logo && file_exists(public_path($agency->logo)))
                            <img src="{{ asset($agency->logo) }}" alt="Logo" id="logoPreview" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <i class="fa-solid fa-image text-slate-300" id="logoPlaceholder" style="font-size: 2.5rem; color: #94A3B8;"></i>
                            <img src="" alt="Logo Preview" id="logoPreview" style="width: 100%; height: 100%; object-fit: cover; display: none;">
                        @endif
                    </div>

                    <div style="flex: 1; min-width: 250px;">
                        <label class="form-label" style="font-size: 0.95rem; margin-bottom: 0.35rem;">
                            <i class="fa-solid fa-upload text-emerald-600 me-1"></i> {{ $lang == 'bn' ? 'অফিসিয়াল এজেন্সি লোগো আপলোড' : 'Upload Official Agency Logo' }}
                        </label>
                        <p style="font-size: 0.82rem; color: var(--text-muted); margin-bottom: 0.75rem;">
                            সমর্থিত ফরম্যাট: PNG, JPG, JPEG, WebP (সর্বোচ্চ সাইজ: ২ মেগাবাইট)। চারকোনা বা স্কয়ার রেশিও রেকমেন্ডেড।
                        </p>
                        <input type="file" name="logo" id="logoInput" accept="image/*" class="form-control" style="padding: 0.55rem; background: white;" onchange="previewImage(event)">
                    </div>
                </div>

                <!-- Basic Names Grid -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label class="form-label">{{ $lang == 'bn' ? 'এজেন্সির ট্রেড নাম (Agency Name) *' : 'Agency Trade Name *' }}</label>
                        <input type="text" name="agency_name" value="{{ old('agency_name', $agency->agency_name) }}" required class="form-control" placeholder="যেমন: আল-মদিনা ট্রাভেলস">
                    </div>
                    <div>
                        <label class="form-label">{{ $lang == 'bn' ? 'কোম্পানি রেজিস্টার্ড নাম (Legal Name) *' : 'Registered Legal Name *' }}</label>
                        <input type="text" name="company_name" value="{{ old('company_name', $agency->company_name) }}" required class="form-control" placeholder="যেমন: Al-Madina Travels & Tours Ltd.">
                    </div>
                </div>

                <!-- Proprietor & Email -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label class="form-label">{{ $lang == 'bn' ? 'মালিক / প্রতিনিধির নাম *' : 'Proprietor / Representative Name *' }}</label>
                        <input type="text" name="owner_name" value="{{ old('owner_name', $agency->owner_name) }}" required class="form-control" placeholder="আপনার পূর্ণ নাম">
                    </div>
                    <div>
                        <label class="form-label">{{ $lang == 'bn' ? 'অফিসিয়াল ইমেইল অ্যাড্রেস *' : 'Official Email *' }}</label>
                        <input type="email" name="email" value="{{ old('email', $agency->email) }}" required class="form-control" placeholder="agency@domain.com">
                    </div>
                </div>

                <!-- Phone, WhatsApp, City Hub -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label class="form-label">{{ $lang == 'bn' ? 'মোবাইল নম্বর *' : 'Phone Number *' }}</label>
                        <input type="text" name="phone" value="{{ old('phone', $agency->phone) }}" required class="form-control" placeholder="017xxxxxxxx">
                    </div>
                    <div>
                        <label class="form-label">{{ $lang == 'bn' ? 'হোয়াটসঅ্যাপ নম্বর' : 'WhatsApp Number' }}</label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp', $agency->whatsapp) }}" class="form-control" placeholder="+88017xxxxxxxx">
                    </div>
                    <div>
                        <label class="form-label">{{ $lang == 'bn' ? 'অফিস লোকেশন (জেলা ও বিভাগ) *' : 'District & Division *' }}</label>
                        <select name="city" class="form-control" style="font-weight: 600;">
                            <optgroup label="ঢাকা বিভাগ (Dhaka Division)">
                                <option value="Dhaka" {{ $agency->city == 'Dhaka' ? 'selected' : '' }}>Dhaka (ঢাকা)</option>
                                <option value="Gazipur" {{ $agency->city == 'Gazipur' ? 'selected' : '' }}>Gazipur (গাজীপুর)</option>
                                <option value="Narayanganj" {{ $agency->city == 'Narayanganj' ? 'selected' : '' }}>Narayanganj (নারায়ণগঞ্জ)</option>
                                <option value="Tangail" {{ $agency->city == 'Tangail' ? 'selected' : '' }}>Tangail (টাঙ্গাইল)</option>
                                <option value="Faridpur" {{ $agency->city == 'Faridpur' ? 'selected' : '' }}>Faridpur (ফরিদপুর)</option>
                                <option value="Narsingdi" {{ $agency->city == 'Narsingdi' ? 'selected' : '' }}>Narsingdi (নরসিংদী)</option>
                            </optgroup>
                            <optgroup label="চট্টগ্রাম বিভাগ (Chittagong Division)">
                                <option value="Chittagong" {{ $agency->city == 'Chittagong' ? 'selected' : '' }}>Chittagong (চট্টগ্রাম)</option>
                                <option value="Cox's Bazar" {{ $agency->city == "Cox's Bazar" ? 'selected' : '' }}>Cox's Bazar (কক্সবাজার)</option>
                                <option value="Comilla" {{ $agency->city == 'Comilla' ? 'selected' : '' }}>Comilla (কুমিল্লা)</option>
                                <option value="Feni" {{ $agency->city == 'Feni' ? 'selected' : '' }}>Feni (ফেনী)</option>
                                <option value="Brahmanbaria" {{ $agency->city == 'Brahmanbaria' ? 'selected' : '' }}>Brahmanbaria (ব্রাহ্মণবাড়িয়া)</option>
                                <option value="Noakhali" {{ $agency->city == 'Noakhali' ? 'selected' : '' }}>Noakhali (নোয়াখালী)</option>
                                <option value="Chandpur" {{ $agency->city == 'Chandpur' ? 'selected' : '' }}>Chandpur (চাঁদপুর)</option>
                            </optgroup>
                            <optgroup label="সিলেট বিভাগ (Sylhet Division)">
                                <option value="Sylhet" {{ $agency->city == 'Sylhet' ? 'selected' : '' }}>Sylhet (সিলেট)</option>
                                <option value="Moulvibazar" {{ $agency->city == 'Moulvibazar' ? 'selected' : '' }}>Moulvibazar (মৌলভীবাজার)</option>
                                <option value="Habiganj" {{ $agency->city == 'Habiganj' ? 'selected' : '' }}>Habiganj (হবিগঞ্জ)</option>
                                <option value="Sunamganj" {{ $agency->city == 'Sunamganj' ? 'selected' : '' }}>Sunamganj (সুনামগঞ্জ)</option>
                            </optgroup>
                            <optgroup label="রাজশাহী বিভাগ (Rajshahi Division)">
                                <option value="Rajshahi" {{ $agency->city == 'Rajshahi' ? 'selected' : '' }}>Rajshahi (রাজশাহী)</option>
                                <option value="Bogra" {{ $agency->city == 'Bogra' ? 'selected' : '' }}>Bogra (বগুড়া)</option>
                                <option value="Pabna" {{ $agency->city == 'Pabna' ? 'selected' : '' }}>Pabna (পাবনা)</option>
                                <option value="Sirajganj" {{ $agency->city == 'Sirajganj' ? 'selected' : '' }}>Sirajganj (সিরাজগঞ্জ)</option>
                                <option value="Naogaon" {{ $agency->city == 'Naogaon' ? 'selected' : '' }}>Naogaon (নওগাঁ)</option>
                            </optgroup>
                            <optgroup label="খুলনা বিভাগ (Khulna Division)">
                                <option value="Khulna" {{ $agency->city == 'Khulna' ? 'selected' : '' }}>Khulna (খুলনা)</option>
                                <option value="Jessore" {{ $agency->city == 'Jessore' ? 'selected' : '' }}>Jessore (যশোর)</option>
                                <option value="Kushtia" {{ $agency->city == 'Kushtia' ? 'selected' : '' }}>Kushtia (কুষ্টিয়া)</option>
                                <option value="Satkhira" {{ $agency->city == 'Satkhira' ? 'selected' : '' }}>Satkhira (সাতক্ষীরা)</option>
                            </optgroup>
                            <optgroup label="বরিশাল বিভাগ (Barisal Division)">
                                <option value="Barisal" {{ $agency->city == 'Barisal' ? 'selected' : '' }}>Barisal (বরিশাল)</option>
                                <option value="Patuakhali" {{ $agency->city == 'Patuakhali' ? 'selected' : '' }}>Patuakhali (পটুয়াখালী)</option>
                                <option value="Bhola" {{ $agency->city == 'Bhola' ? 'selected' : '' }}>Bhola (ভোলা)</option>
                            </optgroup>
                            <optgroup label="রংপুর বিভাগ (Rangpur Division)">
                                <option value="Rangpur" {{ $agency->city == 'Rangpur' ? 'selected' : '' }}>Rangpur (রংপুর)</option>
                                <option value="Dinajpur" {{ $agency->city == 'Dinajpur' ? 'selected' : '' }}>Dinajpur (দিনাজপুর)</option>
                                <option value="Saidpur" {{ $agency->city == 'Saidpur' ? 'selected' : '' }}>Saidpur (সৈয়দপুর)</option>
                            </optgroup>
                            <optgroup label="ময়মনসিংহ বিভাগ (Mymensingh Division)">
                                <option value="Mymensingh" {{ $agency->city == 'Mymensingh' ? 'selected' : '' }}>Mymensingh (ময়মনসিংহ)</option>
                                <option value="Jamalpur" {{ $agency->city == 'Jamalpur' ? 'selected' : '' }}>Jamalpur (জামালপুর)</option>
                            </optgroup>
                        </select>
                    </div>
                </div>

                <!-- Address -->
                <div style="margin-bottom: 1.5rem;">
                    <label class="form-label">{{ $lang == 'bn' ? 'অফিস ও চেম্বার ঠিকানা' : 'Office Address' }}</label>
                    <input type="text" name="address" value="{{ old('address', $agency->address) }}" class="form-control" placeholder="যেমন: হাউজ #১২, রোড #৪, পল্টন / বনানী, ঢাকা">
                </div>

                <!-- Website & ATAB No -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label class="form-label">{{ $lang == 'bn' ? 'অফিসিয়াল ওয়েবসাইট URL' : 'Website URL' }}</label>
                        <input type="url" name="website" value="{{ old('website', $agency->website) }}" class="form-control" placeholder="https://youragency.com">
                    </div>
                    <div>
                        <label class="form-label">{{ $lang == 'bn' ? 'ATAB মেম্বারশিপ নম্বর' : 'ATAB Registration No' }}</label>
                        <input type="text" name="atab_no" value="{{ old('atab_no', $agency->atab_no) }}" class="form-control" placeholder="e.g. 1245">
                    </div>
                </div>

                <!-- HAAB & License No -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label class="form-label">{{ $lang == 'bn' ? 'HAAB মেম্বারশিপ নম্বর' : 'HAAB Registration No' }}</label>
                        <input type="text" name="haab_no" value="{{ old('haab_no', $agency->haab_no) }}" class="form-control" placeholder="e.g. 0542">
                    </div>
                    <div>
                        <label class="form-label">{{ $lang == 'bn' ? 'হজ / ওমরাহ লাইসেন্স নম্বর (ভেরিফাইড)' : 'Verified License No' }}</label>
                        <input type="text" name="license_no" value="{{ $agency->license_no }}" class="form-control" readonly style="background: #F1F5F9; color: #475569; font-weight: 700;">
                    </div>
                </div>

                <!-- Bio -->
                <div style="margin-bottom: 2rem;">
                    <label class="form-label">{{ $lang == 'bn' ? 'এজেন্সি পরিচিতি ও বিশেষত্ব (Bio / About Us)' : 'Agency Bio & Specialization' }}</label>
                    <textarea name="bio" rows="4" class="form-control" placeholder="আপনার এজেন্সির অভিজ্ঞতা, প্রধান এয়ারলাইন্স পার্টনারশিপ, মক্কা-মদিনা গ্রাউন্ড সাপোর্ট এবং সেবার গুণমান সম্পর্কে সংক্ষেপে লিখুন...">{{ old('bio', $agency->bio) }}</textarea>
                </div>

                <div style="display: flex; justify-content: flex-end;">
                    <button type="submit" class="btn-primary" style="padding: 0.85rem 2.25rem; font-size: 1rem; border-radius: 10px; box-shadow: 0 4px 15px rgba(4,78,53,0.2);">
                        <i class="fa-solid fa-floppy-disk me-2"></i> {{ $lang == 'bn' ? 'প্রোফাইল পরিবর্তন সংরক্ষণ করুন' : 'Save Profile Changes' }}
                    </button>
                </div>
            </form>
        </div>

        <!-- Card 2: Security & Password Update -->
        <div style="background: white; border-radius: 18px; border: 1px solid var(--border-color); box-shadow: 0 4px 20px rgba(0,0,0,0.05); padding: 2.25rem;">
            <div style="border-bottom: 2px solid #F1F5F9; padding-bottom: 1.25rem; margin-bottom: 2rem;">
                <h3 class="font-heading" style="font-size: 1.35rem; color: var(--primary-dark); margin: 0;">
                    <i class="fa-solid fa-lock text-emerald-600 me-2"></i> {{ $lang == 'bn' ? 'অ্যাকাউন্ট সিকিউরিটি ও পাসওয়ার্ড' : 'Account Security & Password' }}
                </h3>
                <p style="color: var(--text-muted); font-size: 0.85rem; margin: 0.25rem 0 0 0;">
                    আপনার B2B প্ল্যাটফর্ম অ্যাকাউন্টের নিরাপত্তা নিশ্চিত করতে নিয়মিত পাসওয়ার্ড আপডেট করুন।
                </p>
            </div>

            <form action="{{ route('agency.profile.password') }}" method="POST">
                @csrf

                <div style="margin-bottom: 1.5rem; max-width: 480px;">
                    <label class="form-label">{{ $lang == 'bn' ? 'বর্তমান পাসওয়ার্ড *' : 'Current Password *' }}</label>
                    <input type="password" name="current_password" required class="form-control" placeholder="••••••••">
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
                    <div>
                        <label class="form-label">{{ $lang == 'bn' ? 'নতুন পাসওয়ার্ড (কমপক্ষে ৬ অক্ষর) *' : 'New Password (min 6 chars) *' }}</label>
                        <input type="password" name="password" required class="form-control" placeholder="••••••••">
                    </div>
                    <div>
                        <label class="form-label">{{ $lang == 'bn' ? 'নতুন পাসওয়ার্ড নিশ্চিত করুন *' : 'Confirm New Password *' }}</label>
                        <input type="password" name="password_confirmation" required class="form-control" placeholder="••••••••">
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end;">
                    <button type="submit" class="btn-primary" style="background: #0369A1; padding: 0.85rem 2.25rem; font-size: 1rem; border-radius: 10px; box-shadow: 0 4px 15px rgba(3,105,161,0.2);">
                        <i class="fa-solid fa-key me-2"></i> {{ $lang == 'bn' ? 'নতুন পাসওয়ার্ড সেভ করুন' : 'Update Password' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('logoPreview');
                    const placeholder = document.getElementById('logoPlaceholder');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    if (placeholder) placeholder.style.display = 'none';
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
