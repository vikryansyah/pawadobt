<header>
  <div class="container-fluid">
    <div class="row py-3 border-bottom">
      
      <div class="col-sm-4 col-lg-3 text-center text-sm-start">
        <div class="main-logo">
          <a href="{{ route('home') }}">
            <img src="/images/ChatGPT_Image_Nov_2__2025__04_30_21_PM-removebg-preview.png" alt="logo" class="img-fluid w-25">
          </a>
        </div>
      </div>
      
      <div class="col-sm-6 offset-sm-2 offset-md-0 col-lg-5 d-none d-lg-block">
        <div class="search-bar row bg-light p-2 my-2 rounded-4">
          <div class="col-md-4 d-none d-md-block">
            <select class="form-select border-0 bg-transparent" onchange="if(this.value) window.location=this.value;">
              <option value="">Pilih kategori</option>
              <option value="{{ route('pets.category', 'anjing') }}">Anjing</option>
              <option value="{{ route('pets.category', 'kucing') }}">Kucing</option>
              <option value="{{ route('pets.category', 'kelinci') }}">Kelinci</option>
              <option value="{{ route('pets.category', 'burung') }}">Burung</option>
              <option value="{{ route('pets.category', 'hamster') }}">Hamster</option>
              <option value="{{ route('pets.category', 'reptil') }}">Reptil</option>
            </select>
          </div>
          <div class="col-11 col-md-7">
            <form id="search-form" class="text-center" action="{{ route('search') }}" method="get">
              <input name="search" type="text" class="form-control border-0 bg-transparent" placeholder="Cari hewan lucu untuk jadi temanmu!" />
            </form>
          </div>
          <div class="col-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path fill="currentColor" d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0a1 1 0 0 0 0-1.39ZM11 18a7 7 0 1 1 7-7a7 7 0 0 1-7 7Z"/></svg>
          </div>
        </div>
      </div>
      
      <div class="col-sm-8 col-lg-4 d-flex justify-content-end gap-5 align-items-center mt-4 mt-sm-0 justify-content-center justify-content-sm-end">
        <div class="support-box text-end d-none d-xl-block">
          <span class="fs-6 text-muted">For Support?</span>
          <h5 class="mb-0">+980-34984089</h5>
        </div>

        <ul class="d-flex justify-content-end list-unstyled m-0">
          <li>
            @auth
              <a href="{{ route('profile.show') }}" class="rounded-circle bg-light p-2 mx-1" title="Profil">
                <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#user"></use></svg>
              </a>
            @else
              <a href="{{ route('login') }}" class="rounded-circle bg-light p-2 mx-1">
                <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#user"></use></svg>
              </a>
            @endauth
          </li>
          <li>
            @auth
              <a href="{{ route('favorites.index') }}" class="rounded-circle bg-light p-2 mx-1" title="Favorit Saya">
                <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#heart"></use></svg>
              </a>
            @else
              <a href="{{ route('login') }}" class="rounded-circle bg-light p-2 mx-1" title="Login untuk Favorit">
                <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#heart"></use></svg>
              </a>
            @endauth
          </li>
          <li class="d-lg-none">
            <a href="#" class="rounded-circle bg-light p-2 mx-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
              <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#cart"></use></svg>
            </a>
          </li>
          <li class="d-lg-none">
            <a href="#" class="rounded-circle bg-light p-2 mx-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSearch" aria-controls="offcanvasSearch">
              <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#search"></use></svg>
            </a>
          </li>
        </ul>

        <div class="cart text-end d-none d-lg-block dropdown">
          <button class="border-0 bg-transparent d-flex flex-column gap-2 lh-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
            <span class="fs-6 text-muted dropdown-toggle">Your Cart</span>
            <span class="cart-total fs-5 fw-bold">$1290.00</span>
          </button>
        </div>
      </div>

    </div>
  </div>
  <div class="container-fluid">
    <div class="row py-3">
      <div class="d-flex  justify-content-center justify-content-sm-between align-items-center">
        <nav class="main-menu d-flex navbar navbar-expand-lg">

          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

            <div class="offcanvas-header justify-content-center">
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
          
              <select class="filter-categories border-0 mb-0 me-5" onchange="if(this.value) window.location=this.value;">
                <option value="">Mau mengadopsi apa?</option>
                <option value="{{ route('pets.category', 'anjing') }}">Anjing</option>
                <option value="{{ route('pets.category', 'kucing') }}">Kucing</option>
                <option value="{{ route('pets.category', 'kelinci') }}">Kelinci</option>
                <option value="{{ route('pets.category', 'burung') }}">Burung</option>
                <option value="{{ route('pets.category', 'hamster') }}">Hamster</option>
                <option value="{{ route('pets.category', 'reptil') }}">Reptil</option>
              </select>
          
              <ul class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
                <li class="nav-item active">
                  <a href="{{ route('home') }}" class="nav-link">Beranda</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('pets.index') }}" class="nav-link">Hewan Tersedia</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('adoption.guide') }}" class="nav-link">Cara Adopsi</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('home') }}#newsletter" class="nav-link">Donasi</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('home') }}#latest-blog" class="nav-link">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('home') }}#search-tags" class="nav-link">Tentang Kami</a>
                </li>
                @auth
                  <li class="nav-item">
                    <a href="{{ route('pets.create') }}" class="nav-link">Tambah Hewan</a>
                  </li>
                @endauth
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" role="button" id="pages" data-bs-toggle="dropdown" aria-expanded="false">Halaman</a>
                  <ul class="dropdown-menu" aria-labelledby="pages">
                    <li><a href="{{ route('pets.index') }}" class="dropdown-item">Semua Hewan</a></li>
                    <li><a href="{{ route('shelters.index') }}" class="dropdown-item">Daftar Shelter</a></li>
                    @auth
                      <li><a href="{{ route('adoptions.index') }}" class="dropdown-item">Permohonan Saya</a></li>
                      <li><a href="{{ route('favorites.index') }}" class="dropdown-item">Favorit Saya</a></li>
                      <li><a href="{{ route('pets.mine') }}" class="dropdown-item">Hewan Saya</a></li>
                      <li><a href="{{ route('profile.show') }}" class="dropdown-item">Profil Saya</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li>
                        <form method="post" action="{{ route('logout') }}" class="d-inline">
                          @csrf
                          <button type="submit" class="dropdown-item text-danger">Logout</button>
                        </form>
                      </li>
                      @if(auth()->user()->is_admin)
                        <li><a href="{{ route('admin.dashboard') }}" class="dropdown-item">Admin Panel</a></li>
                      @endif
                    @else
                      <li><a href="{{ route('login') }}" class="dropdown-item">Login untuk Adopsi</a></li>
                    @endauth
                  </ul>
                </li>
              </ul>
            
            </div>

          </div>
      </nav>
    </div>
  </div>
</header>
