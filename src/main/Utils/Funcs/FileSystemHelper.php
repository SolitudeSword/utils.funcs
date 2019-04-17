<?php

namespace Components\Utils\Funcs;

/**
 * Class FileSystemHelper
 * @package Components\Utils\Funcs
 * 文件系统辅助函数
 * @author 王锦
 */
class FileSystemHelper
{
    /**
     * deleteDir
     * 递归删除一个目录
     * @param string $dirPath 目录地址
     * @param bool $fileDelete 如果传入的是文件而非目录，是否也要删除
     * @return bool 是否成功删除
     */
    public static function deleteDir(string $dirPath, bool $fileDelete = true): bool
    {
        if (!is_dir($dirPath)) {
            if ($fileDelete && file_exists($dirPath)) {
                unlink($dirPath);
            }
            return !file_exists($dirPath);
        }
        $stack = [realpath($dirPath)];
        while ($stack) {
            $dir = array_pop($stack);
            $hasChildDir = false;
            $handle = opendir($dir);
            for ($child = readdir($handle); $child; $child = readdir($handle)) {
                if ($child == "." || $child == "..") {
                    continue;
                }
                $fullChild = "{$dir}/{$child}";
                if (is_dir($fullChild)) {
                    if (!$hasChildDir) {
                        $hasChildDir = true;
                        $stack[] = $dir;
                    }
                    $stack[] = $fullChild;
                } else {
                    unlink($fullChild);
                }
            }
            closedir($handle);
            if (!$hasChildDir) {
                rmdir($dir);
            }
        }
        return !file_exists($dirPath);
    }
}

# end of file
