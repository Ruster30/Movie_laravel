<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\MovieService;
use App\Http\Requests\StoreMovieRequest;

class MovieController extends Controller
{
    protected $movieService;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    // LIST MOVIE
    public function index()
    {
        $movies = $this->movieService->getMovies(request('search'));
        return view('homepage', compact('movies'));
    }

    // DETAIL MOVIE
    public function detail($id)
    {
        $movie = $this->movieService->getMovieById($id);
        return view('detail', compact('movie'));
    }

    // FORM CREATE
    public function create()
    {
        $categories = Category::all();
        return view('input', compact('categories'));
    }

    // STORE MOVIE
    public function store(StoreMovieRequest $request)
    {
        $this->movieService->createMovie(
            $request->validated(),
            $request->file('foto_sampul')
        );

        return redirect('/')->with('success', 'Film berhasil ditambahkan.');
    }

    // DATA TABLE
    public function data()
    {
        $movies = $this->movieService->getAllMovies();
        return view('data-movies', compact('movies'));
    }

    // FORM EDIT
    public function form_edit($id)
    {
        $movie = $this->movieService->getMovieById($id);
        $categories = Category::all();

        return view('form-edit', compact('movie', 'categories'));
    }

    // UPDATE MOVIE
    public function update(Request $request, $id)
    {
        $this->movieService->updateMovie($id, $request);

        return redirect('/movies/data')->with('success', 'Data berhasil diperbarui');
    }

    // DELETE MOVIE
    public function delete($id)
    {
        $this->movieService->deleteMovie($id);

        return redirect('/movies/data')->with('success', 'Data berhasil dihapus');
    }
}