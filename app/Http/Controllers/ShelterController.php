<?php

namespace App\Http\Controllers;

use App\Models\Shelter;
use Illuminate\Http\Request;

class ShelterController extends Controller
{
    public function index()
    {
        $shelters = Shelter::where('is_active', true)
            ->where('is_verified', true)
            ->withCount('availablePets')
            ->latest()
            ->paginate(12);

        return view('shelters.index', compact('shelters'));
    }

    public function show($id)
    {
        $shelter = Shelter::with(['pets' => function($query) {
                $query->available()->latest();
            }])
            ->where('id', $id)
            ->where('is_active', true)
            ->firstOrFail();

        $stats = [
            'total_pets' => $shelter->pets()->count(),
            'available_pets' => $shelter->availablePets()->count(),
            'adopted_pets' => $shelter->pets()->where('status', 'adopted')->count(),
        ];

        return view('shelters.show', compact('shelter', 'stats'));
    }

    public function create()
    {
        return view('shelters.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'description' => 'nullable|string',
            'website' => 'nullable|url',
        ]);

        $validated['user_id'] = auth()->id();

        Shelter::create($validated);

        return redirect()->route('home')
            ->with('success', 'Shelter berhasil didaftarkan! Mohon tunggu verifikasi dari admin.');
    }
}
