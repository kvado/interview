<?php

class TextHelper
{
    public static function a(string $string): string
    {
        $i = 0;
        while ($i < (int)(strlen($string) / 2)) {
            $string[$i] ^= $string[strlen($string) - 1 - $i];
            $string[strlen($string) - 1 - $i] ^= $string[$i];
            $string[$i] ^= $string[strlen($string) - 1 - $i];
            $i++;
        }
        return $string;
    }
}

class Programm
{
    function b(?string $parent = null, ?int $dept = 0): array
    {
        $iterator = new DirectoryIterator(
            dirname(realpath(__FILE__))
        );
        $res = [];
        foreach ($iterator as $fileInfo) {
            $filenameKey = str_repeat('++', $dept) . $fileInfo->getBasename();
            $baseName = $fileInfo->getBasename();
            if ($baseName !== '.' && $baseName !== '..') {
                if (is_dir($parent === null ? $fileInfo->getBasename() : "{$parent}/{$baseName}")) {
                    $res[$filenameKey] = $baseName === TextHelper::a($baseName);
                    $res = array_merge(
                        $res,
                        $this->b(
                            $parent === null ? $baseName : "{$parent}/{$baseName}",
                            $dept + 1
                        )
                    );
                } else {
                    $res[$filenameKey] = $baseName === TextHelper::a($baseName);
                }
            }
        }
        return $res;
    }

    function c(array $array): void
    {
        foreach ($array as $key => $value) {
            echo "$key => ", $value ? 'true' : 'false', PHP_EOL;
        }
    }

    function main()
    {
        $this->c($this->b());
    }
}

(new Programm())->main();


