<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class GlobalHelper
{

    public function generateUniqueSlug($data, $name)
    {
        $slug = Str::slug($name);
        $count = 2;

        while ($data->where('slug', $slug)->exists()) {
            $slug = Str::slug($name) . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
