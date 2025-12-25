@extends('layouts.admin')

@section('title', 'Kelola Hewan')

@section('content')
<div class="d-flex" style="min-height: 100vh; background: #f5f7fa;">
  <!-- Sidebar -->
  <div class="bg-dark text-light" style="width: 260px; position: fixed; left: 0; top: 0; bottom: 0; overflow-y: auto; padding-top: 20px; z-index: 1000;">
    <div class="px-3 mb-4">
      <h5 class="text-warning fw-bold">PawAdmin</h5>
    </div>
    <nav class="nav flex-column">
      <a href="{{ route('admin.dashboard') }}" class="nav-link text-light">Dashboard</a>
      <a href="{{ route('admin.pets') }}" class="nav-link text-light active">Kelola Hewan</a>
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
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h1 class="fw-bold">Kelola Hewan</h1>
      <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">← Dashboard</a>
    </div>

    @if($errors->any())
      <div class="alert alert-danger alert-dismissible fade show">
        {{ $errors->first() }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    <div class="card border-0 shadow-sm">
      <div class="table-responsive">
        <table class="table mb-0 align-middle">
          <thead class="table-light">
            <tr>
              <th>Nama</th>
              <th>Kategori</th>
              <th>Pemilik</th>
              <th>Shelter</th>
              <th>Foto</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pets as $pet)
              <tr>
                <td class="fw-semibold">{{ $pet->name }}</td>
                <td>{{ $pet->category->name ?? '-' }}</td>
                <td>{{ $pet->owner->name ?? 'Shelter' }}</td>
                <td>{{ $pet->shelter->name ?? '-' }}</td>
                  <td style="min-width: 260px;">
                    <div class="d-flex align-items-center gap-3">
                      @php
                        $imageSrc = $pet->primary_image
                          ? (\Illuminate\Support\Str::startsWith($pet->primary_image, ['http://','https://'])
                              ? $pet->primary_image
                              : (\Illuminate\Support\Str::startsWith($pet->primary_image, '/storage/')
                                  ? $pet->primary_image
                                  : asset('storage/'.$pet->primary_image)))
                          : 'https://via.placeholder.com/160x120?text=No+Image';
                      @endphp
                      <img src="{{ $imageSrc }}" alt="{{ $pet->name }}" class="rounded" style="width: 110px; height: 80px; object-fit: cover;">
                      <form method="post" action="{{ route('admin.pets.image', $pet) }}" enctype="multipart/form-data" class="d-flex flex-column gap-2" style="max-width: 140px;">
                        @csrf
                        <input type="file" name="primary_image" accept="image/*" class="form-control form-control-sm" required>
                        <small class="text-muted" style="font-size: 11px;">Maks 2MB (jpg/png/webp)</small>
                        <button type="submit" class="btn btn-sm btn-outline-secondary">Ubah Foto</button>
                      </form>
                    </div>
                  </td>
                <td>
                  <form method="post" action="{{ route('admin.pets.status', $pet) }}" class="d-flex align-items-center gap-2">
                    @csrf
                    <select name="status" class="form-select form-select-sm" style="max-width: 130px;">
                      <option value="available" @selected($pet->status === 'available')>Available</option>
                      <option value="pending" @selected($pet->status === 'pending')>Pending</option>
                      <option value="adopted" @selected($pet->status === 'adopted')>Adopted</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                  </form>
                </td>
                <td>
                  <div class="d-flex gap-2">
                    <a href="{{ route('admin.pets.edit', $pet) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                    <a href="{{ route('pets.show', $pet->slug) }}" class="btn btn-sm btn-outline-primary">Lihat</a>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-body">
        {{ $pets->links() }}
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
</style>
@endsection
