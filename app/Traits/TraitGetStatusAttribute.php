<?php

namespace App\Traits;

use App\Enums\BannerPublicFlagEnum;
use App\Enums\BannerPublicStatusEnum;
use Carbon\Carbon;

trait TraitGetStatusAttribute
{
    public function getStatusAttribute()
    {
        if ($this->is_published === BannerPublicFlagEnum::PRIVATE) {
            return BannerPublicStatusEnum::PRIVATE;
        }

        $now = Carbon::now();
        if ($now->format('Y-m-d H:i') < Carbon::parse($this->start_datetime)->format('Y-m-d H:i')) {
            return BannerPublicStatusEnum::BEFORE_OPEN;
        }
        if ($now->format('Y-m-d H:i') >= Carbon::parse($this->end_datetime)->format('Y-m-d H:i')) {
            return BannerPublicStatusEnum::CLOSED;
        }

        return BannerPublicStatusEnum::OPENING;
    }
}
