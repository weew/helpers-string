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
            $string = strtr($format, $args);
        } else {
            $string = call_user_func_array('sprintf', func_get_args());
        }

        return strtr($string, [
            '\t' => "\t",
            '\n' => "\n",
        ]);
    }
}

if ( ! function_exists('str_starts_with')) {
    /**
     * Check if a string starts with the given sequence.
     *
     * @param string $string
     * @param string|array $search
     * @param bool $caseSensitive
     *
     * @return bool
     */
    function str_starts_with($string, $search, $caseSensitive = false) {
        if ( ! is_string($string)) {
            return false;
        }

        if ( ! is_array($search)) {
            $search = [$search];
        }

        foreach ($search as $item) {
            $match = substr($string, 0, strlen($item));

            if ($caseSensitive) {
                if ($match == $item) {
                    return true;
                }
            } else if (strcasecmp($match, $item) === 0) {
                return true;
            }
        }

        return false;
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
        if ( ! is_string($string)) {
            return false;
        }

        if ( ! is_array($search)) {
            $search = [$search];
        }

        foreach ($search as $item) {
            $match = substr($string, -strlen($item));

            if ($caseSensitive) {
                if ($match == $item) {
                    return true;
                }
            } else if(strcasecmp($match, $item) === 0) {
                return true;
            }
        }

        return false;
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

if ( ! function_exists('str_studly_caps')) {
    /**
     * Convert string to StudlyCase.
     *
     * @param $string
     * @param array $delimiters
     *
     * @return string
     */
    function str_studly_caps($string, array $delimiters = ['-', '_']) {
        return str_replace(
            ' ', '', ucwords(str_replace($delimiters, ' ', $string))
        );
    }
}

if ( ! function_exists('str_camel_case')) {
    /**
     * Convert a string to camelCase.
     *
     * @param $string
     * @param array $delimiters
     *
     * @return string
     */
    function str_camel_case($string, array $delimiters = ['-', '_']) {
        return lcfirst(str_studly_caps($string, $delimiters));
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
     * @param null $prefix
     *
     * @return string
     */
    function uuid($prefix = null) {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        $uuid = vsprintf(
            '%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4)
        );

        if ($prefix !== null) {
            $uuid = s('%s-%s', $prefix, $uuid);
        }

        return $uuid;
    }
}

if ( ! function_exists('uuid_simple')) {
    /**
     * Generate a uuid of a simpler format.
     *
     * @param null $prefix
     *
     * @return string
     */
    function uuid_simple($prefix = null) {
        $uuid = str_random(32);

        if ($prefix !== null) {
            $uuid = s('%s-%s', $prefix, $uuid);
        }

        return $uuid;
    }
}
