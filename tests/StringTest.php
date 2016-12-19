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

    public function test_starts_with_array() {
        $this->assertTrue(str_starts_with('foo', ['a', 'b', 'f']));
        $this->assertFalse(str_starts_with('foo', ['a', 'b','c']));
    }

    public function test_starts_with_on_non_string() {
        $this->assertFalse(str_starts_with([], 'a'));
    }

    /**
     * @dataProvider strings_provider
     */
    public function test_ends_with($expected, $string, $starts, $ends, $caseSensitive) {
        $this->assertEquals($expected, str_ends_with($string, $ends, $caseSensitive));
    }

    public function test_ends_with_array() {
        $this->assertTrue(str_starts_with('foo', ['o', 'b', 'f']));
        $this->assertFalse(str_starts_with('foo', ['a', 'b','c']));
    }

    public function test_ends_with_on_non_string() {
        $this->assertFalse(str_ends_with([], 'a'));
    }

    /**
     * @dataProvider formats_provider
     */
    public function test_s($expected, $format, $arg1, $arg2, $arg3) {
        $this->assertEquals($expected, s($format, $arg1, $arg2, $arg3));
    }

    public function test_s_without_arguments() {
        $this->assertEquals('foo % bar', s('foo % bar'));
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

    public function str_snake_case_provider() {
        return [
            ['foo_bar', '_FooBar-'],
            ['foobar', 'Foobar-_'],
            ['foo_bar', 'FooBar__'],
            ['a_b_c_d', '_ABC_-D']
        ];
    }

    /**
     * @dataProvider str_snake_case_provider
     */
    public function test_str_snake_case($expected, $string) {
        $this->assertEquals($expected, str_snake_case($string));
    }

    public function str_studly_case_provider() {
        return [
            ['FooBar', 'foo__-bar_'],
            ['Foobar', 'foobar-'],
            ['FooBar', '__foo_bar'],
            ['ABCD', '-a_b_c_-d'],
        ];
    }

    public function str_camel_case_provider() {
        return [
            ['fooBar', 'foo__-bar_'],
            ['foobar', 'foobar-'],
            ['fooBar', '__foo_bar'],
            ['aBCD', '-a_b_c_-d'],
            ['fooBar', 'FooBar'],
        ];
    }

    /**
     * @dataProvider str_studly_case_provider
     */
    public function test_str_studly_case($expected, $string) {
        $this->assertEquals($expected, str_studly_caps($string));
    }

    /**
     * @dataProvider str_camel_case_provider
     */
    public function test_str_camel_case($expected, $string) {
        $this->assertEquals($expected, str_camel_case($string));
    }

    public function str_random_provider() {
        return [
            [1],
            [2],
            [3],
            [20],
            [32],
            [33],
            [18],
            [286],
        ];
    }

    /**
     * @dataProvider str_random_provider
     */
    public function test_str_random($length) {
        $str1 = str_random($length);
        $str2 = str_random($length);

        $this->assertEquals($length, strlen($str1));
        $this->assertEquals($length, strlen($str2));

        $this->assertTrue($str1 != $str2);
    }

    public function test_uuid() {
        $id1 = uuid();
        $id2 = uuid();

        $this->assertTrue($id1 != $id2);
    }

    public function test_uuid_with_prefix() {
        $uuid = uuid('foo');
        $this->assertStringStartsWith('foo', $uuid);
    }

    public function test_uuid_does_not_end_with_a_dash() {
        $this->assertFalse(str_ends_with(uuid('abcdefghijk'), '-'));
    }

    public function test_uuid_has_a_default_length() {
        $this->assertEquals(36, strlen(uuid()));
        $this->assertEquals(36, strlen(uuid('abcdefghijk')));
    }

    public function test_uuid_takes_custom_length() {
        $this->assertEquals(15, strlen(uuid(null, 15)));
        $this->assertEquals(15, strlen(uuid('abcdefghijk', 15)));
        $this->assertEquals(55, strlen(uuid(null, 55)));
        $this->assertEquals(55, strlen(uuid('abcdefghijk', 55)));
    }

    public function test_uuid_format() {
        $id = uuid_format('1234567812341234123412345678');
        $this->assertEquals('12345678-1234-1234-1234-12345678', $id);
    }

    public function test_uuid_format_with_prefix() {
        $uuid = uuid_format('123', 'foo');
        $this->assertStringStartsWith('foo', $uuid);
    }

    public function test_uuid_format_does_not_end_with_a_dash() {
        $this->assertFalse(str_ends_with(uuid_format('123'), '-'));
    }

    public function test_uuid_format_removes_double_dashes() {
        $this->assertFalse(
            strpos(uuid_format('12345678-1234-1234--1234--12345678'), '--')
        );
    }

    public function test_uuid_format_takes_custom_length() {
        $this->assertEquals(15, strlen(uuid_format('1234567890', null, 15)));
        $this->assertEquals(55, strlen(uuid_format('1', null, 55)));
        $this->assertEquals(55, strlen(uuid_format('12345678901', null, 55)));
    }

    public function test_uuid_simple() {
        $id1 = uuid_simple();
        $id2 = uuid_simple();

        $this->assertTrue($id1 != $id2);
    }

    public function test_uuid_simple_with_prefix() {
        $uuid = uuid_simple('foo');
        $this->assertStringStartsWith('foo', $uuid);
    }

    public function test_uuid_simple_has_default_length() {
        $this->assertEquals(32, strlen(uuid_simple()));
        $this->assertEquals(32, strlen(uuid_simple('abcdefghijk')));
    }

    public function test_uuid_simple_takes_custom_length() {
        $this->assertEquals(15, strlen(uuid_simple(null, 15)));
        $this->assertEquals(15, strlen(uuid_simple('abcdefghijk', 15)));
        $this->assertEquals(55, strlen(uuid_simple(null, 55)));
        $this->assertEquals(55, strlen(uuid_simple('abcdefghijk', 55)));
    }

    public function test_str_explode() {
        $this->assertEquals(['a', 'b'], str_explode('a:b', [':']));
        $this->assertEquals(['a', 'b'], str_explode('a:b', ':'));
        $this->assertEquals(['a:b'], str_explode('a:b', []));
        $this->assertEquals(['a', 'b', 'c', 'd'], str_explode('a:b_c#d', [':', '_', '#']));
    }

    public function test_format_xml() {
        $xml = '<root><element>foo</element></root>';
        $expected = <<<XML
<?xml version="1.0"?>
<root>
  <element>foo</element>
</root>

XML;

        $this->assertEquals($expected, format_xml($xml));
    }
}
