{{-- Popular Pets Section --}}
<section class="py-5 overflow-hidden">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

        <div class="section-header d-flex flex-wrap justify-content-between my-5">
          <h2 class="section-title">Sahabat Baru Terpopuler</h2>

          <div class="d-flex align-items-center">
            <a href="{{ route('pets.index') }}" class="btn-link text-decoration-none">Lihat Semua Hewan →</a>
            <div class="swiper-buttons">
              <button class="swiper-prev products-carousel-prev btn btn-primary">❮</button>
              <button class="swiper-next products-carousel-next btn btn-primary">❯</button>
            </div>  
          </div>
        </div>
        
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">

        <div class="products-carousel swiper">
          <div class="swiper-wrapper">
            
            @forelse($popularPets as $pet)
              <div class="swiper-slide">
                <div class="product-item">
                  @if($pet->is_featured)
                    <span class="badge bg-danger position-absolute m-3">Popular</span>
                  @endif
                  <a href="#" class="btn-wishlist">
                    <svg width="24" height="24"><use xlink:href="#heart"></use></svg>
                  </a>
                  <figure>
                    <a href="{{ route('pets.show', $pet->slug) }}" title="{{ $pet->name }}">
                      <img src="{{ $pet->primary_image_url }}" class="tab-image" alt="{{ $pet->name }}">
                    </a>
                  </figure>
                  <a href="{{ route('pets.show', $pet->slug) }}"><h3>{{ $pet->name }}</h3></a>
                  <span class="rating">
                    <svg width="24" height="24" class="text-primary"><use xlink:href="#star-solid"></use></svg> 
                    {{ number_format($pet->views / 10, 1) }}
                  </span>
                  <span class="qty">({{ $pet->views }} Views)</span>
                  <br>
                  <span class="animal-info" style="font-size: 0.85rem;">
                    {{ $pet->age }} | {{ $pet->gender == 'male' ? 'Jantan' : 'Betina' }} | {{ $pet->breed }}
                  </span>
                  <div class="d-flex align-items-center justify-content-between mt-2">
                    <span class="text-muted small">{{ $pet->shelter->city }}</span>
                  </div>
                  <a href="{{ route('pets.show', $pet->slug) }}" class="nav-link">
                    Lihat Detail <iconify-icon icon="uil:arrow-right"></iconify-icon>
                  </a>
                </div>
              </div>
            @empty
              <div class="swiper-slide">
                <p class="text-center">Belum ada hewan populer.</p>
              </div>
            @endforelse

          </div>
        </div>

      </div>
    </div>
  </div>
</section>
