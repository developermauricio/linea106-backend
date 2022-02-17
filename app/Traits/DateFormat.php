<?php

namespace App\Traits;


trait HasApiTokens
{
    public function getDateFromLocale($date)
    {
        return \Carbon\Carbon::parseFromLocale($date, 'es-co', '-5');
    }
}
