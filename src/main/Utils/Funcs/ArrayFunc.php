<?php

namespace Components\Utils\Funcs;

/**
 * Class ArrayFunc
 * @package Components\Utils\Funcs
 * 一些数组相关的常用函数
 * @author 王锦
 */
class ArrayFunc
{
    /**
     * getArrayChild
     * 获取数组深层的一个值
     * @param array $array 数组值
     * @param string $path 各级下标用/分隔
     * @param mixed $default 如果不存在的返回值
     * @return array|mixed|null
     */
    public static function getArrayChild(array $array, string $path, $default = null)
    {
        $paths = explode("/", $path);
        if (!strlen($path)) {
            return $array;
        }
        $ret = $array;
        # 这一段其实可以用eval，考虑到公司禁用此函数，换了实现方法
        foreach ($paths as $item) {
            if (strlen($item)) {
                if (isset($ret[$item])) {
                    $ret = $ret[$item];
                } else {
                    return $default;
                }
            }
        }
        return $ret;
    }
}

# end of file
