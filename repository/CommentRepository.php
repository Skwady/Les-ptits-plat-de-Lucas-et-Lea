<?php

namespace App\repository;

class CommentRepository extends BaseRepository
{
    public function __construct()
    {
        $this->table = 'comments';
    }
}
