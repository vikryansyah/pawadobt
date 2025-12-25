@extends('layouts.app')

@section('title', 'Permohonan Adopsi Saya - PawFriends')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Permohonan Adopsi Saya</h1>
            </div>
        </div>

        @if($adoptionRequests->count() > 0)
            <div class="row">
                @foreach($adoptionRequests as $request)
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="row g-0">
                                <div class="col-md-4">
                                     <img src="{{ $request->pet->primary_image_url }}" 
                                         class="img-fluid rounded-start h-100" alt="{{ $request->pet->name }}" style="object-fit: cover;">
                                </div>
                                <div class="col-md-8">
                                     <img src="{{ $request->pet->primary_image_url }}" 
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <h5 class="card-title mb-1">{{ $request->pet->name }}</h5>
                                                <p class="text-muted small mb-0">{{ $request->pet->shelter->name }}</p>
                                            </div>
                                            <span class="badge bg-{{ 
                                                $request->status === 'pending' ? 'warning' : 
                                                ($request->status === 'approved' ? 'success' : 
                                                ($request->status === 'rejected' ? 'danger' : 'info'))
                                            }}">
                                                {{ ucfirst($request->status) }}
                                            </span>
                                        </div>
                                        
                                        <p class="card-text small">
                                            <strong>Tanggal Pengajuan:</strong><br>
                                            {{ $request->created_at->format('d M Y H:i') }}
                                        </p>

                                        @if($request->approved_at)
                                            <p class="text-success small">
                                                <i class="bi bi-check-circle"></i> 
                                                Disetujui pada {{ $request->approved_at->format('d M Y') }}
                                            </p>
                                        @elseif($request->rejected_at)
                                            <p class="text-danger small">
                                                <i class="bi bi-x-circle"></i> 
                                                Ditolak pada {{ $request->rejected_at->format('d M Y') }}
                                                @if($request->admin_notes)
                                                    <br><strong>Alasan:</strong> {{ $request->admin_notes }}
                                                @endif
                                            </p>
                                        @endif

                                        <div class="mt-3">
                                            <a href="{{ route('adoptions.show', $request->id) }}" class="btn btn-sm btn-primary">
                                                <i class="bi bi-eye"></i> Lihat Detail
                                            </a>
                                            @if($request->status === 'pending')
                                                <form action="{{ route('adoptions.cancel', $request->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan?')">
                                                        <i class="bi bi-trash"></i> Batalkan
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($adoptionRequests->hasPages())
                <div class="row mt-4">
                    <div class="col-12">
                        {{ $adoptionRequests->links() }}
                    </div>
                </div>
            @endif
        @else
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h5 class="alert-heading"><i class="bi bi-heart"></i> Belum Ada Permohonan Adopsi</h5>
                        <p class="mb-0">Anda belum mengajukan permohonan adopsi. <a href="{{ route('pets.index') }}" class="alert-link">Lihat hewan yang tersedia</a></p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
