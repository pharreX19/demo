<?php

namespace App\Libraries\Traits;

use Illuminate\Support\Str;
use TradenetCorp\OnegovAuthClient\Helpers\Uuid;
use Carbon\Carbon;

trait Filterable
{
    public function scopeFilter($query, $params = [])
    {
        // dd($params);
        $filters = isset($this->filters) ? $this->filters : [];

        $params = $params ?? request()->all();

        foreach ($params as $key => $value) {
            if (array_key_exists($key, $filters)) {
                $query = $this->resolveFilter($filters[$key], $query, $key, $value);
            }
        }

        return $query;
    }

    public function resolveFilter($filter, $query, $key, $value)
    {
        $filter_array = explode('|', $filter); // multi filter
        $data_type = $filter_array[0];
        $rule = isset($filter_array[1]) ? $filter_array[1] : null;

        if ($rule) {
            $operation = Str::before($rule, ':');

            if ($operation) {
                $rules_array = explode('&', Str::after($rule, ':'));
                switch ($operation) {

                    case "in_array":
                        [$field] = explode(',', array_shift($rules_array));
                        $array_values = $value;
                        if (!is_array($value)) {
                            $array_values = explode(',', $value);
                        }
                        // dd($array_values);
                        return $query = $this->resolveDataType($query, $data_type, $field, $array_values);

                    case "json_contains":

                        [$field, $path] = explode(',', array_shift($rules_array));
                        return $query = $this->resolveDataType($query, $data_type, $path, $value);

                    case "carbon_between":

                        [$field] = explode(',', array_shift($rules_array));
                        $to_value = Carbon::now()->add($value);
                        return  $query = $query->where($field, '<=', $to_value);

                    default:

                        [$relation, $field] = explode(',', array_shift($rules_array));
                        $query = $query->whereHas($relation, function ($q)
                        use ($value, $data_type, $field, $rules_array) {
                            $q = $this->resolveDataType($q, $data_type, $field, $value);
                            foreach ($rules_array as $rule) {
                                [$prop, $val] = explode(',', $rule);
                                $q = $q->where($prop, $val);
                            }
                            return $q;
                        });
                }
            }
        } else {
            $query = $this->resolveDataType($query, $data_type, $key, $value);
        }

        return $query;
    }

    public function resolveDataType($query, $type, $field, $value)
    {
        $operation = 'where';
        if (is_array($value)) {
            $operation = 'whereIn';
        }

        if ($type == 'string') {
            $value = $this->transform_values($value, function ($item) {
                return '%' . $item . '%';
            });
            return $query->$operation($field, 'LIKE', $value);
        } else if ($type == 'like') {
            return $query->where($field, 'LIKE', preg_replace('/(^|\s+|\+|$)/', '%', $value));
        } else if ($type == 'uuid') {
            $value = $this->transform_values($value, function ($item) {
                return (Uuid::parse($item))->getBytes();
            });
            return $query->$operation($field, $value);
        } else if ($type == 'datetime') {
            $query->when($value, function ($q) use ($field, $value) {
                return $q->where($field, '>=', Carbon::now()->subDays($value));
            });
            return $query;
        } else {
            return $query->$operation($field, $value);
        }
    }

    private function transform_values($value, callable $fn)
    {
        if (is_array($value)) {
            return array_map($fn, $value);
        } else {
            return $fn($value);
        }
    }
}
