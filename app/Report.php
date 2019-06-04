<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property User reporter
 * @property MorphOne reportable
 */
class Report extends \BrianFaust\Reportable\Models\Report
{
    /**
     * A report has a reporter.
     *
     * @return HasOne
     */
    public function reporter(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'reporter_id');
    }
}
