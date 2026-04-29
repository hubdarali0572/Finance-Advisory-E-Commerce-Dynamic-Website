<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;

class UserSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $subscriptions = Subscription::where('end_date', '>', Carbon::today())->get();

        return view('pages.usersubscription.index', compact('subscriptions'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function table()
    {
        $today = \Carbon\Carbon::today();

        $userSubscriptions = UserSubscription::with('subscription')
            ->where('user_id', auth()->id())
            ->get();

        // Total subscriptions
        $userSubscriptionTotal = $userSubscriptions->count();

        // ✅ TOTAL ALLOWED POSTS (ACTIVE + EXPIRED)
        $totalAllowedPosts = $userSubscriptions
            ->sum(fn($sub) => $sub->subscription->post_number ?? 0);

        // ✅ ACTIVE ALLOWED POSTS (ONLY CURRENT)
        $activeAllowedPosts = $userSubscriptions
            ->filter(function ($sub) use ($today) {
                return $sub->status === 'active'
                    && $sub->start_date
                    && $sub->end_date
                    && $today->between($sub->start_date, $sub->end_date);
            })
            ->sum(fn($sub) => $sub->subscription->post_number ?? 0);

        // Used posts
        $usedPosts = Blog::where('user_id', auth()->id())->count();

        // Remaining posts (ONLY from active)
        $remainingPosts = max($activeAllowedPosts - $usedPosts, 0);

        return view(
            'pages.usersubscription.table',
            compact(
                'userSubscriptions',
                'userSubscriptionTotal',
                'totalAllowedPosts',
                'activeAllowedPosts',
                'usedPosts',
                'remainingPosts'
            )
        );
    }



    public function subscribe(Request $request)
    {
        $subscription = Subscription::find($request->subscription_id);

        if (!$subscription) {
            return response()->json(['success' => false, 'message' => 'Subscription not found']);
        }

        // Check if the user already subscribed
        // $existing = UserSubscription::where('user_id', auth()->id())->first();
        // if ($existing) {
        //     return response()->json(['success' => false, 'message' => 'You already have a subscription']);
        // }

        // Create subscription for the user
        UserSubscription::create([
            'user_id' => auth()->id(),
            'subscription_id' => $subscription->id,
            'start_date'      => $subscription->start_date,
            'end_date'        => $subscription->end_date,
            'status' => 'active',
            'price' => $subscription->price,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Subscription successful!',
            'redirect' => route('user.subscription.table') // the page to show subscribed table
        ]);
    }


    public function renew($id)
    {
        $subscription = UserSubscription::with('subscription')->findOrFail($id);

        if ($subscription->user_id !== auth()->id()) {
            abort(403);
        }

        $plan = $subscription->subscription;
        if (!$plan) {
            return back()->with('error', 'Subscription plan not found.');
        }

        $today = \Carbon\Carbon::today();

        if ($today->lte($subscription->end_date)) {
            // ACTIVE: extend current subscription
            $subscription->end_date = $subscription->end_date->copy()->addDays($plan->duration ?? 30);
            $subscription->status = 'active';
            $subscription->save();

            return redirect()
                ->route('user.subscription.table')
                ->with('success', "Subscription extended by {$plan->duration} days.");
        } else {
            // EXPIRED: create new UserSubscription
            $newStart = $today;
            $newEnd = $newStart->copy()->addDays($plan->duration ?? 30);

            UserSubscription::create([
                'user_id' => auth()->id(),
                'subscription_id' => $plan->id,
                'start_date' => $newStart->toDateString(),
                'end_date' => $newEnd->toDateString(),
                'status' => 'active',
                'price' => $plan->price,
            ]);

            // Create new general Subscription record
            Subscription::create([
                'user_id' => auth()->id(),
                'title' => $plan->title ?? 'Default Title',
                'description' => $plan->description ?? 'No description',
                'price' => $plan->price ?? 0,
                'duration' => $plan->duration ?? 30,
                'start_date' => $newStart->toDateString(),
                'end_date' => $newEnd->toDateString(),
                'is_active' => true,
                'created_by' => auth()->id(),
                'post_number' => $plan->post_number ?? 0,
            ]);

            return redirect()
                ->route('user.subscription.table')
                ->with('success', "Subscription renewed successfully for {$plan->duration} days.");
        }
    }


    // Show available plans
    public function upgrade()
    {

       $userSubscriptions = Subscription::where('end_date', '>', Carbon::today())->get();

        return view('pages.usersubscription.upgrade', compact('userSubscriptions'));
    }
}
