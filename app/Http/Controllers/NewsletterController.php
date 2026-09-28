<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:newsletter_subscribers,email'],
        ]);

        NewsletterSubscriber::query()->create([
            'email' => $validated['email'],
            'is_active' => true,
            'subscribed_at' => now(),
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Subscribed successfully.',
            ]);
        }

        return back()->with('newsletter_success', 'Subscribed successfully.');
    }
}
