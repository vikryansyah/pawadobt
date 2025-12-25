@extends('layouts.app')

@section('title', 'Semua Hewan - PawFriends')

@section('content')
    <!-- Search & Filter Section -->
    <section class="py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="text-white mb-4">Cari Hewan Peliharaan Anda</h1>
                    <form action="{{ route('search') }}" method="GET" class="row g-2">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Nama hewan..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="category" class="form-select">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->slug }}" {{ request('category') === $category->slug ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="size" class="form-select">
                                <option value="">Semua Ukuran</option>
                                <option value="small" {{ request('size') === 'small' ? 'selected' : '' }}>Kecil</option>
                                <option value="medium" {{ request('size') === 'medium' ? 'selected' : '' }}>Sedang</option>
                                <option value="large" {{ request('size') === 'large' ? 'selected' : '' }}>Besar</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-light w-100">
                                <i class="bi bi-search"></i> Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Pets Grid -->
    <section class="py-5">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="mb-2">Daftar Hewan untuk Adopsi</h2>
                    <p class="text-muted">Total: <strong>{{ $pets->total() }}</strong> hewan tersedia</p>
                </div>
            </div>

            @if($pets->count())
                <div class="row g-4">
                    @foreach($pets as $pet)
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
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $pet->name }}</h5>
                                    <p class="text-muted small">
                                        <i class="bi bi-tag"></i> {{ $pet->category->name }} | {{ $pet->breed }}
                                    </p>
                                    <p class="text-muted small mb-2">
                                        <i class="bi bi-calendar"></i> {{ $pet->age }} tahun
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
                        {{ $pets->links() }}
                    </div>
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    <i class="bi bi-info-circle"></i> Tidak ada hewan yang sesuai dengan pencarian Anda. Coba lagi dengan kriteria berbeda.
                </div>
            @endif
        </div>
    </section>
@endsection

<style>
    .pet-card {
        border: none;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .pet-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15) !important;
    }
</style>
