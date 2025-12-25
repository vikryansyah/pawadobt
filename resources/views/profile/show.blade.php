@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="container py-5">
  <div class="row g-4">
    <!-- Sidebar -->
    <div class="col-lg-3">
      <div class="card border-0 shadow-sm">
        <div class="card-body text-center">
          <div class="mb-3">
            <div class="bg-light rounded-circle mx-auto" style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">
              <svg width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            </div>
          </div>
          <h5 class="fw-bold">{{ auth()->user()->name }}</h5>
          <p class="text-muted">{{ auth()->user()->email }}</p>
          
          <div class="d-grid gap-2 mt-4">
            <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profil</a>
            <a href="{{ route('profile.change-password') }}" class="btn btn-outline-secondary">Ubah Password</a>
            <form method="post" action="{{ route('logout') }}" class="d-grid">
              @csrf
              <button type="submit" class="btn btn-outline-danger">Logout</button>
            </form>
          </div>

          <hr>

          <nav class="nav flex-column">
            <a href="{{ route('profile.show') }}" class="nav-link text-dark active">Dashboard</a>
            <a href="{{ route('adoptions.index') }}" class="nav-link text-dark">Permohonan Adopsi</a>
            <a href="{{ route('pets.mine') }}" class="nav-link text-dark">Hewan Saya</a>
          </nav>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="col-lg-9">
      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
      @endif

      <!-- Profile Info -->
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-bottom">
          <h5 class="mb-0">Informasi Profil</h5>
        </div>
        <div class="card-body">
          <div class="row g-3">
            <div class="col-md-6">
              <small class="text-muted">Nama Lengkap</small>
              <p class="fw-semibold">{{ auth()->user()->name }}</p>
            </div>
            <div class="col-md-6">
              <small class="text-muted">Email</small>
              <p class="fw-semibold">{{ auth()->user()->email }}</p>
            </div>
            <div class="col-md-6">
              <small class="text-muted">Nomor Telepon</small>
              <p class="fw-semibold">{{ auth()->user()->phone ?? 'Belum diisi' }}</p>
            </div>
            <div class="col-md-6">
              <small class="text-muted">Alamat</small>
              <p class="fw-semibold">{{ auth()->user()->address ?? 'Belum diisi' }}</p>
            </div>
            <div class="col-12">
              <small class="text-muted">Bio</small>
              <p class="fw-semibold">{{ auth()->user()->bio ?? 'Belum diisi' }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Adoptions -->
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Permohonan Adopsi Terbaru</h5>
          <a href="{{ route('adoptions.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
        </div>
        <div class="card-body">
          @forelse($adoptions->take(3) as $adoption)
            <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
              <div>
                <h6 class="fw-semibold mb-1">{{ $adoption->pet->name ?? '-' }}</h6>
                <small class="text-muted">{{ $adoption->shelter->name ?? '-' }} · {{ $adoption->created_at->format('d M Y') }}</small>
              </div>
              <span class="badge text-bg-{{ $adoption->status === 'pending' ? 'warning' : ($adoption->status === 'approved' ? 'success' : ($adoption->status === 'completed' ? 'info' : 'danger')) }} text-capitalize">{{ $adoption->status }}</span>
            </div>
          @empty
            <p class="text-muted">Belum ada permohonan adopsi.</p>
          @endforelse
        </div>
      </div>

      <!-- Recent Pets -->
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Hewan Saya</h5>
          <a href="{{ route('pets.create') }}" class="btn btn-sm btn-primary">Tambah Hewan</a>
        </div>
        <div class="card-body">
          @forelse($pets->take(3) as $pet)
            <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
              <div>
                <h6 class="fw-semibold mb-1">{{ $pet->name }}</h6>
                <small class="text-muted">{{ $pet->category->name ?? '-' }} · {{ $pet->breed ?? 'N/A' }}</small>
              </div>
              <span class="badge text-bg-{{ $pet->status === 'available' ? 'success' : ($pet->status === 'pending' ? 'warning' : 'secondary') }} text-capitalize">{{ $pet->status }}</span>
            </div>
          @empty
            <p class="text-muted">Belum ada hewan yang kamu pasang.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
