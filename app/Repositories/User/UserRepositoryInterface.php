<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function findByEmail(String $email);
    public function store(array $attr);
}
