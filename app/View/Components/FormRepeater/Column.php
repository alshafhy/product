<?php

namespace App\View\Components\FormRepeater;

use Illuminate\Support\Arr;
use Illuminate\Support\Fluent;
use Illuminate\Support\Str;

/**
 * @property string title
 * @property string data
 * @property string name
 * @property string footer
 * @property array attributes
 * @see https://datatables.net/reference/option/#columns
 */
class Column extends Fluent
{

    /**
     * @param  array  $attributes
     */
    public function __construct($attributes = [])
    {
        $attributes['title'] = isset($attributes['title']) ? $attributes['title'] : self::titleFormat($attributes['data']);
        // $attributes['orderable'] = isset($attributes['orderable']) ? $attributes['orderable'] : true;
        $attributes['showInAddMode'] = isset($attributes['showInAddMode']) ? $attributes['showInAddMode'] : true;
        $attributes['showInEditMode'] = isset($attributes['showInEditMode']) ? $attributes['showInEditMode'] : true;
        $attributes['showInShowMode'] = isset($attributes['showInShowMode']) ? $attributes['showInShowMode'] : true;
        $attributes['type'] = isset($attributes['type']) ? $attributes['type'] : 'text';
        $attributes['value'] = isset($attributes['value']) ? $attributes['value'] : '';
        $attributes['placeholder'] = isset($attributes['placeholder']) ? $attributes['placeholder'] : '';
        $attributes['footer'] = isset($attributes['footer']) ? $attributes['footer'] : '';
        $attributes['attributes'] = isset($attributes['attributes']) ? $attributes['attributes'] : [];

        // Allow methods override attribute value
        foreach ($attributes as $attribute => $value) {
            $method = 'parse' . ucfirst(strtolower($attribute));
            if (!is_null($value) && method_exists($this, $method)) {
                $attributes[$attribute] = $this->$method($value);
            }
        }

        if (!isset($attributes['name']) && isset($attributes['data'])) {
            $attributes['name'] = $attributes['data'];
        }
        $attributes['id'] = isset($attributes['id']) ? $attributes['id'] : $attributes['name'];

        parent::__construct($attributes);
    }

    /**
     * Format string to title case.
     *
     * @param  string  $value
     * @return string
     */
    public static function titleFormat($value)
    {
        return Str::title(str_replace('_', ' ', $value));
    }
}