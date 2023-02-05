<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait CreatedUpdatedDeletedBy
{
    /**
     * Trigger when change database.
     *
     * @return void
     */
    protected static function updateCreatedUpdatedDeletedBy()
    {
        // trigger before create
        static::creating(function ($model) {
            $user = Auth::user();
            $model->created_by = optional($user)->id;
            $model->updated_by = optional($user)->id;
        });

        // trigger before update
        static::updating(function ($model) {
            $user = Auth::user();
            $model->updated_by = optional($user)->id;
        });

        // trigger after soft delete
        static::softDeleted(function ($model) {
            $user = Auth::user();
            $model->deleted_by = optional($user)->id;
            $model->save();
        });
    }
}
