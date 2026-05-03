<?php

namespace App\Services;

use App\Interfaces\MovieRepositoryInterface;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class MovieService
{
    protected $movieRepo;

    public function __construct(MovieRepositoryInterface $movieRepo)
    {
        $this->movieRepo = $movieRepo;
    }

    // CREATE MOVIE
    public function createMovie($data, $file)
    {
        $randomName = Str::uuid()->toString();
        $fileName = $randomName . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('images'), $fileName);

        $data['foto_sampul'] = $fileName;

        return $this->movieRepo->create($data);
    }

    // LIST MOVIES (with search)
    public function getMovies($search = null)
    {
        return $this->movieRepo->getAll($search);
    }

    // ALL MOVIES (for data table)
    public function getAllMovies()
    {
        return $this->movieRepo->getAll(null);
    }

    // DETAIL MOVIE
    public function getMovieById($id)
    {
        return $this->movieRepo->find($id);
    }

    // UPDATE MOVIE
    public function updateMovie($id, $request)
    {
        $data = $request->all();

        // kalau ada file baru
        if ($request->hasFile('foto_sampul')) {
            $file = $request->file('foto_sampul');

            $fileName = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $fileName);

            $data['foto_sampul'] = $fileName;
        }

        return $this->movieRepo->update($id, $data);
    }

    // DELETE MOVIE
    public function deleteMovie($id)
    {
        $movie = $this->movieRepo->find($id);

        // hapus file gambar kalau ada
        if ($movie->foto_sampul && File::exists(public_path('images/' . $movie->foto_sampul))) {
            File::delete(public_path('images/' . $movie->foto_sampul));
        }

        return $this->movieRepo->delete($id);
    }
}