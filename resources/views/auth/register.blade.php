@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <h1 class="h4 mb-3 text-center">Daftar</h1>
          @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
          @endif
          <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Konfirmasi Password</label>
              <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary">Daftar</button>
            </div>
          </form>
          <p class="mt-3 text-center small">Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
