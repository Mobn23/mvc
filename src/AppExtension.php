<?php

// src/Twig/AppExtension.php

namespace App;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    /**
     *
     * This getFilters method.
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('unicode_code_point', [$this, 'getUnicodeCodePoint']),
        ];
    }

    /**
     *
     * This getUnicodeCodePoint method.
     */
    public function getUnicodeCodePoint($char): int
    {
        return mb_ord($char);
    }
}
