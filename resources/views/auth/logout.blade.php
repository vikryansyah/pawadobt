@extends('layouts.app')

@section('title', 'Logout')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card border-0 shadow-sm">
        <div class="card-body text-center py-5">
          <h3 class="mb-3">Yakin ingin logout?</h3>
          <p class="text-muted mb-4">Anda akan kembali ke halaman utama setelah logout.</p>
          
          <form method="post" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger btn-lg">Ya, Logout</button>
          </form>
          <a href="{{ route('home') }}" class="btn btn-outline-secondary btn-lg ms-2">Batal</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
