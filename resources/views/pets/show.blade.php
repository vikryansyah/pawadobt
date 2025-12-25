@extends('layouts.app')

@section('title', $pet->name . ' - PawFriends')

@section('content')
    <div class="container py-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pets.index') }}">Semua Hewan</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pets.category', $pet->category->slug) }}">{{ $pet->category->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $pet->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Image Gallery -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm mb-4">
                    <img src="{{ $pet->primary_image_url }}"
                         class="card-img-top" alt="{{ $pet->name }}" style="height: 500px; object-fit: cover;">
                </div>
                @if($pet->images)
                    <div class="row g-2">
                        @foreach(json_decode($pet->images, true) ?? [] as $image)
                            <div class="col-3">
                                <img src="{{ $image }}" class="img-fluid rounded" alt="{{ $pet->name }}" style="height: 120px; object-fit: cover; cursor: pointer;">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Pet Details -->
            <div class="col-lg-6">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h1 class="display-5 mb-2">{{ $pet->name }}</h1>
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <span class="badge bg-primary">{{ $pet->category->name }}</span>
                                <span class="badge bg-info">{{ $pet->gender === 'male' ? '♂ Jantan' : '♀ Betina' }}</span>
                                @if($pet->is_featured)
                                    <span class="badge bg-warning text-dark"><i class="bi bi-star-fill"></i> Featured</span>
                                @endif
                            </div>
                        </div>
                        @auth
                            <form method="post" action="{{ route('favorites.toggle', $pet) }}" style="display: inline;">
                                @csrf
                                @php
                                    $isFavorited = auth()->user()->favorites()->where('pet_id', $pet->id)->exists();
                                @endphp
                                <button type="submit" class="btn btn-lg p-0" style="border: none; background: none;">
                                    <i class="bi bi-heart-fill" style="font-size: 2rem; color: {{ $isFavorited ? '#dc3545' : '#ddd' }};"></i>
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>

                <!-- Key Information -->
                <div class="card border-0 bg-light mb-4">
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-4">
                                <h5 class="mb-0">{{ $pet->age }}</h5>
                                <small class="text-muted">Usia</small>
                            </div>
                            <div class="col-4">
                                <h5 class="mb-0">{{ $pet->breed }}</h5>
                                <small class="text-muted">Ras</small>
                            </div>
                            <div class="col-4">
                                <h5 class="mb-0">{{ $pet->weight }} kg</h5>
                                <small class="text-muted">Berat</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Health & Personality -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-heart-pulse"></i> Informasi Kesehatan & Kepribadian</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-6">
                                @if($pet->is_vaccinated)
                                    <p class="mb-2"><i class="bi bi-check-circle text-success"></i> <strong>Sudah Divaksin</strong></p>
                                @else
                                    <p class="mb-2"><i class="bi bi-x-circle text-danger"></i> <strong>Belum Divaksin</strong></p>
                                @endif
                                @if($pet->is_neutered)
                                    <p class="mb-2"><i class="bi bi-check-circle text-success"></i> <strong>Sudah Disteril</strong></p>
                                @else
                                    <p class="mb-2"><i class="bi bi-x-circle text-danger"></i> <strong>Belum Disteril</strong></p>
                                @endif
                            </div>
                            <div class="col-6">
                                @if($pet->is_house_trained)
                                    <p class="mb-2"><i class="bi bi-check-circle text-success"></i> <strong>Terlatih di Rumah</strong></p>
                                @else
                                    <p class="mb-2"><i class="bi bi-x-circle text-danger"></i> <strong>Perlu Pelatihan</strong></p>
                                @endif
                                <p class="mb-0"><i class="bi bi-eye"></i> <strong>{{ $pet->views }}</strong> Kali Dilihat</p>
                            </div>
                        </div>
                        <hr>
                        <h6 class="mb-2"><strong>Kepribadian:</strong></h6>
                        <p>{{ $pet->personality }}</p>
                        <h6 class="mb-2"><strong>Kesehatan:</strong></h6>
                        <p>{{ $pet->health_info }}</p>
                    </div>
                </div>

                <!-- Compatibility -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="bi bi-people"></i> Kompatibilitas</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-4">
                                @if($pet->good_with_kids)
                                    <i class="bi bi-check-circle text-success" style="font-size: 2rem;"></i><br>
                                    <small class="text-muted">Cocok dengan Anak-anak</small>
                                @else
                                    <i class="bi bi-x-circle text-danger" style="font-size: 2rem;"></i><br>
                                    <small class="text-muted">Tidak Cocok Anak-anak</small>
                                @endif
                            </div>
                            <div class="col-4">
                                @if($pet->good_with_dogs)
                                    <i class="bi bi-check-circle text-success" style="font-size: 2rem;"></i><br>
                                    <small class="text-muted">Cocok dengan Anjing</small>
                                @else
                                    <i class="bi bi-x-circle text-danger" style="font-size: 2rem;"></i><br>
                                    <small class="text-muted">Tidak Cocok Anjing</small>
                                @endif
                            </div>
                            <div class="col-4">
                                @if($pet->good_with_cats)
                                    <i class="bi bi-check-circle text-success" style="font-size: 2rem;"></i><br>
                                    <small class="text-muted">Cocok dengan Kucing</small>
                                @else
                                    <i class="bi bi-x-circle text-danger" style="font-size: 2rem;"></i><br>
                                    <small class="text-muted">Tidak Cocok Kucing</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shelter Info -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="bi bi-building"></i> Informasi Shelter</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-2"><strong>{{ $pet->shelter->name }}</strong></h6>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-geo-alt"></i> {{ $pet->shelter->address }}, {{ $pet->shelter->city }}
                        </p>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-telephone"></i> {{ $pet->shelter->phone }}
                        </p>
                        <p class="text-muted small">
                            <i class="bi bi-envelope"></i> {{ $pet->shelter->email }}
                        </p>
                        <a href="{{ route('shelters.show', $pet->shelter->id) }}" class="btn btn-outline-info btn-sm mt-2">
                            Lihat Shelter
                        </a>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="d-grid gap-2 mb-4">
                    @auth
                        <a href="{{ route('adoptions.create', $pet->id) }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-heart-fill"></i> Ajukan Adopsi
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-heart-fill"></i> Login untuk Adopsi
                        </a>
                    @endauth
                    <a href="{{ route('shelters.show', $pet->shelter->id) }}" class="btn btn-outline-secondary btn-lg">
                        <i class="bi bi-chat-dots"></i> Hubungi Shelter
                    </a>
                </div>
            </div>
        </div>

        <!-- Description Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-book"></i> Tentang {{ $pet->name }}</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $pet->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
