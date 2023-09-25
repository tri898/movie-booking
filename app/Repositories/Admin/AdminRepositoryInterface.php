<?php

namespace App\Repositories\Admin;

interface AdminRepositoryInterface
{
    public function findByField($field, $value);

    public function store(array $attr);

    public function update($id, array $attr);

}
