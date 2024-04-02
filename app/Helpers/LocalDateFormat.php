<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Number;

class LocalDateFormat
{
    public static function getTimezone(): string
    {
        return env("APP_TIMEZONE_NAME", "UTC");
    }

    public static function getLocalCurrency(string|int $value): string
    {
        return Number::currency($value, in: 'IDR');
    }

    public static function localDateFormatted(string $value): string
    {
        return Carbon::parse($value)->timezone(self::getTimezone())
            ->format('D, d M Y');
    }

    public static function localTimeFormatted(string $value): string
    {
        return Carbon::parse($value)->timezone(self::getTimezone())
            ->format('H:i A');
    }

    public static function localDatetimeFormatted(string $value): string
    {
        return Carbon::parse($value)->timezone(self::getTimezone())
            ->format('D, d M Y H:i A');
    }
}