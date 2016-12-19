# String helpers

[![Build Status](https://img.shields.io/travis/weew/helpers-string.svg)](https://travis-ci.org/weew/helpers-string)
[![Test Coverage](https://img.shields.io/coveralls/weew/helpers-string.svg)](https://coveralls.io/github/weew/helpers-string)
[![Version](https://img.shields.io/packagist/v/weew/helpers-string.svg)](https://packagist.org/packages/weew/helpers-string)
[![Licence](https://img.shields.io/packagist/l/weew/helpers-string.svg)](https://packagist.org/packages/weew/helpers-string)

## Table of contents

- [Installation](#installation)
- [Introduction](#introduction)
- [Functions](#functions)
    - [s](#s)
    - [str_starts_with](#str_starts_with)
    - [str_ends_with](#str_ends_with)
    - [url](#url)
    - [path](#path)
    - [get_type](#get_type)
    - [str_snake_case](#str_snake_case)
    - [str_studly_caps](#str_studly_caps)
    - [str_camel_case](#str_camel_case)
    - [str_random](#str_random)
    - [str_explode](#str_explode)
    - [uuid](#uuid)
    - [uuid_format](#uuid_format)
    - [simple_uuid](#simple_uuid)
    - [format_xml](#format_xml)

## Installation

`composer install weew/helpers-string`

## Introduction

This tiny library provides various helper functions to deal with common string manipulation related problems.

## Functions

#### s

Simple helper to format strings. Supports placeholders like `:key` and `%s`.

`string s(string $format, mixed $args [, mixed $...])`

#### str\_starts\_with

Check if a string starts with the given sequence.

`bool str_starts_with(string $string, string $search [, bool $caseSensitive = false])`

#### str\_ends\_with

heck if a string ends with the given sequence.

`bool str_ends_with(string $string, string $search [, bool $caseSensitive = false])`

#### url

Combine multiple strings to a url. This function makes sure the pieces are properly glued together with a `/` and eliminates all `//`, except after the protocol.

`string url(string $paths [, $...])`

#### path

Combine multiple strings to a path. Glues pieces together with the proper directory separator and eliminates all `//` or `\\`.

`string path(string $paths [, $...])`

#### get\_type

Get type of a value. Returns values like `int`, `string`, `function`. Objects will return its class name.

`string get_type(mixed $abstract)`

#### str\_snake\_case

Convert string to snake_case.

`string str_snake_case(string $string)`

#### str\_studly\_caps

Convert string to StudlyCase.

`string str_studly_caps(string $string [, array $delimiters = ['-', '_']])`

#### str\_camel\_case

Convert a string to camelCase.

`string str_camel_case(string $string [, array $delimiters = ['-', '_']])`

#### str\_random

Generate a random alphanumeric string. Works only with even numbers.

`string str_random([int $length = 10])`

#### str\_explode

Split a string by one or multiple delimiters. Works the same way as the `explode` function, but allows several delimiters.

`string str_explode(string $string, string|array $delimiter [, int $limit = PHP_INT_MAX])`

#### uuid

Generate a v4 uuid.

`string uuid([string $prefix = null, int $length = 36])`

#### uuid\_format

Format string as a v4 uuid.

`string uuid_format(string $string [, string $prefix = null, int $length = null])`

#### simple\_uuid

Generate a uuid of a simpler format.

`string simple_uuid()`

#### format\_xml

Format an xml string.

`string format_xml($string)`
