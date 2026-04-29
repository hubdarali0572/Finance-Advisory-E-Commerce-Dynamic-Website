<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Category;
use App\Models\DraftPost;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    public function index()
    {
        $authUser = Auth::user();

        if ($authUser->user_type === 'superAdmin') {
            $blogs = Blog::all();
        } else {
            $blogs = Blog::where('user_id', $authUser->id)
                ->with('subCategory', 'category')
                ->get();
        }
        return view('pages.blog.index', compact('blogs'));
    }


    /**
     * Show the form for creating a new Category.
     */
    public function create()
    {
        $authUser = Auth::user();
        $categories = Category::where('user_id', $authUser->id)->where('status', 'active')->get();

        $subcategories = SubCategory::where('user_id', $authUser->id)->where('status', 'active')->get();
        return view('pages.blog.add', compact('categories', 'subcategories'));
    }

    /**
     * Store a newly created Category in storage.
     */

    public function store(Request $request)
    {
        $authUser = Auth::user();

        $request->validate([
            'category_id'       => 'required|exists:categories,id',
            'subcategory_id'    => 'required|exists:sub_categories,id',
            'title'             => 'required|string',
            'slug'              => 'required|string|unique:blogs,slug',
            'blog_date'         => 'required|date',
            'video_url'         => 'nullable|url',
            'audio_url'         => 'nullable|url',
            'seo_title'         => 'required|string',
            'seo_keywords'      => 'nullable|string',
            'seo_description'   => 'nullable|string',
            'views'             => 'nullable|integer',
            'likes'             => 'nullable|integer',
            'shares'            => 'nullable|integer',
            'tags'              => 'nullable|string',
            'short_description' => 'nullable|string',
            'content'           => 'nullable|string',
            'image_path'        => 'nullable|mimes:jpeg,png,jpg,gif,webp',
            'file_path'         => 'nullable|mimes:mp4,mov,avi,mpeg',
            'audio_path'        => 'nullable|mimes:mp3,wav',
        ], [
            'file_path.max' => 'The file size must not exceed 100 MB.',
        ]);

        // if ($request->publish_status == 'published') {


        $userSubscription = UserSubscription::where('user_id', $authUser->id)
            ->where('status', 'active')
            ->where('end_date', '>=', Carbon::today()) // not expired
            ->first();

        if (!$userSubscription) {
            return redirect()->back()
                ->with('error', 'Access Denied: Your subscription is inactive or expired. Please renew your plan.')
                ->withInput();
        }


        // Get the post limit from subscription
        $postLimit = $userSubscription->subscription->post_number ?? null;

        // Count the number of posts already created by this user
        $userPostsCount = Blog::where('user_id', $authUser->id)->count();

        if ($postLimit !== null && $userPostsCount >= $postLimit) {
            return redirect()->back()
                ->with('error', 'You have reached your post limit. Please upgrade your plan to publish more posts.')
                ->withInput();
        }
        // }

        $blog = new Blog();
        $blog->category_id       = $request->category_id;
        $blog->subcategory_id       = $request->subcategory_id;
        $blog->user_id           = $authUser->id;
        $blog->title             = $request->title;
        $blog->slug = Str::slug($request->slug);
        $blog->blog_date         = $request->blog_date;
        $blog->video_url         = $request->video_url;
        $blog->audio_url         = $request->audio_url;
        $blog->status            = 'pending';
        $blog->publish_status            = $request->publish_status;
        $blog->seo_title         = $request->seo_title;
        $blog->seo_keywords      = $request->seo_keywords;
        $blog->seo_description   = $request->seo_description;
        $blog->views             = $request->views ?? 0;
        $blog->likes             = $request->likes ?? 0;
        $blog->shares            = $request->shares ?? 0;
        $blog->tags = $request->tags ? json_encode(array_map('trim', explode(',', $request->tags))) : null;
        $blog->short_description = $request->short_description;
        $blog->content           = $request->content;


        /* ---------- IMAGE ---------- */
        if ($request->hasFile('file_path')) {
            $image = $request->file('file_path');
            $imageName = time() . '_img_' . $image->getClientOriginalName();
            $image->move(public_path('assets/blog/video'), $imageName);
            $blog->file_path = $imageName;
        }

        /* ---------- VIDEO ---------- */
        if ($request->hasFile('image_path')) {
            $video = $request->file('image_path');
            $videoName = time() . '_vid_' . $video->getClientOriginalName();
            $video->move(public_path('assets/blog/image'), $videoName);
            $blog->image_path = $videoName;
        }

        /* ---------- AUDIO ---------- */
        if ($request->hasFile('audio_path')) {
            $audio = $request->file('audio_path');
            $audioName = time() . '_aud_' . $audio->getClientOriginalName();
            $audio->move(public_path('assets/blog/audio'), $audioName);
            $blog->audio_path = $audioName;
        }

        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Hooray! Your Post has been created and is ready for readers.');
    }



    /**
     * Display the specified Category.
     */
    public function show(string $id)
    {
        $authUser = Auth::user();

        $blog = Blog::findOrFail($id);

        $categories = Category::where('user_id', $authUser->id)->where('status', 'active')->get();
        $subCategories = SubCategory::where('user_id', $authUser->id)->where('status', 'active')->get();
        return view('pages.blog.view', compact('blog', 'categories', 'subCategories'));
    }

    /**
     * Show the form for editing the specified Category.
     */
    public function edit(string $id)
    {
        $authUser = Auth::user();

        $blog = Blog::findOrFail($id);
        $categories = Category::where('user_id', $authUser->id)->where('status', 'active')->get();
        $subCategories = SubCategory::where('user_id', $authUser->id)->where('status', 'active')->get();

        return view('pages.blog.edit', compact('blog', 'categories', 'subCategories'));
    }

    /**
     * Update the specified Category in storage.
     */
    public function update(Request $request, string $id)
    {
        $authUser = Auth::user();

        $request->validate([
            'category_id'       => 'required|exists:categories,id',
            'subcategory_id'    => 'required|exists:sub_categories,id',
            'title'             => 'required|string',
            'slug' => [
                'required',
                'string',
                Rule::unique('blogs', 'slug')->ignore($id),
            ],
            'blog_date'         => 'required|date',
            'video_url'         => 'nullable|url',
            'audio_url'         => 'nullable|url',
            'seo_title'         => 'required|string',
            'seo_keywords'      => 'nullable|string',
            'seo_description'   => 'nullable|string',
            'views'             => 'nullable|integer',
            'likes'             => 'nullable|integer',
            'shares'            => 'nullable|integer',
            'tags'              => 'nullable|string',
            'short_description' => 'nullable|string',
            'content'           => 'nullable|string',
            'image_path'        => 'nullable|mimes:jpeg,png,jpg,gif,webp',
            'file_path'         => 'nullable|mimes:mp4,mov,avi,mpeg',
            'audio_path'        => 'nullable|mimes:mp3,wav',
        ], [
            'file_path.max' => 'The file size must not exceed 100 MB.',
        ]);

        // if ($request->publish_status == 'published') {
        //     $userSubscription = UserSubscription::where('user_id', $authUser->id)
        //         ->where('status', 'active')
        //         ->first();

        //     if (!$userSubscription) {
        //         return redirect()->back()
        //             ->with('error', 'Access Denied: Please activate your subscription to continue enjoying our premium features.')
        //             ->withInput();
        //     }

        //     $postLimit = $userSubscription->subscription->post_number ?? null;

        //     $userPostsCount = Blog::where('user_id', $authUser->id)->count();

        //     if ($postLimit !== null && $userPostsCount >= $postLimit) {
        //         return redirect()->back()
        //             ->with('error', 'You have reached your post limit. Please upgrade your plan to publish more posts.')

        //             ->withInput();
        //     }
        // }

        $blog = Blog::findOrFail($id);
        $blog->category_id       = $request->category_id;
        $blog->title             = $request->title;
        $blog->slug              = Str::slug($request->slug);
        $blog->blog_date         = $request->blog_date;
        $blog->video_url         = $request->video_url;
        $blog->audio_url         = $request->audio_url;
        $blog->publish_status            = $request->publish_status;
        $blog->seo_title         = $request->seo_title;
        $blog->seo_keywords      = $request->seo_keywords;
        $blog->seo_description   = $request->seo_description;
        $blog->views             = $request->views ?? $blog->views;
        $blog->likes             = $request->likes ?? $blog->likes;
        $blog->shares            = $request->shares ?? $blog->shares;
        $blog->tags = $request->tags
            ? json_encode(array_map('trim', explode(',', $request->tags)))
            : null;
        $blog->short_description = $request->short_description;
        $blog->content           = $request->content;
        $blog->status = 'pending';

        // ---------- VIDEO ----------
        if ($request->hasFile('file_path')) {
            if (!empty($blog->file_path) && file_exists(public_path('assets/blog/video/' . $blog->file_path))) {
                unlink(public_path('assets/blog/video/' . $blog->file_path));
            }

            $video = $request->file('file_path');
            $videoName = time() . '_vid_' . $video->getClientOriginalName();
            $video->move(public_path('assets/blog/video'), $videoName);
            $blog->file_path = $videoName;
        }

        // ---------- IMAGE ----------
        if ($request->hasFile('image_path')) {
            if (!empty($blog->image_path) && file_exists(public_path('assets/blog/image/' . $blog->image_path))) {
                unlink(public_path('assets/blog/image/' . $blog->image_path));
            }

            $image = $request->file('image_path');
            $imageName = time() . '_img_' . $image->getClientOriginalName();
            $image->move(public_path('assets/blog/image'), $imageName);
            $blog->image_path = $imageName;
        }

        // ---------- AUDIO ----------
        if ($request->hasFile('audio_path')) {
            if (!empty($blog->audio_path) && file_exists(public_path('assets/blog/audio/' . $blog->audio_path))) {
                unlink(public_path('assets/blog/audio/' . $blog->audio_path));
            }

            $audio = $request->file('audio_path');
            $audioName = time() . '_aud_' . $audio->getClientOriginalName();
            $audio->move(public_path('assets/blog/audio'), $audioName);
            $blog->audio_path = $audioName;
        }

        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Great! Your Post has been updated and is ready for readers.');
    }

    /**
     * Remove the specified Category from storage.
     */
    public function destroy(string $id)
    {

        $blog = Blog::findOrFail($id);

        if ($blog) {

            // Delete old video if exists
            if (!empty($blog->file_path) && file_exists(public_path('assets/blog/video/' . $blog->file_path))) {
                unlink(public_path('assets/blog/video/' . $blog->file_path));
            }

            if (!empty($blog->image_path) && file_exists(public_path('assets/blog/image/' . $blog->image_path))) {
                unlink(public_path('assets/blog/image/' . $blog->image_path));
            }

            // Delete old audio if exists
            if (!empty($blog->audio_path) && file_exists(public_path('assets/blog/audio/' . $blog->audio_path))) {
                unlink(public_path('assets/blog/audio/' . $blog->audio_path));
            }

            $blog->delete();
        }

        return redirect()->route('blogs.index')->with('danger', 'The blog was deleted successfully. Thank you for keeping your content organized.');
    }


    public function getSubcategories($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)->get();
        return response()->json($subcategories);
    }


    public function approve($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->status = 'approved';
        $blog->save();

        return redirect()->back()->with('success', 'The blog has been approved successfully !');
    }

    public function reject($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->status = 'rejected';
        $blog->save();

        return redirect()->back()->with('danger', 'The blog has been rejected !');
    }
}
