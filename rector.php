<?php

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/app',
    ]);

    $rectorConfig->sets([
        SetList::CODE_QUALITY,    // Улучшение читаемости и структуры кода
        SetList::CODING_STYLE,    // Приведение кода к стилю (например, PSR)
        SetList::DEAD_CODE,       // Удаление неиспользуемого кода
    ]);
};
