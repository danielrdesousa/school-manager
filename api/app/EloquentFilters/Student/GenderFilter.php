<?php

namespace App\EloquentFilters\Student;

use Fouladgar\EloquentBuilder\Support\Foundation\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class GenderFilter extends Filter
{
    /**
     * Apply the gender condition to the query.
     *
     * @param Builder $builder
     * @param mixed   $value
     *
     * @return Builder
     */
    public function apply(Builder $builder, $value): Builder
    {
        return $builder->where('gender', '=', $value);
    }
}