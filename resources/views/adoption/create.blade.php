@extends('layouts.app')

@section('title', 'Ajukan Adopsi')

@section('content')
<div class="container py-5">
  <h1 class="h4 mb-4">Ajukan Adopsi untuk {{ $pet->name }}</h1>
  <div class="row">
    <div class="col-lg-8">
      <div class="card shadow-sm">
        <div class="card-body">
          <form method="POST" action="{{ route('adoptions.store', $pet->id) }}">
            @csrf
            <div class="mb-3">
              <label class="form-label">Nama Lengkap</label>
              <input type="text" name="applicant_name" class="form-control" value="{{ old('applicant_name') }}" required>
            </div>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="applicant_email" class="form-control" value="{{ old('applicant_email') }}" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Telepon</label>
                <input type="text" name="applicant_phone" class="form-control" value="{{ old('applicant_phone') }}" required>
              </div>
            </div>
            <div class="mt-3">
              <label class="form-label">Alamat Lengkap</label>
              <textarea name="applicant_address" class="form-control" rows="2" required>{{ old('applicant_address') }}</textarea>
            </div>
            <div class="mt-3">
              <label class="form-label">Pekerjaan</label>
              <input type="text" name="occupation" class="form-control" value="{{ old('occupation') }}">
            </div>
            <div class="row g-3 mt-1">
              <div class="col-md-6">
                <label class="form-label">Jenis Rumah</label>
                <select name="home_type" class="form-select">
                  <option value="">Pilih</option>
                  <option value="house" @selected(old('home_type')=='house')>Rumah</option>
                  <option value="apartment" @selected(old('home_type')=='apartment')>Apartemen</option>
                  <option value="other" @selected(old('home_type')=='other')>Lainnya</option>
                </select>
              </div>
              <div class="col-md-6 d-flex align-items-end">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="has_yard" id="has_yard" @checked(old('has_yard'))>
                  <label class="form-check-label" for="has_yard">Memiliki halaman</label>
                </div>
              </div>
            </div>
            <div class="mt-3">
              <label class="form-label">Pengalaman Merawat Hewan</label>
              <textarea name="experience" class="form-control" rows="2">{{ old('experience') }}</textarea>
            </div>
            <div class="mt-3">
              <label class="form-label">Alasan Mengadopsi</label>
              <textarea name="why_adopt" class="form-control" rows="3" required>{{ old('why_adopt') }}</textarea>
            </div>
            <div class="mt-3">
              <label class="form-label">Hewan Peliharaan Lain</label>
              <textarea name="other_pets" class="form-control" rows="2">{{ old('other_pets') }}</textarea>
            </div>
            <div class="mt-4 d-flex justify-content-end gap-2">
              <a href="{{ route('pets.show', $pet->slug) }}" class="btn btn-outline-secondary">Batal</a>
              <button type="submit" class="btn btn-primary">Kirim Permohonan</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card shadow-sm mb-3">
        <div class="card-body">
          <h5 class="mb-2">{{ $pet->name }}</h5>
          <p class="text-muted mb-1">{{ $pet->category->name }} • {{ $pet->breed }}</p>
          <p class="text-muted mb-0">{{ $pet->age }} • {{ $pet->gender == 'male' ? 'Jantan' : 'Betina' }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
