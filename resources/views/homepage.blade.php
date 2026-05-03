@extends('layout.template')

@section('title', 'Homepage')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>    
@endif

<!-- Filter Kategori -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form method="GET" action="{{ url('/') }}" class="row g-3 align-items-end">
                    <div class="col-md-10">
                        <label class="form-label fw-semibold mb-1">Filter Kategori</label>
                        <select name="category" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Kategori</option>
                            <option value="Action" {{ request('category') == 'Action' ? 'selected' : '' }}>Action</option>
                            <option value="Drama" {{ request('category') == 'Drama' ? 'selected' : '' }}>Drama</option>
                            <option value="Comedy" {{ request('category') == 'Comedy' ? 'selected' : '' }}>Comedy</option>
                            <option value="Horror" {{ request('category') == 'Horror' ? 'selected' : '' }}>Horror</option>
                            <option value="Romance" {{ request('category') == 'Romance' ? 'selected' : '' }}>Romance</option>
                            <option value="Sci-Fi" {{ request('category') == 'Sci-Fi' ? 'selected' : '' }}>Sci-Fi</option>
                            <option value="Thriller" {{ request('category') == 'Thriller' ? 'selected' : '' }}>Thriller</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ url('/') }}" class="btn btn-secondary w-100">Reset</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<h1>Popular Movie</h1>
<div class="row">
    @foreach ($movies as $movie)
    <div class="col-lg-6 mb-4">
        <div class="card h-100" style="max-width: 540px; margin: 0 auto;">
            <div class="row g-0 h-100">
                <div class="col-md-4">
                    @if($movie->foto_sampul)
                        <img src="{{ asset('images/' . $movie->foto_sampul) }}" 
                            class="img-fluid rounded-start h-100 w-100" 
                            alt="{{ $movie->foto_sampul }}" 
                            style="object-fit: cover;">
                    @else
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center h-100" style="min-height: 200px;">
                            <i class="fas fa-film fa-2x"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <div class="card-body d-flex flex-column h-100">
                        <h5 class="card-title">{{ $movie->judul }}</h5>
                        <p class="card-text text-muted small">
                            <i class="fas fa-tag me-1"></i> {{ $movie->genre ?? 'General' }}
                            <br>
                            <i class="fas fa-star text-warning me-1"></i> {{ $movie->rating ?? 'NR' }}
                            <i class="fas fa-calendar ms-2 me-1"></i> {{ $movie->tahun ?? '-' }}
                        </p>
                        <div class="flex-grow-1">
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($movie->sinopsis ?? 'Tidak ada sinopsis', 100) }}</p>
                        </div>
                        <div class="mt-auto">
                            <a href="{{ url('/movie/' . $movie->id) }}" class="btn btn-success btn-sm">Lihat Selanjutnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    
    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3 w-100">
        {{ $movies->links() }}
    </div>
</div>
@endsection