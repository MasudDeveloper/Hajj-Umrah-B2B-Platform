@extends('layouts.app')

@section('title', 'Subscription Payment - Manual Verification')

@section('content')
<div class="responsive-card-padding" style="max-width: 700px; margin: 0 auto; background: white; border-radius: 16px; padding: 2.5rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-md);">
    <div style="text-align: center; margin-bottom: 2rem;">
        <h1 class="font-heading" style="font-size: 1.8rem; color: var(--primary-dark);">
            <i class="fa-solid fa-crown text-amber-500"></i> Premium Subscription
        </h1>
        <p style="color: var(--text-muted); font-size: 0.95rem; margin-top: 0.5rem;">
            Choose a plan and pay via our secure manual payment system.
        </p>
    </div>

    @if ($errors->any())
        <div class="alert-error" style="background: #FEE2E2; border: 1px solid #F87171; color: #991B1B; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
            <ul style="margin: 0; padding-left: 1.5rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('payment.submit') }}" method="POST">
        @csrf

        <!-- Plan Selection -->
        <h4 style="font-size: 1.1rem; color: var(--primary-dark); margin-bottom: 1rem; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem;">1. Select Subscription Plan</h4>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 2rem;">
            <label style="border: 2px solid #4F46E5; background: #EEF2FF; padding: 1.25rem; border-radius: 12px; cursor: pointer; display: block; text-align: center; position: relative;">
                <input type="radio" name="plan_name" value="monthly" checked style="position: absolute; top: 1rem; left: 1rem; width: 1.2rem; height: 1.2rem; accent-color: #4F46E5;">
                <h5 style="margin: 0; font-size: 1.2rem; color: #3730A3;">Monthly Plan</h5>
                <strong style="display: block; font-size: 1.5rem; color: #4F46E5; margin-top: 0.5rem;">500 BDT</strong>
            </label>
            <label style="border: 2px solid var(--border-color); padding: 1.25rem; border-radius: 12px; cursor: pointer; display: block; text-align: center; position: relative;" onclick="document.querySelectorAll('input[name=plan_name]').forEach(e=>e.parentElement.style.borderColor='var(--border-color)'); document.querySelectorAll('input[name=plan_name]').forEach(e=>e.parentElement.style.background='white'); this.style.borderColor='#4F46E5'; this.style.background='#EEF2FF';">
                <input type="radio" name="plan_name" value="yearly" style="position: absolute; top: 1rem; left: 1rem; width: 1.2rem; height: 1.2rem; accent-color: #4F46E5;">
                <h5 style="margin: 0; font-size: 1.2rem; color: var(--text-dark);">Yearly Plan</h5>
                <strong style="display: block; font-size: 1.5rem; color: var(--primary-dark); margin-top: 0.5rem;">5,000 BDT <span style="font-size:0.8rem; background:#10B981; color:white; padding:2px 6px; border-radius:4px; vertical-align:middle;">Save 1,000!</span></strong>
            </label>
        </div>

        <!-- Payment Method Selection -->
        <h4 style="font-size: 1.1rem; color: var(--primary-dark); margin-bottom: 1rem; border-bottom: 1px solid var(--border-color); padding-bottom: 0.5rem;">2. Select Payment Method</h4>
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
            <label class="pay-method-label active-method" data-method="bkash" style="border: 2px solid #E2136E; background: #FFF0F5; padding: 1rem; border-radius: 12px; cursor: pointer; text-align: center; transition: 0.2s;">
                <input type="radio" name="payment_method" value="bkash" checked style="display: none;">
                <div style="display: flex; align-items: center; justify-content: center; height: 35px;">
                    <img src="{{ asset('images/gateways/bkash.png') }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                </div>
            </label>
            <label class="pay-method-label" data-method="nagad" style="border: 2px solid var(--border-color); padding: 1rem; border-radius: 12px; cursor: pointer; text-align: center; transition: 0.2s;">
                <input type="radio" name="payment_method" value="nagad" style="display: none;">
                <div style="display: flex; align-items: center; justify-content: center; height: 35px;">
                    <img src="{{ asset('images/gateways/nagad.png') }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                </div>
            </label>
            <label class="pay-method-label" data-method="rocket" style="border: 2px solid var(--border-color); padding: 1rem; border-radius: 12px; cursor: pointer; text-align: center; transition: 0.2s;">
                <input type="radio" name="payment_method" value="rocket" style="display: none;">
                <div style="display: flex; align-items: center; justify-content: center; height: 35px;">
                    <img src="{{ asset('images/gateways/rocket.png') }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                </div>
            </label>
            <label class="pay-method-label" data-method="upay" style="border: 2px solid var(--border-color); padding: 1rem; border-radius: 12px; cursor: pointer; text-align: center; transition: 0.2s;">
                <input type="radio" name="payment_method" value="upay" style="display: none;">
                <div style="display: flex; align-items: center; justify-content: center; height: 35px;">
                    <img src="{{ asset('images/gateways/upay.png') }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                </div>
            </label>
        </div>

        <!-- Payment Instructions & Inputs -->
        <div id="payment-instructions" style="border: 2px solid #E2136E; border-radius: 12px; overflow: hidden; margin-bottom: 2rem; transition: border-color 0.3s ease;">
            <!-- Dynamic Gateway Header -->
            <div id="gateway-header" style="background: #E2136E; color: white; padding: 1.2rem; text-align: center; transition: background 0.3s ease;">
                <img id="gateway-header-img" src="{{ asset('images/gateways/bkash.png') }}" style="height: 40px; object-fit: contain; filter: brightness(0) invert(1); transition: 0.3s;">
                <p style="margin: 0.5rem 0 0; font-size: 0.85rem; opacity: 0.9; letter-spacing: 1px;">SECURE MANUAL PAYMENT GATEWAY</p>
            </div>
            
            <div style="background: #F8FAFC; padding: 2rem;">
                <div style="text-align: center; margin-bottom: 2rem;">
                    <p style="margin-bottom: 0.75rem; font-size: 0.95rem; color: #475569;">অনুগ্রহ করে নিচের <strong><span id="gateway-name">bKash</span> Personal</strong> নাম্বারে সেন্ড মানি করুন।</p>
                    <div id="gateway-number" style="font-size: 1.8rem; font-weight: bold; color: #E2136E; letter-spacing: 2px; text-align: center; background: white; padding: 1rem 2rem; border-radius: 8px; border: 2px dashed #E2136E; display: inline-block; transition: 0.3s;">
                        017XXXXXXXX (bKash)
                    </div>
                </div>

                <!-- Payment Step-by-Step Instructions -->
                <div id="payment-steps" style="font-size: 0.9rem; color: #334155; margin-bottom: 2rem; background: #FFF; padding: 1.25rem; border-radius: 8px; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
                    <strong style="display: block; margin-bottom: 0.75rem; color: #0F172A;"><i class="fa-solid fa-circle-info text-amber-500 me-1"></i> কীভাবে পেমেন্ট করবেন? (How to pay)</strong>
                    <ol style="margin: 0; padding-left: 1.5rem; line-height: 1.7;" id="instruction-list">
                        <li>আপনার <strong>bKash অ্যাপ</strong> অথবা USSD (<strong>*247#</strong>) ডায়াল করুন।</li>
                        <li>"<strong>Send Money</strong>" অপশনটি সিলেক্ট করুন।</li>
                        <li>উপরের নাম্বারটি (017XXXXXXXX) দিন।</li>
                        <li>সাবস্ক্রিপশনের অ্যামাউন্ট দিন এবং Reference হিসেবে আপনার এজেন্সির নাম দিন।</li>
                        <li>পেমেন্ট সফল হলে প্রাপ্ত <strong>ট্রানজাকশন আইডি (TrxID)</strong> নিচের ফর্মে পূরণ করুন।</li>
                    </ol>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.5rem; color: #334155;">আপনার সেন্ডার নাম্বার (Sender Number) *</label>
                        <input type="text" name="sender_number" required placeholder="01XXXXXXXXX" style="width: 100%; padding: 0.9rem; border: 1px solid var(--border-color); border-radius: 8px; outline: none; transition: 0.2s;" onfocus="this.style.borderColor=currentThemeColor; this.style.boxShadow=`0 0 0 3px ${currentThemeColor}33`" onblur="this.style.borderColor='var(--border-color)'; this.style.boxShadow='none'">
                    </div>
                    <div>
                        <label style="display: block; font-weight: 600; font-size: 0.85rem; margin-bottom: 0.5rem; color: #334155;">ট্রানজাকশন আইডি (Transaction ID) *</label>
                        <input type="text" name="transaction_id" required placeholder="e.g. 9F5GH7YUI2" style="width: 100%; padding: 0.9rem; border: 1px solid var(--border-color); border-radius: 8px; text-transform: uppercase; outline: none; transition: 0.2s;" onfocus="this.style.borderColor=currentThemeColor; this.style.boxShadow=`0 0 0 3px ${currentThemeColor}33`" onblur="this.style.borderColor='var(--border-color)'; this.style.boxShadow='none'">
                    </div>
                </div>
            </div>
        </div>

        <button id="submit-btn" type="submit" class="btn-primary" style="width: 100%; justify-content: center; font-size: 1.2rem; padding: 1rem; background: #E2136E; border: none; border-radius: 8px; color: white; cursor: pointer; transition: 0.3s; font-weight: 700;">
            <i class="fa-solid fa-lock me-2"></i> <span id="submit-btn-text">Verify bKash Payment</span>
        </button>
    </form>
</div>

<script>
    const themes = {
        'bkash': { color: '#E2136E', name: 'bKash', number: '017XXXXXXXX (bKash)', ussd: '*247#', logo: '{{ asset("images/gateways/bkash.png") }}', invertLogo: true },
        'nagad': { color: '#ED1C24', name: 'Nagad', number: '016XXXXXXXX (Nagad)', ussd: '*167#', logo: '{{ asset("images/gateways/nagad.png") }}', invertLogo: true },
        'rocket': { color: '#8C1515', name: 'Rocket', number: '019XXXXXXXX (Rocket)', ussd: '*322#', logo: '{{ asset("images/gateways/rocket.png") }}', invertLogo: true },
        'upay': { color: '#F6921E', name: 'Upay', number: '014XXXXXXXX (Upay)', ussd: '*268#', logo: '{{ asset("images/gateways/upay.png") }}', invertLogo: false }
    };
    let currentThemeColor = '#E2136E';

    document.querySelectorAll('.pay-method-label').forEach(label => {
        label.addEventListener('click', function() {
            // Reset all method labels
            document.querySelectorAll('.pay-method-label').forEach(l => {
                l.style.borderColor = 'var(--border-color)';
                l.style.background = 'white';
            });
            
            const method = this.getAttribute('data-method');
            const theme = themes[method];
            currentThemeColor = theme.color;
            
            // Set active label
            this.style.borderColor = theme.color;
            this.style.background = theme.color + '11'; // light background
            this.querySelector('input').checked = true;
            
            // Update Gateway UI
            const instructionBox = document.getElementById('payment-instructions');
            const header = document.getElementById('gateway-header');
            const headerImg = document.getElementById('gateway-header-img');
            const gatewayName = document.getElementById('gateway-name');
            const gatewayNumber = document.getElementById('gateway-number');
            const submitBtn = document.getElementById('submit-btn');
            const submitBtnText = document.getElementById('submit-btn-text');
            const instructionList = document.getElementById('instruction-list');
            
            instructionBox.style.borderColor = theme.color;
            header.style.background = theme.color;
            
            headerImg.src = theme.logo;
            headerImg.style.filter = theme.invertLogo ? 'brightness(0) invert(1)' : 'none';
            
            gatewayName.textContent = theme.name;
            gatewayNumber.textContent = theme.number;
            gatewayNumber.style.color = theme.color;
            gatewayNumber.style.borderColor = theme.color;
            
            submitBtn.style.background = theme.color;
            submitBtnText.textContent = `Verify ${theme.name} Payment`;

            // Update Instructions Dynamic Text
            instructionList.innerHTML = `
                <li>আপনার <strong>${theme.name} অ্যাপ</strong> অথবা USSD (<strong>${theme.ussd}</strong>) ডায়াল করুন।</li>
                <li>"<strong>Send Money</strong>" অপশনটি সিলেক্ট করুন।</li>
                <li>উপরের নাম্বারটি (${theme.number.split(' ')[0]}) দিন।</li>
                <li>সাবস্ক্রিপশনের অ্যামাউন্ট দিন এবং Reference হিসেবে আপনার এজেন্সির নাম দিন।</li>
                <li>পেমেন্ট সফল হলে প্রাপ্ত <strong>ট্রানজাকশন আইডি (TrxID)</strong> নিচের ফর্মে পূরণ করুন।</li>
            `;
        });
    });
</script>
@endsection
