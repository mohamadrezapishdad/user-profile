<?php
namespace Larafa\UserProfile;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

 class Service
 {
 	public function filter(Builder $query, Request $request)
    {
        $filters = json_decode($request->filters , true);
        if (! is_array($filters)) {return $query;}
        $this->applyFilters($query , $filters);
        return $query;
    }

    protected function applyFilters(Builder $query, Array $filters)
    {
        // If the value is not an array then the query would be added
        foreach ($filters as $key => $value) {
            if (! in_array($key , $this->filterables)){continue;}
            $query = (is_array($value))?$query:$query->where($key, 'like', '%'.$value.'%');
        }
    }

    public function include(Builder $query, Request $request)
    {
        $include = json_decode($request->include , true);
        if (! is_array($include)) {return $query->get();}
        return $query->get($include);
    }
 } 