<?php

namespace App\Repositories;

use App\Interfaces\Repositories\BaseRepositoryInterface;
use App\Traits\HasPerPageRequest;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

abstract class BaseRepository implements BaseRepositoryInterface
{
    use HasPerPageRequest;

    protected Model $model;
    protected array $with = [];
    protected string $defaultSort = '-created_at';
    protected array $defaultSelect = ['*'];
    protected array $allowedFilters = [
        'id'
    ];
    protected array $allowedSorts = [
        'id',
        'created_at',
        'updated_at',
    ];
    protected array $allowedIncludes = [];
    protected array $allowedFields = [];

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    protected function addExtraFilters($filters)
    {
        $this->allowedFilters = array_merge($this->allowedFilters, $filters);
    }

    public function index($conditions = [], $relations = [], $all = false)
    {
        $query = QueryBuilder::for($this->model->query()->where($conditions))
            ->select($this->defaultSelect)
            ->allowedFilters($this->allowedFilters)
            ->allowedFields($this->allowedFields)
            ->allowedIncludes($this->allowedIncludes)
            ->allowedSorts($this->allowedSorts)
            ->defaultSort($this->defaultSort);

        if ($all)
            return $query->get();

        return $query->paginate($this->getPerPage());
    }

    public function cursor($conditions = [], $relations = [], $all = false)
    {
        $query = QueryBuilder::for($this->model->query()->where($conditions))
            ->select($this->defaultSelect)
            ->with($relations)
            ->allowedFilters($this->allowedFilters)
            ->allowedFields($this->allowedFields)
            ->allowedIncludes($this->allowedIncludes)
            ->allowedSorts($this->allowedSorts)
            ->defaultSort($this->defaultSort);

        if ($all)
            return $query->get();

        return $query->take($this->getPerPage())
            ->offset($this->getOffset())
            ->cursor();
    }

    public function show($id)
    {
        return QueryBuilder::for($this->model->where('id', $id))
            ->allowedFields($this->allowedFields)
            ->allowedIncludes($this->allowedIncludes)->firstOrFail();
    }

    public function store($attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes)
    {
        $data = $this->model->where('id', $id)->firstOrFail();
        $data->update($attributes);
        return $data->refresh();
        // For trigger observer
    }

    public function destroy($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    public function exists($attributes)
    {
        return $this->model->where($attributes)->exists();
    }

    public function getFirstByAttributes($attributes)
    {
        return $this->model->where($attributes)->firstOrFail();
    }

    public function getByAttributes($attributes)
    {
        return $this->model->where($attributes)->get();
    }

    public function query()
    {
        return $this->model->query();
    }

    public function model()
    {
        return $this->model;
    }
}
