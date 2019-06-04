<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Collection;

/**
 * @property User reporter
 * @property MorphOne reportable
 */
class Report extends \BrianFaust\Reportable\Models\Report
{

    public function scopeUnjudged(Builder $query) : Builder
    {
        return $query->doesntHave('conclusion');
    }

    /**
     * A report has a reporter
     *
     * @return HasOne
     */
    public function reporter(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'reporter_id');
    }
}
