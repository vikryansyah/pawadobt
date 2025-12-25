@extends('layouts.app')

@section('title', $shelter->name . ' - PawFriends')

@section('content')
    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('shelters.index') }}">Semua Shelter</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $shelter->name }}</li>
            </ol>
        </nav>

        <!-- Shelter Header -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-lg overflow-hidden">
                    <div class="shelter-header" style="height: 300px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>
                    <div class="card-body position-relative" style="margin-top: -80px;">
                        <div class="row">
                            <div class="col-lg-3 mb-3 mb-lg-0">
                                <div class="bg-light rounded p-3 text-center">
                                    @if($shelter->logo)
                                        <img src="{{ $shelter->logo }}" class="img-fluid rounded" style="max-height: 150px;">
                                    @else
                                        <i class="bi bi-building" style="font-size: 5rem; color: #667eea;"></i>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <h1 class="mb-2">{{ $shelter->name }}</h1>
                                @if($shelter->is_verified)
                                    <span class="badge bg-success mb-3"><i class="bi bi-check-circle"></i> Terverifikasi</span>
                                @endif
                                <p class="text-muted mb-3">{{ $shelter->description }}</p>
                                
                                <div class="row g-3 mb-3">
                                    <div class="col-md-3">
                                        <div class="bg-light p-3 rounded">
                                            <h5 class="mb-0">{{ $shelter->pets()->where('status', 'available')->count() }}</h5>
                                            <small class="text-muted">Hewan Tersedia</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="bg-light p-3 rounded">
                                            <h5 class="mb-0">{{ $shelter->pets()->count() }}</h5>
                                            <small class="text-muted">Total Hewan</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="bg-light p-3 rounded">
                                            <h5 class="mb-0">{{ $shelter->adoptionRequests()->count() }}</h5>
                                            <small class="text-muted">Permintaan Adopsi</small>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="bg-light p-3 rounded">
                                            <h5 class="mb-0">{{ $shelter->adoptionRequests()->where('status', 'completed')->count() }}</h5>
                                            <small class="text-muted">Adopsi Berhasil</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact & Location Info -->
        <div class="row mb-5">
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-telephone"></i> Hubungi Kami</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2">
                            <strong>Telepon:</strong><br>
                            <a href="tel:{{ $shelter->phone }}" class="link-primary">{{ $shelter->phone }}</a>
                        </p>
                        <p class="mb-2">
                            <strong>Email:</strong><br>
                            <a href="mailto:{{ $shelter->email }}" class="link-primary">{{ $shelter->email }}</a>
                        </p>
                        @if($shelter->website)
                            <p class="mb-0">
                                <strong>Website:</strong><br>
                                <a href="{{ $shelter->website }}" target="_blank" class="link-primary">{{ $shelter->website }}</a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-8 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="bi bi-geo-alt"></i> Lokasi</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2">
                            <strong>Alamat:</strong><br>
                            {{ $shelter->address }}<br>
                            {{ $shelter->postal_code }} {{ $shelter->city }}, {{ $shelter->province }}
                        </p>
                        @if($shelter->latitude && $shelter->longitude)
                            <div id="map" style="height: 300px; border-radius: 8px;"></div>
                            <small class="text-muted d-block mt-2">
                                Koordinat: {{ $shelter->latitude }}, {{ $shelter->longitude }}
                            </small>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Hewan di Shelter Ini -->
        <div class="row mb-5">
            <div class="col-12">
                <h2 class="mb-4">Hewan di Shelter Ini</h2>
                @if($shelter->pets()->where('status', 'available')->count() > 0)
                    <div class="row g-4">
                        @foreach($shelter->pets()->where('status', 'available')->latest()->get() as $pet)
                            <div class="col-lg-3 col-md-6">
                                <div class="card pet-card h-100 border-0 shadow-sm">
                                    <div class="pet-image-wrapper position-relative overflow-hidden" style="height: 250px;">
                                            <img src="{{ $pet->primary_image_url }}" 
                                             class="card-img-top h-100" style="object-fit: cover;" alt="{{ $pet->name }}">
                                        @if($pet->is_featured)
                                            <div class="position-absolute top-0 end-0 m-2">
                                                <span class="badge bg-warning text-dark"><i class="bi bi-star-fill"></i> Featured</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $pet->name }}</h5>
                                        <p class="text-muted small mb-2">
                                            <i class="bi bi-tag"></i> {{ $pet->category->name }} | {{ $pet->breed }}
                                        </p>
                                        <p class="text-muted small mb-3">
                                            <i class="bi bi-calendar"></i> {{ $pet->age }} tahun
                                            @if($pet->is_vaccinated)
                                                | <i class="bi bi-check-circle text-success"></i> Vaksin
                                            @endif
                                        </p>
                                        <p class="card-text small flex-grow-1">{{ Str::limit($pet->description, 80) }}</p>
                                        <a href="{{ route('pets.show', $pet->slug) }}" class="btn btn-primary btn-sm w-100 mt-auto">
                                            <i class="bi bi-heart"></i> Lihat Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> Tidak ada hewan yang tersedia untuk adopsi dari shelter ini saat ini.
                    </div>
                @endif
            </div>
        </div>

        <!-- CTA Section -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body py-5 text-center text-white">
                        <h3 class="mb-3">Ingin Menjadi Relawan?</h3>
                        <p class="mb-4 lead">Bantu kami menyelamatkan lebih banyak hewan dengan bergabung sebagai relawan.</p>
                        <a href="mailto:{{ $shelter->email }}" class="btn btn-light btn-lg">
                            <i class="bi bi-envelope"></i> Hubungi {{ $shelter->name }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .pet-card {
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .pet-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15) !important;
    }
</style>

@push('scripts')
    @if($shelter->latitude && $shelter->longitude)
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script>
            const map = L.map('map').setView([{{ $shelter->latitude }}, {{ $shelter->longitude }}], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            L.marker([{{ $shelter->latitude }}, {{ $shelter->longitude }}]).addTo(map)
                .bindPopup('<strong>{{ $shelter->name }}</strong><br>{{ $shelter->city }}');
        </script>
    @endif
@endpush
