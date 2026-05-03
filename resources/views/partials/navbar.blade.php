<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            <i class="fas fa-film me-2"></i>best<span class="text-warning">movie</span>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/movies') }}">Semua Film</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/movies/create') }}">Tambah Film</a>
                </li>
            </ul>
            
            <form action="{{ url('/search') }}" method="GET" class="d-flex">
                <input class="form-control me-2" type="search" name="q" placeholder="Cari film..." value="{{ request('q') }}">
                <button class="btn btn-outline-warning" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>
</nav>