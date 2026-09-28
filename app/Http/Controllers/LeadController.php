<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'help_category' => ['nullable', 'string', 'max:100'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'company' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:5000'],
            'source' => ['nullable', 'string', 'max:50'],
        ]);

        Lead::query()->create([
            'help_category' => $validated['help_category'] ?? null,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'company' => $validated['company'] ?? null,
            'message' => $validated['message'] ?? null,
            'source' => $validated['source'] ?? 'homepage',
            'status' => 'new',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you. We received your message and will be in touch soon.',
        ]);
    }
}
