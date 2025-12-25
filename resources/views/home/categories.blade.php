<section class="py-5 overflow-hidden">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="section-header d-flex flex-wrap justify-content-between mb-5">
          <h2 class="section-title">Category</h2>

          <div class="d-flex align-items-center">
            <a href="{{ route('pets.index') }}" class="btn-link text-decoration-none">Lihat Semua Hewan →</a>
            <div class="swiper-buttons">
              <button class="swiper-prev category-carousel-prev btn btn-yellow">❮</button>
              <button class="swiper-next category-carousel-next btn btn-yellow">❯</button>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">

        <div class="category-carousel swiper">
          <div class="swiper-wrapper">
            @forelse($categories as $category)
              <a href="{{ route('pets.category', $category->slug) }}" class="nav-link category-item swiper-slide">
                <img src="{{ $category->icon ? asset('images/'.$category->icon.'.png') : 'images/dog03.png' }}" alt="{{ $category->name }}" class="img-fluid" style="max-width: 80px;">
                <h3 class="category-title">{{ $category->name }}</h3>
                <p class="small text-muted mb-0">{{ $category->active_pets_count ?? $category->activePets()->count() }} hewan</p>
              </a>
            @empty
              <p class="text-center">Belum ada kategori.</p>
            @endforelse
            
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
