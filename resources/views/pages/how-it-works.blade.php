@extends('layouts.app')

@section('title', 'কীভাবে কাজ করে - সরকার অনুমোদিত হজ্ব ও ওমরাহ বিটুবি প্ল্যাটফর্ম')

@section('content')
<style>
    .hiw-hero {
        background: linear-gradient(135deg, rgba(7, 13, 24, 0.94) 0%, rgba(4, 78, 53, 0.92) 100%), url('{{ asset("images/makkah_kaaba_hero.jpg") }}') center/cover no-repeat;
        padding: 5rem 2rem;
        border-radius: 20px;
        color: white;
        text-align: center;
        margin-bottom: 3.5rem;
        box-shadow: 0 15px 35px rgba(4, 78, 53, 0.2);
        border: 1px solid rgba(212, 175, 55, 0.3);
    }
    .step-card {
        background: white;
        border-radius: 16px;
        padding: 2.25rem 1.75rem;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-sm);
        position: relative;
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .step-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.08);
        border-color: var(--accent);
    }
    .step-number {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.4rem;
        margin-bottom: 1.25rem;
        font-family: var(--font-heading);
    }
    .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1.25rem;
        border-radius: 30px;
        font-weight: 800;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
    }
</style>

<!-- Hero Section -->
<div class="hiw-hero">
    <div style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(212, 175, 55, 0.2); border: 1px solid rgba(212, 175, 55, 0.6); color: #F3E5AB; padding: 0.45rem 1.25rem; border-radius: 30px; font-weight: 700; font-size: 0.88rem; margin-bottom: 1.5rem; text-transform: uppercase;">
        <i class="fa-solid fa-kaaba text-amber-300"></i> সহজ ও স্বচ্ছ বিটুবি কার্যপ্রণালী
    </div>
    <h1 style="font-size: 2.6rem; font-weight: 800; margin-bottom: 1.25rem; font-family: var(--font-heading); color: white; line-height: 1.25;">
        কীভাবে কাজ করে HAJJ & UMRAH B2B প্ল্যাটফর্ম?
    </h1>
    <p style="font-size: 1.15rem; color: #E2E8F0; max-width: 820px; margin: 0 auto; line-height: 1.7;">
        বাংলাদেশ সরকারের অনুমোদিত হজ্ব ও ওমরাহ লাইসেন্সপ্রাপ্ত ট্রাভেল এজেন্সিগুলোর জন্য গ্রুপ সিট, বিমান টিকিট ও হোটেল শেয়ারিংয়ের সম্পূর্ণ অটোমেটেড ৪-ধাপের প্রক্রিয়া।
    </p>
</div>

<div class="container" style="max-width: 1140px; margin: 0 auto; padding: 0 1rem;">

    <!-- 4 Main Workflow Steps -->
    <div style="margin-bottom: 5rem;">
        <div style="text-align: center; max-width: 700px; margin: 0 auto 3rem;">
            <span style="color: #047857; font-weight: 800; font-size: 0.88rem; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 0.5rem;">
                <i class="fa-solid fa-list-check me-1"></i> মূল ৪টি সহজ ধাপ
            </span>
            <h2 style="font-size: 2.1rem; font-weight: 800; color: var(--primary-dark); margin: 0;">
                প্ল্যাটফর্ম ব্যবহারের সম্পূর্ণ ধাপসমূহ
            </h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.75rem;">
            <!-- Step 1 -->
            <div class="step-card">
                <div class="step-number" style="background: #ECFDF5; color: #047857; border: 1.5px solid #A7F3D0;">
                    ১
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 0.75rem;">
                    ফ্রি সাইন-আপ ও লাইসেন্স ভেরিফিকেশন
                </h3>
                <p style="color: #64748B; font-size: 0.92rem; line-height: 1.6; margin: 0 0 1rem 0;">
                    আপনার মোবাইল নম্বরে ওটিপি কোড দিয়ে তাৎক্ষণিক অ্যাকাউন্ট তৈরি করুন। এরপর আপনার <strong>সরকার অনুমোদিত হজ্ব ও ওমরাহ লাইসেন্স</strong> ও ট্রেড লাইসেন্স আপলোড করুন (হাব মেম্বারশিপ নম্বর সম্পূর্ণ ঐচ্ছিক)।
                </p>
                <div style="margin-top: auto; padding-top: 0.75rem; border-top: 1px dashed var(--border-color); font-size: 0.82rem; color: #047857; font-weight: 700;">
                    <i class="fa-solid fa-shield-check me-1"></i> সুপার এডমিন কর্তৃক দ্রুত অনুমোদন
                </div>
            </div>

            <!-- Step 2 -->
            <div class="step-card">
                <div class="step-number" style="background: #E0F2FE; color: #0284C7; border: 1.5px solid #BAE6FD;">
                    ২
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 0.75rem;">
                    মার্কেটপ্লেস ব্রাউজ বা পোস্ট প্রকাশ
                </h3>
                <p style="color: #64748B; font-size: 0.92rem; line-height: 1.6; margin: 0 0 1rem 0;">
                    আপনার অতিরিক্ত ব্লকড সিট বা হোটেল রুম থাকলে <strong>'পোস্ট তৈরি'</strong> করুন (এয়ারলাইন্স, ফ্লাইটের তারিখ, রেট ও সিট সংখ্যা)। অথবা আপনার সিট ঘাটতি থাকলে ফিল্টার করে উপযুক্ত পোস্ট খুঁজে নিন।
                </p>
                <div style="margin-top: auto; padding-top: 0.75rem; border-top: 1px dashed var(--border-color); font-size: 0.82rem; color: #0284C7; font-weight: 700;">
                    <i class="fa-solid fa-layer-group me-1"></i> গ্রুপ সিট, টিকিট ও হোটেল শেয়ারিং
                </div>
            </div>

            <!-- Step 3 -->
            <div class="step-card">
                <div class="step-number" style="background: #FEF3C7; color: #D97706; border: 1.5px solid #FDE68A;">
                    ৩
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 0.75rem;">
                    লাইভ চ্যাট ও রিয়েল-টাইম নেগোসিয়েশন
                </h3>
                <p style="color: #64748B; font-size: 0.92rem; line-height: 1.6; margin: 0 0 1rem 0;">
                    পোস্ট দেখে পছন্দের এজেন্সিকে সরাসরি অফার বা কোটেশন পাঠান। বিল্ট-ইন লাইভ চ্যাট, সরাসরি ফোন কল বা হোয়াটসঅ্যাপের মাধ্যমে জনপ্রতি রেট এবং অগ্রিম টোকেন মানি দ্রুত চূড়ান্ত করুন।
                </p>
                <div style="margin-top: auto; padding-top: 0.75rem; border-top: 1px dashed var(--border-color); font-size: 0.82rem; color: #D97706; font-weight: 700;">
                    <i class="fa-solid fa-comments me-1"></i> মেসেজ আসলে লাইভ নোটিফিকেশন সাউন্ড
                </div>
            </div>

            <!-- Step 4 -->
            <div class="step-card">
                <div class="step-number" style="background: #EEF2FF; color: #4F46E5; border: 1.5px solid #C7D2FE;">
                    ৪
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 0.75rem;">
                    দ্বিপাক্ষিক ডিল ও চুক্তিপত্র ডাউনলোড
                </h3>
                <p style="color: #64748B; font-size: 0.92rem; line-height: 1.6; margin: 0 0 1rem 0;">
                    উভয় এজেন্সি টোকেন মানি লেনদেন নিশ্চিত করলেই ডিল সম্পূর্ণ (Done)। সিস্টেম থেকে স্বয়ংক্রিয়ভাবে <strong>সরকারি নীতিমালা সম্মত বিটুবি চুক্তিপত্র (B2B Contract Deed)</strong> জেনারেট ও ডাউনলোড করা যায়।
                </p>
                <div style="margin-top: auto; padding-top: 0.75rem; border-top: 1px dashed var(--border-color); font-size: 0.82rem; color: #4F46E5; font-weight: 700;">
                    <i class="fa-solid fa-file-contract me-1"></i> প্রিন্টযোগ্য অফিসিয়াল লিগ্যাল চুক্তিপত্র
                </div>
            </div>
        </div>
    </div>

    <!-- Dual Role Breakdown (Buyer vs Seller) -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem; margin-bottom: 5rem;">
        
        <!-- Role 1: Agencies Needing Seats (Buyer) -->
        <div style="background: white; border-radius: 18px; padding: 2.25rem 2rem; border: 1.5px solid #BAE6FD; box-shadow: var(--shadow-sm);">
            <div class="role-badge" style="background: #E0F2FE; color: #0284C7;">
                <i class="fa-solid fa-magnifying-glass"></i> বায়ার এজেন্সির জন্য (যাদের সিট প্রয়োজন)
            </div>
            <h3 style="font-size: 1.35rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 1rem;">
                সিট শর্টেজ হলে যা করবেন:
            </h3>
            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 1rem; font-size: 0.95rem; color: #475569; line-height: 1.6;">
                <li style="display: flex; gap: 0.75rem;">
                    <i class="fa-solid fa-check-circle text-sky-600" style="margin-top: 4px;"></i>
                    <span><strong>সহজ ফিল্টারিং:</strong> নির্দিষ্ট তারিখ, পছন্দের এয়ারলাইন্স (যেমন সাউদিয়া, বিমান বাংলাদেশ, ফ্লাইনাস) এবং রুট অনুযায়ী সিট খুঁজুন।</span>
                </li>
                <li style="display: flex; gap: 0.75rem;">
                    <i class="fa-solid fa-check-circle text-sky-600" style="margin-top: 4px;"></i>
                    <span><strong>কোটেশন রিকোয়েস্ট:</strong> প্রয়োজনীয় সিট সংখ্যা উল্লেখ করে সেলার এজেন্সিকে প্রপোজাল দিন।</span>
                </li>
                <li style="display: flex; gap: 0.75rem;">
                    <i class="fa-solid fa-check-circle text-sky-600" style="margin-top: 4px;"></i>
                    <span><strong>সরাসরি যোগাযোগ:</strong> ভেরিফাইড সেলারের মোবাইল নম্বরে কল করুন বা এক ক্লিকে হোয়াটসঅ্যাপে বার্তা পাঠান।</span>
                </li>
                <li style="display: flex; gap: 0.75rem;">
                    <i class="fa-solid fa-check-circle text-sky-600" style="margin-top: 4px;"></i>
                    <span><strong>নিরাপদ বুকিং:</strong> টোকেন মানি পরিশোধ করে ড্যাশবোর্ড থেকে অফিসিয়াল চুক্তিপত্র নামিয়ে নিন।</span>
                </li>
            </ul>
        </div>

        <!-- Role 2: Agencies with Extra Seats (Seller) -->
        <div style="background: white; border-radius: 18px; padding: 2.25rem 2rem; border: 1.5px solid #A7F3D0; box-shadow: var(--shadow-sm);">
            <div class="role-badge" style="background: #ECFDF5; color: #047857;">
                <i class="fa-solid fa-layer-group"></i> সেলার এজেন্সির জন্য (যাদের অতিরিক্ত সিট আছে)
            </div>
            <h3 style="font-size: 1.35rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 1rem;">
                অতিরিক্ত সিট থাকলে যা করবেন:
            </h3>
            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 1rem; font-size: 0.95rem; color: #475569; line-height: 1.6;">
                <li style="display: flex; gap: 0.75rem;">
                    <i class="fa-solid fa-check-circle text-emerald-600" style="margin-top: 4px;"></i>
                    <span><strong>তাৎক্ষণিক পোস্ট:</strong> মাত্র ২ মিনিটে আপনার অবিক্রিত গ্রুপ টিকিট বা হোটেল বরাদ্দের রিকোয়ারমেন্ট প্রকাশ করুন।</span>
                </li>
                <li style="display: flex; gap: 0.75rem;">
                    <i class="fa-solid fa-check-circle text-emerald-600" style="margin-top: 4px;"></i>
                    <span><strong>ইনবক্সে অফার লাভ:</strong> অন্যান্য আগ্রহী লাইসেন্সধারী এজেন্সিদের থেকে সরাসরি কোটেশন ও মেসেজ গ্রহণ করুন।</span>
                </li>
                <li style="display: flex; gap: 0.75rem;">
                    <i class="fa-solid fa-check-circle text-emerald-600" style="margin-top: 4px;"></i>
                    <span><strong>সিট বিয়োগ / বিক্রি এডজাস্টমেন্ট:</strong> অফলাইনে বা প্ল্যাটফর্মের বাইরে সিট বিক্রি হলে এক ক্লিকেই অবশিষ্ট সিট সংখ্যা আপডেট করতে পারবেন।</span>
                </li>
                <li style="display: flex; gap: 0.75rem;">
                    <i class="fa-solid fa-check-circle text-emerald-600" style="margin-top: 4px;"></i>
                    <span><strong>জিরো সিট লোকসান:</strong> অতিরিক্ত সিটের দ্রুত গ্রাহক পেয়ে মূলধন ও মুনাফা শতভাগ নিরাপদ রাখুন।</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Real-Time Alerts & Notification Highlight -->
    <div style="background: linear-gradient(135deg, #070D18, #0B1D15); border-radius: 20px; padding: 2.5rem; color: white; border: 1.5px solid var(--accent); margin-bottom: 5rem;">
        <div style="display: flex; align-items: center; gap: 1.5rem; flex-wrap: wrap;">
            <div style="width: 60px; height: 60px; border-radius: 16px; background: rgba(212,175,55,0.2); color: var(--accent); display: flex; align-items: center; justify-content: center; font-size: 1.8rem; flex-shrink: 0;">
                <i class="fa-solid fa-bell"></i>
            </div>
            <div style="flex: 1; min-width: 280px;">
                <h3 style="font-size: 1.35rem; font-weight: 800; color: white; margin: 0 0 0.35rem 0;">
                    রিয়েল-টাইম লাইভ নোটিফিকেশন ও মেসেজ চিম সাউন্ড
                </h3>
                <p style="color: #CBD5E1; font-size: 0.95rem; line-height: 1.6; margin: 0;">
                    ড্যাশবোর্ডে বারবার পেজ রিফ্রেশ করার কোনো প্রয়োজন নেই। কোনো এজেন্সি আপনাকে নতুন মেসেজ পাঠালে বা কোটেশন রেসপন্স দিলে এবং এডমিন আপনার লাইসেন্স অনুমোদন করলে সাথে সাথে মিষ্টি নোটিফিকেশন সাউন্ড ও পপআপ এলার্টের মাধ্যমে আপনাকে জানিয়ে দেওয়া হবে।
                </p>
            </div>
        </div>
    </div>

    <!-- Security & Trust Banner -->
    <div style="background: #F8FAFC; border: 1.5px solid var(--border-color); border-radius: 18px; padding: 2rem 2.25rem; margin-bottom: 5rem;">
        <div style="display: flex; align-items: flex-start; gap: 1.25rem; flex-wrap: wrap;">
            <div style="width: 50px; height: 50px; border-radius: 12px; background: #044E35; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0;">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div style="flex: 1; min-width: 280px;">
                <h4 style="font-size: 1.2rem; font-weight: 800; color: var(--primary-dark); margin: 0 0 0.5rem 0;">
                    নিরাপত্তা নিশ্চয়তা: সরকার অনুমোদিত হজ্ব ও ওমরাহ লাইসেন্স ভেরিফিকেশন
                </h4>
                <p style="color: #475569; font-size: 0.92rem; line-height: 1.65; margin: 0 0 0.85rem 0;">
                    আমাদের প্ল্যাটফর্মে নিরাপত্তা ও বিশ্বাসকে সর্বোচ্চ গুরুত্ব দেওয়া হয়। কোনো দালাল, মধ্যস্বত্বভোগী বা অপেশাদার ব্যক্তি এখানে প্রবেশ করতে পারে না। শুধুমাত্র <strong>বাংলাদেশ সরকারের ধর্ম বিষয়ক মন্ত্রণালয় অনুমোদিত বৈধ হজ্ব ও ওমরাহ লাইসেন্সধারী</strong> ট্রাভেল এজেন্সিগুলো সুপার এডমিন কর্তৃক অনুমোদিত হয়ে ডিল পরিচালনা করতে পারে। হাব (HAAB) মেম্বারশিপ নম্বর ঐচ্ছিক (Optional) রাখা হয়েছে যাতে সকল বৈধ সরকারি লাইসেন্সধারী এজেন্সি সহজেই উপকৃত হতে পারে।
                </p>
            </div>
        </div>
    </div>

    <!-- Bottom CTA -->
    <div style="background: linear-gradient(135deg, #044E35, #023624); border-radius: 20px; padding: 3rem 2rem; color: white; text-align: center; margin-bottom: 4rem; box-shadow: 0 15px 35px rgba(4, 78, 53, 0.25);">
        <h2 style="font-size: 2.1rem; font-weight: 800; color: white; margin-bottom: 0.75rem; font-family: var(--font-heading);">
            সহজেই শুরু করুন আপনার এজেন্সির B2B লেনদেন
        </h2>
        <p style="color: #E2E8F0; font-size: 1.05rem; max-width: 650px; margin: 0 auto 1.75rem; line-height: 1.6;">
            ১০০% ফ্রি মোডে সম্পূর্ণ বিনামূল্যে আপনার এজেন্সি রেজিস্টার করে আজই সিট শেয়ারিং শুরু করুন।
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; align-items: center; flex-wrap: wrap;">
            <a href="{{ route('register') }}" class="btn-gold" style="padding: 0.75rem 1.75rem; font-size: 1rem; font-weight: 800;">
                <i class="fa-solid fa-user-plus me-1"></i> ফ্রি অ্যাকাউন্ট তৈরি করুন
            </a>
            <a href="{{ route('posts.index') }}" class="btn-primary" style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); padding: 0.75rem 1.75rem; font-size: 1rem;">
                <i class="fa-solid fa-store me-1"></i> মার্কেটপ্লেস দেখুন
            </a>
        </div>
    </div>

</div>
@endsection
