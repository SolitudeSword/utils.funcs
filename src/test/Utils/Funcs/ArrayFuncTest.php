<?php

namespace Components\Utils\Funcs;

use PHPUnit\Framework\TestCase;

class ArrayFuncTest extends TestCase
{
    public function getArrayChildData()
    {
        $array = [
            "dk1" => [
                "dk2" => "v1",
                "dk4" => [
                    "v3",
                    "v4",
                ],
            ],
            "dk3" => "v2",
        ];
        return [
            [$array, "", null, $array],
            [
                $array,
                "dk1/dk2",
                null,
                "v1",
            ],
            [
                $array,
                "dk3/dk2",
                "def",
                "def",
            ],
            [
                $array,
                "dk1/dk4/1",
                "def",
                "v4",
            ],
        ];
    }

    /**
     * testGetArrayChild
     * -
     * @param array $ary
     * @param string $path
     * @param mixed $def
     * @param mixed $expected
     * @return void
     * @dataProvider getArrayChildData
     */
    public function testGetArrayChild($ary, $path, $def, $expected)
    {
        self::assertEquals($expected, ArrayFunc::getArrayChild($ary, $path, $def));
    }
}

# end of file
