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
     *
     * @return bool
     */
    function str_starts_with($string, $search) {
        return substr($string, 0, strlen($search)) == $search;
    }
}

if ( ! function_exists('str_ends_with')) {
    /**
     * Check if a string ends with the given sequence.
     *
     * @param $string
     * @param $search
     *
     * @return bool
     */
    function str_ends_with($string, $search) {
        return substr($string, -strlen($search)) == $search;
    }
}

if ( ! function_exists('path')) {
    /**
     * @param $paths
     *
     * @return string
     */
    function path($paths) {
        return implode(DIRECTORY_SEPARATOR, func_get_args());
    }
}
