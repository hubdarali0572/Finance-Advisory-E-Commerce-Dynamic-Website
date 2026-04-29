<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class FrontendController extends Controller
{
    // Home page

    public function home()
    {
        $categories = Category::with(['subcategories', 'blogs'])
            ->latest()
            ->take(5)
            ->get();

            // $users = User::whereHas('blogs')
            // ->with(['blogs' => function ($query) { $query->latest()->take(3); 
            // }, 'blogs.category'])->get();



        // Step 1: Try to get users who have blogs created in the last 24 hours
        $recentUsers = User::whereHas('blogs', function ($query) {
            $query->where('created_at', '>=', Carbon::now()->subDay());
        })
            ->with(['blogs' => function ($query) {
                $query->latest()->take(3);
            }, 'blogs.category'])
            ->latest()
            ->get();

        // If no user has blogs in the last 24 hours, fallback to any 3 users with blogs
        if ($recentUsers->isEmpty()) {
            $recentUsers = User::whereHas('blogs')
                ->with(['blogs' => function ($query) {
                    $query->latest()->take(3);
                }, 'blogs.category'])
                ->latest()
                ->take(3)
                ->get();
        }

        $users = $recentUsers;


        $subscriptions = Subscription::all();
        $recentBlogs = Blog::latest()->take(3)->get();

        return view('Frontend.pages.home', compact('categories', 'users', 'subscriptions', 'recentBlogs'));
    }

    // Contact Us Page

    public function contact()
    {
        $recentBlogs = Blog::latest()->take(3)->get();
        return view('Frontend.pages.contact-us', compact('recentBlogs'));
    }
    public function Privacy()
    {
        $recentBlogs = Blog::latest()->take(3)->get();
        return view('Frontend.pages.Privacy', compact('recentBlogs'));
    }
    public function Terms()
    {
        $recentBlogs = Blog::latest()->take(3)->get();
        return view('Frontend.pages.Terms', compact('recentBlogs'));
    }

    public function blogs()
    {

        $userBlogs = User::whereHas('blogs')
            ->with([
                'blogs' => function ($query) {
                    $query->latest(); // no limit
                },
                'blogs.category'
            ])
            ->get();
        $recentBlogs = Blog::latest()->take(3)->get();

        // dd( $userBlogs);
        return view('Frontend.pages.blogs', compact('userBlogs', 'recentBlogs'));
    }


    public function detailPage($id)
    {

        $blog = Blog::with(['user', 'category', 'subcategory'])->findOrFail($id);
        $recentBlogs = Blog::latest()->take(3)->get();
        return view('frontend.pages.detail-each', compact('blog', 'recentBlogs'));
    }
}
