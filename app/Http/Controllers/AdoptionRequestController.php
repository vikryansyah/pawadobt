<?php

namespace App\Http\Controllers;

use App\Models\AdoptionRequest;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdoptionRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $requests = AdoptionRequest::with(['pet', 'shelter'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('adoption.index', compact('requests'));
    }

    public function create(Pet $pet)
    {
        if ($pet->status !== 'available') {
            return redirect()->route('pets.show', $pet->slug)
                ->with('error', 'Hewan ini sudah tidak tersedia untuk diadopsi.');
        }

        $existingRequest = AdoptionRequest::where('user_id', Auth::id())
            ->where('pet_id', $pet->id)
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            return redirect()->route('pets.show', $pet->slug)
                ->with('error', 'Anda sudah memiliki permohonan adopsi yang sedang diproses untuk hewan ini.');
        }

        return view('adoption.create', compact('pet'));
    }

    public function store(Request $request, Pet $pet)
    {
        $validated = $request->validate([
            'applicant_name' => 'required|string|max:255',
            'applicant_email' => 'required|email',
            'applicant_phone' => 'required|string|max:20',
            'applicant_address' => 'required|string',
            'occupation' => 'nullable|string|max:255',
            'home_type' => 'nullable|string',
            'has_yard' => 'boolean',
            'experience' => 'nullable|string',
            'why_adopt' => 'required|string',
            'other_pets' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['pet_id'] = $pet->id;
        $validated['shelter_id'] = $pet->shelter_id;
        $validated['has_yard'] = $request->has('has_yard');

        AdoptionRequest::create($validated);

        return redirect()->route('adoptions.index')
            ->with('success', 'Permohonan adopsi berhasil dikirim! Shelter akan segera menghubungi Anda.');
    }

    public function show(AdoptionRequest $adoptionRequest)
    {
        if ($adoptionRequest->user_id !== Auth::id()) {
            abort(403);
        }

        $adoptionRequest->load(['pet', 'shelter']);

        return view('adoption.show', compact('adoptionRequest'));
    }

    public function cancel(AdoptionRequest $adoptionRequest)
    {
        if ($adoptionRequest->user_id !== Auth::id()) {
            abort(403);
        }

        if ($adoptionRequest->status !== 'pending') {
            return redirect()->back()
                ->with('error', 'Permohonan adopsi ini tidak dapat dibatalkan.');
        }

        $adoptionRequest->delete();

        return redirect()->route('adoptions.index')
            ->with('success', 'Permohonan adopsi berhasil dibatalkan.');
    }
}
