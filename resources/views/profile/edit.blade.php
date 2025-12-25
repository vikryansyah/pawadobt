@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom">
          <h5 class="mb-0">Edit Profil</h5>
        </div>
        <div class="card-body">
          <form method="put" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label class="form-label">Nama Lengkap</label>
              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->name) }}" required>
              @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', auth()->user()->email) }}" required>
              @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Nomor Telepon</label>
              <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', auth()->user()->phone) }}" placeholder="+62...">
              @error('phone') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Alamat</label>
              <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address', auth()->user()->address) }}</textarea>
              @error('address') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Bio</label>
              <textarea name="bio" rows="3" class="form-control @error('bio') is-invalid @enderror" placeholder="Cerita singkat tentang Anda...">{{ old('bio', auth()->user()->bio) }}</textarea>
              @error('bio') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
              <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
