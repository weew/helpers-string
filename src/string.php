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
