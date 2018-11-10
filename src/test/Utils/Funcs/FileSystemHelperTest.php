<?php

namespace Components\Utils\Funcs;

use PHPUnit\Framework\TestCase;

class FileSystemHelperTest extends TestCase
{
    public function testDeleteDir()
    {
        # 创建目录
        $dir = __DIR__ . "/../../../../cache/" . uniqid("tmp_pre_delete");
        mkdir($dir, 0777, true);
        for ($idx = 0; $idx < 100; ++$idx)
        {
            $createFile = mt_rand(0, 1) == 1;
            $dep = mt_rand(1, 10);
            $ary = [];
            for ($jdx = 0; $jdx < $dep; ++$jdx)
            {
                $ary[] = "sub_" . mt_rand(0, 10);
            }
            $path = $dir . "/" . implode("/", $ary);
            if (!is_dir($path))
            {
                mkdir($path, 0777, true);
            }
            $name = uniqid("_{$idx}");
            if ($createFile)
            {
                file_put_contents("{$path}/{$name}.txt", uniqid("", true));
            }
            else
            {
                mkdir("{$path}/{$name}");
            }
        }

        # 尝试删除
        self::assertTrue(FileSystemHelper::deleteDir($dir));
        # 判断目录是否存在
        self::assertDirectoryNotExists($dir);
    }

    public function testDeleteFile()
    {
        $cacheFile = __DIR__ . "/../../../../cache/";
        if (!file_exists($cacheFile))
        {
            mkdir($cacheFile, 0777, true);
        }
        $cacheFile .= "/cachetmp_" . uniqid() . ".txt";
        file_put_contents($cacheFile, uniqid("", true));

        self::assertFalse(FileSystemHelper::deleteDir($cacheFile, false));
        self::assertFileExists($cacheFile);
        self::assertTrue(FileSystemHelper::deleteDir($cacheFile));
        self::assertFileNotExists($cacheFile);
    }
}

# end of file
