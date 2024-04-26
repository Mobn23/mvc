<?php

// src/Twig/AppExtension.php

namespace App;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('unicode_code_point', [$this, 'getUnicodeCodePoint']),
        ];
    }

    public function getUnicodeCodePoint($char): int
    {
        return mb_ord($char);
    }
}
