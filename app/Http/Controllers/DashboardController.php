<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Subscription;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authUser = Auth::user();

        if ($authUser->user_type === 'superAdmin') {

            // Display All Users Data
          $usersTotal = User::where('user_type', '!=', 'superAdmin')->count();
            $categoryTotal = Category::count();
            $subscriptionTotal = Subscription::count();
            $blogsTotal = Blog::count();
            $blogsTotal = Blog::count();
            $approvedPosts = Blog::where('status', 'approved')
                ->count();
            $pendingPosts = Blog::where('status', 'pending')
                ->count();
            $rejectedPosts = Blog::where('status', 'rejected')
                ->count();

            return view('superadmin-dashboard', compact('usersTotal', 'categoryTotal', 'subscriptionTotal', 'blogsTotal', 'approvedPosts', 'rejectedPosts', 'pendingPosts'));
        } else {

            // Display Only Logged-in User Data
            $usersTotal = User::where('id', $authUser->id)->count();
            $categoryTotal = Category::where('user_id', $authUser->id)->count();
            $blogsTotal = Blog::where('user_id', $authUser->id)->count();
            $approvedPosts = Blog::where('user_id', $authUser->id)
                ->where('status', 'approved')
                ->count();

            $pendingPosts = Blog::where('user_id', $authUser->id)
                ->where('status', 'pending')
                ->count();

            $rejectedPosts = Blog::where('user_id', $authUser->id)
                ->where('status', 'rejected')
                ->count();

            $subscriptionStats = UserSubscription::where('user_id', $authUser->id)
                ->with('subscription:id,title')
                ->get()
                ->groupBy('subscription.title')
                ->map(fn($items) => $items->count());
            $subscriptionTotal = $subscriptionStats->sum();

            $totalNoPosts = UserSubscription::where('user_id', $authUser->id)
            ->with('subscription:id,post_number')->get()
            ->sum(fn($item) => $item->subscription->post_number ?? 0);

            $usedPosts = Blog::where('user_id', $authUser->id)->count();
    
            $remainingPosts = max($totalNoPosts - $usedPosts, 0);


            return view('user-dashboard', compact(
                'usersTotal',
                'categoryTotal',
                'subscriptionTotal',
                'subscriptionStats',
                'blogsTotal',
                'approvedPosts',
                'pendingPosts',
                'rejectedPosts',
                'totalNoPosts',
                'usedPosts',
                'remainingPosts'
            ));
        }
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
}
