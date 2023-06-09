<?php

namespace App\Helpers;

use Carbon\Carbon;
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

    public function convertStringToHoursMinutes($timeString,$start_time)
    {
        $minutes = intval(preg_replace('/[^0-9]+/', '', $timeString));

        // $hours = floor($minutes / 60);
        // $remainingMinutes = $minutes % 60;


        // $time = Carbon::now()->setTime($hours, $remainingMinutes);
        $time = Carbon::createFromFormat('Y/m/d H:i:s', $start_time)->addMinutes( $minutes + 30);
        return  $time;
    }
}
