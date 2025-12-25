@extends('layouts.app')

@section('title', 'Tambah Hewan untuk Adopsi')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <h1 class="mb-4">Tambah Hewan</h1>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="post" action="{{ route('pets.store') }}" class="card card-body border-0 shadow-sm">
        @csrf
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nama Hewan</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Kategori</label>
            <select name="category_id" class="form-select" required>
              <option value="">Pilih kategori</option>
              @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Jenis Kelamin</label>
            <select name="gender" class="form-select" required>
              <option value="">Pilih</option>
              <option value="male" @selected(old('gender')=='male')>Jantan</option>
              <option value="female" @selected(old('gender')=='female')>Betina</option>
            </select>
          </div>
          <div class="col-md-3">
            <label class="form-label">Usia (tahun)</label>
            <input type="number" name="age_years" class="form-control" min="0" value="{{ old('age_years', 0) }}">
          </div>
          <div class="col-md-3">
            <label class="form-label">Usia (bulan)</label>
            <input type="number" name="age_months" class="form-control" min="0" max="11" value="{{ old('age_months', 0) }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Ras</label>
            <input type="text" name="breed" class="form-control" value="{{ old('breed') }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Ukuran</label>
            <input type="text" name="size" class="form-control" placeholder="small/medium/large" value="{{ old('size') }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Warna</label>
            <input type="text" name="color" class="form-control" value="{{ old('color') }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Berat (kg)</label>
            <input type="number" step="0.1" name="weight" class="form-control" value="{{ old('weight') }}">
          </div>
          <div class="col-12">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" rows="4" class="form-control" required>{{ old('description') }}</textarea>
          </div>
          <div class="col-12">
            <label class="form-label">Info Kesehatan</label>
            <textarea name="health_info" rows="3" class="form-control">{{ old('health_info') }}</textarea>
          </div>
          <div class="col-12">
            <label class="form-label">Kepribadian</label>
            <textarea name="personality" rows="3" class="form-control">{{ old('personality') }}</textarea>
          </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
          <a href="{{ route('pets.mine') }}" class="btn btn-outline-secondary">Lihat hewan saya</a>
          <button type="submit" class="btn btn-primary">Simpan Hewan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
