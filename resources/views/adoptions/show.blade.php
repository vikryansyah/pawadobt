@extends('layouts.app')

@section('title', 'Detail Permohonan Adopsi - PawFriends')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Status Card -->
                <div class="alert alert-{{ 
                    $adoptionRequest->status === 'pending' ? 'warning' : 
                    ($adoptionRequest->status === 'approved' ? 'success' : 
                    ($adoptionRequest->status === 'rejected' ? 'danger' : 'info'))
                }} alert-dismissible fade show" role="alert">
                    <h4 class="alert-heading">
                        <i class="bi bi-{{ 
                            $adoptionRequest->status === 'pending' ? 'hourglass-split' : 
                            ($adoptionRequest->status === 'approved' ? 'check-circle' : 
                            ($adoptionRequest->status === 'rejected' ? 'x-circle' : 'info-circle'))
                        }}"></i>
                        Status Permohonan: {{ ucfirst($adoptionRequest->status) }}
                    </h4>
                    @if($adoptionRequest->status === 'pending')
                        <p class="mb-0">Permohonan Anda sedang ditinjau oleh tim {{ $adoptionRequest->shelter->name }}. Kami akan menghubungi Anda segera.</p>
                    @elseif($adoptionRequest->status === 'approved')
                        <p class="mb-0">Selamat! Permohonan adopsi Anda telah disetujui. Hubungi shelter untuk melanjutkan proses penyerahan hewan.</p>
                    @elseif($adoptionRequest->status === 'rejected')
                        <p class="mb-0">Maaf, permohonan adopsi Anda tidak dapat disetujui saat ini.</p>
                    @endif
                </div>

                <!-- Pet Information -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-heart-fill"></i> Informasi Hewan</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                  <img src="{{ $adoptionRequest->pet->primary_image_url }}" 
                                     class="img-fluid rounded" alt="{{ $adoptionRequest->pet->name }}">
                            </div>
                            <div class="col-md-9">
                                      <img src="{{ $adoptionRequest->pet->primary_image_url }}" 
                                <p class="text-muted mb-2">
                                    <strong>Kategori:</strong> {{ $adoptionRequest->pet->category->name }}<br>
                                    <strong>Ras:</strong> {{ $adoptionRequest->pet->breed }}<br>
                                    <strong>Usia:</strong> {{ $adoptionRequest->pet->age }} tahun<br>
                                    <strong>Jenis Kelamin:</strong> {{ $adoptionRequest->pet->gender === 'male' ? 'Jantan' : 'Betina' }}
                                </p>
                                <a href="{{ route('pets.show', $adoptionRequest->pet->slug) }}" class="btn btn-sm btn-outline-primary">
                                    Lihat Profil Hewan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Applicant Information -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0"><i class="bi bi-person-fill"></i> Informasi Pemohon</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Nama:</strong><br>
                                    {{ $adoptionRequest->first_name }} {{ $adoptionRequest->last_name }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Email:</strong><br>
                                    {{ $adoptionRequest->email }}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-0">
                                    <strong>Telepon:</strong><br>
                                    {{ $adoptionRequest->phone }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-0">
                                    <strong>Alamat:</strong><br>
                                    {{ $adoptionRequest->address }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Home Information -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="bi bi-house-fill"></i> Informasi Rumah</h5>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Tipe Rumah:</strong><br>
                                    {{ ucfirst(str_replace('_', ' ', $adoptionRequest->home_type)) }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-2">
                                    <strong>Memiliki Halaman:</strong><br>
                                    {{ $adoptionRequest->has_yard ? 'Ya' : 'Tidak' }}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="mb-0">
                                    <strong>Hewan Peliharaan Lain:</strong><br>
                                    {{ $adoptionRequest->other_pets }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Experience & Motivation -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="mb-0"><i class="bi bi-chat-dots-fill"></i> Pengalaman & Motivasi</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-3">Pengalaman dengan Hewan Peliharaan:</h6>
                        <p class="text-muted mb-4">{{ $adoptionRequest->experience }}</p>

                        <h6 class="mb-3">Mengapa Ingin Mengadopsi {{ $adoptionRequest->pet->name }}:</h6>
                        <p class="text-muted">{{ $adoptionRequest->why_adopt }}</p>
                    </div>
                </div>

                <!-- Shelter Information -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0"><i class="bi bi-building"></i> Shelter</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-2">{{ $adoptionRequest->shelter->name }}</h6>
                        <p class="text-muted small mb-2">
                            <i class="bi bi-telephone"></i> 
                            <a href="tel:{{ $adoptionRequest->shelter->phone }}">{{ $adoptionRequest->shelter->phone }}</a>
                        </p>
                        <p class="text-muted small">
                            <i class="bi bi-envelope"></i> 
                            <a href="mailto:{{ $adoptionRequest->shelter->email }}">{{ $adoptionRequest->shelter->email }}</a>
                        </p>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0"><i class="bi bi-calendar-event"></i> Timeline</h5>
                    </div>
                    <div class="card-body">
                        <div class="timeline">
                            <div class="timeline-item mb-3">
                                <h6 class="mb-1">Permohonan Diajukan</h6>
                                <p class="text-muted small mb-0">{{ $adoptionRequest->created_at->format('d M Y H:i') }}</p>
                            </div>

                            @if($adoptionRequest->approved_at)
                                <div class="timeline-item mb-3">
                                    <h6 class="mb-1 text-success"><i class="bi bi-check-circle"></i> Permohonan Disetujui</h6>
                                    <p class="text-muted small mb-0">{{ $adoptionRequest->approved_at->format('d M Y H:i') }}</p>
                                </div>
                            @endif

                            @if($adoptionRequest->rejected_at)
                                <div class="timeline-item mb-3">
                                    <h6 class="mb-1 text-danger"><i class="bi bi-x-circle"></i> Permohonan Ditolak</h6>
                                    <p class="text-muted small mb-0">{{ $adoptionRequest->rejected_at->format('d M Y H:i') }}</p>
                                </div>
                            @endif

                            @if($adoptionRequest->completed_at)
                                <div class="timeline-item">
                                    <h6 class="mb-1 text-success"><i class="bi bi-check-circle-fill"></i> Adopsi Selesai</h6>
                                    <p class="text-muted small mb-0">{{ $adoptionRequest->completed_at->format('d M Y H:i') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-grid gap-2">
                    <a href="{{ route('adoptions.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Permohonan
                    </a>
                    @if($adoptionRequest->status === 'pending')
                        <form action="{{ route('adoptions.cancel', $adoptionRequest->id) }}" method="POST" class="d-grid">
                            @csrf
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan permohonan ini?')">
                                <i class="bi bi-trash"></i> Batalkan Permohonan
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: linear-gradient(180deg, #667eea, #764ba2);
        }

        .timeline-item {
            position: relative;
            padding-bottom: 20px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -37px;
            top: 0;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #667eea;
            border: 3px solid white;
        }
    </style>
@endsection
