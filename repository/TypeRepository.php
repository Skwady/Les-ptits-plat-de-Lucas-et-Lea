<?php

namespace App\repository;

class TypeRepository extends BaseRepository
{

    public function __construct()
    {
        $this->table = 'type';
    }
}