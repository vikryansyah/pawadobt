@extends('layouts.app')

@section('title', 'Daftarkan Shelter')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-sm">
        <div class="card-header">
          <h5 class="mb-0">Daftarkan Shelter Baru</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('shelters.store') }}">
            @csrf
            <div class="mb-3">
              <label class="form-label">Nama Shelter</label>
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Telepon</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
              </div>
            </div>
            <div class="mt-3">
              <label class="form-label">Alamat</label>
              <textarea name="address" class="form-control" rows="2" required>{{ old('address') }}</textarea>
            </div>
            <div class="row g-3 mt-1">
              <div class="col-md-6">
                <label class="form-label">Kota</label>
                <input type="text" name="city" class="form-control" value="{{ old('city') }}" required>
              </div>
              <div class="col-md-4">
                <label class="form-label">Provinsi</label>
                <input type="text" name="province" class="form-control" value="{{ old('province') }}" required>
              </div>
              <div class="col-md-2">
                <label class="form-label">Kode Pos</label>
                <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code') }}">
              </div>
            </div>
            <div class="mt-3">
              <label class="form-label">Deskripsi</label>
              <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>
            <div class="mt-3">
              <label class="form-label">Website</label>
              <input type="url" name="website" class="form-control" value="{{ old('website') }}">
            </div>
            <div class="mt-4 d-flex justify-content-end gap-2">
              <a href="{{ route('shelters.index') }}" class="btn btn-outline-secondary">Batal</a>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
