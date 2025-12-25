<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Category;
use App\Models\Shelter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetController extends Controller
{
    public function index(Request $request)
    {
        $query = Pet::with(['shelter', 'category'])->available();

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('size')) {
            $query->where('size', $request->size);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('breed', 'like', '%' . $search . '%');
            });
        }

        $pets = $query->latest()->paginate(20);
        $categories = Category::where('is_active', true)->get();

        return view('pets.index', compact('pets', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();

        return view('pets.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
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
        ]);

        $communityShelter = Shelter::firstOrCreate(
            ['email' => 'community@shelter.local'],
            [
                'name' => 'Community Listings',
                'phone' => '000-0000000',
                'address' => 'Online only',
                'city' => 'Virtual',
                'province' => 'N/A',
                'description' => 'Shelter placeholder untuk pemilik individu.',
                'is_verified' => true,
                'is_active' => true,
            ]
        );

        $pet = Pet::create([
            ...$validated,
            'shelter_id' => $communityShelter->id,
            'owner_id' => Auth::id(),
            'status' => 'available',
        ]);

        return redirect()->route('pets.show', $pet->slug)
            ->with('success', 'Hewan berhasil ditambahkan dan menunggu adopter.');
    }

    public function show($slug)
    {
        $pet = Pet::with(['shelter', 'category'])
            ->where('slug', $slug)
            ->firstOrFail();

        $pet->incrementViews();

        $similarPets = Pet::with(['shelter', 'category'])
            ->where('category_id', $pet->category_id)
            ->where('id', '!=', $pet->id)
            ->available()
            ->take(4)
            ->get();

        return view('pets.show', compact('pet', 'similarPets'));
    }

    public function mine()
    {
        $pets = Pet::with(['shelter', 'category'])
            ->where('owner_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('pets.mine', compact('pets'));
    }

    public function byCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        
        $pets = Pet::with(['shelter', 'category'])
            ->where('category_id', $category->id)
            ->available()
            ->latest()
            ->paginate(20);

        return view('pets.category', compact('pets', 'category'));
    }
}
