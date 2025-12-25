{{-- Available Pets Section --}}
<section class="py-5">
  <div class="container-fluid">
    
    <div class="row">
      <div class="col-md-12">

        <div class="bootstrap-tabs product-tabs">
          <div class="tabs-header d-flex justify-content-between border-bottom my-5">
            <h3>Hewan Siap Adopsi</h3>
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a href="#nav-all" class="nav-link text-uppercase fs-6 active" id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all">Semua</a>
                @foreach($categories as $category)
                  <a href="#nav-{{ $category->slug }}" class="nav-link text-uppercase fs-6" id="nav-{{ $category->slug }}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ $category->slug }}">{{ $category->name }}</a>
                @endforeach
              </div>
            </nav>
          </div>
          <div class="tab-content" id="nav-tabContent">
            {{-- All Pets Tab --}}
            <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
              <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                @forelse($latestPets as $pet)
                  <div class="col">
                    <div class="product-item">
                      @if($pet->is_featured)
                        <span class="badge bg-success position-absolute m-3">Featured</span>
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
                        <svg width="24" height="24" class="text-primary"><use xlink:href="#star-solid"></use></svg> {{ number_format($pet->views / 10, 1) }}
                      </span>
                      <span class="qty">({{ $pet->views }} Views)</span>
                      <br>
                      <span class="animal-info" style="font-size: 0.85rem;">
                        {{ $pet->age }} | {{ $pet->gender == 'male' ? 'Jantan' : 'Betina' }} | 
                        @if($pet->is_vaccinated) Sudah divaksin @else Belum divaksin @endif
                      </span>
                      <div class="d-flex align-items-center justify-content-between mt-2">
                        <span class="text-muted small">{{ $pet->shelter->name }}</span>
                      </div>
                      <a href="{{ route('pets.show', $pet->slug) }}" class="nav-link">
                        Lihat Detail <iconify-icon icon="uil:arrow-right"></iconify-icon>
                      </a>
                    </div>
                  </div>
                @empty
                  <div class="col-12">
                    <p class="text-center">Belum ada hewan yang tersedia untuk adopsi.</p>
                  </div>
                @endforelse
              </div>
            </div>

            {{-- Category Tabs --}}
            @foreach($categories as $category)
              <div class="tab-pane fade" id="nav-{{ $category->slug }}" role="tabpanel" aria-labelledby="nav-{{ $category->slug }}-tab">
                <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5">
                  @forelse($category->activePets()->available()->latest()->take(10)->get() as $pet)
                    <div class="col">
                      <div class="product-item">
                        @if($pet->is_featured)
                          <span class="badge bg-success position-absolute m-3">Featured</span>
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
                          <svg width="24" height="24" class="text-primary"><use xlink:href="#star-solid"></use></svg> {{ number_format($pet->views / 10, 1) }}
                        </span>
                        <span class="qty">({{ $pet->views }} Views)</span>
                        <br>
                        <span class="animal-info" style="font-size: 0.85rem;">
                          {{ $pet->age }} | {{ $pet->gender == 'male' ? 'Jantan' : 'Betina' }} | 
                          @if($pet->is_vaccinated) Sudah divaksin @else Belum divaksin @endif
                        </span>
                        <div class="d-flex align-items-center justify-content-between mt-2">
                          <span class="text-muted small">{{ $pet->shelter->name }}</span>
                        </div>
                        <a href="{{ route('pets.show', $pet->slug) }}" class="nav-link">
                          Lihat Detail <iconify-icon icon="uil:arrow-right"></iconify-icon>
                        </a>
                      </div>
                    </div>
                  @empty
                    <div class="col-12">
                      <p class="text-center">Belum ada {{ strtolower($category->name) }} yang tersedia untuk adopsi.</p>
                    </div>
                  @endforelse
                </div>
              </div>
            @endforeach
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
