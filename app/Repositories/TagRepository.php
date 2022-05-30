<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface
{
    public function getById($id)
    {
        return Tag::with('articles')->find($id)->articles;
    }
}
