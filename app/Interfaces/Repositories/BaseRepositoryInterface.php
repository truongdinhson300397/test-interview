<?php

namespace App\Interfaces\Repositories;

interface BaseRepositoryInterface
{
    public function index($conditions = [], $relations = [], $all = false);

    public function cursor($conditions = [], $relations = [], $all = false);

    public function show($id);

    public function store($attributes);

    public function update($id, $attributes);

    public function destroy($id);

    public function exists($attributes);

    public function query();

    public function model();
}
