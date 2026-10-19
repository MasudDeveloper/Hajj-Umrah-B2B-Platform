@extends('layouts.app')

@section('title', 'আমাদের সম্পর্কে - সরকার অনুমোদিত হজ্ব ও ওমরাহ বিটুবি প্ল্যাটফর্ম')

@section('content')
<style>
    .about-hero {
        background: linear-gradient(135deg, rgba(7, 13, 24, 0.94) 0%, rgba(4, 78, 53, 0.92) 100%), url('{{ asset("images/makkah_kaaba_hero.jpg") }}') center/cover no-repeat;
        position: relative;
        padding: 5rem 2rem;
        border-radius: 20px;
        color: white;
        text-align: center;
        margin-bottom: 3.5rem;
        box-shadow: 0 15px 35px rgba(4, 78, 53, 0.2);
        border: 1px solid rgba(212, 175, 55, 0.3);
    }
    .about-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(212, 175, 55, 0.2);
        border: 1px solid rgba(212, 175, 55, 0.6);
        color: #F3E5AB;
        padding: 0.45rem 1.25rem;
        border-radius: 30px;
        font-weight: 700;
        font-size: 0.88rem;
        margin-bottom: 1.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .feature-box {
        background: white;
        border-radius: 16px;
        padding: 2.25rem 1.75rem;
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-sm);
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .feature-box:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        border-color: var(--accent);
    }
    .feature-icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        margin-bottom: 1.25rem;
    }
    .stat-pill {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        text-align: center;
    }
</style>

<!-- Hero Section -->
<div class="about-hero">
    <div class="about-badge">
        <i class="fa-solid fa-kaaba text-amber-300"></i> সরকার অনুমোদিত হজ্ব ও ওমরাহ বিটুবি নেটওয়ার্ক
    </div>
    <h1 style="font-size: 2.6rem; font-weight: 800; margin-bottom: 1.25rem; font-family: var(--font-heading); color: white; line-height: 1.25;">
        বাংলাদেশি হজ্ব ও ওমরাহ এজেন্সিদের জন্য নির্ভরযোগ্য B2B প্ল্যাটফর্ম
    </h1>
    <p style="font-size: 1.15rem; color: #E2E8F0; max-width: 820px; margin: 0 auto; line-height: 1.7;">
        গ্রুপ সিট সংকট নিরসন, এয়ারলাইন্স টিকিট এক্সচেঞ্জ এবং মক্কা-মদিনা আবাসন শেয়ারিংয়ের মাধ্যমে লাইসেন্সপ্রাপ্ত ট্রাভেল এজেন্সিদের পারস্পরিক ব্যবসায়িক সমৃদ্ধি নিশ্চিত করাই আমাদের মূল লক্ষ্য।
    </p>
</div>

<div class="container" style="max-width: 1140px; margin: 0 auto; padding: 0 1rem;">

    <!-- Story & Mission Section -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 3rem; align-items: center; margin-bottom: 5rem;">
        <div>
            <span style="color: #047857; font-weight: 800; font-size: 0.88rem; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 0.5rem;">
                <i class="fa-solid fa-compass me-1"></i> আমাদের উদ্দেশ্য ও লক্ষ্য
            </span>
            <h2 style="font-size: 2.1rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 1.25rem; line-height: 1.3;">
                কেন প্রতিষ্ঠিত হলো এই হজ্ব-ওমরাহ বিটুবি প্ল্যাটফর্ম?
            </h2>
            <p style="color: #475569; font-size: 1.02rem; line-height: 1.75; margin-bottom: 1.25rem;">
                বাংলাদেশের হজ্ব ও ওমরাহ ট্রাভেল সেক্টর অত্যন্ত সুবিশাল হলেও দীর্ঘদিন ধরে এজেন্সিরা ব্যক্তিগত ফোন কল, বিচ্ছিন্ন ফেসবুক গ্রুপ এবং মধ্যস্বত্বভোগী বা দালালদের ওপর নির্ভরশীল ছিল। অনেক সময় একটি এজেন্সির অতিরিক্ত গ্রুপ টিকিট অবিক্রিত থেকে আর্থিক লোকসান হতো, আবার অন্য একটি এজেন্সি শেষ মুহূর্তে যাত্রীদের জন্য সিট খুঁজে না পেয়ে বিব্রতকর পরিস্থিতিতে পড়ত।
            </p>
            <p style="color: #475569; font-size: 1.02rem; line-height: 1.75; margin-bottom: 1.5rem;">
                এই সমস্যার একটি স্থায়ী ও আধুনিক ডিজিটাল সমাধান দিতেই <strong>B2B Hajj Umrah Platform</strong>-এর যাত্রা। এখানে শুধুমাত্র <strong>বাংলাদেশ সরকারের ধর্ম বিষয়ক মন্ত্রণালয় অনুমোদিত বৈধ হজ্ব ও ওমরাহ লাইসেন্সধারী</strong> ট্রাভেল এজেন্সিগুলো সরাসরি নিজেদের মধ্যে গ্রুপ সিট বিনিময়, বিমান টিকিট ও হোটেল শেয়ারিং পরিচালনা করতে পারে।
            </p>
            
            <div style="background: #ECFDF5; border: 1.5px solid #A7F3D0; border-radius: 12px; padding: 1.25rem; display: flex; align-items: center; gap: 1rem;">
                <div style="width: 48px; height: 48px; border-radius: 50%; background: #047857; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; flex-shrink: 0;">
                    <i class="fa-solid fa-certificate"></i>
                </div>
                <div>
                    <h4 style="margin: 0; font-size: 0.98rem; font-weight: 800; color: #065F46;">সরকারি লাইসেন্স প্রাধান্য (Government Approved License)</h4>
                    <p style="margin: 0.2rem 0 0; font-size: 0.85rem; color: #047857; line-height: 1.4;">
                        সরকার অনুমোদিত হজ্ব ও ওমরাহ লাইসেন্স এবং ভেরিফাইড ট্রেড লাইসেন্স বাধ্যতামূলক। হাব (HAAB) নম্বরটি সম্পূর্ণ ঐচ্ছিক (Optional)।
                    </p>
                </div>
            </div>
        </div>

        <!-- Highlight Card -->
        <div style="background: linear-gradient(135deg, #070D18, #0B1D15); border-radius: 20px; padding: 2.5rem 2rem; border: 1.5px solid var(--accent); color: white; box-shadow: 0 15px 35px rgba(0,0,0,0.2);">
            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem;">
                <div style="width: 44px; height: 44px; background: rgba(212,175,55,0.2); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--accent); font-size: 1.3rem;">
                    <i class="fa-solid fa-shield-check"></i>
                </div>
                <div>
                    <h3 style="font-size: 1.3rem; font-weight: 800; margin: 0; color: white;">প্ল্যাটফর্মের মূল সুবিধা</h3>
                    <span style="font-size: 0.8rem; color: #94A3B8;">নিরাপদ এজেন্সি-টু-এজেন্সি নেটওয়ার্ক</span>
                </div>
            </div>

            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 1.1rem; font-size: 0.95rem; line-height: 1.5;">
                <li style="display: flex; align-items: flex-start; gap: 0.75rem;">
                    <i class="fa-solid fa-circle-check text-emerald-400" style="margin-top: 3px;"></i>
                    <span><strong>১০০% যাচাইকৃত এজেন্সি:</strong> কোনো দালাল বা সাধারণ কাস্টমার ডিল বা ফোন নম্বর দেখতে পারে না।</span>
                </li>
                <li style="display: flex; align-items: flex-start; gap: 0.75rem;">
                    <i class="fa-solid fa-circle-check text-emerald-400" style="margin-top: 3px;"></i>
                    <span><strong>সিট অপচয় রোধ:</strong> ব্লকড অবিক্রিত গ্রুপ টিকিট দ্রুত সহকর্মী এজেন্সির কাছে হস্তান্তর।</span>
                </li>
                <li style="display: flex; align-items: flex-start; gap: 0.75rem;">
                    <i class="fa-solid fa-circle-check text-emerald-400" style="margin-top: 3px;"></i>
                    <span><strong>স্বয়ংক্রিয় বিটুবি চুক্তিপত্র:</strong> উভয় পক্ষের সম্মতিতে সরকারি নিয়মানুযায়ী আইনি চুক্তিপত্র (Contract Deed) তৈরি।</span>
                </li>
                <li style="display: flex; align-items: flex-start; gap: 0.75rem;">
                    <i class="fa-solid fa-circle-check text-emerald-400" style="margin-top: 3px;"></i>
                    <span><strong>লাইভ চ্যাট ও রিয়েল-টাইম নেগোসিয়েশন:</strong> কোনো বিলম্ব ছাড়াই সরাসরি রেট ও টোকেন মানি আলোচনা।</span>
                </li>
                <li style="display: flex; align-items: flex-start; gap: 0.75rem;">
                    <i class="fa-solid fa-circle-check text-emerald-400" style="margin-top: 3px;"></i>
                    <span><strong>হোটেল ও রুম শেয়ারিং:</strong> মক্কা ও মদিনার হোটেল রুমের ফাঁকা বেড বা রুম অন্য এজেন্সির সাথে শেয়ারিং।</span>
                </li>
            </ul>

            <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.15); display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <span style="font-size: 0.75rem; color: #94A3B8; display: block;">প্ল্যাটফর্ম স্ট্যাটাস</span>
                    <strong style="color: #34D399; font-size: 0.95rem;">১০০% ফ্রি মোড সক্রিয়</strong>
                </div>
                <a href="{{ route('register') }}" class="btn-gold" style="font-size: 0.85rem; padding: 0.5rem 1rem;">
                    রেজিস্ট্রেশন করুন
                </a>
            </div>
        </div>
    </div>

    <!-- Core Values Section -->
    <div style="margin-bottom: 5rem;">
        <div style="text-align: center; max-width: 700px; margin: 0 auto 3rem;">
            <span style="color: #047857; font-weight: 800; font-size: 0.88rem; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 0.5rem;">
                <i class="fa-solid fa-gem me-1"></i> আমাদের নীতি ও আদর্শ
            </span>
            <h2 style="font-size: 2.1rem; font-weight: 800; color: var(--primary-dark); margin: 0 0 0.5rem 0;">
                যে মূল মূল্যবোধে আমরা পরিচালিত
            </h2>
            <p style="color: #64748B; font-size: 0.98rem; margin: 0;">
                একটি স্বচ্ছ, ভ্রাতৃত্বপূর্ণ ও বিশ্বস্ত ব্যবসায়িক পরিবেশ বজায় রাখতে আমরা প্রতিটি ধাপে দায়বদ্ধ।
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.75rem;">
            <!-- Value 1 -->
            <div class="feature-box">
                <div class="feature-icon-wrapper" style="background: #ECFDF5; color: #047857;">
                    <i class="fa-solid fa-handshake"></i>
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 0.75rem;">
                    বিশ্বাস ও সরকারি লাইসেন্স যাচাই
                </h3>
                <p style="color: #64748B; font-size: 0.92rem; line-height: 1.6; margin: 0;">
                    আমরা শতভাগ নিশ্চিত করি যে প্ল্যাটফর্মে যোগদানকারী প্রতিটি এজেন্সি সরকার অনুমোদিত হজ্ব ও ওমরাহ লাইসেন্সধারী। এর ফলে যেকোনো লেনদেন হয় শতভাগ নিরাপদ।
                </p>
            </div>

            <!-- Value 2 -->
            <div class="feature-box">
                <div class="feature-icon-wrapper" style="background: #E0F2FE; color: #0284C7;">
                    <i class="fa-solid fa-bolt"></i>
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 0.75rem;">
                    গতি ও ডিজিটাল দক্ষতা
                </h3>
                <p style="color: #64748B; font-size: 0.92rem; line-height: 1.6; margin: 0;">
                    ঘণ্টার পর ঘণ্টা ফোন করে সিট খোঁজার দিন শেষ। এখন মাত্র কয়েক ক্লিকে লাইভ অনুসন্ধান, কোটেশন পাঠানো এবং রিয়েল-টাইম নেগোসিয়েশন সম্ভব।
                </p>
            </div>

            <!-- Value 3 -->
            <div class="feature-box">
                <div class="feature-icon-wrapper" style="background: #FEF3C7; color: #D97706;">
                    <i class="fa-solid fa-scale-balanced"></i>
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 0.75rem;">
                    শরীয়াহ ও ব্যবসায়িক সততা
                </h3>
                <p style="color: #64748B; font-size: 0.92rem; line-height: 1.6; margin: 0;">
                    হজ্ব ও ওমরাহ একটি পবিত্র ইবাদত। তাই আমাদের প্ল্যাটফর্মে স্বচ্ছ মূল্যনীতি, মিথ্যা বা বিভ্রান্তিকর পোস্ট প্রতিরোধ এবং পারস্পরিক সম্মান অক্ষুণ্ণ রাখা হয়।
                </p>
            </div>

            <!-- Value 4 -->
            <div class="feature-box">
                <div class="feature-icon-wrapper" style="background: #EEF2FF; color: #4F46E5;">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--primary-dark); margin-bottom: 0.75rem;">
                    পারস্পরিক বৃদ্ধি ও সমৃদ্ধি
                </h3>
                <p style="color: #64748B; font-size: 0.92rem; line-height: 1.6; margin: 0;">
                    আমরা বিশ্বাস করি সহমর্মিতায়। একটি এজেন্সির অতিরিক্ত সিট অন্য এজেন্সির ক্লায়েন্টকে সেবা দিয়ে উভয় এজেন্সিরই লাভ নিশ্চিত করে।
                </p>
            </div>
        </div>
    </div>

    <!-- Verification Policy Disclaimer Box -->
    <div style="background: #F8FAFC; border: 1.5px solid var(--border-color); border-radius: 18px; padding: 2rem 2.25rem; margin-bottom: 5rem;">
        <div style="display: flex; align-items: flex-start; gap: 1.25rem; flex-wrap: wrap;">
            <div style="width: 50px; height: 50px; border-radius: 12px; background: #044E35; color: white; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0;">
                <i class="fa-solid fa-file-contract"></i>
            </div>
            <div style="flex: 1; min-width: 280px;">
                <h4 style="font-size: 1.2rem; font-weight: 800; color: var(--primary-dark); margin: 0 0 0.5rem 0;">
                    ভেরিফিকেশন নীতিমালা ও লিগ্যাল ফ্রেমওয়ার্ক
                </h4>
                <p style="color: #475569; font-size: 0.92rem; line-height: 1.65; margin: 0 0 0.85rem 0;">
                    ১. <strong>লাইসেন্স অগ্রাধিকার:</strong> প্ল্যাটফর্মে রেজিস্ট্রেশনের পর এজেন্সিকে অবশ্যই বাংলাদেশ সরকারের ধর্ম বিষয়ক মন্ত্রণালয় অনুমোদিত বৈধ হজ্ব ও ওমরাহ লাইসেন্স কপি এবং হালনাগাদ ট্রেড লাইসেন্স আপলোড করতে হবে।<br>
                    ২. <strong>হাব মেম্বারশিপ:</strong> হজ এজেন্সিস এসোসিয়েশন অব বাংলাদেশ (HAAB) মেম্বারশিপ নম্বর প্রদান ঐচ্ছিক (Optional)।<br>
                    ৩. <strong>স্বয়ংক্রিয় বিটুবি চুক্তি:</strong> প্রতিটি সফল ডিলের পর সিস্টেম থেকে উভয় এজেন্সির লাইসেন্স নম্বর, যাত্রীর সংখ্যা, ফ্লাইটের বিবরণ এবং টোকেন মানি সম্বলিত সরকারি স্ট্যান্ডার্ড চুক্তিপত্র (Contract Deed) প্রস্তুত হয় যা প্রিন্ট করে অফিসিয়াল সিল ও স্বাক্ষর দিয়ে সংরক্ষণ করা যায়।
                </p>
                <div style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
                    <a href="{{ route('pages.how-it-works') }}" class="btn-primary" style="padding: 0.5rem 1.15rem; font-size: 0.85rem;">
                        <i class="fa-solid fa-circle-info me-1"></i> বিস্তারিত কার্যপ্রণালী দেখুন
                    </a>
                    <a href="javascript:void(0)" onclick="openTermsModal()" style="font-size: 0.85rem; color: #047857; font-weight: 700; text-decoration: underline;">
                        প্ল্যাটফর্মের শর্তাবলী পড়ুন
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom CTA -->
    <div style="background: linear-gradient(135deg, #044E35, #023624); border-radius: 20px; padding: 3rem 2rem; color: white; text-align: center; margin-bottom: 4rem; box-shadow: 0 15px 35px rgba(4, 78, 53, 0.25);">
        <h2 style="font-size: 2.1rem; font-weight: 800; color: white; margin-bottom: 0.75rem; font-family: var(--font-heading);">
            আজই আপনার এজেন্সির ফ্রি এক্সেস নিশ্চিত করুন
        </h2>
        <p style="color: #E2E8F0; font-size: 1.05rem; max-width: 650px; margin: 0 auto 1.75rem; line-height: 1.6;">
            সরকার অনুমোদিত লাইসেন্স দিয়ে নিবন্ধন করে বাংলাদেশের শত শত বিশ্বস্ত হজ্ব ও ওমরাহ এজেন্সির সাথে সরাসরি সংযুক্ত হোন।
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; align-items: center; flex-wrap: wrap;">
            <a href="{{ route('register') }}" class="btn-gold" style="padding: 0.75rem 1.75rem; font-size: 1rem; font-weight: 800;">
                <i class="fa-solid fa-user-plus me-1"></i> ফ্রি এজেন্সি রেজিস্ট্রেশন
            </a>
            <a href="{{ route('posts.index') }}" class="btn-primary" style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); padding: 0.75rem 1.75rem; font-size: 1rem;">
                <i class="fa-solid fa-store me-1"></i> মার্কেটপ্লেস ব্রাউজ করুন
            </a>
        </div>
    </div>

</div>
@endsection
