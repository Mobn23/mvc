<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};

// bin/console cache:clear
// php -S localhost:8888 -t public
// php -S localhost:8888
// npm run build

// Find issues need to fix
// tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src --dry-run

// Fix the issues just like npm run eslint:fix in node.js
// tools/php-cs-fixer/vendor/bin/php-cs-fixer fix src

// composer run csfix
// composer run csfix:dry to show the changes without excute them.