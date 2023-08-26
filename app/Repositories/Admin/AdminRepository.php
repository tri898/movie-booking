<?php

namespace App\Repositories\Admin;

use App\Models\Admin;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AdminRepository implements AdminRepositoryInterface
{
    /**
     * Get all field in admin with relationships.
     *
     * @param array $relations
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getAllWith(array $relations, int $limit = 10): LengthAwarePaginator
    {
        return Admin::with($relations)->latest()->paginate($limit);
    }

    /**
     * Store admin information.
     *
     * @param array $attr
     * @return mixed
     */
    public function store(array $attr): mixed
    {
        return Admin::create($attr);
    }

    /**
     * Update admin information.
     *
     * @param $id
     * @param array $attr
     * @return mixed
     */
    public function update($id, array $attr): mixed
    {
        return $this->findOrFail($id)->update($attr);
    }

    /**
     * Find admin by field.
     *
     * @param $field
     * @param $value
     * @return mixed
     */
    public function findByField($field, $value): mixed
    {
        return Admin::where($field, $value)->first();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOrFail($id): mixed
    {
        return Admin::findOrFail($id);
    }

}
