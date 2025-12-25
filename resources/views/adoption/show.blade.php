@extends('layouts.app')

@section('title', 'Detail Permohonan Adopsi')

@section('content')
<div class="container py-5">
  <h1 class="h4 mb-4">Detail Permohonan Adopsi</h1>
  <div class="row g-3">
    <div class="col-lg-8">
      <div class="card shadow-sm mb-3">
        <div class="card-body">
          <h5 class="mb-3">Informasi Permohonan</h5>
          <p class="mb-1"><strong>Status:</strong> <span class="badge bg-secondary text-uppercase">{{ $adoptionRequest->status }}</span></p>
          <p class="mb-1"><strong>Dibuat:</strong> {{ $adoptionRequest->created_at->format('d M Y') }}</p>
          <p class="mb-1"><strong>Nama:</strong> {{ $adoptionRequest->applicant_name }}</p>
          <p class="mb-1"><strong>Email:</strong> {{ $adoptionRequest->applicant_email }}</p>
          <p class="mb-1"><strong>Telepon:</strong> {{ $adoptionRequest->applicant_phone }}</p>
          <p class="mb-1"><strong>Alamat:</strong> {{ $adoptionRequest->applicant_address }}</p>
          @if($adoptionRequest->occupation)
            <p class="mb-1"><strong>Pekerjaan:</strong> {{ $adoptionRequest->occupation }}</p>
          @endif
          @if($adoptionRequest->home_type)
            <p class="mb-1"><strong>Jenis Rumah:</strong> {{ $adoptionRequest->home_type }}</p>
          @endif
          <p class="mb-1"><strong>Memiliki Halaman:</strong> {{ $adoptionRequest->has_yard ? 'Ya' : 'Tidak' }}</p>
          @if($adoptionRequest->experience)
            <p class="mb-1"><strong>Pengalaman:</strong> {{ $adoptionRequest->experience }}</p>
          @endif
          <p class="mb-1"><strong>Alasan Adopsi:</strong> {{ $adoptionRequest->why_adopt }}</p>
          @if($adoptionRequest->other_pets)
            <p class="mb-1"><strong>Hewan Lain:</strong> {{ $adoptionRequest->other_pets }}</p>
          @endif
        </div>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="card shadow-sm mb-3">
        <div class="card-body">
          <h5 class="mb-2">Hewan</h5>
          <p class="mb-1"><a href="{{ route('pets.show', $adoptionRequest->pet->slug) }}">{{ $adoptionRequest->pet->name }}</a></p>
          <p class="text-muted mb-1">{{ $adoptionRequest->pet->category->name }} • {{ $adoptionRequest->pet->breed }}</p>
        </div>
      </div>
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="mb-2">Shelter</h5>
          <p class="mb-1"><a href="{{ route('shelters.show', $adoptionRequest->shelter->id) }}">{{ $adoptionRequest->shelter->name }}</a></p>
          <p class="text-muted mb-1">{{ $adoptionRequest->shelter->city }}, {{ $adoptionRequest->shelter->province }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
