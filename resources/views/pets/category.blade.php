@extends('layouts.app')

@section('title', $category->name . ' - PawFriends')

@section('content')
<div class="container py-5">
  <h1 class="h4 mb-4">{{ $category->name }}</h1>
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    @forelse($pets as $pet)
      <div class="col">
        <div class="card h-100 shadow-sm">
          <img src="{{ $pet->primary_image_url }}" class="card-img-top" alt="{{ $pet->name }}">
          <div class="card-body">
            <h5 class="card-title">{{ $pet->name }}</h5>
            <p class="text-muted small mb-1">{{ $pet->breed }}</p>
            <p class="text-muted small mb-2">{{ $pet->age }} • {{ $pet->gender == 'male' ? 'Jantan' : 'Betina' }}</p>
            <a href="{{ route('pets.show', $pet->slug) }}" class="btn btn-outline-primary btn-sm">Detail</a>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-info">Tidak ada hewan di kategori ini.</div>
      </div>
    @endforelse
  </div>
  <div class="mt-4">{{ $pets->links() }}</div>
</div>
@endsection
