@extends('layouts.app')

@section('title', 'Semua Shelter - PawFriends')

@section('content')
    <!-- Header -->
    <section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="text-white mb-3">Temukan Shelter Terdekat</h1>
                    <p class="text-white-50">Kerjasama dengan shelter terpercaya untuk adopsi hewan yang aman dan bermakna</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Shelters Grid -->
    <section class="py-5">
        <div class="container">
            @if($shelters->count())
                <div class="row g-4">
                    @foreach($shelters as $shelter)
                        <div class="col-lg-4 col-md-6">
                            <div class="card shelter-card h-100 border-0 shadow-sm">
                                <div class="shelter-header" style="height: 200px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);"></div>
                                <div class="card-body position-relative" style="margin-top: -50px;">
                                    <div class="mb-3">
                                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 100px; height: 100px;">
                                            @if($shelter->logo)
                                                <img src="{{ $shelter->logo }}" class="img-fluid rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                                            @else
                                                <i class="bi bi-building" style="font-size: 3rem; color: #667eea;"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <h5 class="card-title mb-1">{{ $shelter->name }}</h5>
                                    @if($shelter->is_verified)
                                        <span class="badge bg-success mb-2"><i class="bi bi-check-circle"></i> Terverifikasi</span>
                                    @endif
                                    <p class="text-muted small mb-3">
                                        <i class="bi bi-geo-alt"></i> {{ $shelter->city }}, {{ $shelter->province }}
                                    </p>
                                    <p class="card-text small mb-3">{{ Str::limit($shelter->description, 100) }}</p>
                                    
                                    <div class="shelter-info mb-3 pb-3 border-bottom">
                                        <p class="mb-2 small">
                                            <i class="bi bi-telephone"></i> <a href="tel:{{ $shelter->phone }}">{{ $shelter->phone }}</a>
                                        </p>
                                        <p class="mb-2 small">
                                            <i class="bi bi-envelope"></i> <a href="mailto:{{ $shelter->email }}">{{ $shelter->email }}</a>
                                        </p>
                                        @if($shelter->website)
                                            <p class="mb-0 small">
                                                <i class="bi bi-globe"></i> <a href="{{ $shelter->website }}" target="_blank">Website</a>
                                            </p>
                                        @endif
                                    </div>

                                    <div class="shelter-stats mb-3 pb-3 border-bottom">
                                        <p class="mb-0 small text-muted">
                                            <strong>{{ $shelter->pets()->where('status', 'available')->count() }}</strong> hewan tersedia
                                        </p>
                                    </div>

                                    <a href="{{ route('shelters.show', $shelter->id) }}" class="btn btn-primary btn-sm w-100">
                                        <i class="bi bi-arrow-right"></i> Lihat Selengkapnya
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="row mt-5">
                    <div class="col-12">
                        {{ $shelters->links() }}
                    </div>
                </div>
            @else
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i> Tidak ada shelter yang tersedia saat ini.
                </div>
            @endif
        </div>
    </section>
@endsection

<style>
    .shelter-card {
        border-radius: 12px;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .shelter-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15) !important;
    }
</style>
