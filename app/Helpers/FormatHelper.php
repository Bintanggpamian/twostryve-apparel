<?php

namespace App\Helpers;

class FormatHelper
{
    public static function price($num): string
    {
        return 'Rp ' . number_format($num, 0, ',', '.');
    }

    public static function discountPercent($price, $salePrice): int
    {
        if (!$salePrice || $salePrice >= $price) return 0;
        return (int) round((($price - $salePrice) / $price) * 100);
    }
}
