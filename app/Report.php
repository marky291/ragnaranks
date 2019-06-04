<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Report extends \BrianFaust\Reportable\Models\Report
{
    /**
     * A report has a reporter
     *
     * @return HasOne
     */
    public function reporter()
    {
        return $this->hasOne(User::class, 'id', 'reporter_id');
    }
}
