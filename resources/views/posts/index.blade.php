@extends('layouts.app')

@section('title', 'B2B Multi-Category Marketplace - B2B Hajj Umrah')

@section('content')
    <div class="responsive-card-padding" style="background: white; padding: 2rem; border-radius: 16px; margin-bottom: 2rem; border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
        <div class="responsive-header-flex" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <h1 class="font-heading" style="font-size: 2rem; color: var(--primary-dark); margin-bottom: 0.25rem;">B2B Hajj Umrah Collaboration Portal</h1>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Browse group seat vacancies, ticket sales, and hotel sharing deals from verified agencies.</p>
            </div>

            @auth
                @if(Auth::user()->isApproved() || Auth::user()->isAdmin())
                    <a href="{{ route('posts.create') }}" class="btn-gold">
                        <i class="fa-solid fa-plus-circle"></i> Post New Deal Requirement
                    </a>
                @else
                    <div style="background: #FEF3C7; color: #92400E; font-size: 0.85rem; font-weight: 600; padding: 0.5rem 0.85rem; border-radius: 8px; border: 1px solid #FDE68A;">
                        <i class="fa-solid fa-clock"></i> Verification Pending - Posting Locked
                    </div>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn-gold">
                    <i class="fa-solid fa-lock"></i> Login to Post & Unlock Contacts
                </a>
            @endauth
        </div>

        <!-- Category Tabs -->
        <div class="responsive-category-tabs" style="display: flex; gap: 0.75rem; border-bottom: 2px solid var(--border-color); padding-bottom: 0.75rem; margin-bottom: 1.5rem; flex-wrap: wrap;">
            <a href="{{ route('posts.index') }}" class="btn-primary" style="{{ !request('post_category') ? 'background: var(--primary);' : 'background: #F1F5F9; color: var(--text-dark);' }} padding: 0.55rem 1rem; font-size: 0.88rem; white-space: nowrap;">
                <i class="fa-solid fa-border-all"></i> All B2B Posts
            </a>
            <a href="{{ route('posts.index', ['post_category' => 'group_seats']) }}" class="btn-primary" style="{{ request('post_category') == 'group_seats' ? 'background: var(--primary);' : 'background: #F1F5F9; color: var(--text-dark);' }} padding: 0.55rem 1rem; font-size: 0.88rem; white-space: nowrap;">
                <i class="fa-solid fa-users"></i> Category A: Group Seats
            </a>
            <a href="{{ route('posts.index', ['post_category' => 'ticket_only']) }}" class="btn-primary" style="{{ request('post_category') == 'ticket_only' ? 'background: var(--primary);' : 'background: #F1F5F9; color: var(--text-dark);' }} padding: 0.55rem 1rem; font-size: 0.88rem; white-space: nowrap;">
                <i class="fa-solid fa-ticket"></i> Category B: Ticket & Visa
            </a>
            <a href="{{ route('posts.index', ['post_category' => 'hotel_share']) }}" class="btn-primary" style="{{ request('post_category') == 'hotel_share' ? 'background: var(--primary);' : 'background: #F1F5F9; color: var(--text-dark);' }} padding: 0.55rem 1rem; font-size: 0.88rem; white-space: nowrap;">
                <i class="fa-solid fa-hotel"></i> Category C: Hotel Room Share
            </a>
        </div>

        <!-- Multi-Field Filter Bar -->
        <form action="{{ route('posts.index') }}" method="GET" class="filter-form-grid" style="background: #F8FAFC; padding: 1.25rem; border-radius: 12px; border: 1px solid var(--border-color);">
            <input type="hidden" name="post_category" value="{{ request('post_category') }}">

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 600; color: var(--text-muted); margin-bottom: 0.35rem;">Search Title/Hotel</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="e.g. Saudia / Clock Tower..." style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.88rem;">
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 600; color: var(--text-muted); margin-bottom: 0.35rem;">Requirement Type</label>
                <select name="requirement_type" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.88rem;">
                    <option value="">All Types</option>
                    <option value="have_extra_seats" {{ request('requirement_type') == 'have_extra_seats' ? 'selected' : '' }}>Seats Available (Extra)</option>
                    <option value="need_seats" {{ request('requirement_type') == 'need_seats' ? 'selected' : '' }}>Seats Required (Shortage)</option>
                    <option value="ticket_sale" {{ request('requirement_type') == 'ticket_sale' ? 'selected' : '' }}>Ticket Sale</option>
                    <option value="hotel_share" {{ request('requirement_type') == 'hotel_share' ? 'selected' : '' }}>Hotel Sharing</option>
                </select>
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 600; color: var(--text-muted); margin-bottom: 0.35rem;">Departure Hub</label>
                <select name="departure_city" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.88rem;">
                    <option value="">All Hubs</option>
                    <option value="Dhaka" {{ request('departure_city') == 'Dhaka' ? 'selected' : '' }}>Dhaka</option>
                    <option value="Chittagong" {{ request('departure_city') == 'Chittagong' ? 'selected' : '' }}>Chittagong</option>
                    <option value="Sylhet" {{ request('departure_city') == 'Sylhet' ? 'selected' : '' }}>Sylhet</option>
                </select>
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 600; color: var(--text-muted); margin-bottom: 0.35rem;">Package Tier</label>
                <select name="package_tier" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.88rem;">
                    <option value="">All Tiers</option>
                    <option value="economy" {{ request('package_tier') == 'economy' ? 'selected' : '' }}>Economy</option>
                    <option value="standard" {{ request('package_tier') == 'standard' ? 'selected' : '' }}>3-Star Standard</option>
                    <option value="vip" {{ request('package_tier') == 'vip' ? 'selected' : '' }}>5-Star VIP</option>
                </select>
            </div>

            <div>
                <label style="display: block; font-size: 0.78rem; font-weight: 600; color: var(--text-muted); margin-bottom: 0.35rem;">Max Price (BDT)</label>
                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="e.g. 200000" style="width: 100%; padding: 0.6rem 0.8rem; border: 1px solid var(--border-color); border-radius: 8px; font-size: 0.88rem;">
            </div>

            <div style="display: flex; align-items: flex-end;">
                <button type="submit" class="btn-primary" style="width: 100%; justify-content: center; padding: 0.65rem;">
                    <i class="fa-solid fa-filter"></i> Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Posts Detailed Grid Section -->
    <div class="posts-cards-grid" style="margin-bottom: 2rem;">
        @forelse($posts as $post)
            <div class="card" style="display: flex; flex-direction: column;">
                <div style="padding: 1.1rem 1.25rem; background: #F8FAFC; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem;">
                    <div style="display: flex; gap: 0.4rem; align-items: center; flex-wrap: wrap;">
                        @if(($post->hajj_or_umrah ?? 'umrah') === 'hajj')
                            <span class="badge" style="background: #FEF3C7; color: #92400E; font-weight: 800; font-size: 0.78rem; padding: 0.25rem 0.6rem; border-radius: 12px; border: 1px solid #FDE68A;">
                                <i class="fa-solid fa-kaaba me-1"></i> 🕋 HAJJ DEAL
                            </span>
                        @else
                            <span class="badge" style="background: #E0E7FF; color: #3730A3; font-weight: 800; font-size: 0.78rem; padding: 0.25rem 0.6rem; border-radius: 12px; border: 1px solid #C7D2FE;">
                                <i class="fa-solid fa-mosque me-1"></i> 🕌 UMRAH DEAL
                            </span>
                        @endif

                        <span class="badge badge-{{ $post->post_category === 'group_seats' ? 'seats' : ($post->post_category === 'ticket_only' ? 'ticket' : 'hotel') }}">
                            @if($post->post_category === 'group_seats') <i class="fa-solid fa-users"></i> GROUP SEATS
                            @elseif($post->post_category === 'ticket_only') <i class="fa-solid fa-ticket"></i> TICKET ONLY
                            @else <i class="fa-solid fa-hotel"></i> HOTEL SHARE @endif
                        </span>
                    </div>

                    <div style="display: flex; align-items: center; gap: 0.35rem; flex-wrap: wrap;">
                        <div style="background: {{ $post->requirement_type === 'need_seats' ? '#FEF2F2' : '#ECFDF5' }}; color: {{ $post->requirement_type === 'need_seats' ? '#991B1B' : '#065F46' }}; font-weight: 700; font-size: 0.8rem; padding: 0.2rem 0.6rem; border-radius: 12px; border: 1px solid {{ $post->requirement_type === 'need_seats' ? '#FCA5A5' : '#A7F3D0' }};">
                            @if($post->requirement_type === 'need_seats')
                                <i class="fa-solid fa-user-plus me-1"></i> {{ $post->available_seats }} Seats Needed
                            @else
                                <i class="fa-solid fa-chair me-1"></i> {{ $post->available_seats }} Seats Available
                            @endif
                        </div>

                        @if($post->pendingSeats() > 0)
                            <span style="background: #FEF3C7; color: #D97706; font-size: 0.72rem; padding: 0.2rem 0.5rem; border-radius: 12px; font-weight: 800; border: 1px solid #FCD34D;" title="Seats currently under deal negotiation">
                                <i class="fa-solid fa-clock"></i> {{ $post->pendingSeats() }} In-Process
                            </span>
                        @endif
                    </div>
                </div>

                <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                    <div>
                        <h3 class="font-heading" style="font-size: 1.15rem; color: var(--text-dark); margin-bottom: 0.75rem; line-height: 1.3;">
                            @auth
                                @if(Auth::user()->isApproved() || Auth::user()->isAdmin())
                                    <a href="{{ route('posts.show', $post->id) }}" style="color: inherit; text-decoration: none;">
                                        {{ $post->title }}
                                    </a>
                                @else
                                    <a href="javascript:void(0)" onclick="openRestrictedModal()" style="color: inherit; text-decoration: none;">
                                        {{ $post->title }}
                                    </a>
                                @endif
                            @else
                                <a href="javascript:void(0)" onclick="openRestrictedModal()" style="color: inherit; text-decoration: none;">
                                    {{ $post->title }}
                                </a>
                            @endauth
                        </h3>

                        <!-- Posting Agency Badge -->
                        @auth
                            @if(Auth::user()->isApproved() || Auth::user()->isAdmin())
                                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; background: #F1F5F9; padding: 0.5rem 0.75rem; border-radius: 8px;">
                                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                                        <div style="width: 30px; height: 30px; background: var(--primary); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8rem;">
                                            {{ strtoupper(substr($post->agency->agency_name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <h4 style="font-size: 0.85rem; color: var(--primary-dark); font-weight: 700;">{{ $post->agency->agency_name }}</h4>
                                            <span style="font-size: 0.72rem; color: var(--text-muted);"><i class="fa-solid fa-certificate text-amber-500 me-1"></i> License: {{ $post->agency->license_no }}</span>
                                        </div>
                                    </div>
                                    <span class="badge badge-verified" style="font-size: 0.65rem;">VERIFIED</span>
                                </div>
                            @else
                                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; background: #FFFBEB; padding: 0.5rem 0.75rem; border-radius: 8px; border: 1px solid #FCD34D; cursor: pointer;" onclick="openRestrictedModal()">
                                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                                        <div style="filter: blur(5px); user-select: none; opacity: 0.45; font-weight: 700; color: var(--primary-dark);">R.B Tours & Travels</div>
                                    </div>
                                    <span class="badge" style="background: #FEF3C7; color: #92400E; font-size: 0.65rem;">
                                        <i class="fa-solid fa-lock me-1"></i> AGENCY LOCKED
                                    </span>
                                </div>
                            @endif
                        @else
                            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.25rem; background: #FFFBEB; padding: 0.5rem 0.75rem; border-radius: 8px; border: 1px solid #FCD34D; cursor: pointer;" onclick="openRestrictedModal()">
                                <div style="display: flex; align-items: center; gap: 0.5rem;">
                                    <div style="filter: blur(5px); user-select: none; opacity: 0.45; font-weight: 700; color: var(--primary-dark);">R.B Tours & Travels</div>
                                </div>
                                <span class="badge" style="background: #FEF3C7; color: #92400E; font-size: 0.65rem;">
                                    <i class="fa-solid fa-lock me-1"></i> AGENCY LOCKED
                                </span>
                            </div>
                        @endauth

                        <!-- Data Fields Grid -->
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem; font-size: 0.85rem; color: var(--text-dark); margin-bottom: 1.25rem;">
                            <div>
                                <span style="color: var(--text-muted); display: block; font-size: 0.72rem;">Flight Date & Time</span>
                                <strong><i class="fa-regular fa-calendar me-1"></i> {{ $post->flight_date->format('d M, Y') }}</strong>
                                @if($post->departure_time)
                                    <div style="font-size: 0.75rem; color: #0284C7; font-weight: 600;"><i class="fa-regular fa-clock me-1"></i> {{ $post->departure_time }}</div>
                                @endif
                            </div>
                            <div>
                                <span style="color: var(--text-muted); display: block; font-size: 0.72rem;">Hub & Airline</span>
                                <strong><i class="fa-solid fa-plane me-1"></i> {{ $post->departure_city }} ({{ $post->airline }})</strong>
                                @if($post->transit_duration)
                                    <div style="font-size: 0.75rem; color: #64748B;"><i class="fa-solid fa-stopwatch me-1"></i> Transit: {{ $post->transit_duration }}</div>
                                @endif
                            </div>
                            @if($post->makkah_hotel)
                                <div style="grid-column: 1 / -1; background: #ECFDF5; padding: 0.5rem 0.75rem; border-radius: 8px; border: 1px solid #A7F3D0;">
                                    <span style="color: #065F46; font-size: 0.75rem; font-weight: 700; display: block; margin-bottom: 0.15rem;">
                                        <i class="fa-solid fa-hotel me-1"></i> {{ $post->makkah_hotel }}
                                    </span>
                                    <span style="color: #047857; font-size: 0.78rem; font-weight: 600;">
                                        <i class="fa-solid fa-person-walking me-1"></i> {{ $post->makkah_hotel_distance }}m (~{{ ceil($post->makkah_hotel_distance / 80) }} Mins Walk to Haram)
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Price & Action -->
                    <div style="border-top: 1px dashed var(--border-color); padding-top: 1rem; display: flex; align-items: center; justify-content: space-between;">
                        <div>
                            <span style="font-size: 0.72rem; color: var(--text-muted); display: block;">Rate per Seat</span>
                            <span style="font-size: 1.3rem; font-weight: 800; color: var(--primary-dark);">৳{{ number_format($post->price_per_seat) }}</span>
                        </div>

                        <div style="display: flex; gap: 0.4rem;">
                            @auth
                                @if(Auth::user()->isApproved() || Auth::user()->isAdmin())
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn-gold" style="padding: 0.5rem 0.9rem; font-size: 0.85rem;">
                                        View Details & Contact
                                    </a>
                                @else
                                    <button type="button" onclick="openRestrictedModal()" class="btn-gold" style="padding: 0.5rem 0.9rem; font-size: 0.85rem; background: linear-gradient(135deg, #0284C7, #0369A1); color: white;">
                                        <i class="fa-solid fa-lock me-1"></i> View Details & Contact
                                    </button>
                                @endif
                            @else
                                <button type="button" onclick="openRestrictedModal()" class="btn-gold" style="padding: 0.5rem 0.9rem; font-size: 0.85rem; background: linear-gradient(135deg, #0284C7, #0369A1); color: white;">
                                    <i class="fa-solid fa-lock me-1"></i> View Details & Contact
                                </button>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 4rem 2rem; background: white; border-radius: 12px;">
                <i class="fa-solid fa-folder-open" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
                <h3 style="color: var(--text-dark); margin-bottom: 0.5rem;">No B2B Posts Found</h3>
                <p style="color: var(--text-muted);">Try clearing your search filters or post a new requirement.</p>
            </div>
        @endforelse
    </div>

    <div>
        {{ $posts->links() }}
    </div>
@endsection
