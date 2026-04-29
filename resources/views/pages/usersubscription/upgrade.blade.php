@extends('layout.master')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush
<style>
    .subscription-container {
        display: flex;
        gap: 30px;
        width: 100%;
        max-width: 100%;
        flex-wrap: wrap;
        justify-content: center;
        padding: 40px 20px;
    }

    .subscription-card {
        background: white;
        border-radius: 20px;
        width: 350px;
        height: 700px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .subscription-card:hover {
        transform: translateY(-5px);
    }

    .subscription-header {
        padding: 50px 30px 40px;
        text-align: center;
        color: white;
        position: relative;
    }

    .subscription-header::before {
        content: '';
        position: absolute;
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .subscription-header::after {
        content: '';
        position: absolute;
        bottom: -30px;
        left: -30px;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    /* Color schemes for each plan */
    .subscription-card[data-plan="basic plan"] .subscription-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .subscription-card[data-plan="pro plan"] .subscription-header {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .subscription-card[data-plan="premium"] .subscription-header {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .subscription-card[data-plan="ultimate"] .subscription-header {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }

    .subscription-price {
        background: white;
        color: #333;
        display: inline-block;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 18px;
        position: relative;
        z-index: 1;
    }

    .subscription-card[data-plan="basic plan"] .subscription-price {
        color: #667eea;
    }

    .subscription-card[data-plan="pro plan"] .subscription-price {
        color: #f5576c;
    }

    .subscription-card[data-plan="premium"] .subscription-price {
        color: #00f2fe;
    }

    .subscription-card[data-plan="ultimate"] .subscription-price {
        color: #43e97b;
    }


    .subscription-name {
        font-size: 18px;
        font-weight: 600;
        letter-spacing: 1px;
        margin-bottom: 4px;
        text-transform: uppercase;
    }

    .subscription-duration {
        font-size: 11px;
        opacity: 0.9;
        letter-spacing: 0.5px;
    }

    .subscription-body {
        padding: 30px 25px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .subscription-description {
        font-size: 14px;
        color: #666;
        line-height: 1.6;
        margin-bottom: 25px;
        text-align: center;
    }

    .subscription-features {
        list-style: none;
        margin-bottom: 30px;
        flex: 1;
    }

    .subscription-features li {
        padding: 15px 0;
        font-size: 13px;
        color: #999;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .subscription-features li::before {
        content: '✓';
        width: 18px;
        height: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        font-size: 11px;
        font-weight: bold;
        flex-shrink: 0;
        background: #E8F5E9;
        color: #4CAF50;
    }

    .subscription-btn {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 25px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 1px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .subscription-card[data-plan="basic plan"] .subscription-btn {
        background: white;
        color: #667eea;
        border: 2px solid #667eea;
    }

    .subscription-card[data-plan="basic plan"] .subscription-btn:hover {
        background: #667eea;
        color: white;
    }

    .subscription-card[data-plan="pro plan"] .subscription-btn {
        background: white;
        color: #f5576c;
        border: 2px solid #f5576c;
    }

    .subscription-card[data-plan="pro plan"] .subscription-btn:hover {
        background: #f5576c;
        color: white;
    }

    .subscription-card[data-plan="premium"] .subscription-btn {
        background: white;
        color: #00f2fe;
        border: 2px solid #00f2fe;
    }

    .subscription-card[data-plan="premium"] .subscription-btn:hover {
        background: #00f2fe;
        color: white;
    }

    .subscription-card[data-plan="ultimate"] .subscription-btn {
        background: white;
        color: #43e97b;
        border: 2px solid #43e97b;
    }

    .subscription-card[data-plan="ultimate"] .subscription-btn:hover {
        background: #43e97b;
        color: white;
    }

    @media (max-width: 768px) {
        .subscription-container {
            gap: 20px;
        }

        .subscription-card {
            width: 100%;
            max-width: 350px;
        }
    }
</style>


@section('content')
    @include('includes.messages')
    @php
        $planColors = [
            'Basic' => '#667eea',
            'Basic Plan' => '#667eea',
            'Standard' => '#00b894',         // Added Standard
            'Standard Plan' => '#00b894',    // Optional, if title has "Plan"
            'Pro' => '#f5576c',
            'Pro Plan' => '#f5576c',
            'Premium' => '#00f2fe',
            'Ultimate' => '#43e97b',
            'Enterprise' => '#ff9800',
            'Enterprise Plan' => '#ff9800',
        ];
    @endphp


    <div id="subscription-toast" style="
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #4ade80; /* green background */
        color: #fff;
        padding: 20px 30px;
        border-radius: 10px;
        font-size: 18px;
        font-weight: 600;
        display: none;
        z-index: 9999;
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        ">Subscription successful!
    </div>

    <div id="subscription-cards" class="subscription-container">

        @foreach($userSubscriptions as $subscription)
            @php
                $start = \Carbon\Carbon::parse($subscription->start_date);
                $end = \Carbon\Carbon::parse($subscription->end_date);
                $durationDays = $start->diffInDays($end) + 1; // include start & end
            @endphp

            <div class="subscription-card" data-plan="{{ strtolower($subscription->title) }}">
                <div class="subscription-header" style="background: {{ $planColors[$subscription->title] ?? '#ccc' }};">
                    <div class="subscription-price">${{ number_format($subscription->price, 0) }}</div>
                    <div class="subscription-name">{{ $subscription->title }}</div>
                    <div class="subscription-duration">{{ $durationDays }} DAYS</div>
                </div>
                <div class="subscription-body">

                    @if(!empty($subscription->description))
                        @php
                            // Convert Markdown description to HTML
                            $descriptionHtml = Illuminate\Support\Str::markdown($subscription->description);

                            // Use DOMDocument to extract <li> elements
                            $doc = new \DOMDocument();
                            libxml_use_internal_errors(true);
                            $doc->loadHTML('<html><body>' . $descriptionHtml . '</body></html>');
                            libxml_clear_errors();

                            $lis = $doc->getElementsByTagName('li');
                        @endphp

                        @if($lis->length)
                            <ul class="subscription-features">
                                @foreach($lis as $li)
                                    <li>{!! $li->nodeValue !!}</li>
                                @endforeach
                            </ul>
                        @else
                            {{-- If no list items, just display paragraph --}}
                            <p>{!! $subscription->description !!}</p>
                        @endif
                    @else
                        <p>N/A</p>
                    @endif

                    <button class="subscription-btn" onclick="subscribeNow({{ $subscription->id }})">
                        Subscribe Now →
                    </button>

                </div>

            </div>
        @endforeach
    </div>

@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>

    <script>
        function subscribeNow(subscriptionId) {
            fetch('/subscribe', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ subscription_id: subscriptionId })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        // Redirect to subscription table page
                        window.location.href = data.redirect;
                    } else {
                        showToast(data.message, '#f87171');
                    }
                })
                .catch(err => showToast('Something went wrong!', '#f87171'));
        }

        function showToast(message, bgColor = '#4ade80') {
            const toast = document.getElementById('subscription-toast');
            toast.innerText = message;
            toast.style.background = bgColor;
            toast.style.display = 'block';
            setTimeout(() => { toast.style.display = 'none'; }, 3000);
        }

    </script>


@endpush