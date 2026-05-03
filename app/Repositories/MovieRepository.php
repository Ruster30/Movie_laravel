<?php

namespace App\Repositories;

use App\Models\Movie;
use App\Interfaces\MovieRepositoryInterface;

class MovieRepository implements MovieRepositoryInterface
{
    public function getAll($search)
    {
        $query = Movie::latest();

        if ($search) {
            $query->where('judul', 'like', "%$search%")
                  ->orWhere('sinopsis', 'like', "%$search%");
        }

        return $query->paginate(6);
    }

    public function create(array $data)
    {
        return Movie::create($data);
    }

    public function find($id)
    {
        return Movie::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $movie = $this->find($id);
        return $movie->update($data);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
