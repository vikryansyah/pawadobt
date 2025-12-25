@extends('layouts.admin')

@section('title', 'Edit Hewan - ' . $pet->name)

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
      <h1 class="fw-bold">Edit Hewan: {{ $pet->name }}</h1>
      <a href="{{ route('admin.pets') }}" class="btn btn-outline-secondary">← Kembali</a>
    </div>

    @if($errors->any())
      <div class="alert alert-danger alert-dismissible fade show">
        <strong>Error:</strong>
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    <div class="row">
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
          <div class="card-header bg-light border-bottom">
            <h5 class="mb-0">Informasi Dasar</h5>
          </div>
          <div class="card-body">
            <form method="post" action="{{ route('admin.pets.update', $pet) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="name" class="form-label">Nama Hewan *</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $pet->name) }}" required>
                  @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                  <label for="category_id" class="form-label">Kategori *</label>
                  <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                      <option value="{{ $cat->id }}" @selected(old('category_id', $pet->category_id) == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                  </select>
                  @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-3">
                  <label for="gender" class="form-label">Jenis Kelamin *</label>
                  <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                    <option value="">-- Pilih --</option>
                    <option value="male" @selected(old('gender', $pet->gender) == 'male')>♂ Jantan</option>
                    <option value="female" @selected(old('gender', $pet->gender) == 'female')>♀ Betina</option>
                  </select>
                  @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-3">
                  <label for="age_years" class="form-label">Umur (Tahun)</label>
                  <input type="number" class="form-control @error('age_years') is-invalid @enderror" id="age_years" name="age_years" value="{{ old('age_years', $pet->age_years) }}" min="0">
                  @error('age_years') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-3">
                  <label for="age_months" class="form-label">Umur (Bulan)</label>
                  <input type="number" class="form-control @error('age_months') is-invalid @enderror" id="age_months" name="age_months" value="{{ old('age_months', $pet->age_months) }}" min="0" max="11">
                  @error('age_months') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-3">
                  <label for="weight" class="form-label">Berat (kg)</label>
                  <input type="number" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" value="{{ old('weight', $pet->weight) }}" min="0" step="0.01">
                  @error('weight') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-4">
                  <label for="breed" class="form-label">Ras/Jenis</label>
                  <input type="text" class="form-control @error('breed') is-invalid @enderror" id="breed" name="breed" value="{{ old('breed', $pet->breed) }}">
                  @error('breed') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                  <label for="size" class="form-label">Ukuran</label>
                  <select class="form-select @error('size') is-invalid @enderror" id="size" name="size">
                    <option value="">-- Pilih --</option>
                    <option value="small" @selected(old('size', $pet->size) == 'small')>Kecil</option>
                    <option value="medium" @selected(old('size', $pet->size) == 'medium')>Sedang</option>
                    <option value="large" @selected(old('size', $pet->size) == 'large')>Besar</option>
                  </select>
                  @error('size') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-4">
                  <label for="color" class="form-label">Warna</label>
                  <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color', $pet->color) }}">
                  @error('color') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>

              <div class="mb-3">
                <label for="description" class="form-label">Deskripsi *</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description', $pet->description) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="mb-3">
                <label for="personality" class="form-label">Kepribadian</label>
                <textarea class="form-control @error('personality') is-invalid @enderror" id="personality" name="personality" rows="3">{{ old('personality', $pet->personality) }}</textarea>
                @error('personality') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="mb-3">
                <label for="health_info" class="form-label">Info Kesehatan</label>
                <textarea class="form-control @error('health_info') is-invalid @enderror" id="health_info" name="health_info" rows="3">{{ old('health_info', $pet->health_info) }}</textarea>
                @error('health_info') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <hr>

              <h6 class="fw-bold mb-3">Status & Kesehatan</h6>

              <div class="row mb-3">
                <div class="col-md-6">
                  <label for="status" class="form-label">Status *</label>
                  <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                    <option value="available" @selected(old('status', $pet->status) == 'available')>Available</option>
                    <option value="pending" @selected(old('status', $pet->status) == 'pending')>Pending</option>
                    <option value="adopted" @selected(old('status', $pet->status) == 'adopted')>Adopted</option>
                  </select>
                  @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <div class="form-check">
                    <input type="hidden" name="is_vaccinated" value="0">
                    <input class="form-check-input" type="checkbox" id="is_vaccinated" name="is_vaccinated" value="1" @checked(old('is_vaccinated', $pet->is_vaccinated))>
                    <label class="form-check-label" for="is_vaccinated">Sudah Divaksin</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-check">
                    <input type="hidden" name="is_neutered" value="0">
                    <input class="form-check-input" type="checkbox" id="is_neutered" name="is_neutered" value="1" @checked(old('is_neutered', $pet->is_neutered))>
                    <label class="form-check-label" for="is_neutered">Sudah Disteril</label>
                  </div>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-md-6">
                  <div class="form-check">
                    <input type="hidden" name="is_house_trained" value="0">
                    <input class="form-check-input" type="checkbox" id="is_house_trained" name="is_house_trained" value="1" @checked(old('is_house_trained', $pet->is_house_trained))>
                    <label class="form-check-label" for="is_house_trained">Sudah Terlatih di Rumah</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-check">
                    <input type="hidden" name="is_featured" value="0">
                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" @checked(old('is_featured', $pet->is_featured))>
                    <label class="form-check-label" for="is_featured">Featured</label>
                  </div>
                </div>
              </div>

              <hr>

              <h6 class="fw-bold mb-3">Kompatibilitas</h6>

              <div class="row mb-4">
                <div class="col-md-4">
                  <div class="form-check">
                    <input type="hidden" name="good_with_kids" value="0">
                    <input class="form-check-input" type="checkbox" id="good_with_kids" name="good_with_kids" value="1" @checked(old('good_with_kids', $pet->good_with_kids))>
                    <label class="form-check-label" for="good_with_kids">Cocok Dengan Anak-anak</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                    <input type="hidden" name="good_with_dogs" value="0">
                    <input class="form-check-input" type="checkbox" id="good_with_dogs" name="good_with_dogs" value="1" @checked(old('good_with_dogs', $pet->good_with_dogs))>
                    <label class="form-check-label" for="good_with_dogs">Cocok Dengan Anjing</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-check">
                    <input type="hidden" name="good_with_cats" value="0">
                    <input class="form-check-input" type="checkbox" id="good_with_cats" name="good_with_cats" value="1" @checked(old('good_with_cats', $pet->good_with_cats))>
                    <label class="form-check-label" for="good_with_cats">Cocok Dengan Kucing</label>
                  </div>
                </div>
              </div>

              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
                <a href="{{ route('admin.pets') }}" class="btn btn-outline-secondary">Batal</a>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
          <div class="card-header bg-light border-bottom">
            <h5 class="mb-0">Foto Hewan</h5>
          </div>
          <div class="card-body">
            <div class="mb-3">
              @php
                $imageSrc = $pet->primary_image
                  ? (\Illuminate\Support\Str::startsWith($pet->primary_image, ['http://','https://'])
                      ? $pet->primary_image
                      : (\Illuminate\Support\Str::startsWith($pet->primary_image, '/storage/')
                          ? $pet->primary_image
                          : asset('storage/'.$pet->primary_image)))
                  : 'https://via.placeholder.com/300x300?text=No+Image';
              @endphp
              <img src="{{ $imageSrc }}" alt="{{ $pet->name }}" class="img-fluid rounded mb-3" style="width: 100%; height: 300px; object-fit: cover;">
            </div>
            <form method="post" action="{{ route('admin.pets.image', $pet) }}" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label for="primary_image" class="form-label">Ganti Foto</label>
                <input type="file" class="form-control @error('primary_image') is-invalid @enderror" id="primary_image" name="primary_image" accept="image/*">
                <small class="text-muted">Maksimal 2MB (jpg, png, webp)</small>
                @error('primary_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <button type="submit" class="btn btn-sm btn-outline-secondary w-100">Ubah Foto</button>
            </form>
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
</style>
@endsection
