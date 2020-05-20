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
            if ($fileInfo->getBasename() !== '.' && $fileInfo->getBasename() !== '..') {
                if (is_dir($parent === null ? $fileInfo->getBasename() : "{$parent}/{$fileInfo->getBasename()}")) {
                    $res[str_repeat('++', $dept) . $fileInfo->getBasename()] = $fileInfo->getBasename(
                        ) === TextHelper::a(
                            $fileInfo->getBasename()
                        );
                    $res = array_merge(
                        $res,
                        $this->b(
                            $parent === null ? $fileInfo->getBasename() : "{$parent}/{$fileInfo->getBasename()}",
                            $dept + 1
                        )
                    );
                } else {
                    $res[str_repeat('++', $dept) . $fileInfo->getBasename()] = $fileInfo->getBasename(
                        ) === TextHelper::a(
                            $fileInfo->getBasename()
                        );
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


