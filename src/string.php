<?php

if ( ! function_exists('s')) {
    /**
     * Simple helper to format strings.
     *
     * @param $format
     * @param string ...$args
     * @param array [string] $args
     *
     * @return string
     */
    function s($format, $args) {
        if (is_array($args)) {
            return strtr($format, $args);
        } else {
            return call_user_func_array('sprintf', func_get_args());
        }
    }
}

if ( ! function_exists('str_starts_with')) {
    /**
     * Check if a string starts with the given sequence.
     *
     * @param $string
     * @param $search
     * @param bool $caseSensitive
     *
     * @return bool
     */
    function str_starts_with($string, $search, $caseSensitive = false) {
        $match = substr($string, 0, strlen($search));

        if ($caseSensitive) {
            return $match == $search;
        }

        return strcasecmp($match, $search) === 0;
    }
}

if ( ! function_exists('str_ends_with')) {
    /**
     * Check if a string ends with the given sequence.
     *
     * @param $string
     * @param $search
     * @param bool $caseSensitive
     *
     * @return bool
     */
    function str_ends_with($string, $search, $caseSensitive = false) {
        $match = substr($string, -strlen($search));

        if ($caseSensitive) {
            return $match == $search;
        }

        return strcasecmp($match, $search) === 0;
    }
}

if ( ! function_exists('url')) {
    /**
     * Combine multiple strings to a url.
     *
     * @param $paths
     *
     * @return string
     */
    function url($paths) {
        if ( ! is_array($paths)) {
            $paths = func_get_args();
        }

        $path = implode('/', $paths);
        $path = preg_replace('#(^|[^:])//+#', '\\1/', $path);
        $path = preg_replace('#([/]+$)#', '', $path);

        return $path;
    }
}

if ( ! function_exists('path')) {
    /**
     * Combine multiple strings to a path.
     *
     * @param $paths
     *
     * @return string
     */
    function path($paths) {
        if ( ! is_array($paths)) {
            $paths = func_get_args();
        }

        $path = implode(DIRECTORY_SEPARATOR, $paths);
        $path = preg_replace(
            '#' . DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR . '+#',
            DIRECTORY_SEPARATOR,
            $path
        );
        $path = preg_replace('#([' . DIRECTORY_SEPARATOR . ']+$)#', '', $path);

        return $path;
    }
}

if ( ! function_exists('get_type')) {
    /**
     * Get type of a value.
     *
     * @param $abstract
     *
     * @return string
     */
    function get_type($abstract) {
        $type = gettype($abstract);

        if ($type == 'object') {
            $type = get_class($abstract);
        }

        return $type;
    }
}

if ( ! function_exists('str_snake_case')) {
    /**
     * Convert string to snake_case.
     *
     * @param $string
     *
     * @return string
     */
    function str_snake_case($string) {
        $string = str_replace(['-', '_'], '', $string);
        $string = strtolower(preg_replace('/(?<!^)([A-Z])/', '_$1', $string));

        return $string;
    }
}

if ( ! function_exists('str_camel_case')) {
    /**
     * Convert string to CamelCase.
     *
     * @param $string
     * @param array $delimiters
     *
     * @return string
     */
    function str_camel_case($string, array $delimiters = ['-', '_']) {
        return str_replace(
            ' ', '', ucwords(str_replace($delimiters, ' ', $string))
        );
    }
}

if ( ! function_exists('str_random')) {
    /**
     * Generate a random alphanumeric string.
     * Works only with even numbers.
     *
     * @param int $length
     *
     * @return string
     */
    function str_random($length = 10) {
        return bin2hex(openssl_random_pseudo_bytes($length / 2));
    }
}

if ( ! function_exists('uuid')) {
    /**
     * Generate a v4 uuid.
     * http://stackoverflow.com/a/15875555/1734033
     *
     * @return string
     */
    function uuid() {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        return vsprintf(
            '%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4)
        );
    }
}

if ( ! function_exists('simple_uuid')) {
    /**
     * Generate a uuid of a simpler format.
     *
     * @return string
     */
    function simple_uuid() {
        return str_random(32);
    }
}
