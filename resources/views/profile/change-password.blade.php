@extends('layouts.app')

@section('title', 'Ubah Password')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">
          <h5 class="mb-0">Ubah Password</h5>
        </div>
        <div class="card-body">
          @if($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="put" action="{{ route('profile.update-password') }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label class="form-label">Password Saat Ini</label>
              <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
              @error('current_password') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Password Baru</label>
              <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
              @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
              <small class="text-muted">Minimal 8 karakter</small>
            </div>

            <div class="mb-3">
              <label class="form-label">Konfirmasi Password</label>
              <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
              @error('password_confirmation') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary">Ubah Password</button>
              <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
