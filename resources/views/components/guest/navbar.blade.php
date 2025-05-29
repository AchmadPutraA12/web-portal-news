<header>
    <nav class="navbar navbar-expand-lg bg-white py-3">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('gambar/LOGOO.png') }}" alt="News360 Logo" style="height: 45px; max-width: 100%;">
            </a>

            <!-- Hamburger button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="navbar-collapse justify-content-center collapse" id="navbarContent">
                <ul class="navbar-nav gap-4">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ? 'active' : '' }}"
                            href="{{ url('/') }}">BERANDA</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="kategoriDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            KATEGORI
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="kategoriDropdown">
                            @forelse ($navCategories as $cat)
                                <li>
                                    <a class="dropdown-item" href="{{ route('category', $cat->id) }}">
                                        {{ strtoupper($cat->name) }}
                                    </a>
                                </li>
                            @empty
                                <li><span class="dropdown-item text-muted">Belum ada kategori</span></li>
                            @endforelse
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <style>
        .nav-link.active {
            color: #f25f0d !important;
            font-weight: bold;
            position: relative;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #f25f0d;
        }

        .btn-outline-orange {
            border: 1px solid #f25f0d;
            color: #f25f0d;
        }

        .btn-outline-orange:hover {
            background-color: #f25f0d;
            color: white;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28242,95,13, 1%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }
    </style>
</header>
