<?php

namespace Components\Utils\Funcs;

use PHPUnit\Framework\TestCase;

/**
 * Class ArrayFuncTest
 * @package Components\Utils\Funcs
 * ArrayFunc的测试类
 * @author 王锦
 */
class ArrayFuncTest extends TestCase
{
    /**
     * getArrayChildData
     * testGetArrayChild的数据供给器
     * @return array 每条都是一个测试数据，结构参看testGetArrayChild的参数说明
     * @see testGetArrayChild
     */
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
            [
                $array,
                "",
                null,
                $array,
            ],
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
     * 测试getArrayChild
     * @param array $ary 要检索的数组
     * @param string $path 要检索的路径
     * @param mixed $def 默认值
     * @param mixed $expected 预期的值
     * @return void
     * @dataProvider getArrayChildData
     */
    public function testGetArrayChild($ary, $path, $def, $expected)
    {
        self::assertEquals($expected, ArrayFunc::getArrayChild($ary, $path, $def));
    }
}

# end of file
