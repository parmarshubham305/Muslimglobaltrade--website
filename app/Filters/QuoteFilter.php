<?php

/**
 * @author TechVillage <support@techvill.org>
 *
 * @contributor Al Mamun <[almamun.techvill@gmail.com]>
 *
 * @created 03-03-2024
 */

namespace App\Filters;

class QuoteFilter extends Filter
{
    /**
     * set the rules of query string
     *
     * @var array
     */
    protected $filterRules = [];

    /**
     * filter read at  query string
     *
     * @param  string  $readStatus
     * @return query builder
     */
    public function users($id)
    {
        return $this->query->where('user_id', $id);
    }
}
