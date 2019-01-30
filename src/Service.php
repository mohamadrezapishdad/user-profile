<?php
namespace Larafa\UserProfile;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

 class Service
 {
 	public function filter(Builder $query, Array $filters)
    {
        $this->applyFilters($query , $filters);
        return $query;
    }

    protected function applyFilters(Builder &$query, Array $filters)
    {
        foreach ($filters as $key => $value) {
            if (! in_array($key , $this->filterables)){continue;}
            $query = (is_array($value))?$query:$query->where($key, 'like', '%'.$value.'%');
        }
    }

    public function include(Builder $query, Array $include)
    {
        $include = json_decode($request->include , true);
        if (! is_array($include)) {return $query->get();}
        return $query->get($include);
    }

    public function hasTrait($class , $trait){
 	    $traits = class_uses($class);
 	    return array_key_exists($trait, $traits);
    }
 } 