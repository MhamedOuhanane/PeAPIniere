<?php 

namespace App\Repositories;

use App\Models\Photo;

class PhotoRepository
{
    public function insertImage($data)
    {
        return Photo::create($data);
    }
}