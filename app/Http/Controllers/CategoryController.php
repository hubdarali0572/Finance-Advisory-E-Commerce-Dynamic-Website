<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the Category.
     */
    public function index()
    {
        $authUser = Auth::user();

        if ($authUser->user_type === 'superAdmin') {
            $categories = Category::all();
        } else {
            $categories = Category::where('user_id', $authUser->id)->get();
        }


        return view('pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new Category.
     */
    public function create()
    {
        return view('pages.category.add');
    }

    /**
     * Store a newly created Category in storage.
     */
    public function store(Request $request)
    {


        $authuser = Auth::user();


        $userSubscription = UserSubscription::where('user_id', $authuser->id)
            ->where('status', 'active')
            ->where('end_date', '>=', Carbon::today()) // not expired
            ->first();

        if (!$userSubscription) {
            return redirect()->back()
                ->with('error', 'Access Denied: Your subscription is inactive or expired. Please renew your plan.')
                ->withInput();
        }
        // Validate the request
        $request->validate([
            'name'        => 'required|string',
            'seo_title'        => 'required|string',
            'seo_keywords'        => 'required|string',
            'status'      => 'required|in:active,inactive',
            'description' => 'nullable|string',
            'seo_description' => 'nullable|string',

            'image_path'        => 'nullable|mimes:jpeg,png,jpg,gif,webp',
            'file_path'         => 'nullable|mimes:mp4,mov,avi,mpeg',
            'audio_path'        => 'nullable|mimes:mp3,wav',
        ], [
            'file_path.max' => 'The file size must not exceed 100 MB.',
        ]);


        // Create new category
        $category = new Category();
        $category->name = $request->name;
        $category->title = $request->title;
        $category->user_id = $authuser->id;
        $category->seo_title = $request->seo_title;
        $category->seo_keywords = $request->seo_keywords;
        $category->status = $request->status;
        $category->description = $request->description;
        $category->seo_description = $request->seo_description;

        $category->tags = $request->tags ? json_encode(array_map('trim', explode(',', $request->tags))) : null;


        /* ---------- IMAGE ---------- */
        if ($request->hasFile('file_path')) {
            $image = $request->file('file_path');
            $imageName = time() . '_img_' . $image->getClientOriginalName();
            $image->move(public_path('assets/category/video'), $imageName);
            $category->file_path = $imageName;
        }

        /* ---------- VIDEO ---------- */
        if ($request->hasFile('image_path')) {
            $video = $request->file('image_path');
            $videoName = time() . '_vid_' . $video->getClientOriginalName();
            $video->move(public_path('assets/category/image'), $videoName);
            $category->image_path = $videoName;
        }

        /* ---------- AUDIO ---------- */
        if ($request->hasFile('audio_path')) {
            $audio = $request->file('audio_path');
            $audioName = time() . '_aud_' . $audio->getClientOriginalName();
            $audio->move(public_path('assets/category/audio'), $audioName);
            $category->audio_path = $audioName;
        }

        $category->save();

        return redirect()->route('category.index')->with('success', 'Article created successfully!');
    }


    /**
     * Display the specified Category.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);

        return view('pages.category.view', compact('category'));
    }

    /**
     * Show the form for editing the specified Category.
     */
    public function edit(string $id)
    {

        $category = Category::findOrFail($id);

        return view('pages.category.edit', compact('category'));
    }

    /**
     * Update the specified Category in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'name'             => 'required|string',
            'title'            => 'required|string',
            'seo_title'        => 'required|string',
            'seo_keywords'     => 'required|string',
            'status'           => 'required|in:active,inactive',
            'description'      => 'nullable|string',
            'seo_description'  => 'nullable|string',
            'image_path'        => 'nullable|mimes:jpeg,png,jpg,gif,webp',
            'file_path'         => 'nullable|mimes:mp4,mov,avi,mpeg',
            'audio_path'        => 'nullable|mimes:mp3,wav',
        ], [
            'file_path.max' => 'The file size must not exceed 100 MB.',
            'image_path.max' => 'The file size must not exceed 10 MB.',
        ]);

        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->title = $request->title;
        $category->seo_title = $request->seo_title;
        $category->seo_keywords = $request->seo_keywords;
        $category->status = $request->status;
        $category->description = $request->description;
        $category->seo_description = $request->seo_description;

        // Tags
        $category->tags = $request->tags ? json_encode(array_map('trim', explode(',', $request->tags))) : $category->tags;

        // ---------- VIDEO ----------
        if ($request->hasFile('file_path')) {
            // Delete old video if exists
            if (!empty($category->file_path) && file_exists(public_path('assets/category/video/' . $category->file_path))) {
                unlink(public_path('assets/category/video/' . $category->file_path));
            }

            $video = $request->file('file_path');
            $videoName = time() . '_vid_' . $video->getClientOriginalName();
            $video->move(public_path('assets/category/video'), $videoName);
            $category->file_path = $videoName;
        }

        // ---------- IMAGE ----------
        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if (!empty($category->image_path) && file_exists(public_path('assets/category/image/' . $category->image_path))) {
                unlink(public_path('assets/category/image/' . $category->image_path));
            }

            $image = $request->file('image_path');
            $imageName = time() . '_img_' . $image->getClientOriginalName();
            $image->move(public_path('assets/category/image'), $imageName);
            $category->image_path = $imageName;
        }

        // ---------- AUDIO ----------
        if ($request->hasFile('audio_path')) {
            // Delete old audio if exists
            if (!empty($category->audio_path) && file_exists(public_path('assets/category/audio/' . $category->audio_path))) {
                unlink(public_path('assets/category/audio/' . $category->audio_path));
            }

            $audio = $request->file('audio_path');
            $audioName = time() . '_aud_' . $audio->getClientOriginalName();
            $audio->move(public_path('assets/category/audio'), $audioName);
            $category->audio_path = $audioName;
        }

        $category->save();

        return redirect()->route('category.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified Category from storage.
     */
    public function destroy(string $id)
    {

        $category = Category::findOrFail($id);
        if ($category) {

            // Delete old video if exists
            if (!empty($category->file_path) && file_exists(public_path('assets/category/video/' . $category->file_path))) {
                unlink(public_path('assets/category/video/' . $category->file_path));
            }

            if (!empty($category->image_path) && file_exists(public_path('assets/category/image/' . $category->image_path))) {
                unlink(public_path('assets/category/image/' . $category->image_path));
            }

            // Delete old audio if exists
            if (!empty($category->audio_path) && file_exists(public_path('assets/category/audio/' . $category->audio_path))) {
                unlink(public_path('assets/category/audio/' . $category->audio_path));
            }


            $category->delete();
        }

        return redirect()->route('category.index')->with('danger', 'Article Deleted  successfully!');
    }
}
