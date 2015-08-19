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

if ( ! function_exists('path')) {
    /**
     * @param $paths
     *
     * @return string
     */
    function path($paths) {
        $path = implode(DIRECTORY_SEPARATOR, func_get_args());
        $path = preg_replace('#(^|[^:])//+#', '\\1/', $path);
        $path = preg_replace('#([/]+$)#', '', $path);

        return $path;
    }
}
