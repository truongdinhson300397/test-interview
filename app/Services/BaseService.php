<?php

namespace App\Services;

use App\Repositories\BaseRepository;
use App\Traits\HasTransformer;

abstract class BaseService
{
    use HasTransformer;

    protected BaseRepository $repository;
    protected $transformer = null;

    public function __construct(BaseRepository $repository, $transformer)
    {
        $this->repository = $repository;
        $this->transformer = $transformer;
    }

    public function index()
    {
        $data = $this->repository->index();
        return $this->success($data, $this->transformer);
    }

    public function show($id)
    {
        $resource = $this->repository->show($id);
        return $this->success($resource, $this->transformer);
    }

    public function store($params)
    {
        $resource = $this->repository->store($params);
        return $this->success($resource, $this->transformer);
    }

    public function update($id, $params)
    {
        $resource = $this->repository->update($id, $params);
        return $this->success($resource, $this->transformer);
    }

    public function destroy($id)
    {
        $this->repository->destroy($id);
        return $this->success(null, null, 204);
    }
}
