<?php

namespace App\Casts;

use Brick\Money\Money;
use Brick\Money\AbstractMoney;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class MoneyCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $formatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
        // $formatter->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, 'US$ ');
        $formatter->setSymbol(\NumberFormatter::MONETARY_GROUPING_SEPARATOR_SYMBOL, ',');
        $formatter->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, 0);

        $money = Money::ofMinor($attributes['price'], $attributes['currency'] ?? 'USD');

        return $money->formatWith($formatter);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if ($value instanceof AbstractMoney)
        {
            return $value->getMinorAmount()->toInt();
        }

        return Money::of($value, $attributes['currency'] ?? 'USD')->getMinorAmount()->toInt();
    }

}
