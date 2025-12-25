<?php

namespace App\Http\Controllers;

use App\Models\AdoptionRequest;
use App\Models\Pet;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'pets' => Pet::count(),
            'adoptions' => AdoptionRequest::count(),
            'availablePets' => Pet::where('status', 'available')->count(),
            'adoptedPets' => Pet::where('status', 'adopted')->count(),
        ];

        $recentPets = Pet::with(['shelter', 'category'])->latest('pets.id')->take(5)->get();
        $recentAdoptions = AdoptionRequest::with(['pet', 'user'])->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentPets', 'recentAdoptions'));
    }

    public function pets()
    {
        $pets = Pet::with(['owner', 'shelter', 'category'])->latest()->paginate(20);

        return view('admin.pets', compact('pets'));
    }

    public function updatePetStatus(Request $request, Pet $pet)
    {
        $data = $request->validate([
            'status' => 'required|in:available,pending,adopted',
        ]);

        $pet->update(['status' => $data['status']]);

        return back()->with('success', 'Status hewan diperbarui.');
    }

    public function updatePetImage(Request $request, Pet $pet)
    {
        $data = $request->validate([
            'primary_image' => 'required|image|max:2048',
        ]);

        $path = $data['primary_image']->store('pets', 'public');

        if ($pet->primary_image) {
            $previousPath = str_starts_with($pet->primary_image, '/storage/')
                ? ltrim(str_replace('/storage/', '', $pet->primary_image), '/')
                : ltrim($pet->primary_image, '/');
            Storage::disk('public')->delete($previousPath);
        }

        $pet->update(['primary_image' => $path]);

        return back()->with('success', 'Foto hewan diperbarui.');
    }

    public function editPet(Pet $pet)
    {
        $categories = Category::where('is_active', true)->get();

        return view('admin.edit-pet', compact('pet', 'categories'));
    }

    public function updatePet(Request $request, Pet $pet)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'gender' => 'required|in:male,female',
            'age_years' => 'nullable|integer|min:0',
            'age_months' => 'nullable|integer|min:0|max:11',
            'breed' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:20',
            'color' => 'nullable|string|max:100',
            'weight' => 'nullable|numeric|min:0',
            'description' => 'required|string',
            'health_info' => 'nullable|string',
            'personality' => 'nullable|string',
            'is_vaccinated' => 'nullable|boolean',
            'is_neutered' => 'nullable|boolean',
            'is_house_trained' => 'nullable|boolean',
            'good_with_kids' => 'nullable|boolean',
            'good_with_dogs' => 'nullable|boolean',
            'good_with_cats' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:available,pending,adopted',
        ]);

        $pet->update($data);

        return redirect()->route('admin.pets')->with('success', 'Data hewan berhasil diperbarui.');
    }

    public function adoptions()
    {
        $adoptions = AdoptionRequest::with(['pet', 'user'])->latest()->paginate(20);

        return view('admin.adoptions', compact('adoptions'));
    }

    public function approveAdoption(AdoptionRequest $adoptionRequest)
    {
        $adoptionRequest->approve();

        return back()->with('success', 'Permohonan adopsi disetujui.');
    }

    public function rejectAdoption(Request $request, AdoptionRequest $adoptionRequest)
    {
        $adoptionRequest->reject($request->input('admin_notes'));

        return back()->with('success', 'Permohonan adopsi ditolak.');
    }
}
