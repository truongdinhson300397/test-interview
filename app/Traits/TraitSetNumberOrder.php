<?php

namespace App\Traits;

trait TraitSetNumberOrder
{
    public function setNumberOrder($data, $request)
    {
        // Set default
        $sortedBy = $request->sortedBy ?? 'asc';
        $total = $request->has('perPage') ? $data->total() : $data->count();
        $page = $request->page ?? 1;
        $perPage = $request->perPage ?? null;

        if (!empty($perPage)) {
            $startNumberOrder = $sortedBy === 'asc' ? (1 + ($page - 1) * $perPage) : ($total - ($page - 1) * $perPage);
            $data->map(function ($item, $key) use ($sortedBy, $startNumberOrder) {
                $item->index = $sortedBy === 'asc' ? ($startNumberOrder + $key) : ($startNumberOrder - $key);

                return $item;
            });
        }

        return $data;
    }
}
