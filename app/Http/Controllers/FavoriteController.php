<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Pet $pet)
    {
        $user = Auth::user();

        if ($user->favorites()->where('pet_id', $pet->id)->exists()) {
            $user->favorites()->detach($pet->id);
            return back()->with('success', 'Dihapus dari favorit.');
        } else {
            $user->favorites()->attach($pet->id);
            return back()->with('success', 'Ditambahkan ke favorit!');
        }
    }

    public function index()
    {
        $favorites = Auth::user()->favorites()->with(['shelter', 'category'])->latest()->paginate(20);

        return view('favorites.index', compact('favorites'));
    }
}
