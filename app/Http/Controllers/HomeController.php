<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Category;
use App\Models\Shelter;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPets = Pet::with(['shelter', 'category'])
            ->available()
            ->featured()
            ->latest()
            ->take(8)
            ->get();

        $latestPets = Pet::with(['shelter', 'category'])
            ->available()
            ->latest()
            ->take(10)
            ->get();

        $popularPets = Pet::with(['shelter', 'category'])
            ->available()
            ->orderBy('views', 'desc')
            ->take(8)
            ->get();

        $categories = Category::where('is_active', true)
            ->withCount('activePets')
            ->get();

        $stats = [
            'total_pets' => Pet::available()->count(),
            'total_adopted' => Pet::where('status', 'adopted')->count(),
            'total_shelters' => Shelter::where('is_active', true)->count(),
        ];

        return view('home', compact('featuredPets', 'latestPets', 'popularPets', 'categories', 'stats'));
    }

    public function search(Request $request)
    {
        $query = Pet::with(['shelter', 'category'])->available();

        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('size')) {
            $query->where('size', $request->size);
        }

        if ($request->filled('city')) {
            $query->whereHas('shelter', function($q) use ($request) {
                $q->where('city', 'like', '%' . $request->city . '%');
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('breed', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $pets = $query->paginate(20);
        $categories = Category::where('is_active', true)->get();

        return view('pets.search', compact('pets', 'categories'));
    }
}
