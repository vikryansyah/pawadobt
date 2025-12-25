@extends('layouts.app')

@section('title', 'Ajukan Adopsi - PawFriends')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-heart-fill"></i> Ajukan Permintaan Adopsi</h4>
                    </div>
                    <div class="card-body">
                        <!-- Pet Info Card -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                  <img src="{{ $pet->primary_image_url }}" 
                                     class="img-fluid rounded" alt="{{ $pet->name }}">
                            </div>
                            <div class="col-md-8">
                                  <img src="{{ $pet->primary_image_url }}" 
                                <p class="text-muted mb-2">
                                    <strong>Kategori:</strong> {{ $pet->category->name }}<br>
                                    <strong>Ras:</strong> {{ $pet->breed }}<br>
                                    <strong>Usia:</strong> {{ $pet->age }} tahun<br>
                                    <strong>Shelter:</strong> {{ $pet->shelter->name }}
                                </p>
                            </div>
                        </div>

                        <hr>

                        <!-- Adoption Form -->
                        <form action="{{ route('adoptions.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="pet_id" value="{{ $pet->id }}">
                            <input type="hidden" name="shelter_id" value="{{ $pet->shelter_id }}">

                            <!-- Informasi Pemohon -->
                            <h6 class="mb-3"><strong>Informasi Pemohon</strong></h6>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">Nama Depan *</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                           id="first_name" name="first_name" value="{{ old('first_name', auth()->user()->name) }}" required>
                                    @error('first_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">Nama Belakang</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                           id="last_name" name="last_name" value="{{ old('last_name') }}">
                                    @error('last_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Nomor Telepon *</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat Lengkap *</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr>

                            <!-- Informasi Rumah -->
                            <h6 class="mb-3"><strong>Informasi Rumah & Keluarga</strong></h6>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="home_type" class="form-label">Tipe Rumah *</label>
                                    <select class="form-select @error('home_type') is-invalid @enderror" 
                                            id="home_type" name="home_type" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="house" {{ old('home_type') === 'house' ? 'selected' : '' }}>Rumah</option>
                                        <option value="apartment" {{ old('home_type') === 'apartment' ? 'selected' : '' }}>Apartemen</option>
                                        <option value="condo" {{ old('home_type') === 'condo' ? 'selected' : '' }}>Kondominium</option>
                                        <option value="other" {{ old('home_type') === 'other' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('home_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="has_yard" class="form-label">Memiliki Halaman? *</label>
                                    <select class="form-select @error('has_yard') is-invalid @enderror" 
                                            id="has_yard" name="has_yard" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="1" {{ old('has_yard') === '1' ? 'selected' : '' }}>Ya</option>
                                        <option value="0" {{ old('has_yard') === '0' ? 'selected' : '' }}>Tidak</option>
                                    </select>
                                    @error('has_yard')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="other_pets" class="form-label">Apakah Anda memiliki hewan peliharaan lain? *</label>
                                <input type="text" class="form-control @error('other_pets') is-invalid @enderror" 
                                       id="other_pets" name="other_pets" placeholder="Contoh: 2 anjing, 1 kucing" value="{{ old('other_pets') }}" required>
                                @error('other_pets')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="experience" class="form-label">Pengalaman Anda dengan Hewan Peliharaan *</label>
                                <textarea class="form-control @error('experience') is-invalid @enderror" 
                                          id="experience" name="experience" rows="3" placeholder="Ceritakan pengalaman Anda..." required>{{ old('experience') }}</textarea>
                                @error('experience')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="why_adopt" class="form-label">Mengapa Anda Ingin Mengadopsi {{ $pet->name }}? *</label>
                                <textarea class="form-control @error('why_adopt') is-invalid @enderror" 
                                          id="why_adopt" name="why_adopt" rows="3" placeholder="Jelaskan alasan Anda..." required>{{ old('why_adopt') }}</textarea>
                                @error('why_adopt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr>

                            <!-- Persetujuan -->
                            <div class="form-check mb-4">
                                <input class="form-check-input @error('agree') is-invalid @enderror" 
                                       type="checkbox" id="agree" name="agree" value="1" {{ old('agree') ? 'checked' : '' }} required>
                                <label class="form-check-label" for="agree">
                                    Saya setuju untuk mematuhi semua syarat dan ketentuan adopsi dari {{ $pet->shelter->name }}. *
                                </label>
                                @error('agree')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-check-circle"></i> Ajukan Adopsi
                                </button>
                                <a href="{{ route('pets.show', $pet->slug) }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle"></i> Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Info Alert -->
                <div class="alert alert-info mt-4">
                    <h6 class="alert-heading"><i class="bi bi-info-circle"></i> Informasi Penting</h6>
                    <ul class="mb-0 small">
                        <li>Setiap permohonan adopsi akan ditinjau oleh tim {{ $pet->shelter->name }}</li>
                        <li>Tim shelter akan menghubungi Anda melalui email dan telepon untuk verifikasi</li>
                        <li>Proses persetujuan biasanya membutuhkan waktu 3-7 hari kerja</li>
                        <li>Kami melakukan screening untuk memastikan keselamatan hewan peliharaan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
