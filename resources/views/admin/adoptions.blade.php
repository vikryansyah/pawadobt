@extends('layouts.admin')

@section('title', 'Kelola Permohonan Adopsi')

@section('content')
<div class="d-flex" style="min-height: 100vh; background: #f5f7fa;">
  <!-- Sidebar -->
  <div class="bg-dark text-light" style="width: 260px; position: fixed; left: 0; top: 0; bottom: 0; overflow-y: auto; padding-top: 20px; z-index: 1000;">
    <div class="px-3 mb-4">
      <h5 class="text-warning fw-bold">PawAdmin</h5>
    </div>
    <nav class="nav flex-column">
      <a href="{{ route('admin.dashboard') }}" class="nav-link text-light">Dashboard</a>
      <a href="{{ route('admin.pets') }}" class="nav-link text-light">Kelola Hewan</a>
      <a href="{{ route('admin.adoptions') }}" class="nav-link text-light active">Permohonan Adopsi</a>
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
      <h1 class="fw-bold">Permohonan Adopsi</h1>
      <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">← Dashboard</a>
    </div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    <div class="card border-0 shadow-sm">
      <div class="table-responsive">
        <table class="table mb-0 align-middle">
          <thead class="table-light">
            <tr>
              <th>Pelamar</th>
              <th>Hewan</th>
              <th>Email</th>
              <th>Status</th>
              <th>Diajukan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($adoptions as $adoption)
              <tr>
                <td class="fw-semibold">{{ $adoption->user->name ?? '-' }}</td>
                <td>{{ $adoption->pet->name ?? '-' }}</td>
                <td><small>{{ $adoption->applicant_email }}</small></td>
                <td>
                  <span class="badge text-bg-{{ $adoption->status === 'pending' ? 'warning' : ($adoption->status === 'approved' ? 'success' : ($adoption->status === 'completed' ? 'info' : 'danger')) }} text-capitalize">{{ $adoption->status }}</span>
                </td>
                <td><small>{{ $adoption->created_at->format('d M Y') }}</small></td>
                <td>
                  @if($adoption->status === 'pending')
                    <div class="d-flex gap-2">
                      <form method="post" action="{{ route('admin.adoptions.approve', $adoption) }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-success">Setujui</button>
                      </form>
                      <form method="post" action="{{ route('admin.adoptions.reject', $adoption) }}" class="d-inline">
                        @csrf
                        <input type="hidden" name="admin_notes" value="Ditolak oleh admin">
                        <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                      </form>
                    </div>
                  @else
                    <span class="text-muted">-</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-body">
        {{ $adoptions->links() }}
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
