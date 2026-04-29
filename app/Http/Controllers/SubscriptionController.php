<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{

    public function index()
    {
        $subscriptions = Subscription::all();

        return view('pages.subscription.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new Category.
     */
    public function create()
    {


        return view('pages.subscription.add');
    }

    /**
     * Store a newly created Category in storage.
     */
    public function store(Request $request)
    {

        // Validate the request
        $request->validate([
            'title'       => 'required|string',
            'price'         => 'required',
            'post_number'         => 'required',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after:start_date',
        ]);

        $authUser = Auth::user();

        // Create new blog
        $subscriptions = new Subscription();
        $subscriptions->created_by           = $authUser->id;
        $subscriptions->user_id           = $authUser->id;
        $subscriptions->title             = $request->title;
        $subscriptions->duration         = $request->duration;
        $subscriptions->price         = $request->price;
        $subscriptions->post_number         = $request->post_number;
        $subscriptions->start_date         = $request->start_date;
        $subscriptions->end_date         = $request->end_date;
        $subscriptions->is_active            = $request->is_active;
        $subscriptions->description            = $request->description;

        $subscriptions->save();

        return redirect()->route('subscriptions.index')->with('success', 'Subscription created successfully!');
    }


    /**
     * Display the specified Category.
     */
    public function show(string $id)
    {
        $subscription = Subscription::with('user')->findOrFail($id);
        return view('pages.subscription.view', compact('subscription'));
    }

    /**
     * Show the form for editing the specified Category.
     */
    public function edit(string $id)
    {

        $subscription = Subscription::findOrFail($id);

        return view('pages.subscription.edit', compact('subscription'));
    }

    /**
     * Update the specified Category in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request
        $request->validate([
            'title'       => 'required|string',
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after:start_date',
            'price'       => 'required',
            'post_number'       => 'required',
        ]);

        // Create new blog
        $subscriptions =  Subscription::find($id);
        $subscriptions->title             = $request->title;
        $subscriptions->duration         = $request->duration;
        $subscriptions->price         = $request->price;
        $subscriptions->post_number         = $request->post_number;
        $subscriptions->start_date         = $request->start_date;
        $subscriptions->end_date         = $request->end_date;
        $subscriptions->is_active            = $request->is_active;
        $subscriptions->description            = $request->description;

        $subscriptions->save();

        return redirect()->route('subscriptions.index')->with('success', 'Subscription updated successfully!');
    }

    /**
     * Remove the specified Category from storage.
     */
    public function destroy(string $id)
    {

        $subscriptions = Subscription::findOrFail($id);
        if ($subscriptions) {
            $subscriptions->delete();
        }

        return redirect()->route('subscriptions.index')->with('danger', 'Subscription Deleted  successfully!');
    }
}
