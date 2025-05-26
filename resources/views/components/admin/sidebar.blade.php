<style>
    .sidebar-wrapper {
        height: 100vh;
        background-color: #FF5F00;
        padding: 1rem;
        color: white;
    }

    .sidebar-link {
        display: block;
        padding: 0.5rem 1rem;
        margin-bottom: 0.5rem;
        border-radius: 5px;
        background-color: transparent;
        color: white;
        text-decoration: none;
        transition: background 0.2s;
    }

    .sidebar-link:hover,
    .sidebar-link.active {
        background-color: #fff;
        color: #FF5F00;
        font-weight: bold;
    }

    .btn-logout {
        background-color: white;
        color: #FF5F00;
        font-weight: bold;
        padding: 0.4rem 1rem;
        border: none;
        border-radius: 6px;
    }

    @media (max-width: 768px) {
        .sidebar-wrapper {
            position: relative;
            height: auto;
        }
    }
</style>

<div class="d-flex flex-column justify-content-between p-3 text-white" style="height: 100%;">
    <div>
        <button class="btn btn-light text-dark mb-3">Kembali</button>
        <h5 class="fw-bold">Dashboard</h5>
        <nav class="nav flex-column">
            <a href="#" class="nav-link ps-0 text-white">Profil</a>
            <a href="{{ route('admin.user.index') }}" class="nav-link ps-0 text-white">User</a>
            <a href="{{ route('admin.verifikasi-article.index') }}" class="nav-link ps-0 text-white">Verifikasi Artikel</a>
            <a href="{{ route('admin.article.index') }}" class="nav-link ps-0 text-white">Artikel</a>
        </nav>
    </div>
    <div class="mt-4">
        <button class="btn btn-light text-danger fw-bold">Logout</button>
    </div>
</div>
