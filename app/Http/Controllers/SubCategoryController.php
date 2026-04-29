<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\UserSubscription;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $authUser = Auth::user();

        if ($authUser->user_type === 'superAdmin') {
            $subCategories = SubCategory::all();
        } else {
            $subCategories = SubCategory::where('user_id', $authUser->id)->get();
        }


        return view('pages.subcategory.index', compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authUser = Auth::user();
        $categories = Category::where('user_id', $authUser->id)->where('status', 'active')->get();

        return view('pages.subcategory.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
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
            'category_id'       => 'required|exists:categories,id',
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


        $subCategory = new SubCategory();
        $subCategory->category_id       = $request->category_id;
        $subCategory->name = $request->name;
        $subCategory->title = $request->title;
        $subCategory->user_id = $authuser->id;
        $subCategory->seo_title = $request->seo_title;
        $subCategory->seo_keywords = $request->seo_keywords;
        $subCategory->status = $request->status;
        $subCategory->description = $request->description;
        $subCategory->seo_description = $request->seo_description;

        $subCategory->tags = $request->tags ? json_encode(array_map('trim', explode(',', $request->tags))) : null;


        /* ---------- IMAGE ---------- */
        if ($request->hasFile('file_path')) {
            $image = $request->file('file_path');
            $imageName = time() . '_img_' . $image->getClientOriginalName();
            $image->move(public_path('assets/subcategory/video'), $imageName);
            $subCategory->file_path = $imageName;
        }

        /* ---------- VIDEO ---------- */
        if ($request->hasFile('image_path')) {
            $video = $request->file('image_path');
            $videoName = time() . '_vid_' . $video->getClientOriginalName();
            $video->move(public_path('assets/subcategory/image'), $videoName);
            $subCategory->image_path = $videoName;
        }

        /* ---------- AUDIO ---------- */
        if ($request->hasFile('audio_path')) {
            $audio = $request->file('audio_path');
            $audioName = time() . '_aud_' . $audio->getClientOriginalName();
            $audio->move(public_path('assets/subcategory/audio'), $audioName);
            $subCategory->audio_path = $audioName;
        }

        $subCategory->save();

        return redirect()->route('subcategory.index')->with('success', 'SubCategory created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $authUser = Auth::user();
        $subCategory = SubCategory::findOrFail($id);

        $categories = Category::where('user_id', $authUser->id)->where('status', 'active')->get();
        return view('pages.subcategory.view', compact('subCategory', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $authUser = Auth::user();
        $subCategory = SubCategory::findOrFail($id);

        $categories = Category::where('user_id', $authUser->id)->where('status', 'active')->get();
        return view('pages.subcategory.edit', compact('subCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the subcategory
        $subCategory = SubCategory::findOrFail($id);

        // Validate the request
        $request->validate([
            'category_id'       => 'required|exists:categories,id',
            'name'              => 'required|string',
            'seo_title'         => 'required|string',
            'seo_keywords'      => 'required|string',
            'status'            => 'required|in:active,inactive',
            'description'       => 'nullable|string',
            'seo_description'   => 'nullable|string',
            'image_path'        => 'nullable|mimes:jpeg,png,jpg,gif,webp',
            'file_path'         => 'nullable|mimes:mp4,mov,avi,mpeg',
            'audio_path'        => 'nullable|mimes:mp3,wav',
        ], [
            'file_path.max' => 'The file size must not exceed 100 MB.',
        ]);

        $authuser = Auth::user();

        // Update fields
        $subCategory->category_id      = $request->category_id;
        $subCategory->name             = $request->name;
        $subCategory->title            = $request->title;
        $subCategory->user_id          = $authuser->id;
        $subCategory->seo_title        = $request->seo_title;
        $subCategory->seo_keywords     = $request->seo_keywords;
        $subCategory->status           = $request->status;
        $subCategory->description      = $request->description;
        $subCategory->seo_description  = $request->seo_description;
        $subCategory->tags             = $request->tags ? json_encode(array_map('trim', explode(',', $request->tags))) : null;

        /* ---------- VIDEO / FILE ---------- */
        if ($request->hasFile('file_path')) {
            // Remove old file if exists
            if ($subCategory->file_path && file_exists(public_path('assets/subcategory/video/' . $subCategory->file_path))) {
                unlink(public_path('assets/subcategory/video/' . $subCategory->file_path));
            }

            $file = $request->file('file_path');
            $fileName = time() . '_vid_' . $file->getClientOriginalName();
            $file->move(public_path('assets/subcategory/video'), $fileName);
            $subCategory->file_path = $fileName;
        }

        /* ---------- IMAGE ---------- */
        if ($request->hasFile('image_path')) {
            // Remove old image if exists
            if ($subCategory->image_path && file_exists(public_path('assets/subcategory/image/' . $subCategory->image_path))) {
                unlink(public_path('assets/subcategory/image/' . $subCategory->image_path));
            }

            $image = $request->file('image_path');
            $imageName = time() . '_img_' . $image->getClientOriginalName();
            $image->move(public_path('assets/subcategory/image'), $imageName);
            $subCategory->image_path = $imageName;
        }

        /* ---------- AUDIO ---------- */
        if ($request->hasFile('audio_path')) {
            // Remove old audio if exists
            if ($subCategory->audio_path && file_exists(public_path('assets/subcategory/audio/' . $subCategory->audio_path))) {
                unlink(public_path('assets/subcategory/audio/' . $subCategory->audio_path));
            }

            $audio = $request->file('audio_path');
            $audioName = time() . '_aud_' . $audio->getClientOriginalName();
            $audio->move(public_path('assets/subcategory/audio'), $audioName);
            $subCategory->audio_path = $audioName;
        }

        // Save updates
        $subCategory->save();

        return redirect()->route('subcategory.index')->with('success', 'SubCategory updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $subCategory = SubCategory::findOrFail($id);

        if ($subCategory) {
            // Delete old video if exists
            if (!empty($subCategory->file_path) && file_exists(public_path('assets/subcategory/video/' . $subCategory->file_path))) {
                unlink(public_path('assets/subcategory/video/' . $subCategory->file_path));
            }

            if (!empty($subCategory->image_path) && file_exists(public_path('assets/subcategory/image/' . $subCategory->image_path))) {
                unlink(public_path('assets/subcategory/image/' . $subCategory->image_path));
            }

            // Delete old audio if exists
            if (!empty($subCategory->audio_path) && file_exists(public_path('assets/subcategory/audio/' . $subCategory->audio_path))) {
                unlink(public_path('assets/subcategory/audio/' . $subCategory->audio_path));
            }

            $subCategory->delete();
        }

        return redirect()->route('subcategory.index')->with('danger', 'SubCategory Deleted  successfully!');
    }
}
