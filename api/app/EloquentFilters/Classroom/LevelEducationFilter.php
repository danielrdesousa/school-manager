<?php

namespace App\EloquentFilters\Classroom;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class LevelEducationFilter extends Filter
{
    /**
     * Apply the education level condition to the query.
     *
     * @param Builder $builder
     * @param mixed   $value
     *
     * @return Builder
     */
    public function apply(Builder $builder, $value): Builder
    {
        return $builder->where('level_education', '=', $value);
    }
}
