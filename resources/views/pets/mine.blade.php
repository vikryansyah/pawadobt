@extends('layouts.app')

@section('title', 'Hewan Saya')

@section('content')
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Hewan Saya</h1>
    <a href="{{ route('pets.create') }}" class="btn btn-primary">Tambah Hewan</a>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if($pets->isEmpty())
    <div class="alert alert-info">Belum ada hewan yang kamu pasang untuk adopsi.</div>
  @else
    <div class="card border-0 shadow-sm">
      <div class="table-responsive">
        <table class="table mb-0 align-middle">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Kategori</th>
              <th>Status</th>
              <th>Dibuat</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($pets as $pet)
              <tr>
                <td>{{ $pet->name }}</td>
                <td>{{ $pet->category->name ?? '-' }}</td>
                <td><span class="badge text-bg-secondary text-capitalize">{{ $pet->status }}</span></td>
                <td>{{ $pet->created_at->format('d M Y') }}</td>
                <td class="text-end"><a href="{{ route('pets.show', $pet->slug) }}" class="btn btn-sm btn-outline-primary">Lihat</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="card-body">
        {{ $pets->links() }}
      </div>
    </div>
  @endif
</div>
@endsection
