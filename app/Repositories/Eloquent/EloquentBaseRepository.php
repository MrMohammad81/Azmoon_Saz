<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;

class EloquentBaseRepository implements RepositoryInterface
{
    protected $model;

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->model::where('id' , $id)->update($data);
    }

    public function all(array $where)
    {
        $query = $this->model::query();

        foreach ($where as $key => $value)
        {
            $query->where($key , $value);
        }

        return $query->get();
    }

    public function delete(array $where)
    {
        $query = $this->model::query();

        foreach ($where as $key => $value)
        {
            $query->where($key , $value);
        }

        return $query->delete();
    }

    public function find(int $id)
    {
        return $this->model::find($id);
    }

    public function deleteBy(array $where)
    {
        // TODO: Implement deleteBy() method.
    }

    public function paginate(string $search, int $page, int $pagesize = 20)
    {
        // TODO: Implement paginate() method.
    }
}
