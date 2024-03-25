<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Number;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_name',
        'transaction_value',
        'transaction_date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getTimezoneAttribute(): string
    {
        return env("APP_TIMEZONE_NAME", "UTC");
    }

    public function getLocalCurrencyAttribute(): string
    {
        return Number::currency($this->transaction_value, in: 'IDR');
    }

    public function getLocalDatetimeFormatAttribute(): string
    {
        return Carbon::parse($this->transaction_date)->timezone($this->getTimezoneAttribute())->format('D, d M Y H:i A');
    }
}
