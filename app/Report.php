<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @property User reporter
 * @property MorphOne reportable
 */
class Report extends \Artisanry\Reportable\Models\Report
{
    //
}
