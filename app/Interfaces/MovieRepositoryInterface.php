<?php

namespace App\Interfaces;

interface MovieRepositoryInterface
{
    public function getAll($search);
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
    public function delete($id);
}