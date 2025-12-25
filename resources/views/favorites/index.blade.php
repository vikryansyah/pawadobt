@extends('layouts.app')

@section('title', 'Favorit Saya - PawFriends')

@section('content')
    <div class="container py-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item active" aria-current="page">Favorit Saya</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-12">
                <h1 class="display-5 fw-bold mb-4">💛 Favorit Saya</h1>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($favorites->count())
            <div class="row g-4">
                @foreach($favorites as $pet)
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div class="card pet-card h-100 shadow-sm">
                            <div class="pet-image-wrapper position-relative overflow-hidden" style="height: 250px;">
                                <img src="{{ $pet->primary_image_url }}"
                                     class="card-img-top h-100" style="object-fit: cover;" alt="{{ $pet->name }}">
                                @if($pet->is_featured)
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge bg-warning text-dark"><i class="bi bi-star-fill"></i> Featured</span>
                                    </div>
                                @endif
                                <div class="position-absolute top-0 start-0 m-2">
                                    <span class="badge bg-info">{{ $pet->gender === 'male' ? '♂ Jantan' : '♀ Betina' }}</span>
                                </div>
                                <div class="position-absolute top-0 end-0 m-2">
                                    <form method="post" action="{{ route('favorites.toggle', $pet) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-light rounded-circle p-2" title="Hapus dari favorit">
                                            <i class="bi bi-heart-fill" style="color: #dc3545; font-size: 1.2rem;"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $pet->name }}</h5>
                                <p class="text-muted small">
                                    <i class="bi bi-tag"></i> {{ $pet->category->name }} | {{ $pet->breed }}
                                </p>
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-calendar"></i> {{ $pet->age }}
                                    @if($pet->is_vaccinated)
                                        | <i class="bi bi-check-circle text-success"></i> Sudah divaksin
                                    @endif
                                </p>
                                <p class="card-text small flex-grow-1">{{ Str::limit($pet->description, 100) }}</p>
                                <p class="text-muted small">
                                    <i class="bi bi-building"></i> {{ $pet->shelter->name }}
                                </p>
                                <div class="mt-auto">
                                    <a href="{{ route('pets.show', $pet->slug) }}" class="btn btn-primary btn-sm w-100">
                                        <i class="bi bi-heart"></i> Lihat Detail & Adopsi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row mt-5">
                <div class="col-12">
                    {{ $favorites->links() }}
                </div>
            </div>
        @else
            <div class="alert alert-info text-center py-5">
                <p class="mb-3">
                    <i class="bi bi-heart" style="font-size: 3rem; color: #6c757d;"></i>
                </p>
                <h5>Belum ada favorit</h5>
                <p class="text-muted mb-3">Jelajahi hewan-hewan yang tersedia dan tambahkan ke favorit untuk menyimpannya.</p>
                <a href="{{ route('pets.index') }}" class="btn btn-primary">
                    <i class="bi bi-search"></i> Jelajahi Hewan
                </a>
            </div>
        @endif
    </div>
@endsection
