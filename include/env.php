<?php
/**
 * Lightweight .env loader.
 *
 * - Reads the project root .env file (sibling of /include).
 * - Populates getenv(), $_ENV and $_SERVER once per request.
 * - Safe to include multiple times thanks to the ENV_LOADED guard.
 */

if (!defined('ENV_LOADED')) {
    define('ENV_LOADED', true);

    $envPath = __DIR__ . '/../.env';
    if (file_exists($envPath) && is_readable($envPath)) {
        $env = parse_ini_file($envPath, false, INI_SCANNER_TYPED);
        if ($env !== false) {
            foreach ($env as $key => $value) {
                if (getenv($key) === false) {
                    putenv("$key=$value");
                    $_ENV[$key]    = $value;
                    $_SERVER[$key] = $value;
                }
            }
        }
    }
}

