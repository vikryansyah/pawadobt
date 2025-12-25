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

      <form method="post" action="{{ route('pets.store') }}" class="card card-body border-0 shadow-sm" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
          <div class="col-12">
            <label class="form-label"><strong>Foto Hewan</strong> (Wajib)</label>
            <div class="border-2 border-dashed rounded p-4 text-center" id="uploadArea" style="cursor: pointer; border-color: #dee2e6;">
              <input type="file" name="primary_image" id="imageInput" class="d-none" accept="image/*" required>
              <img id="imagePreview" src="" alt="Preview" style="max-width: 100%; max-height: 300px; display: none; margin-bottom: 15px;">
              <div id="uploadText">
                <i class="bi bi-cloud-arrow-up" style="font-size: 2rem; color: #667eea;"></i>
                <p class="mt-2 mb-0"><strong>Klik atau drag gambar ke sini</strong></p>
                <small class="text-muted">PNG, JPG, JPEG (Max 2MB)</small>
              </div>
            </div>
            @error('primary_image')
              <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
          </div>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
  const uploadArea = document.getElementById('uploadArea');
  const imageInput = document.getElementById('imageInput');
  const imagePreview = document.getElementById('imagePreview');
  const uploadText = document.getElementById('uploadText');

  // Click to upload
  uploadArea.addEventListener('click', () => imageInput.click());

  // Drag and drop
  uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.style.borderColor = '#667eea';
    uploadArea.style.backgroundColor = '#f8f9ff';
  });

  uploadArea.addEventListener('dragleave', () => {
    uploadArea.style.borderColor = '#dee2e6';
    uploadArea.style.backgroundColor = 'transparent';
  });

  uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.style.borderColor = '#dee2e6';
    uploadArea.style.backgroundColor = 'transparent';
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
      imageInput.files = files;
      handleImageUpload();
    }
  });

  // Handle file input change
  imageInput.addEventListener('change', handleImageUpload);

  function handleImageUpload() {
    const file = imageInput.files[0];
    if (file) {
      // Validate file size (2MB max)
      if (file.size > 2 * 1024 * 1024) {
        alert('Gambar terlalu besar! Maksimal 2MB');
        imageInput.value = '';
        return;
      }

      // Preview image
      const reader = new FileReader();
      reader.onload = function(e) {
        imagePreview.src = e.target.result;
        imagePreview.style.display = 'block';
        uploadText.style.display = 'none';
      };
      reader.readAsDataURL(file);
    }
  }
});
</script>
@endsection
