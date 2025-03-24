<?php 

namespace App\Repositories;

use App\Models\Photo;
use App\RepositorieInterface\PhotoRepositoryInterface;

class PhotoRepository implements PhotoRepositoryInterface
{
    public function insertImage($data)
    {
        return Photo::create($data);
    }
}