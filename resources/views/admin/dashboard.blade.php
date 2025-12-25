@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-flex" style="min-height: 100vh; background: #f5f7fa;">
  <!-- Sidebar -->
  <div class="bg-dark text-light" style="width: 260px; position: fixed; left: 0; top: 0; bottom: 0; overflow-y: auto; padding-top: 20px; z-index: 1000;">
    <div class="px-3 mb-4">
      <h5 class="text-warning fw-bold">PawAdmin</h5>
    </div>
    <nav class="nav flex-column">
      <a href="{{ route('admin.dashboard') }}" class="nav-link text-light active">Dashboard</a>
      <a href="{{ route('admin.pets') }}" class="nav-link text-light">Kelola Hewan</a>
      <a href="{{ route('admin.adoptions') }}" class="nav-link text-light">Permohonan Adopsi</a>
      <a href="{{ route('home') }}" class="nav-link text-light">Kembali ke Beranda</a>
      <hr class="bg-secondary">
      <form method="post" action="{{ route('logout') }}" class="d-inline">
        @csrf
        <button type="submit" class="nav-link text-danger border-0 bg-transparent">Logout</button>
      </form>
    </nav>
  </div>

  <!-- Main Content -->
  <div style="margin-left: 260px; flex: 1; padding: 30px;">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="fw-bold">Dashboard</h1>
      <div class="text-muted">{{ now()->format('d F Y') }}</div>
    </div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
      <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm" style="border-left: 4px solid #FF9F43;">
          <div class="card-body">
            <p class="text-muted mb-1">Total Pengguna</p>
            <h3 class="fw-bold mb-0">{{ $stats['users'] }}</h3>
            <small class="text-success">+2 baru hari ini</small>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm" style="border-left: 4px solid #00D084;">
          <div class="card-body">
            <p class="text-muted mb-1">Total Hewan</p>
            <h3 class="fw-bold mb-0">{{ $stats['pets'] }}</h3>
            <small class="text-success">{{ $stats['availablePets'] }} tersedia</small>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm" style="border-left: 4px solid #FF6B6B;">
          <div class="card-body">
            <p class="text-muted mb-1">Permohonan Adopsi</p>
            <h3 class="fw-bold mb-0">{{ $stats['adoptions'] }}</h3>
            <small class="text-warning">Butuh review</small>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm" style="border-left: 4px solid #1E90FF;">
          <div class="card-body">
            <p class="text-muted mb-1">Hewan Diadopsi</p>
            <h3 class="fw-bold mb-0">{{ $stats['adoptedPets'] ?? 0 }}</h3>
            <small class="text-info">Sukses matched</small>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Data -->
    <div class="row g-4">
      <!-- Recent Pets -->
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-header bg-white border-bottom">
            <h5 class="mb-0">Hewan Terbaru</h5>
          </div>
          <div class="card-body">
            @forelse($recentPets as $pet)
              <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                <div>
                  <h6 class="fw-semibold mb-1">{{ $pet->name }}</h6>
                  <small class="text-muted">{{ $pet->category->name ?? '-' }} • {{ $pet->breed ?? 'N/A' }}</small>
                </div>
                <span class="badge text-bg-{{ $pet->status === 'available' ? 'success' : ($pet->status === 'pending' ? 'warning' : 'secondary') }} text-capitalize">{{ $pet->status }}</span>
              </div>
            @empty
              <p class="text-muted">Belum ada hewan terdaftar.</p>
            @endforelse
            <a href="{{ route('admin.pets') }}" class="btn btn-sm btn-outline-primary">Kelola Semua →</a>
          </div>
        </div>
      </div>

      <!-- Recent Adoptions -->
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100">
          <div class="card-header bg-white border-bottom">
            <h5 class="mb-0">Permohonan Adopsi Terbaru</h5>
          </div>
          <div class="card-body">
            @forelse($recentAdoptions as $adoption)
              <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
                <div>
                  <h6 class="fw-semibold mb-1">{{ $adoption->user->name ?? '-' }}</h6>
                  <small class="text-muted">Hewan: {{ $adoption->pet->name ?? '-' }}</small>
                </div>
                <span class="badge text-bg-{{ $adoption->status === 'pending' ? 'warning' : ($adoption->status === 'approved' ? 'success' : 'danger') }} text-capitalize">{{ $adoption->status }}</span>
              </div>
            @empty
              <p class="text-muted">Belum ada permohonan adopsi.</p>
            @endforelse
            <a href="{{ route('admin.adoptions') }}" class="btn btn-sm btn-outline-primary">Kelola Semua →</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-4 mt-2">
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white border-bottom">
            <h5 class="mb-0">Tindakan Cepat</h5>
          </div>
          <div class="card-body">
            <a href="{{ route('pets.create') }}" class="btn btn-sm btn-outline-primary me-2">Tambah Hewan</a>
            <a href="{{ route('admin.pets') }}" class="btn btn-sm btn-outline-secondary me-2">Review Hewan</a>
            <a href="{{ route('admin.adoptions') }}" class="btn btn-sm btn-outline-warning">Review Adopsi</a>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-white border-bottom">
            <h5 class="mb-0">Statistik Cepat</h5>
          </div>
          <div class="card-body">
            <div class="row text-center">
              <div class="col-4">
                <h4 class="fw-bold">{{ $stats['availablePets'] }}</h4>
                <small class="text-muted">Tersedia</small>
              </div>
              <div class="col-4">
                <h4 class="fw-bold">{{ $stats['adoptedPets'] ?? 0 }}</h4>
                <small class="text-muted">Diadopsi</small>
              </div>
              <div class="col-4">
                <h4 class="fw-bold">{{ $stats['users'] }}</h4>
                <small class="text-muted">Pengguna</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .nav-link {
    padding: 0.75rem 1rem;
    border-radius: 0.25rem;
    transition: all 0.3s;
    margin-bottom: 0.25rem;
  }
  .nav-link:hover {
    background: rgba(255, 255, 255, 0.1);
    margin-left: 0.25rem;
  }
  .nav-link.active {
    background: #FF9F43;
    color: white !important;
  }
  .card {
    transition: transform 0.3s, box-shadow 0.3s;
  }
  .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1) !important;
  }
</style>
@endsection

