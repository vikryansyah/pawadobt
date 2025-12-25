@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card shadow-sm">
        <div class="card-body p-4">
          <h1 class="h4 mb-3 text-center">Masuk</h1>
          @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
          @endif
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" name="remember" id="remember">
              <label class="form-check-label" for="remember">Ingat saya</label>
            </div>
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary">Masuk</button>
            </div>
          </form>
          <p class="mt-3 text-center small">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
