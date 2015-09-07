<?php

class StringTest extends PHPUnit_Framework_TestCase {
    public function strings_provider() {
        return [
            [true, 'foo bar', 'foo', 'bar', false],
            [true, 'foo bar', 'Foo', 'Bar', false],
            [true, 'Foo Bar', 'Foo', 'Bar', true],
            [false, 'bar foo', 'foo', 'bar', false],
            [false, 'foo bar', 'Foo', 'Bar', true],
        ];
    }

    public function formats_provider() {
        return [
            ['foo yolo bar', 'foo %s bar', 'yolo', null, null],
            ['killer coding ninja monkey', 'killer %s %s %s', 'coding', 'ninja', 'monkey'],
            ['Luke, I am your father!!', ':luke, I am your :father!!',
                [':luke' => 'Luke', ':father' => 'father'], null, null]
        ];
    }

    public function urls_provider() {
        return [
            ['foo/bar', ['foo', 'bar']],
            ['x/y/z', ['x', 'y', 'z']],
            ['http://foo.bar/yolo/baz', ['http://foo.bar////yolo////baz/////']],
        ];
    }

    public function paths_provider() {
        return [
            ['/foo/bar/baz', ['///foo', '/bar////', 'baz////']],
            ['/foo/bar/baz', ['///foo//', '//bar/', '/baz/']]
        ];
    }

    /**
     * @dataProvider strings_provider
     */
    public function test_starts_with($expected, $string, $starts, $ends, $caseSensitive) {
        $this->assertEquals($expected, str_starts_with($string, $starts, $caseSensitive));
    }

    /**
     * @dataProvider strings_provider
     */
    public function test_ends_with($expected, $string, $starts, $ends, $caseSensitive) {
        $this->assertEquals($expected, str_ends_with($string, $ends, $caseSensitive));
    }

    /**
     * @dataProvider formats_provider
     */
    public function test_s($expected, $format, $arg1, $arg2, $arg3) {
        $this->assertEquals($expected, s($format, $arg1, $arg2, $arg3));
    }

    /**
     * @dataProvider urls_provider
     */
    public function test_url($expected, $segments) {
        $this->assertEquals(
            $expected, call_user_func_array('url', $segments)
        );
        $this->assertEquals(
            $expected, call_user_func_array('url', $segments)
        );
    }

    /**
     * @dataProvider paths_provider
     */
    public function test_path($expected, $segments) {
        $this->assertEquals(
            $expected, call_user_func_array('path', $segments)
        );
        $this->assertEquals(
            $expected, path($segments)
        );
    }

    public function test_get_type() {
        $this->assertEquals('Closure', get_type(function() {}));
        $this->assertEquals('string', get_type('foo'));
        $this->assertEquals('integer', get_type(1));
        $this->assertEquals('double', get_type(1.0));
        $this->assertEquals('boolean', get_type(true));
        $this->assertEquals('array', get_type([]));
        $this->assertEquals('stdClass', get_type(new stdClass()));
    }
}
