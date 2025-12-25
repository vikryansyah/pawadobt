@extends('layouts.app')

@section('title', 'Cara Adopsi')

@section('content')
<div class="container py-5">
  <h1 class="h3 mb-4 text-center">Cara Adopsi Hewan</h1>

  <div class="row">
    <div class="col-lg-8 mx-auto">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title mb-4">Langkah-langkah Mengadopsi Hewan</h5>

          <div class="step mb-4">
            <div class="d-flex align-items-start">
              <div class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; font-weight: bold;">1</div>
              <div>
                <h6 class="mb-2">Pilih Hewan yang Ingin Diadopsi</h6>
                <p class="text-muted mb-0">Jelajahi katalog hewan peliharaan kami dan pilih hewan yang sesuai dengan gaya hidup dan preferensi Anda.</p>
              </div>
            </div>
          </div>

          <div class="step mb-4">
            <div class="d-flex align-items-start">
              <div class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; font-weight: bold;">2</div>
              <div>
                <h6 class="mb-2">Login ke Akun Anda</h6>
                <p class="text-muted mb-0">Pastikan Anda sudah memiliki akun dan login untuk dapat mengajukan permohonan adopsi.</p>
              </div>
            </div>
          </div>

          <div class="step mb-4">
            <div class="d-flex align-items-start">
              <div class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; font-weight: bold;">3</div>
              <div>
                <h6 class="mb-2">Isi Formulir Permohonan Adopsi</h6>
                <p class="text-muted mb-0">Lengkapi formulir dengan informasi pribadi, pengalaman merawat hewan, dan alasan mengadopsi.</p>
              </div>
            </div>
          </div>

          <div class="step mb-4">
            <div class="d-flex align-items-start">
              <div class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; font-weight: bold;">4</div>
              <div>
                <h6 class="mb-2">Tunggu Verifikasi dari Shelter</h6>
                <p class="text-muted mb-0">Shelter akan meninjau permohonan Anda dan menghubungi Anda untuk proses selanjutnya.</p>
              </div>
            </div>
          </div>

          <div class="step mb-4">
            <div class="d-flex align-items-start">
              <div class="step-number bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; font-weight: bold;">5</div>
              <div>
                <h6 class="mb-2">Jemput Hewan dan Mulai Kehidupan Baru</h6>
                <p class="text-muted mb-0">Setelah disetujui, Anda dapat menjemput hewan dari shelter dan memulai perjalanan bersama.</p>
              </div>
            </div>
          </div>

          <hr class="my-4">

          <h6 class="mb-3">Persyaratan Adopsi</h6>
          <ul class="list-unstyled">
            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Berusia minimal 18 tahun</li>
            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Memiliki tempat tinggal yang stabil</li>
            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Bersedia menjalani wawancara dengan shelter</li>
            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Berkomitmen untuk merawat hewan seumur hidup</li>
            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Bersedia melakukan sterilisasi jika diperlukan</li>
          </ul>

          <div class="text-center mt-4">
            <a href="{{ route('pets.index') }}" class="btn btn-primary">Mulai Adopsi Sekarang</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection