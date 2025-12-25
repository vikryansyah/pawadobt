@extends('layouts.app')

@section('title', 'Permohonan Adopsi Saya')

@section('content')
<div class="container py-5">
  <h1 class="h4 mb-4">Permohonan Adopsi Saya</h1>
  <div class="table-responsive">
    <table class="table align-middle">
      <thead>
        <tr>
          <th>Hewan</th>
          <th>Shelter</th>
          <th>Status</th>
          <th>Dibuat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($requests as $req)
          <tr>
            <td>{{ $req->pet->name }}</td>
            <td>{{ $req->shelter->name }}</td>
            <td><span class="badge bg-secondary text-uppercase">{{ $req->status }}</span></td>
            <td>{{ $req->created_at->format('d M Y') }}</td>
            <td class="d-flex gap-2">
              <a class="btn btn-sm btn-outline-primary" href="{{ route('adoptions.show', $req->id) }}">Detail</a>
              @if($req->status === 'pending')
                <form method="POST" action="{{ route('adoptions.cancel', $req->id) }}">
                  @csrf
                  <button class="btn btn-sm btn-outline-danger" type="submit">Batalkan</button>
                </form>
              @endif
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" class="text-center">Belum ada permohonan adopsi.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="mt-3">
    {{ $requests->links() }}
  </div>
</div>
@endsection
